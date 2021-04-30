<?php
class ControllerModuleAutologin extends Controller
{

    private $base_name   = 'autologin';
    private $cookie_name = 'ALTKN';
    private $error       = false;

    public function __construct($registry)
    {
        parent::__construct($registry);

        if (version_compare(VERSION, '2.3', '>=')) {
            $oc_module_dir = 'extension/module/';
            $model_object  = 'model_extension_module_';
        } else {
            $oc_module_dir = 'module/';
            $model_object  = 'model_module_';
        }

        $this->module_path  = $oc_module_dir . $this->base_name;
        $this->model_object = $model_object . $this->base_name;
    }

    // Trigger: catalog/model/account/customer/deleteLoginAttempts/after
    public function add()
    {
        if ($this->config->get('module_autologin_status')) {

            $customer_id = $this->customer->getId();

            // Remove outdated autologins
            $this->removeOutdatedAutologins($customer_id);

            $autologin_enabled = true;

            if ($this->config->get('module_autologin_show_checkbox')) {
                if (isset($this->request->post['autologin_has_checkbox'])) {
                    if (!isset($this->request->post['autologin_remember_me'])) {
                        $autologin_enabled = false;
                    }
                }
            }

            if ($autologin_enabled) {
                // Generate a unique token
                $token = '';
                $range = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));

                for ($i = 0; $i < 40; $i++) {
                    $token .= $range[mt_rand(0, count($range) - 1)];
                }

                // Save token in cookie
                $this->setCookie($token);

                // Save Autologin data in DB
                $this->load->model('account/customer');
                $customer_info = $this->model_account_customer->getCustomer($customer_id);

                if (isset($this->request->server['HTTP_USER_AGENT'])) {
                    $user_agent = $this->request->server['HTTP_USER_AGENT'];
                } else {
                    $user_agent = '';
                }

                if ($customer_info) {
                    $autologin_data = array(
                        'customer_id' => $customer_id,
                        'email'       => $customer_info['email'],
                        'token'       => $token,
                        'ip'          => $customer_info['ip'],
                        'user_agent'  => $user_agent,
                    );

                    $this->load->model($this->module_path);
                    $this->{$this->model_object}->addAutologin($autologin_data);
                }
            }
        }
    }

    // Trigger: catalog/controller/account/logout/before
    public function remove()
    {
        if ($this->config->get('module_autologin_status')) {
            // Remove outdated autologins
            $this->removeOutdatedAutologins($this->customer->getId());

            // Remove current autologin
            if (isset($_COOKIE[$this->cookie_name]) && $_COOKIE[$this->cookie_name] != '') {
                $token = $_COOKIE[$this->cookie_name];

                $this->removeAutologin($token);
            }
        }
    }

    // Trigger: catalog/view/account/login/before
    public function add_input(&$route, &$data, &$output = null)
    {
        $data['autologin_status']        = $this->config->get('module_autologin_status');
        $data['autologin_show_checkbox'] = $this->config->get('module_autologin_show_checkbox');

        if ($this->config->get('module_autologin_checked_by_default')) {
            $data['autologin_checked'] = 'checked';
        } else {
            $data['autologin_checked'] = '';
        }

        if ($this->config->get('module_autologin_label_color')) {
            $data['autologin_label_color'] = $this->config->get('module_autologin_label_color');
        } else {
            $data['autologin_label_color'] = 'inherit';
        }

        $language_code = $this->session->data['language'];

        $autologin_label_text = $this->config->get('module_autologin_label_text');

        if (!empty($autologin_label_text[$language_code])) {
            $data['autologin_label_text'] = $autologin_label_text[$language_code];
        } else {
            $data['autologin_label_text'] = 'Remember me';
        }
    }

    // Trigger: catalog/controller/common/header/before
    public function autologin()
    {
        if ($this->config->get('module_autologin_status') && !$this->customer->isLogged()) {
            if (isset($_COOKIE[$this->cookie_name]) && $_COOKIE[$this->cookie_name] != '') {
                $token = $_COOKIE[$this->cookie_name];

                $this->load->model($this->module_path);
                $autologin_info = $this->{$this->model_object}->getAutologinByToken($token);

                if ($autologin_info && $token === $autologin_info['token'] && $this->validate($autologin_info)) {
                    // Clear Cart before login
                    $this->cart->clear();

                    // Login
                    $this->customer->login($autologin_info['email'], '', true);

                    // Unset guest
                    unset($this->session->data['guest']);

                    // Default Shipping Address
                    $this->load->model('account/address');

                    if ($this->config->get('config_tax_customer') == 'payment') {
                        $this->session->data['payment_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
                    }

                    if ($this->config->get('config_tax_customer') == 'shipping') {
                        $this->session->data['shipping_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
                    }

                    // Wishlist
                    if (isset($this->session->data['wishlist']) && is_array($this->session->data['wishlist'])) {
                        $this->load->model('account/wishlist');

                        foreach ($this->session->data['wishlist'] as $key => $product_id) {
                            $this->model_account_wishlist->addWishlist($product_id);
                            unset($this->session->data['wishlist'][$key]);
                        }
                    }

                    // Add to activity log
                    if ($this->config->get('config_customer_activity')) {
                        $this->load->model('account/activity');

                        $activity_data = array(
                            'customer_id' => $this->customer->getId(),
                            'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName(),
                        );

                        $this->model_account_activity->addActivity('login', $activity_data);
                    }

                    // Update Autologin
                    $this->{$this->model_object}->updateAutologin($token);

                    $this->setCookie($token);

                    // Remove outdated autologins
                    $this->removeOutdatedAutologins($this->customer->getId());

                    // One-time redirect
                    $this->response->redirect($_SERVER['REQUEST_URI']);
                } else {
                    $this->removeCookie();
                }
            }
        }
    }

    protected function setCookie($token)
    {
        $exp_days = (int) $this->config->get('module_autologin_expiration_time');
        $exp_time = ($exp_days > 0 ? $exp_days : 1) * 24 * 60 * 60;

        setcookie($this->cookie_name, $token, time() + $exp_time, "/", "", false, true);
    }

    protected function removeCookie()
    {
        unset($_COOKIE[$this->cookie_name]);
        setcookie($this->cookie_name, "", time() - 42000, "/", "", false, true);
    }

    protected function removeAutologin($token)
    {
        $this->load->model($this->module_path);
        $this->{$this->model_object}->removeAutologin($token);

        $this->removeCookie();
    }

    protected function removeOutdatedAutologins($customer_id)
    {
        $autologin_days = (int) $this->config->get('module_autologin_expiration_time');
        $autologin_time = $autologin_days * 24 * 60 * 60;

        $this->load->model($this->module_path);
        $autologins = $this->{$this->model_object}->getAutologinsByCustomerId($customer_id);

        foreach ($autologins as $autologin) {
            if (strtotime($autologin['date_modified']) + $autologin_time < time()) {
                $this->{$this->model_object}->removeAutologin($autologin['token']);
            }
        }
    }

    protected function validate($autologin_info)
    {
        $this->load->model('account/customer');

        $customer_info = $this->model_account_customer->getCustomer($autologin_info['customer_id']);

        if ($customer_info) {
            // Check the customer status.
            if (!$customer_info['status']) {
                $this->error = true;
            }

            // Check if customer has been approved.
            if (version_compare(VERSION, '3.0', '<')) {
                if (!$customer_info['approved']) {
                    $this->error = true;
                }
            }

            // Check if Autologin has expired.
            $autologin_days = (int) $this->config->get('module_autologin_expiration_time');
            $autologin_time = $autologin_days * 24 * 60 * 60;

            if (strtotime($autologin_info['date_modified']) + $autologin_time < time()) {
                $this->error = true;
            }

            // Check if customer's email has been changed.
            if ($autologin_info['email'] !== $customer_info['email']) {
                $this->error = true;
            }

            // Check the User-agent.
            if ($this->config->get('module_autologin_check_user_agent')) {
                if (isset($this->request->server['HTTP_USER_AGENT'])) {
                    $user_agent = $this->request->server['HTTP_USER_AGENT'];
                } else {
                    $user_agent = '';
                }

                if (empty($user_agent) || ($user_agent !== $autologin_info['user_agent'])) {
                    $this->error = true;
                }
            }

            // Check the IP address.
            if ($this->config->get('module_autologin_check_ip')) {
                if ($autologin_info['ip'] !== $customer_info['ip']) {
                    $this->error = true;
                }
            }
        } else {
            $this->error = true;
        }

        if ($this->error) {
            $this->removeAutologin($autologin_info['token']);
        }

        return !$this->error;
    }
}
