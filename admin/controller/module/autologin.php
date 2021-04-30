<?php
class ControllerModuleAutologin extends Controller
{

    private $module_title   = 'AutoLogin';
    private $module_version = '1.0.7';
    private $founded        = '2016';
    private $author         = 'MagDevel';
    private $support_email  = 'magdeveloper2@gmail.com';

    private $base_name = 'autologin';
    private $error     = array();

    public function __construct($registry)
    {
        parent::__construct($registry);

        if (version_compare(VERSION, '3.0', '>=')) {
            $oc_module_dir        = 'extension/module';
            $this->extension_dir  = 'marketplace/extension';
            $this->token_url      = 'user_token=' . $this->session->data['user_token'];
            $this->extension_type = '&type=module';
            $this->model_object   = 'model_extension_module_' . $this->base_name;
            $this->tpl_ext        = '';
        } elseif (version_compare(VERSION, '2.3', '>=')) {
            $oc_module_dir        = 'extension/module';
            $this->extension_dir  = 'extension/extension';
            $this->token_url      = 'token=' . $this->session->data['token'];
            $this->extension_type = '&type=module';
            $this->model_object   = 'model_extension_module_' . $this->base_name;
            $this->tpl_ext        = '.tpl';
        } else {
            $oc_module_dir        = 'module';
            $this->extension_dir  = 'extension/module';
            $this->token_url      = 'token=' . $this->session->data['token'];
            $this->extension_type = '';
            $this->model_object   = 'model_module_' . $this->base_name;
            $this->tpl_ext        = '.tpl';
        }

        $this->module_path  = $oc_module_dir . '/' . $this->base_name;
        $this->setting_code = 'module_' . $this->base_name;
    }

    public function index()
    {
        $this->load->language($this->module_path);

        $data['text_module_version'] = $this->language->get('text_module_version');
        $data['text_get_support']    = $this->language->get('text_get_support');

        if ($this->founded < date('Y')) {
            $copyright_years = $this->founded . '-' . date('Y');
        } else {
            $copyright_years = $this->founded;
        }

        $data['text_copyright'] = $this->author . ' © ' . $copyright_years;
        $data['module_version'] = $this->module_version;
        $data['support_href']   = 'mailto:' . $this->support_email . '?Subject=Request Support: ' . $this->module_title . '&body=Shop: ' . HTTP_CATALOG . ', OpenCart: ' . VERSION . ', ' . $this->module_title . ': ' . $this->module_version;

        $this->document->setTitle(strip_tags($this->language->get('heading_title')));

        $this->load->model('setting/setting');

        $settings = array();

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $settings = $this->request->post;
            foreach ($settings as $key => $value) {
                $config_key            = $this->setting_code . '_' . $key;
                $settings[$config_key] = $value;
            }
            $this->model_setting_setting->editSetting($this->setting_code, $settings);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link($this->extension_dir, $this->token_url . $this->extension_type, 'SSL'));
        }

        $data['apply_url']  = $this->url->link($this->module_path . '/apply&' . $this->token_url, '', 'SSL');
        $data['reload_url'] = $this->url->link($this->module_path . '/index&' . $this->token_url, '', 'SSL');

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', $this->token_url, 'SSL'),
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link($this->extension_dir, $this->token_url . $this->extension_type, 'SSL'),
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link($this->module_path, $this->token_url, 'SSL'),
        );

        $data['action'] = $this->url->link($this->module_path, $this->token_url, 'SSL');
        $data['cancel'] = $this->url->link($this->extension_dir, $this->token_url . $this->extension_type, 'SSL');

        // Get Language
        $data['heading_title']    = $this->language->get('heading_title');
        $data['text_module']      = $this->language->get('text_module');
        $data['button_save']      = $this->language->get('button_save');
        $data['button_apply']     = $this->language->get('button_apply');
        $data['button_cancel']    = $this->language->get('button_cancel');
        $data['button_reset']     = $this->language->get('button_reset');
        $data['text_success']     = $this->language->get('text_success');
        $data['error_permission'] = $this->language->get('error_permission');
        $data['text_edit']        = $this->language->get('text_edit');
        $data['text_default']     = $this->language->get('text_default');
        $data['text_custom']      = $this->language->get('text_custom');
        $data['text_enabled']     = $this->language->get('text_enabled');
        $data['text_disabled']    = $this->language->get('text_disabled');
        $data['text_confirm']     = $this->language->get('text_confirm');
        $data['text_general']     = $this->language->get('text_general');
        $data['text_additional']  = $this->language->get('text_additional');

        $data['entry_status']             = $this->language->get('entry_status');
        $data['entry_expiration_time']    = $this->language->get('entry_expiration_time');
        $data['entry_check_user_agent']   = $this->language->get('entry_check_user_agent');
        $data['entry_check_ip']           = $this->language->get('entry_check_ip');
        $data['entry_show_checkbox']      = $this->language->get('entry_show_checkbox');
        $data['entry_remember_me']        = $this->language->get('entry_remember_me');
        $data['text_remember_me']         = $this->language->get('text_remember_me');
        $data['entry_checked_by_default'] = $this->language->get('entry_checked_by_default');
        $data['text_checked']             = $this->language->get('text_checked');
        $data['text_unchecked']           = $this->language->get('text_unchecked');
        $data['entry_label_color']        = $this->language->get('entry_label_color');

        $data['text_module_version'] = $this->language->get('text_module_version');
        $data['text_get_support']    = $this->language->get('text_get_support');

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages(array('sort' => 'code'));

        foreach ($data['languages'] as $key => $language) {
            if (version_compare(VERSION, '2.2', '>=')) {
                $get_flag = 'language/' . $language['code'] . '/' . $language['code'] . '.png';
            } else {
                $get_flag = 'view/image/flags/' . $language['image'];
            }
            if (is_file($get_flag)) {
                $flag_img = $get_flag;
            } else {
                $flag_img = '';
            }
            $data['languages'][$key]['flag_img'] = $flag_img;
        }

        $configs = array(
            'status'             => '0',
            'expiration_time'    => '30',
            'check_user_agent'   => '0',
            'check_ip'           => '0',
            'show_checkbox'      => '1',
            'checked_by_default' => '0',
            'label_text'         => array(),
            'label_color'        => '',
            'custom_css_code'    => '',
        );

        foreach ($configs as $key => $value) {
            $config_key = $this->setting_code . '_' . $key;
            if (isset($this->request->post[$key])) {
                $data[$key] = $this->request->post[$key];
            } elseif ($this->config->get($config_key) !== null) {
                $data[$key] = $this->config->get($config_key);
            } else {
                $data[$key] = $value;
            }
        }

        $this->document->addStyle('view/javascript/' . $this->base_name . '/minicolors/jquery.minicolors.css');
        $this->document->addScript('view/javascript/' . $this->base_name . '/minicolors/jquery.minicolors.min.js');

        $data['header']      = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer']      = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view($this->module_path . $this->tpl_ext, $data));
    }

    public function apply()
    {
        $settings = $this->request->post;
        $json     = array();

        $this->load->language($this->module_path);
        $this->load->model('setting/setting');

        if ($this->validate()) {
            foreach ($settings as $key => $value) {
                $config_key            = $this->setting_code . '_' . $key;
                $settings[$config_key] = $value;
            }
            $this->model_setting_setting->editSetting($this->setting_code, $settings);
            $json['success'] = $this->language->get('text_success') . ' ----- [' . date("Y-m-d, H:i:s") . ']';
        } else {
            $json['error'] = $this->error['warning'] . ' ----- [' . date("Y-m-d, H:i:s") . ']';
        }

        $this->response->addHeader('Content-Type: application/json; charset=utf-8');
        $this->response->setOutput(json_encode($json));
    }

    protected function validate()
    {
        if (!$this->user->hasPermission('modify', $this->module_path)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    // Trigger: admin/model/customer/customer/deleteCustomer/before
    public function deleteCustomer($route, $args, $output = null)
    {
        if (version_compare(VERSION, '2.3', '>=')) {
            $customer_id = $args[0];
        } else {
            $customer_id = $args;
        }

        $this->load->model($this->module_path);
        $this->{$this->model_object}->deleteCustomer($customer_id);
    }

    public function install()
    {
        $this->load->model($this->module_path);

        $this->{$this->model_object}->createTable();

        if (version_compare(VERSION, '3.0', '>=')) {
            $this->load->model('setting/event');
            $this->model_setting_event->addEvent($this->base_name, 'catalog/model/account/customer/deleteLoginAttempts/after', $this->module_path . '/add');
            $this->model_setting_event->addEvent($this->base_name, 'catalog/controller/account/logout/before', $this->module_path . '/remove');
            $this->model_setting_event->addEvent($this->base_name, 'catalog/controller/common/header/before', $this->module_path . '/autologin');
            $this->model_setting_event->addEvent($this->base_name, 'catalog/view/account/login/before', $this->module_path . '/add_input');
            $this->model_setting_event->addEvent($this->base_name, 'catalog/view/checkout/login/before', $this->module_path . '/add_input');
            $this->model_setting_event->addEvent($this->base_name, 'admin/model/customer/customer/deleteCustomer/before', $this->module_path . '/deleteCustomer');
        } elseif (version_compare(VERSION, '2.2', '>=')) {
            $this->load->model('extension/event');
            $this->model_extension_event->addEvent($this->base_name, 'catalog/model/account/customer/deleteLoginAttempts/after', $this->module_path . '/add');
            $this->model_extension_event->addEvent($this->base_name, 'catalog/controller/account/logout/before', $this->module_path . '/remove');
            $this->model_extension_event->addEvent($this->base_name, 'catalog/controller/common/header/before', $this->module_path . '/autologin');
            $this->model_extension_event->addEvent($this->base_name, 'catalog/view/account/login/before', $this->module_path . '/add_input');
            $this->model_extension_event->addEvent($this->base_name, 'catalog/view/checkout/login/before', $this->module_path . '/add_input');
            $this->model_extension_event->addEvent($this->base_name, 'admin/model/customer/customer/deleteCustomer/before', $this->module_path . '/deleteCustomer');
        } else {
            $this->load->model('extension/event');
            $this->model_extension_event->addEvent($this->base_name, 'post.customer.login', $this->module_path . '/add');
            $this->model_extension_event->addEvent($this->base_name, 'pre.customer.logout', $this->module_path . '/remove');
        }
    }

    public function uninstall()
    {
        $this->load->model($this->module_path);

        $this->{$this->model_object}->removeTable();

        if (version_compare(VERSION, '3.0', '>=')) {
            $this->load->model('setting/event');
            $this->model_setting_event->deleteEventByCode($this->base_name);
        } else {
            $this->load->model('extension/event');
            $this->model_extension_event->deleteEvent($this->base_name);
        }

        $this->load->model('setting/store');
        $this->load->model('setting/setting');

        $this->model_setting_setting->deleteSetting($this->setting_code, 0);

        $stores = $this->model_setting_store->getStores();

        foreach ($stores as $store) {
            $this->model_setting_setting->deleteSetting($this->setting_code, $store['store_id']);
        }
    }
}
