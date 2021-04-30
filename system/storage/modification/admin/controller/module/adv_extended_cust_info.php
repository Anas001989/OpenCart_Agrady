<?php
class ControllerModuleAdvExtendedCustInfo extends Controller {
	private $error = array(); 

	public function index() { 

$data['adv_current_version'] = '3.0';
            
		$query = $this->db->query("DESC " . DB_PREFIX . "customer note");
			if (!$query->num_rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "customer` ADD `note` text NOT NULL AFTER `ip`;");
			}
			
		$this->load->language('module/adv_extended_cust_info');
		
		$this->document->setTitle($this->language->get('heading_title_main'));

	  	$this->document->addScript('view/javascript/bootstrap/js/bootstrap-multiselect.js');
	    $this->document->addStyle('view/javascript/bootstrap/css/bootstrap-multiselect.css');
		
		if (!isset($_POST['acode']) && !isset($_POST['deact']) && ($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {		
			$this->model_setting_setting->editSetting('adveci', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], true));
		}
		
		}
		
		$data['heading_title_main'] = $this->language->get('heading_title_main');
		$data['text_edit'] = $this->language->get('text_edit');
			
		$data['tab_settings'] = $this->language->get('tab_settings');
		$data['tab_about'] = $this->language->get('tab_about');

		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all'] = $this->language->get('text_all');
		$data['text_selected'] = $this->language->get('text_selected');		
		$data['text_all_statuses'] = $this->language->get('text_all_statuses');

		$data['text_clist_settings'] = $this->language->get('text_clist_settings');
		$data['text_clist_orders_status'] = $this->language->get('text_clist_orders_status');
		$data['text_clist_total_value_status'] = $this->language->get('text_clist_total_value_status');
		$data['text_cust_order_value_ostatus'] = $this->language->get('text_cust_order_value_ostatus');
		$data['text_ct_settings'] = $this->language->get('text_ct_settings');
		$data['text_customer_track_status'] = $this->language->get('text_customer_track_status');
		$data['text_purchased_settings'] = $this->language->get('text_purchased_settings');
		$data['text_purchased_status'] = $this->language->get('text_purchased_status');
		$data['text_local_settings'] = $this->language->get('text_local_settings');
		$data['text_format_date'] = $this->language->get('text_format_date');
		$data['text_format_date_eu'] = $this->language->get('text_format_date_eu');
		$data['text_format_date_us'] = $this->language->get('text_format_date_us');
		$data['text_format_hour'] = $this->language->get('text_format_hour');
		$data['text_format_hour_24'] = $this->language->get('text_format_hour_24');
		$data['text_format_hour_12'] = $this->language->get('text_format_hour_12');	
		
		$data['text_help_request'] = $this->language->get('text_help_request');
		$data['text_asking_help'] = $this->language->get('text_asking_help');		
		$data['text_terms'] = $this->language->get('text_terms');		

		$data['ldata'] = FALSE;	
		$data['laccess'] = '';

		if (!file_exists(DIR_APPLICATION . 'model/module/adv_settings.php')) {
			$data['module_page'] = $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], true));
		}
		
		$data['error_permission'] = $this->language->get('error_permission');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');			
		$data['button_documentation'] = $this->language->get('button_documentation');

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);			
		} else {
			$data['success'] = '';
		}

		if (isset($this->session->data['warning'])) {
			$data['warning'] = $this->session->data['warning'];
			unset($this->session->data['warning']);			
		} else {
			$data['warning'] = '';
		}
		

		$data['adv_text_ext_name'] = $this->language->get('adv_text_ext_name');
		$data['adv_ext_name'] = $this->language->get('adv_ext_name');
		$data['adv_ext_short_name'] = 'adv_extended_cust_info';
		$data['adv_text_instal_version'] = $this->language->get('adv_text_instal_version');
		$data['adv_text_latest_version'] = $this->language->get('adv_text_latest_version');
		$data['adv_ext_version'] = $this->language->get('adv_ext_version');
		$data['adv_ext_type'] = $this->language->get('adv_ext_type');
		$data['adv_text_ext_compatibility'] = $this->language->get('adv_text_ext_compatibility');
		$data['adv_ext_compatibility'] = $this->language->get('adv_ext_compatibility');
		$data['adv_text_ext_url'] = $this->language->get('adv_text_ext_url');
		$data['adv_ext_url'] = 'https://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=3292';
		$data['adv_all_ext_url'] = 'https://www.opencart.com/index.php?route=marketplace/extension&filter_member=cmerry';
		$data['adv_help_url'] = 'http://www.opencartreports.com/documentation/eci/index.html#support';
		$data['adv_legal_notice_url'] = 'http://www.opencartreports.com/documentation/eci/index.html#terms';		
		$data['adv_text_reg_info'] = $this->language->get('adv_text_reg_info');
		$data['adv_text_reg_status'] = $this->language->get('adv_text_reg_status');
		$data['adv_text_ext_support'] = $this->language->get('adv_text_ext_support');
		$data['adv_ext_support'] = $this->language->get('adv_ext_support');
		$data['adv_ext_subject'] = sprintf($this->language->get('adv_ext_subject'), $this->language->get('adv_ext_name'));
		$data['adv_text_ext_legal'] = $this->language->get('adv_text_ext_legal');	
		$data['adv_text_copyright'] = $this->language->get('adv_text_copyright');
		$data['auth'] = TRUE;
		$data['servers'] = '';	
            
		$data['token'] = $this->session->data['token'];
		
  		$data['breadcrumbs'] = array();
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)

   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], true)
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title_main'),
			'href'      => $this->url->link('module/adv_extended_cust_info', 'token=' . $this->session->data['token'], true)
   		);
		
		$data['action'] = $this->url->link('module/adv_extended_cust_info', 'token=' . $this->session->data['token'], true);
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], true);

		if (isset($this->request->post['adveci_clist_orders_status'])) {
			$data['adveci_clist_orders_status'] = $this->request->post['adveci_clist_orders_status'];
		} else {
			$data['adveci_clist_orders_status'] = $this->config->get('adveci_clist_orders_status');
		}

		if (isset($this->request->post['adveci_clist_total_value_status'])) {
			$data['adveci_clist_total_value_status'] = $this->request->post['adveci_clist_total_value_status'];
		} else {
			$data['adveci_clist_total_value_status'] = $this->config->get('adveci_clist_total_value_status');
		}
		
		$this->load->model('customer/customer');
		$data['order_statuses'] = $this->model_customer_customer->getOrderStatuses(); 	
		
		if (isset($this->request->post['adveci_order_value_status'])) {
			$data['adveci_order_value_status'] = $this->request->post['adveci_order_value_status'];
		} else {
			$data['adveci_order_value_status'] = $this->config->get('adveci_order_value_status');
		}

		if (isset($this->request->post['adveci_purchased_status'])) {
			$data['adveci_purchased_status'] = $this->request->post['adveci_purchased_status'];
		} else {
			$data['adveci_purchased_status'] = $this->config->get('adveci_purchased_status');
		}
		
		if (isset($this->request->post['adveci_customer_track'])) {
			$data['adveci_customer_track'] = $this->request->post['adveci_customer_track'];
		} else {
			$data['adveci_customer_track'] = $this->config->get('adveci_customer_track');
		}
		
		if (isset($this->request->post['adveci_date_format'])) {
			$data['adveci_date_format'] = $this->request->post['adveci_date_format'];
		} else {
			$data['adveci_date_format'] = $this->config->get('adveci_date_format');
		}

		if (isset($this->request->post['adveci_hour_format'])) {
			$data['adveci_hour_format'] = $this->request->post['adveci_hour_format'];
		} else {
			$data['adveci_hour_format'] = $this->config->get('adveci_hour_format');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


		$adv_check = curl_init();
 		     // Set URL to download
		curl_setopt($adv_check, CURLOPT_URL,"http://opencartreports.com/version/adv_eci_version.xml");
 		    // Include header in result? (0 = yes, 1 = no)
		curl_setopt($adv_check, CURLOPT_HEADER, 0);
     		// Should cURL return or print out the data? (true = return, false = print)
		curl_setopt($adv_check, CURLOPT_RETURNTRANSFER, true);
 		    // Timeout in seconds
		curl_setopt($adv_check, CURLOPT_TIMEOUT, 10);
 		    // Download the given URL, and return output
		$adv_output = curl_exec($adv_check);
    		// Close the cURL resource, and free system resources
 		curl_close($adv_check);
		$adv_analyse = simplexml_load_string($adv_output,null);
		if ($adv_output != FALSE) {				
		$data['version'] = $adv_analyse->children()->version;
		$data['whats_new'] = $adv_analyse->children()->whats_new;
		}
            
		$this->response->setOutput($this->load->view('module/adv_extended_cust_info.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/adv_extended_cust_info')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
			
		return !$this->error;	
	}
	
	public function install(){
		$query = $this->db->query("DESC " . DB_PREFIX . "customer note");
			if (!$query->num_rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "customer` ADD `note` text NOT NULL AFTER `ip`;");
			}
			
		// Optimize all tables
		//$alltables = mysql_query("SHOW TABLES");
		//while ($table = mysql_fetch_assoc($alltables)) {
		//	foreach ($table as $db => $tablename) {
		//		mysql_query("OPTIMIZE TABLE `" . $tablename . "`")
		//		or die(mysql_error());
		//	}
		//}
		
		// Add indexes
		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "order_product` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order_product` ADD INDEX (product_id,total,price,tax,quantity);");
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order_product` ADD INDEX (order_id);");
			}	
			
		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "order_total` WHERE Key_name != 'PRIMARY' AND Key_name != 'idx_orders_total_orders_id';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order_total` ADD INDEX (order_id,value,code);");
			}	
			
		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "order_option` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order_option` ADD INDEX (order_product_id,type,name,product_option_value_id);");
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order_option` ADD INDEX (order_id);");
			}
			
		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "order_history` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order_history` ADD INDEX (order_status_id);");
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order_history` ADD INDEX (order_id);");
			}
			
		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "order` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD INDEX (customer_id,date_added,total,email,firstname,lastname,payment_company);");
			}

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "product` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "product` ADD INDEX (product_id,model,sku,manufacturer_id,sort_order,status);");
			}	

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "category` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "category` ADD INDEX (category_id,parent_id);");
			}	

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "option` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "option` ADD INDEX (sort_order);");
			}
			
		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "option_description` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "option_description` ADD INDEX (name);");
			}	

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "option_value` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "option_value` ADD INDEX (option_id,sort_order);");
			}

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "option_value_description` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "option_value_description` ADD INDEX (option_id,name);");
			}

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "product_option` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "product_option` ADD INDEX (product_id,option_id);");
			}

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "product_option_value` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "product_option_value` ADD INDEX (product_id,option_id,option_value_id,quantity,price);");
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "product_option_value` ADD INDEX (product_option_id);");
			}

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "return` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "return` ADD INDEX (order_id);");
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "return` ADD INDEX (product_id);");
			}	

		$query = $this->db->query("SHOW KEYS FROM `" . DB_PREFIX . "customer_reward` WHERE Key_name != 'PRIMARY';");
			if (!$query->rows) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "customer_reward` ADD INDEX (order_id);");
			}
			
        $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "customer_track'");
        	if (!$query->num_rows) {
            	$this->db->query("
                	CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "customer_track` (
					  `customer_track_id` INT(10) NOT NULL AUTO_INCREMENT,
					  `route` VARCHAR(100) NOT NULL,
					  `ip_address` VARCHAR(15) NOT NULL,
					  `customer_id` INT(11) NOT NULL,
					  `current_url` TINYTEXT NOT NULL,
					  `referrer` TINYTEXT NOT NULL,
					  `agent_type` VARCHAR(200) NOT NULL,
					  `access_time` DATETIME NOT NULL,
					  PRIMARY KEY (`customer_track_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
            	");
			} 
			
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "modification` MODIFY COLUMN `xml` mediumtext NOT NULL;");
			
		$this->load->model('user/user_group');
		$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'module/adv_extended_cust_info');
		$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'module/adv_extended_cust_info');	
	}
}