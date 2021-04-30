<?php
class ControllerModuleGoToCart extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('module/go_to_cart');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('go_to_cart', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], true));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_label_text'] = $this->language->get('text_label_text');
        $data['text_label_color'] = $this->language->get('text_label_color');

        $data['entry_status'] = $this->language->get('entry_status');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

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
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'] . '&type=module', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/go_to_cart', 'token=' . $this->session->data['token'], true)
        );

        $data['action'] = $this->url->link('module/go_to_cart', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'] . '&type=module', true);

        if (isset($this->request->post['go_to_cart_button_color'])) {
            $data['go_to_cart_button_color'] = $this->request->post['go_to_cart_button_color'];
        } else {
            $data['go_to_cart_button_color'] = $this->config->get('go_to_cart_button_color');
        }

        if (isset($this->request->post['go_to_cart_button_text_color'])) {
            $data['go_to_cart_button_text_color'] = $this->request->post['go_to_cart_button_text_color'];
        } else {
            $data['go_to_cart_button_text_color'] = $this->config->get('go_to_cart_button_text_color');
        }

        if (isset($this->request->post['go_to_cart_status'])) {
            $data['go_to_cart_status'] = $this->request->post['go_to_cart_status'];
        } else {
            $data['go_to_cart_status'] = $this->config->get('go_to_cart_status');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/go_to_cart.tpl', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/go_to_cart')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
    public function install() {
        $insert_data=array(
            'go_to_cart_button_color'=>"#1cbfef",
            'go_to_cart_button_text_color'=>"#ffffff",
        );
        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('go_to_cart',$insert_data);

    }

    public function uninstall() {
        $this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting('go_to_cart');

    }
}