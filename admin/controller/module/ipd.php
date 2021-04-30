<?php 
#################################################################
## Leandro R.P.P.O - Support:sw-ad@hotmail.com			       ##
## Manuella - with all my love                                 ##
#################################################################
class ControllerModuleipd extends Controller {
	
	private $error = array(); 

	public function index() {
		
		$this->load->language('module/ipd');

		$this->document->setTitle($this->language->get('heading_title_ipd'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('ipd', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], true));

		}
		
		$text_array = array('heading_title','see_modification','heading_title_ipd','entry_ipdsaleorder','entry_ipdcart','entry_ipdbtnorder','entry_ipdinvoice','entry_ipdshipping','entry_ipdclientorder','entry_ipdconfirm','entry_ipdemailorder','text_help_ipdsaleorder','text_help_ipdbtnorder','text_help_ipdinvoice','text_help_ipdshipping','text_help_ipdclientorder','text_help_ipdconfirm','text_help_ipdemailorder','text_edit','text_enabled','text_disabled','text_on','text_off','entry_status','button_save','button_cancel','text_yes','text_no');
		
		foreach($text_array as $key){
			$data[$key] = $this->language->get($key);
		}
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		      
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], true)
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], true)
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title_ipd'),
			'href'      => $this->url->link('module/ipd', 'token=' . $this->session->data['token'], true)
   		);
				
		$data['action'] = $this->url->link('module/ipd', 'token=' . $this->session->data['token'], true);
		
		$data['cancel'] = $this->url->link('module/ipd', 'token=' . $this->session->data['token'], true);

		$this->load->language('common/menu');
 
		$data['modification'] = $this->url->link('extension/modification', 'token=' . $this->session->data['token'], true);

		$data['text_modification'] = $this->language->get('text_modification');

		if (isset($this->request->post['ipd'])) {
			$data['ipd'] = $this->request->post['ipd'];
		} else {
			$data['ipd'] = $this->config->get('ipd');
		}
		if (isset($this->request->post['ipdsaleorder'])) {
			$data['ipdsaleorder'] = $this->request->post['ipdsaleorder'];
		} else {
			$data['ipdsaleorder'] = $this->config->get('ipdsaleorder');
		}
		if (isset($this->request->post['ipdbtnorder'])) {
			$data['ipdbtnorder'] = $this->request->post['ipdbtnorder'];
		} else {
			$data['ipdbtnorder'] = $this->config->get('ipdbtnorder');
		}
        if (isset($this->request->post['ipdinvoice'])) {
			$data['ipdinvoice'] = $this->request->post['ipdinvoice'];
		} else {
			$data['ipdinvoice'] = $this->config->get('ipdinvoice');
		}
		if (isset($this->request->post['ipdclientorder'])) {
			$data['ipdclientorder'] = $this->request->post['ipdclientorder'];
		} else {
			$data['ipdclientorder'] = $this->config->get('ipdclientorder');
		}
		if (isset($this->request->post['ipdshipping'])) {
			$data['ipdshipping'] = $this->request->post['ipdshipping'];
		} else {
			$data['ipdshipping'] = $this->config->get('ipdshipping');
		}
		if (isset($this->request->post['ipdconfirm'])) {
			$data['ipdconfirm'] = $this->request->post['ipdconfirm'];
		} else {
			$data['ipdconfirm'] = $this->config->get('ipdconfirm');
		}
		if (isset($this->request->post['ipdemailorder'])) {
			$data['ipdemailorder'] = $this->request->post['ipdemailorder'];
		} else {
			$data['ipdemailorder'] = $this->config->get('ipdemailorder');
		}
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], true);
	

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('module/ipd.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/ipd')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;	
		
	}	
}

?>