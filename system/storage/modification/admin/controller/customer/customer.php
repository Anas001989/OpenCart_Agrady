<?php
class ControllerCustomerCustomer extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('customer/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/customer');

		$this->getList();
	}

	public function add() {
		$this->load->language('customer/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_customer_customer->addCustomer($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('customer/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_customer_customer->editCustomer($this->request->get['customer_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('customer/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/customer');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $customer_id) {
				$this->model_customer_customer->deleteCustomer($customer_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	public function approve() {
		$this->load->language('customer/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/customer');

		$customers = array();

		if (isset($this->request->post['selected'])) {
			$customers = $this->request->post['selected'];
		} elseif (isset($this->request->get['customer_id'])) {
			$customers[] = $this->request->get['customer_id'];
		}

		if ($customers && $this->validateApprove()) {
			$this->model_customer_customer->approve($this->request->get['customer_id']);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	public function unlock() {
		$this->load->language('customer/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/customer');

		if (isset($this->request->get['email']) && $this->validateUnlock()) {
			$this->model_customer_customer->deleteLoginAttempts($this->request->get['email']);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {

		if (!$this->IsInstalled()) {		
			$this->session->data['error_eci'] = $this->language->get('error_installed');
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], true));		
		}	
            
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_email'])) {
			$filter_email = $this->request->get['filter_email'];
		} else {
			$filter_email = null;
		}

		if (isset($this->request->get['filter_customer_group_id'])) {
			$filter_customer_group_id = $this->request->get['filter_customer_group_id'];
		} else {
			$filter_customer_group_id = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['filter_approved'])) {
			$filter_approved = $this->request->get['filter_approved'];
		} else {
			$filter_approved = null;
		}

		if (isset($this->request->get['filter_ip'])) {
			$filter_ip = $this->request->get['filter_ip'];
		} else {
			$filter_ip = null;
		}

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_customer_group_id'])) {
			$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_approved'])) {
			$url .= '&filter_approved=' . $this->request->get['filter_approved'];
		}

		if (isset($this->request->get['filter_ip'])) {
			$url .= '&filter_ip=' . $this->request->get['filter_ip'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('customer/customer/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('customer/customer/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['customers'] = array();

		$filter_data = array(
			'filter_name'              => $filter_name,
			'filter_email'             => $filter_email,
			'filter_customer_group_id' => $filter_customer_group_id,
			'filter_status'            => $filter_status,
			'filter_approved'          => $filter_approved,
			'filter_date_added'        => $filter_date_added,
			'filter_ip'                => $filter_ip,
			'sort'                     => $sort,
			'order'                    => $order,
			'start'                    => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                    => $this->config->get('config_limit_admin')
		);

		$customer_total = $this->model_customer_customer->getTotalCustomers($filter_data);

		$results = $this->model_customer_customer->getCustomers($filter_data);

		foreach ($results as $result) {
			if (!$result['approved']) {
				$approve = $this->url->link('customer/customer/approve', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'] . $url, true);
			} else {
				$approve = '';
			}

			$login_info = $this->model_customer_customer->getTotalLoginAttempts($result['email']);

			if ($login_info && $login_info['total'] >= $this->config->get('config_login_attempts')) {
				$unlock = $this->url->link('customer/customer/unlock', 'token=' . $this->session->data['token'] . '&email=' . $result['email'] . $url, true);
			} else {
				$unlock = '';
			}

			$data['customers'][] = array(

				'total_orders' 	 => $this->config->get('adveci_clist_orders_status') == '1' ? ($result['total_orders'] ? $result['total_orders'] : 0) : '',
				'total_value' 	 => $this->config->get('adveci_clist_total_value_status') == '1' ? ($this->currency->format($result['total_value'], $this->config->get('config_currency'))) : '',
            
				'customer_id'    => $result['customer_id'],
				'name'           => $result['name'],
				'email'          => $result['email'],
				'customer_group' => $result['customer_group'],
				'status'         => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'ip'             => $result['ip'],
				'date_added'     => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'approve'        => $approve,
				'unlock'         => $unlock,
				'edit'           => $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_email'] = $this->language->get('column_email');
		$data['column_customer_group'] = $this->language->get('column_customer_group');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_approved'] = $this->language->get('column_approved');
		$data['column_ip'] = $this->language->get('column_ip');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_approved'] = $this->language->get('entry_approved');
		$data['entry_ip'] = $this->language->get('entry_ip');
		$data['entry_date_added'] = $this->language->get('entry_date_added');


		$data['adveci_clist_orders_status'] = $this->config->get('adveci_clist_orders_status');
		$data['adveci_clist_total_value_status'] = $this->config->get('adveci_clist_total_value_status');
					
		$data['auth'] = TRUE;
		$data['ldata'] = FALSE;
		$data['adv_ext_name'] = $this->language->get('adv_ext_name');
		$data['adv_ext_short_name'] = 'adv_extended_cust_info';
		$data['adv_ext_version'] = $this->language->get('adv_ext_version');	
		$data['adv_ext_url'] = 'https://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=3292';	

		if (!file_exists(DIR_APPLICATION . 'model/module/adv_settings.php')) {
			$data['module_page'] = $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], true));
		}	
							
		$data['column_total_value'] = $this->language->get('column_total_value');
		$data['column_total_orders'] = $this->language->get('column_total_orders');
		
		$data['access_permission2'] = $this->user->hasPermission('access', 'module/adv_extended_cust_info');
            
		$data['button_approve'] = $this->language->get('button_approve');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_login'] = $this->language->get('button_login');
		$data['button_unlock'] = $this->language->get('button_unlock');

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_customer_group_id'])) {
			$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_approved'])) {
			$url .= '&filter_approved=' . $this->request->get['filter_approved'];
		}

		if (isset($this->request->get['filter_ip'])) {
			$url .= '&filter_ip=' . $this->request->get['filter_ip'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_email'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.email' . $url, true);
		$data['sort_customer_group'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=customer_group' . $url, true);
		$data['sort_status'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.status' . $url, true);
		$data['sort_ip'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.ip' . $url, true);
		$data['sort_date_added'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.date_added' . $url, true);

		$data['sort_total_orders'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=total_orders' . $url, true);
		$data['sort_total_value'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=total_value' . $url, true);
            

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_customer_group_id'])) {
			$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_approved'])) {
			$url .= '&filter_approved=' . $this->request->get['filter_approved'];
		}

		if (isset($this->request->get['filter_ip'])) {
			$url .= '&filter_ip=' . $this->request->get['filter_ip'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $customer_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($customer_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($customer_total - $this->config->get('config_limit_admin'))) ? $customer_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $customer_total, ceil($customer_total / $this->config->get('config_limit_admin')));

		$data['filter_name'] = $filter_name;
		$data['filter_email'] = $filter_email;
		$data['filter_customer_group_id'] = $filter_customer_group_id;
		$data['filter_status'] = $filter_status;
		$data['filter_approved'] = $filter_approved;
		$data['filter_ip'] = $filter_ip;
		$data['filter_date_added'] = $filter_date_added;

		$this->load->model('customer/customer_group');

		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('customer/customer_list', $data));
	}


	public function filter_orders() {
	  $data['customer_id'] = isset($this->request->get['customer_id']);	
			
	  if (isset($this->request->get['customer_id'])) {
		
		$json = array();

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['filter_orders_date_start'])) {
			$filter_orders_date_start = $this->request->get['filter_orders_date_start'];
		} else {
			$filter_orders_date_start = '';
		}

		if (isset($this->request->get['filter_orders_date_end'])) {
			$filter_orders_date_end = $this->request->get['filter_orders_date_end'];
		} else {
			$filter_orders_date_end = '';
		}
		
		$data['ranges_orders'] = array();
		
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_custom'),
			'value' => 'custom',
			'style' => 'color:#666',
		);
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_today'),
			'value' => 'today',
			'style' => 'color:#090',
		);
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_yesterday'),
			'value' => 'yesterday',
			'style' => 'color:#090',
		);		
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_week'),
			'value' => 'week',
			'style' => 'color:#090',
		);
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_month'),
			'value' => 'month',
			'style' => 'color:#090',
		);					
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_quarter'),
			'value' => 'quarter',
			'style' => 'color:#090',
		);
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_year'),
			'value' => 'year',
			'style' => 'color:#090',
		);
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_current_week'),
			'value' => 'current_week',
			'style' => 'color:#06C',
		);
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_current_month'),
			'value' => 'current_month',
			'style' => 'color:#06C',
		);	
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_current_quarter'),
			'value' => 'current_quarter',
			'style' => 'color:#06C',
		);			
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_current_year'),
			'value' => 'current_year',
			'style' => 'color:#06C',
		);			
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_last_week'),
			'value' => 'last_week',
			'style' => 'color:#F90',
		);
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_last_month'),
			'value' => 'last_month',
			'style' => 'color:#F90',
		);	
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_last_quarter'),
			'value' => 'last_quarter',
			'style' => 'color:#F90',
		);			
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_last_year'),
			'value' => 'last_year',
			'style' => 'color:#F90',
		);			
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_all_time'),
			'value' => 'all_time',
			'style' => 'color:#F00',
		);
		
		if (isset($this->request->get['filter_orders_range'])) {
			$filter_orders_range = $this->request->get['filter_orders_range'];
		} else {
			$filter_orders_range = 'all_time';
		}

		if (isset($this->request->get['filter_orders_order_status'])) {
			$filter_orders_order_status = explode('_', $this->request->get['filter_orders_order_status']);
		} else {
			$filter_orders_order_status = 0;
		}
		
		if (isset($this->request->get['sort_orders'])) {
			$sort_orders = $this->request->get['sort_orders'];
		} else {
			$sort_orders = 'order_id';
		}

		if (isset($this->request->get['order_orders'])) {
			$order_orders = $this->request->get['order_orders'];
		} else {
			$order_orders = 'DESC';
		}
				
		if (isset($this->request->get['page_orders'])) {
			$page_orders = $this->request->get['page_orders'];
		} else {
			$page_orders = 1;
		}
				
		$json['customer_order'] = array();
		
		$filter_data = array(
			'filter_orders_date_start'	  		=> $filter_orders_date_start, 
			'filter_orders_date_end'	  		=> $filter_orders_date_end, 
			'filter_orders_range'	  	  		=> $filter_orders_range, 
			'filter_orders_order_status'	  	=> $filter_orders_order_status,
			'sort_orders'            			=> $sort_orders,
			'order_orders'           			=> $order_orders,
			'start_orders'           	  		=> ($page_orders - 1) * $this->config->get('config_limit_admin'),
			'limit_orders'           	  		=> $this->config->get('config_limit_admin')			
		);
		
		$this->load->model('customer/customer');
		
		$data['order_statuses'] = $this->model_customer_customer->getOrderStatuses(); 
		
		$customer_orders_total = $this->model_customer_customer->getCustomerOrdersTotal($filter_data, $this->request->get['customer_id']);
		
		$customer_orders = $this->model_customer_customer->getCustomerOrders($filter_data, $this->request->get['customer_id']);
		
		foreach ($customer_orders as $order) {
		
			$json['customer_order'][] = array(
				'date_added' 			=> date($this->config->get('adveci_date_format') == 'DDMMYYYY' ? 'd/m/Y' : 'm/d/Y', strtotime($order['date_added'])),
				'order_id'    			=> $order['order_id'],
				'inv_no'     			=> $order['invoice_prefix'] . $order['invoice_no'],
				'shipping_method'     	=> strip_tags($order['shipping_method']),
				'payment_method'     	=> strip_tags($order['payment_method']),
				'os_name'     			=> $order['os_name'],												
				'store_name'    		=> $order['store_name'],
				'currency'     			=> $order['currency_code'],
				'products'    			=> $order['products'],						
				'sub_total'    			=> $this->currency->format($order['sub_total'], $order['currency_code'], $order['currency_value']),
				'shipping'    			=> $this->currency->format($order['shipping'], $order['currency_code'], $order['currency_value']),
				'tax'    				=> $this->currency->format($order['tax'], $order['currency_code'], $order['currency_value']),						
				'total'    				=> $this->currency->format($order['total'], $order['currency_code'], $order['currency_value']),												
				'total_products'   		=> $order['total_products'],	
				'total_sub_total'   	=> $this->currency->format($order['total_sub_total'], $order['currency_code'], $order['currency_value']),
				'total_shipping'   		=> $this->currency->format($order['total_shipping'], $order['currency_code'], $order['currency_value']),
				'total_tax'   			=> $this->currency->format($order['total_tax'], $order['currency_code'], $order['currency_value']),
				'total_value'   		=> $this->currency->format($order['total_value'], $order['currency_code'], $order['currency_value'])
			);
		}

		$pagination_orders = new Pagination();
		$pagination_orders->total = $customer_orders_total;
		$pagination_orders->page = $page_orders;
		$pagination_orders->limit = $this->config->get('config_limit_admin');
		$pagination_orders->url = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page_orders={page}', true);
			
		$json['pagination_orders'] = $pagination_orders->render();
			
		$json['results_orders'] = sprintf($this->language->get('text_pagination'), ($customer_orders_total) ? (($page_orders - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page_orders - 1) * $this->config->get('config_limit_admin')) > ($customer_orders_total - $this->config->get('config_limit_admin'))) ? $customer_orders_total : ((($page_orders - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $customer_orders_total, ceil($customer_orders_total / $this->config->get('config_limit_admin')));
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	  }
	}	
	
	public function filter_products() {
	  $data['customer_id'] = isset($this->request->get['customer_id']);	
			
	  if (isset($this->request->get['customer_id'])) {
		
		$json = array();

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['filter_products_date_start'])) {
			$filter_products_date_start = $this->request->get['filter_products_date_start'];
		} else {
			$filter_products_date_start = '';
		}

		if (isset($this->request->get['filter_products_date_end'])) {
			$filter_products_date_end = $this->request->get['filter_products_date_end'];
		} else {
			$filter_products_date_end = '';
		}
		
		$data['ranges_products'] = array();
		
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_custom'),
			'value' => 'custom',
			'style' => 'color:#666',
		);
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_today'),
			'value' => 'today',
			'style' => 'color:#090',
		);
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_yesterday'),
			'value' => 'yesterday',
			'style' => 'color:#090',
		);		
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_week'),
			'value' => 'week',
			'style' => 'color:#090',
		);
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_month'),
			'value' => 'month',
			'style' => 'color:#090',
		);					
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_quarter'),
			'value' => 'quarter',
			'style' => 'color:#090',
		);
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_year'),
			'value' => 'year',
			'style' => 'color:#090',
		);
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_current_week'),
			'value' => 'current_week',
			'style' => 'color:#06C',
		);
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_current_month'),
			'value' => 'current_month',
			'style' => 'color:#06C',
		);	
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_current_quarter'),
			'value' => 'current_quarter',
			'style' => 'color:#06C',
		);			
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_current_year'),
			'value' => 'current_year',
			'style' => 'color:#06C',
		);			
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_last_week'),
			'value' => 'last_week',
			'style' => 'color:#F90',
		);
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_last_month'),
			'value' => 'last_month',
			'style' => 'color:#F90',
		);	
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_last_quarter'),
			'value' => 'last_quarter',
			'style' => 'color:#F90',
		);			
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_last_year'),
			'value' => 'last_year',
			'style' => 'color:#F90',
		);			
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_all_time'),
			'value' => 'all_time',
			'style' => 'color:#F00',
		);
		
		if (isset($this->request->get['filter_products_range'])) {
			$filter_products_range = $this->request->get['filter_products_range'];
		} else {
			$filter_products_range = 'all_time';
		}

		if (isset($this->request->get['filter_products_order_status'])) {
			$filter_products_order_status = explode('_', $this->request->get['filter_products_order_status']);
		} else {
			$filter_products_order_status = 0;
		}
		
		if (isset($this->request->get['sort_products'])) {
			$sort_products = $this->request->get['sort_products'];
		} else {
			$sort_products = 'quantity';
		}

		if (isset($this->request->get['order_products'])) {
			$order_products = $this->request->get['order_products'];
		} else {
			$order_products = 'DESC';
		}
				
		if (isset($this->request->get['page_products'])) {
			$page_products = $this->request->get['page_products'];
		} else {
			$page_products = 1;
		}
				
		$json['customer_product'] = array();
		
		$filter_data = array(
			'filter_products_date_start'	  	=> $filter_products_date_start, 
			'filter_products_date_end'	  		=> $filter_products_date_end, 
			'filter_products_range'	  	  		=> $filter_products_range, 
			'filter_products_order_status'	  	=> $filter_products_order_status,
			'sort_products'            			=> $sort_products,
			'order_products'           			=> $order_products,
			'start_products'           	  		=> ($page_products - 1) * $this->config->get('config_limit_admin'),
			'limit_products'           	  		=> $this->config->get('config_limit_admin')			
		);
		
		$this->load->model('customer/customer');
		$this->load->model('tool/image');
		
		$data['order_statuses'] = $this->model_customer_customer->getOrderStatuses(); 
		
		$customer_products_total = $this->model_customer_customer->getCustomerProductsTotal($filter_data, $this->request->get['customer_id']);
		$counter = 0;
		foreach ($customer_products_total as $total) {
			$counter += count(explode(',',$total['counter'],0));
		}
		$total = $counter;
			
		$customer_products = $this->model_customer_customer->getCustomerProducts($filter_data, $this->request->get['customer_id']);
		
		foreach ($customer_products as $product) {
			
			if ($product['image'] && file_exists(DIR_IMAGE . $product['image'])) {
				$image_product = $this->model_tool_image->resize($product['image'], 40, 40);
			} else {
				$image_product = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$option_data = array();
			$options = $this->model_customer_customer->getOrderOptions($product['order_product_id']);

			foreach ($options as $option) {
				if ($option['type'] != 'textarea' && $option['type'] != 'file' && $option['type'] != 'image' && $option['type'] != 'date' && $option['type'] != 'datetime' && $option['type'] != 'time') {
					$option_data[] = array(
						'name'  => $option['name'],
						'value' => $option['value'],
						'type'  => $option['type']
					);
				}
			}
									
			$json['customer_product'][] = array(
				'product_id' 						=> $product['product_id'],			
				'image'      						=> $image_product,
				'sku'    							=> $product['sku'],
				'model'    							=> $product['model'],
				'name'     							=> $product['name'],
				'option'   		 	  				=> $option_data,
				'manufacturer'  					=> $product['manufacturer'],
				'categories'  						=> $product['categories'],
				'quantity' 							=> $product['quantity'],
				'total_excl_vat'  				  	=> $this->currency->format($product['total_excl_vat'], $this->config->get('config_currency')),
				'prod_tax'    						=> $this->currency->format($product['prod_tax'], $this->config->get('config_currency')),												
				'total_incl_vat'   				 	=> $this->currency->format($product['total_incl_vat'], $this->config->get('config_currency')),
				'product_order_ord_id'     			=> $product['product_order_ord_id'],
				'product_order_ord_idc'     		=> $product['product_order_ord_idc'],
				'product_order_date'    			=> $product['product_order_date'],
				'product_order_inv_no'     			=> $product['product_order_inv_no'],
				'product_order_shipping_method' 	=> strip_tags($product['product_order_shipping_method'], '<br>'),
				'product_order_payment_method'  	=> strip_tags($product['product_order_payment_method'], '<br>'),
				'product_order_status'  			=> $product['product_order_status'],
				'product_order_store'      			=> $product['product_order_store'],	
				'product_order_currency' 			=> $product['product_order_currency'],
				'product_order_price' 				=> $product['product_order_price'],
				'product_order_quantity' 			=> $product['product_order_quantity'],
				'product_order_total_excl_vat'  	=> $product['product_order_total_excl_vat'],				
				'product_order_tax'  				=> $product['product_order_tax'],				
				'product_order_total_incl_vat'  	=> $product['product_order_total_incl_vat'],
				'total_quantity' 					=> $product['total_quantity'],
				'total_total_excl_vat' 				=> $this->currency->format($product['total_total_excl_vat'], $this->config->get('config_currency')),
				'total_prod_tax' 					=> $this->currency->format($product['total_prod_tax'], $this->config->get('config_currency')),
				'total_total_incl_vat' 				=> $this->currency->format($product['total_total_incl_vat'], $this->config->get('config_currency'))
			);
		}

		$pagination_products = new Pagination();
		$pagination_products->total = $total;
		$pagination_products->page = $page_products;
		$pagination_products->limit = $this->config->get('config_limit_admin');
		$pagination_products->url = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page_products={page}', true);
			
		$json['pagination_products'] = $pagination_products->render();
			
		$json['results_products'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page_products - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page_products - 1) * $this->config->get('config_limit_admin')) > ($total - $this->config->get('config_limit_admin'))) ? $total : ((($page_products - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $total, ceil($total / $this->config->get('config_limit_admin')));
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	  }
	}
					
	public function filter_track() {
		$data['customer_id'] = isset($this->request->get['customer_id']);	
			
		if (isset($this->request->get['customer_id'])) {
		
			$json = array();

			$data['token'] = $this->session->data['token'];

			if (isset($this->request->get['filter_start_date'])) {
				$filter_start_date = $this->request->get['filter_start_date'];
			} else {
				$filter_start_date = '';
			}

			if (isset($this->request->get['filter_end_date'])) {
				$filter_end_date = $this->request->get['filter_end_date'];
			} else {
				$filter_end_date = '';
			}
		
			$data['ranges'] = array();
		
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_custom'),
				'value' => 'custom',
				'style' => 'color:#666',
			);			
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_today'),
				'value' => 'today',
				'style' => 'color:#090',
			);
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_yesterday'),
				'value' => 'yesterday',
				'style' => 'color:#090',
			);
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_week'),
				'value' => 'week',
				'style' => 'color:#090',
			);
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_month'),
				'value' => 'month',
				'style' => 'color:#090',
			);					
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_quarter'),
				'value' => 'quarter',
				'style' => 'color:#090',
			);
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_year'),
				'value' => 'year',
				'style' => 'color:#090',
			);
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_current_week'),
				'value' => 'current_week',
				'style' => 'color:#06C',
			);
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_current_month'),
				'value' => 'current_month',
				'style' => 'color:#06C',
			);	
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_current_quarter'),
				'value' => 'current_quarter',
				'style' => 'color:#06C',
			);			
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_current_year'),
				'value' => 'current_year',
				'style' => 'color:#06C',
			);			
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_last_week'),
				'value' => 'last_week',
				'style' => 'color:#F90',
			);
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_last_month'),
				'value' => 'last_month',
				'style' => 'color:#F90',
			);	
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_last_quarter'),
				'value' => 'last_quarter',
				'style' => 'color:#F90',
			);			
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_last_year'),
				'value' => 'last_year',
				'style' => 'color:#F90',
			);			
			$data['ranges'][] = array(
				'text'  => $this->language->get('stat_all_time'),
				'value' => 'all_time',
				'style' => 'color:#F00',
			);
		
			if (isset($this->request->get['filter_range'])) {
				$filter_range = $this->request->get['filter_range'];
			} else {
				$filter_range = 'all_time'; //show All Time in Statistical Range by default
			}

			if (isset($this->request->get['sort_track'])) {
				$sort_track = $this->request->get['sort_track'];
			} else {
				$sort_track = 'access_time';
			}

			if (isset($this->request->get['order_track'])) {
				$order_track = $this->request->get['order_track'];
			} else {
				$order_track = 'DESC';
			}
				
			if (isset($this->request->get['page_track'])) {
				$page_track = $this->request->get['page_track'];
			} else {
				$page_track = 1;
			}
				
			$json['customer_track'] = array();
		
			$filter_data = array(
				'filter_range'			=>	$filter_range,
				'filter_start_date'		=>	$filter_start_date, 
				'filter_end_date'		=>	$filter_end_date,
				'sort_track'           	=>	$sort_track,
				'order_track'          	=>	$order_track,
				'start_track'          	=>	($page_track - 1) * $this->config->get('config_limit_admin'),
				'limit_track'          	=>	$this->config->get('config_limit_admin')					
			);
		
			$this->load->model('customer/customer');
		
			$customer_tracks_total = $this->model_customer_customer->getCustomerTrackTotal($filter_data, $this->request->get['customer_id']);
			
			$customer_tracks = $this->model_customer_customer->getCustomerTrack($filter_data, $this->request->get['customer_id']);

			foreach ($customer_tracks as $track) {
				$json['customer_track'][] = array(
					'ip_address'    			=> $track['ip_address'],
					'agent_type'    			=> $track['agent_type'],
					'route' 					=> $track['route'],
					'current_url'    			=> htmlspecialchars_decode($track['current_url']),					
					'referrer'    				=> htmlspecialchars_decode($track['referrer']),
					'visit_date'  				=> date($this->config->get('adveci_date_format') == 'DDMMYYYY' ? 'd/m/Y' : 'm/d/Y', strtotime($track['access_time'])),
					'visit_time'    			=> date($this->config->get('adveci_hour_format') == '24' ? 'H:i:s' : 'g:i:s A', strtotime($track['access_time']))
				);
			}
					
			$pagination_track = new Pagination();
			$pagination_track->total = $customer_tracks_total;
			$pagination_track->page = $page_track;
			$pagination_track->limit = $this->config->get('config_limit_admin');
			$pagination_track->url = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page_track={page}', true);
			
			$json['pagination_track'] = $pagination_track->render();
			
			$json['results_track'] = sprintf($this->language->get('text_pagination'), ($customer_tracks_total) ? (($page_track - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page_track - 1) * $this->config->get('config_limit_admin')) > ($customer_tracks_total - $this->config->get('config_limit_admin'))) ? $customer_tracks_total : ((($page_track - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $customer_tracks_total, ceil($customer_tracks_total / $this->config->get('config_limit_admin')));
		
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
	  	}
	}	
            
	protected function getForm() {

		if (!$this->IsInstalled()) {		
			$this->session->data['error_eci'] = $this->language->get('error_installed');
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], true));		
		}	

	   	$this->document->addScript('view/javascript/jquery/jquery.tmpl.min.js');
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap-multiselect.js');
	   	$this->document->addStyle('view/javascript/bootstrap/css/bootstrap-multiselect.css');
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap-select.min.js');
		$this->document->addStyle('view/javascript/bootstrap/css/bootstrap-select.css');
		
		$data['customer_id'] = isset($this->request->get['customer_id']);	
			
		if (isset($this->request->get['customer_id'])) {
			$data['customer_id'] = $this->request->get['customer_id'];	
			$data['access_permission1'] = $this->user->hasPermission('modify', 'customer/customer');
			$data['access_permission2'] = $this->user->hasPermission('access', 'module/adv_extended_cust_info');
			$data['url_product'] = $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=', true);

		if (isset($this->request->get['filter_orders_date_start'])) {
			$filter_orders_date_start = $this->request->get['filter_orders_date_start'];
		} else {
			$filter_orders_date_start = '';
		}
						
		if (isset($this->request->get['filter_orders_date_end'])) {
			$filter_orders_date_end = $this->request->get['filter_orders_date_end'];
		} else {
			$filter_orders_date_end = '';
		}
		
		$data['ranges_orders'] = array();
		
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_custom'),
			'value' => 'custom',
			'style' => 'color:#666',
		);
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_today'),
			'value' => 'today',
			'style' => 'color:#090',
		);
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_yesterday'),
			'value' => 'yesterday',
			'style' => 'color:#090',
		);		
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_week'),
			'value' => 'week',
			'style' => 'color:#090',
		);
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_month'),
			'value' => 'month',
			'style' => 'color:#090',
		);					
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_quarter'),
			'value' => 'quarter',
			'style' => 'color:#090',
		);
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_year'),
			'value' => 'year',
			'style' => 'color:#090',
		);
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_current_week'),
			'value' => 'current_week',
			'style' => 'color:#06C',
		);
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_current_month'),
			'value' => 'current_month',
			'style' => 'color:#06C',
		);	
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_current_quarter'),
			'value' => 'current_quarter',
			'style' => 'color:#06C',
		);			
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_current_year'),
			'value' => 'current_year',
			'style' => 'color:#06C',
		);			
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_last_week'),
			'value' => 'last_week',
			'style' => 'color:#F90',
		);
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_last_month'),
			'value' => 'last_month',
			'style' => 'color:#F90',
		);	
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_last_quarter'),
			'value' => 'last_quarter',
			'style' => 'color:#F90',
		);			
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_last_year'),
			'value' => 'last_year',
			'style' => 'color:#F90',
		);			
		$data['ranges_orders'][] = array(
			'text'  => $this->language->get('stat_all_time'),
			'value' => 'all_time',
			'style' => 'color:#F00',
		);
		
		if (isset($this->request->get['filter_orders_range'])) {
			$filter_orders_range = $this->request->get['filter_orders_range'];
		} else {
			$filter_orders_range = 'all_time';
		}

		if (isset($this->request->get['filter_orders_order_status'])) {
			$filter_orders_order_status = explode('_', $this->request->get['filter_orders_order_status']);
		} else {
			$filter_orders_order_status = 0;
		}
		
		if (isset($this->request->get['sort_orders'])) {
			$sort_orders = $this->request->get['sort_orders'];
		} else {
			$sort_orders = 'order_id';
		}

		if (isset($this->request->get['order_orders'])) {
			$order_orders = $this->request->get['order_orders'];
		} else {
			$order_orders = 'DESC';
		}
				
		if (isset($this->request->get['page_orders'])) {
			$page_orders = $this->request->get['page_orders'];
		} else {
			$page_orders = 1;
		}

		$data['sort_orders'] = $sort_orders;
		$data['order_orders'] = $order_orders;
		$data['page_orders'] = $page_orders;
														
		$data['customer_order'] = array();
				
		$filter_data = array(
			'filter_orders_date_start'	  		=> $filter_orders_date_start, 
			'filter_orders_date_end'	  		=> $filter_orders_date_end, 
			'filter_orders_range'	  	  		=> $filter_orders_range, 
			'filter_orders_order_status'	  	=> $filter_orders_order_status,
			'sort_orders'            			=> $sort_orders,
			'order_orders'           			=> $order_orders,
			'start_orders'           	  		=> ($page_orders - 1) * $this->config->get('config_limit_admin'),
			'limit_orders'           	  		=> $this->config->get('config_limit_admin')	
		);

		$this->load->model('customer/customer');
					
		$data['order_statuses'] = $this->model_customer_customer->getOrderStatuses(); 
		
		$customer_orders_total = $this->model_customer_customer->getCustomerOrdersTotal($filter_data, $this->request->get['customer_id']);
		
		$customer_orders = $this->model_customer_customer->getCustomerOrders($filter_data, $this->request->get['customer_id']);

		foreach ($customer_orders as $order) {
				
			$data['customer_order'][] = array(
				'date_added' 			=> date($this->config->get('adveci_date_format') == 'DDMMYYYY' ? 'd/m/Y' : 'm/d/Y', strtotime($order['date_added'])),
				'order_id'    			=> $order['order_id'],
				'inv_no'     			=> $order['invoice_prefix'] . $order['invoice_no'],
				'shipping_method'     	=> strip_tags($order['shipping_method']),
				'payment_method'     	=> strip_tags($order['payment_method']),
				'os_name'     			=> $order['os_name'],												
				'store_name'    		=> $order['store_name'],
				'currency'     			=> $order['currency_code'],
				'products'    			=> $order['products'],						
				'sub_total'    			=> $this->currency->format($order['sub_total'], $order['currency_code'], $order['currency_value']),
				'shipping'    			=> $this->currency->format($order['shipping'], $order['currency_code'], $order['currency_value']),
				'tax'    				=> $this->currency->format($order['tax'], $order['currency_code'], $order['currency_value']),						
				'total'    				=> $this->currency->format($order['total'], $order['currency_code'], $order['currency_value']),												
				'total_products'   		=> $order['total_products'],	
				'total_sub_total'   	=> $this->currency->format($order['total_sub_total'], $order['currency_code'], $order['currency_value']),
				'total_shipping'   		=> $this->currency->format($order['total_shipping'], $order['currency_code'], $order['currency_value']),
				'total_tax'   			=> $this->currency->format($order['total_tax'], $order['currency_code'], $order['currency_value']),
				'total_value'   		=> $this->currency->format($order['total_value'], $order['currency_code'], $order['currency_value'])
			);
		}
		
		$url = '';

		if (isset($this->request->get['filter_orders_date_start'])) {
			$url .= '&filter_orders_date_start=' . $this->request->get['filter_orders_date_start'];
		}
		
		if (isset($this->request->get['filter_orders_date_end'])) {
			$url .= '&filter_orders_date_end=' . $this->request->get['filter_orders_date_end'];
		}
		
		if (isset($this->request->get['filter_orders_range'])) {
			$url .= '&filter_orders_range=' . $this->request->get['filter_orders_range'];
		}
		
		if (isset($this->request->get['filter_orders_order_status'])) {
			$url .= '&filter_orders_order_status=' . $this->request->get['filter_orders_order_status'];
		}
										
		if ($order_orders == 'ASC') {
			$url .= '&order_orders=DESC';
		} else {
			$url .= '&order_orders=ASC';
		}

		if (isset($this->request->get['page_orders'])) {
			$url .= '&page_orders=' . $this->request->get['page_orders'];
		}
								
		$data['sort_orders_order_id'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_orders=o.order_id' . $url, true);
		$data['sort_orders_date_added'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_orders=o.date_added' . $url, true);
		$data['sort_orders_inv_no'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_orders=inv_number' . $url, true);
		$data['sort_orders_shipping_method'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_orders=o.shipping_method' . $url, true);		
		$data['sort_orders_payment_method'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_orders=o.payment_method' . $url, true);
		$data['sort_orders_order_status'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_orders=os_name' . $url, true);		
		$data['sort_orders_store'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_orders=o.store_name' . $url, true);
		$data['sort_orders_currency'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_orders=o.currency_code' . $url, true);
		$data['sort_orders_quantity'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_orders=products' . $url, true);		
		$data['sort_orders_sub_total'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_orders=sub_total' . $url, true);
		$data['sort_orders_shipping'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_orders=shipping' . $url, true);
		$data['sort_orders_tax'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_orders=tax' . $url, true);
		$data['sort_orders_value'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_orders=o.total' . $url, true);

		$pagination_orders = new Pagination();
		$pagination_orders->total = $customer_orders_total;
		$pagination_orders->page = $page_orders;
		$pagination_orders->limit = $this->config->get('config_limit_admin');
		$pagination_orders->text = $this->language->get('text_pagination');
		$pagination_orders->url = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page_orders={page}', true);
			
		$data['pagination_orders'] = $pagination_orders->render();

		$data['results_orders'] = sprintf($this->language->get('text_pagination'), ($customer_orders_total) ? (($page_orders - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page_orders - 1) * $this->config->get('config_limit_admin')) > ($customer_orders_total - $this->config->get('config_limit_admin'))) ? $customer_orders_total : ((($page_orders - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $customer_orders_total, ceil($customer_orders_total / $this->config->get('config_limit_admin')));
										
		$data['filter_orders_date_start'] = $filter_orders_date_start; 
		$data['filter_orders_date_end'] = $filter_orders_date_end; 		
		$data['filter_orders_range'] = $filter_orders_range; 
		$data['filter_orders_order_status'] = $filter_orders_order_status;	
		
		$data['sort_orders'] = $sort_orders;
		$data['order_orders'] = $order_orders;

			
		if (isset($this->request->get['filter_products_date_start'])) {
			$filter_products_date_start = $this->request->get['filter_products_date_start'];
		} else {
			$filter_products_date_start = '';
		}
						
		if (isset($this->request->get['filter_products_date_end'])) {
			$filter_products_date_end = $this->request->get['filter_products_date_end'];
		} else {
			$filter_products_date_end = '';
		}
		
		$data['ranges_products'] = array();
		
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_custom'),
			'value' => 'custom',
			'style' => 'color:#666',
		);
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_today'),
			'value' => 'today',
			'style' => 'color:#090',
		);
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_yesterday'),
			'value' => 'yesterday',
			'style' => 'color:#090',
		);		
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_week'),
			'value' => 'week',
			'style' => 'color:#090',
		);
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_month'),
			'value' => 'month',
			'style' => 'color:#090',
		);					
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_quarter'),
			'value' => 'quarter',
			'style' => 'color:#090',
		);
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_year'),
			'value' => 'year',
			'style' => 'color:#090',
		);
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_current_week'),
			'value' => 'current_week',
			'style' => 'color:#06C',
		);
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_current_month'),
			'value' => 'current_month',
			'style' => 'color:#06C',
		);	
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_current_quarter'),
			'value' => 'current_quarter',
			'style' => 'color:#06C',
		);			
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_current_year'),
			'value' => 'current_year',
			'style' => 'color:#06C',
		);			
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_last_week'),
			'value' => 'last_week',
			'style' => 'color:#F90',
		);
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_last_month'),
			'value' => 'last_month',
			'style' => 'color:#F90',
		);	
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_last_quarter'),
			'value' => 'last_quarter',
			'style' => 'color:#F90',
		);			
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_last_year'),
			'value' => 'last_year',
			'style' => 'color:#F90',
		);			
		$data['ranges_products'][] = array(
			'text'  => $this->language->get('stat_all_time'),
			'value' => 'all_time',
			'style' => 'color:#F00',
		);
		
		if (isset($this->request->get['filter_products_range'])) {
			$filter_products_range = $this->request->get['filter_products_range'];
		} else {
			$filter_products_range = 'all_time';
		}

		if (isset($this->request->get['filter_products_order_status'])) {
			$filter_products_order_status = explode('_', $this->request->get['filter_products_order_status']);
		} else {
			$filter_products_order_status = 0;
		}
		
		if (isset($this->request->get['sort_products'])) {
			$sort_products = $this->request->get['sort_products'];
		} else {
			$sort_products = 'quantity';
		}

		if (isset($this->request->get['order_products'])) {
			$order_products = $this->request->get['order_products'];
		} else {
			$order_products = 'DESC';
		}
				
		if (isset($this->request->get['page_products'])) {
			$page_products = $this->request->get['page_products'];
		} else {
			$page_products = 1;
		}

		$data['sort_products'] = $sort_products;
		$data['order_products'] = $order_products;
		$data['page_products'] = $page_products;
														
		$data['customer_product'] = array();
				
		$filter_data = array(
			'filter_products_date_start'	  	=> $filter_products_date_start, 
			'filter_products_date_end'	  		=> $filter_products_date_end, 
			'filter_products_range'	  	  		=> $filter_products_range, 
			'filter_products_order_status'	  	=> $filter_products_order_status,
			'sort_products'            			=> $sort_products,
			'order_products'           			=> $order_products,
			'start_products'           	  		=> ($page_products - 1) * $this->config->get('config_limit_admin'),
			'limit_products'           	  		=> $this->config->get('config_limit_admin')	
		);

		$this->load->model('customer/customer');
		$this->load->model('tool/image');
					
		$data['order_statuses'] = $this->model_customer_customer->getOrderStatuses(); 
		
		$customer_products_total = $this->model_customer_customer->getCustomerProductsTotal($filter_data, $this->request->get['customer_id']);
		$counter = 0;
		foreach ($customer_products_total as $total) {
			$counter += count(explode(',',$total['counter'],0));
		}
		$total = $counter;
				
		$customer_products = $this->model_customer_customer->getCustomerProducts($filter_data, $this->request->get['customer_id']);

		foreach ($customer_products as $product) {
			
			if ($product['image'] && file_exists(DIR_IMAGE . $product['image'])) {
				$image_product = $this->model_tool_image->resize($product['image'], 40, 40);
			} else {
				$image_product = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$option_data = array();
			$options = $this->model_customer_customer->getOrderOptions($product['order_product_id']);

			foreach ($options as $option) {
				if ($option['type'] != 'textarea' && $option['type'] != 'file' && $option['type'] != 'image' && $option['type'] != 'date' && $option['type'] != 'datetime' && $option['type'] != 'time') {
					$option_data[] = array(
						'name'  => $option['name'],
						'value' => $option['value'],
						'type'  => $option['type']
					);
				}
			}
			
			$data['customer_product'][] = array(
				'product_id' 						=> $product['product_id'],			
				'image'      						=> $image_product,
				'sku'    							=> $product['sku'],
				'model'    							=> $product['model'],
				'name'     							=> $product['name'],
				'option'   		 	 		 		=> $option_data,				
				'manufacturer'  					=> $product['manufacturer'],
				'categories'  						=> $product['categories'],
				'quantity' 							=> $product['quantity'],
				'total_excl_vat'  				  	=> $this->currency->format($product['total_excl_vat'], $this->config->get('config_currency')),
				'prod_tax'    						=> $this->currency->format($product['prod_tax'], $this->config->get('config_currency')),												
				'total_incl_vat'   		 			=> $this->currency->format($product['total_incl_vat'], $this->config->get('config_currency')),
				'product_order_ord_id'     			=> $product['product_order_ord_id'],
				'product_order_ord_idc'     		=> $product['product_order_ord_idc'],
				'product_order_date'    			=> $product['product_order_date'],
				'product_order_inv_no'     			=> $product['product_order_inv_no'],
				'product_order_shipping_method' 	=> strip_tags($product['product_order_shipping_method'], '<br>'),
				'product_order_payment_method'  	=> strip_tags($product['product_order_payment_method'], '<br>'),
				'product_order_status'  			=> $product['product_order_status'],
				'product_order_store'      			=> $product['product_order_store'],	
				'product_order_currency' 			=> $product['product_order_currency'],
				'product_order_price' 				=> $product['product_order_price'],
				'product_order_quantity' 			=> $product['product_order_quantity'],
				'product_order_total_excl_vat'  	=> $product['product_order_total_excl_vat'],				
				'product_order_tax'  				=> $product['product_order_tax'],				
				'product_order_total_incl_vat'  	=> $product['product_order_total_incl_vat'],
				'total_quantity' 					=> $product['total_quantity'],
				'total_total_excl_vat' 				=> $this->currency->format($product['total_total_excl_vat'], $this->config->get('config_currency')),
				'total_prod_tax' 					=> $this->currency->format($product['total_prod_tax'], $this->config->get('config_currency')),
				'total_total_incl_vat' 				=> $this->currency->format($product['total_total_incl_vat'], $this->config->get('config_currency'))
			);
		}

		$url = '';

		if (isset($this->request->get['filter_products_date_start'])) {
			$url .= '&filter_products_date_start=' . $this->request->get['filter_products_date_start'];
		}
		
		if (isset($this->request->get['filter_products_date_end'])) {
			$url .= '&filter_products_date_end=' . $this->request->get['filter_products_date_end'];
		}
		
		if (isset($this->request->get['filter_products_range'])) {
			$url .= '&filter_products_range=' . $this->request->get['filter_products_range'];
		}
		
		if (isset($this->request->get['filter_products_order_status'])) {
			$url .= '&filter_products_order_status=' . $this->request->get['filter_products_order_status'];
		}
										
		if ($order_products == 'ASC') {
			$url .= '&order_products=DESC';
		} else {
			$url .= '&order_products=ASC';
		}

		if (isset($this->request->get['page_products'])) {
			$url .= '&page_products=' . $this->request->get['page_products'];
		}
								
		$data['sort_products_sku'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_products=sku' . $url, true);
		$data['sort_products_model'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_products=op.model' . $url, true);
		$data['sort_products_product'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_products=op.name' . $url, true);
		$data['sort_products_category'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_products=categories' . $url, true);
		$data['sort_products_manufacturer'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_products=manufacturer' . $url, true);		
		$data['sort_products_quantity'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_products=quantity' . $url, true);
		$data['sort_products_total_excl_vat'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_products=total_excl_vat' . $url, true);
		$data['sort_products_prod_tax'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_products=prod_tax' . $url, true);		
		$data['sort_products_total_incl_vat'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_products=total_incl_vat' . $url, true);

		$pagination_products = new Pagination();
		$pagination_products->total = $total;
		$pagination_products->page = $page_products;
		$pagination_products->limit = $this->config->get('config_limit_admin');
		$pagination_products->text = $this->language->get('text_pagination');
		$pagination_products->url = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page_products={page}', true);
			
		$data['pagination_products'] = $pagination_products->render();

		$data['results_products'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page_products - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page_products - 1) * $this->config->get('config_limit_admin')) > ($total - $this->config->get('config_limit_admin'))) ? $total : ((($page_products - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $total, ceil($total / $this->config->get('config_limit_admin')));
										
		$data['filter_products_date_start'] = $filter_products_date_start; 
		$data['filter_products_date_end'] = $filter_products_date_end; 		
		$data['filter_products_range'] = $filter_products_range; 
		$data['filter_products_order_status'] = $filter_products_order_status;	
		
		$data['sort_products'] = $sort_products;
		$data['order_products'] = $order_products;
		
		
		if (isset($this->request->get['filter_start_date'])) {
			$filter_start_date = $this->request->get['filter_start_date'];
		} else {
			$filter_start_date = '';
		}

		if (isset($this->request->get['filter_end_date'])) {
			$filter_end_date = $this->request->get['filter_end_date'];
		} else {
			$filter_end_date = '';
		}
	
		$data['ranges'] = array();
		
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_custom'),
			'value' => 'custom',
			'style' => 'color:#666',
		);			
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_today'),
			'value' => 'today',
			'style' => 'color:#090',
		);
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_yesterday'),
			'value' => 'yesterday',
			'style' => 'color:#090',
		);
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_week'),
			'value' => 'week',
			'style' => 'color:#090',
		);
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_month'),
			'value' => 'month',
			'style' => 'color:#090',
		);					
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_quarter'),
			'value' => 'quarter',
			'style' => 'color:#090',
		);
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_year'),
			'value' => 'year',
			'style' => 'color:#090',
		);
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_current_week'),
			'value' => 'current_week',
			'style' => 'color:#06C',
		);
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_current_month'),
			'value' => 'current_month',
			'style' => 'color:#06C',
		);	
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_current_quarter'),
			'value' => 'current_quarter',
			'style' => 'color:#06C',
		);			
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_current_year'),
			'value' => 'current_year',
			'style' => 'color:#06C',
		);			
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_last_week'),
			'value' => 'last_week',
			'style' => 'color:#F90',
		);
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_last_month'),
			'value' => 'last_month',
			'style' => 'color:#F90',
		);	
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_last_quarter'),
			'value' => 'last_quarter',
			'style' => 'color:#F90',
		);			
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_last_year'),
			'value' => 'last_year',
			'style' => 'color:#F90',
		);			
		$data['ranges'][] = array(
			'text'  => $this->language->get('stat_all_time'),
			'value' => 'all_time',
			'style' => 'color:#F00',
		);
		
		if (isset($this->request->get['filter_range'])) {
			$filter_range = $this->request->get['filter_range'];
		} else {
			$filter_range = 'all_time'; //show All Time in Statistical Range by default
		}

		if (isset($this->request->get['sort_track'])) {
			$sort_track = $this->request->get['sort_track'];
		} else {
			$sort_track = 'access_time';
		}

		if (isset($this->request->get['order_track'])) {
			$order_track = $this->request->get['order_track'];
		} else {
			$order_track = 'DESC';
		}
				
		if (isset($this->request->get['page_track'])) {
			$page_track = $this->request->get['page_track'];
		} else {
			$page_track = 1;
		}

		$data['sort_track'] = $sort_track;
		$data['order_track'] = $order_track;
		$data['page_track'] = $page_track;
								
		$data['customer_track'] = array();	
					
		$filter_data = array(
			'filter_range'			=>	$filter_range,
			'filter_start_date'		=>	$filter_start_date, 
			'filter_end_date'		=>	$filter_end_date,
			'sort_track'           	=>	$sort_track,
			'order_track'          	=>	$order_track,
			'start_track'          	=>	($page_track - 1) * $this->config->get('config_limit_admin'),
			'limit_track'          	=>	$this->config->get('config_limit_admin')					
		);

		$this->load->model('customer/customer');
						
		$customer_tracks_total = $this->model_customer_customer->getCustomerTrackTotal($filter_data, $this->request->get['customer_id']);
			
		$customer_tracks = $this->model_customer_customer->getCustomerTrack($filter_data, $this->request->get['customer_id']); 
					
		foreach ($customer_tracks as $track) {
			$data['customer_track'][] = array(
				'ip_address'    			=> $track['ip_address'],
				'agent_type'    			=> $track['agent_type'],
				'route' 					=> $track['route'],
				'current_url'    			=> htmlspecialchars_decode($track['current_url']),					
				'referrer'    				=> htmlspecialchars_decode($track['referrer']),
				'visit_date'  				=> date($this->config->get('adveci_date_format') == 'DDMMYYYY' ? 'd/m/Y' : 'm/d/Y', strtotime($track['access_time'])),
				'visit_time'    			=> date($this->config->get('adveci_hour_format') == '24' ? 'H:i:s' : 'g:i:s A', strtotime($track['access_time']))
			);
		}
		
		$furl = '';

		if (isset($this->request->get['filter_start_date'])) {
			$furl .= '&filter_start_date=' . $this->request->get['filter_start_date'];
		}
		
		if (isset($this->request->get['filter_end_date'])) {
			$furl .= '&filter_end_date=' . $this->request->get['filter_end_date'];
		}
		
		if (isset($this->request->get['filter_range'])) {
			$furl .= '&filter_range=' . $this->request->get['filter_range'];
		}
										
		if ($order_track == 'ASC') {
			$furl .= '&order_track=DESC';
		} else {
			$furl .= '&order_track=ASC';
		}

		if (isset($this->request->get['page_track'])) {
			$furl .= '&page_track=' . $this->request->get['page_track'];
		}
								
		$data['sort_track_page'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_track=route' . $furl, true);
		$data['sort_track_url'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_track=current_url' . $furl, true);
		$data['sort_track_referrer'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_track=referrer' . $furl, true);
		$data['sort_track_visit'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&sort_track=access_time' . $furl, true);		
		
		$pagination_track = new Pagination();
		$pagination_track->total = $customer_tracks_total;
		$pagination_track->page = $page_track;
		$pagination_track->limit = $this->config->get('config_limit_admin');
		$pagination_track->url = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page_track={page}', true);
			
		$data['pagination_track'] = $pagination_track->render();
		
		$data['results_track'] = sprintf($this->language->get('text_pagination'), ($customer_tracks_total) ? (($page_track - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page_track - 1) * $this->config->get('config_limit_admin')) > ($customer_tracks_total - $this->config->get('config_limit_admin'))) ? $customer_tracks_total : ((($page_track - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $customer_tracks_total, ceil($customer_tracks_total / $this->config->get('config_limit_admin')));
								
		$data['filter_range'] = $filter_range;
		$data['filter_start_date'] = $filter_start_date;
		$data['filter_end_date'] = $filter_end_date;	
	
		$data['sort_track'] = $sort_track;
		$data['order_track'] = $order_track;
		$data['page_track'] = $page_track;
					

						
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->request->get['delete_wishlist'])) {
			$this->delete_wishlist();
		}
		
		$data['wishlist_products'] = array();		
		$cust_wishlists = $this->model_customer_customer->getCustomerWishList($this->request->get['customer_id']);
		$this->load->model('catalog/product');
		$this->load->model('tool/image');			
			
		foreach ($cust_wishlists as $cust_wishlist) {
		  $product_info = $this->model_catalog_product->getProduct($cust_wishlist['product_id']);
		  if ($product_info) {
		  
				if (isset($product_info['name'])) {
					$delete_wishlist = array();
					$delete_wishlist[] = array(
						'text' => $this->language->get('text_clear_wishlist'),
						'href' => $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&delete_wishlist', true)
					);
					
					if ($product_info['image']) {
						$image_wishlist = $this->model_tool_image->resize($product_info['image'], 40, 40);
					} else {
						$image_wishlist = $this->model_tool_image->resize('no_image.jpg', 40, 40);
					}	

			$special = false;

			$product_specials = $this->model_catalog_product->getProductSpecials($product_info['product_id']);

			foreach ($product_specials  as $product_special) {
				if (($product_special['date_start'] == '0000-00-00' || strtotime($product_special['date_start']) < time()) && ($product_special['date_end'] == '0000-00-00' || strtotime($product_special['date_end']) > time())) {
					$special = $product_special['price'];

					break;
				}
			}
									
					$data['wishlist_products'][] = array(
						'image'      			=> $image_wishlist,															   
						'product_name'			=> $product_info['name'],
						'product_sku'			=> $product_info['sku'],
						'product_model'			=> $product_info['model'],
						'product_price'			=> $this->currency->format($product_info['price'], $this->config->get('config_currency')),
						'product_special'    	=> $special,
						'product_id'			=> $product_info['product_id'],
						'delete_wishlist'		=> $delete_wishlist
					);
				} else {
					$data['error_wishlist_product'] = $this->language->get('error_wishlist_product');
				}
		  } else {
			  $this->model_customer_customer->deleteCustomerWishList($this->request->get['customer_id']);
		  }	
		}
		
		if (isset($this->request->get['clear_cart'])) {
			$this->clear_cart();
		}
		
		$data['cart_products'] = array();		
		$cust_carts = $this->model_customer_customer->getCustomerCart($this->request->get['customer_id']);
		$this->load->model('tool/image');
			
		foreach ($cust_carts as $cust_cart) {
			$stock = true;
				
			$product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_store p2s LEFT JOIN " . DB_PREFIX . "product p ON (p2s.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND p2s.product_id = '" . (int)$cust_cart['product_id'] . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.date_available <= NOW() AND p.status = '1'");

			if ($product_query->num_rows && ($cust_cart['quantity'] > 0)) {		
				$option_price = 0;
				$option_data = array();
					foreach (json_decode($cust_cart['option']) as $product_option_id => $value) {
						$option_query = $this->db->query("SELECT po.product_option_id, po.option_id, od.name, o.type FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_option_id = '" . (int)$product_option_id . "' AND po.product_id = '" . (int)$cust_cart['product_id'] . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");
						if ($option_query->num_rows) {
							if ($option_query->row['type'] == 'select' || $option_query->row['type'] == 'radio' || $option_query->row['type'] == 'image') {
								$option_value_query = $this->db->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_option_value_id = '" . (int)$value . "' AND pov.product_option_id = '" . (int)$product_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
							
								if ($option_value_query->num_rows) {
									if ($option_value_query->row['price_prefix'] == '+') {
										$option_price += $option_value_query->row['price'];
									} elseif ($option_value_query->row['price_prefix'] == '-') {
										$option_price -= $option_value_query->row['price'];
									}
																	
									$option_data[] = array(
										'name'                    => $option_query->row['name'],
										'option_value'            => $option_value_query->row['name'],
										'price'                   => $option_value_query->row['price'],
										'price_prefix'            => $option_value_query->row['price_prefix']
									);
								}
							} elseif ($option_query->row['type'] == 'checkbox' && is_array($value)) {
								foreach ($value as $product_option_value_id) {
									$option_value_query = $this->db->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_option_value_id = '" . (int)$product_option_value_id . "' AND pov.product_option_id = '" . (int)$product_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
									
									if ($option_value_query->num_rows) {
										if ($option_value_query->row['price_prefix'] == '+') {
											$option_price += $option_value_query->row['price'];
										} elseif ($option_value_query->row['price_prefix'] == '-') {
											$option_price -= $option_value_query->row['price'];
										}
																			
										$option_data[] = array(
											'name'                    => $option_query->row['name'],
											'option_value'            => $option_value_query->row['name'],
											'price'                   => $option_value_query->row['price'],
											'price_prefix'            => $option_value_query->row['price_prefix']
										);
									}
								}
							} elseif ($option_query->row['type'] == 'text' || $option_query->row['type'] == 'textarea' || $option_query->row['type'] == 'file' || $option_query->row['type'] == 'date' || $option_query->row['type'] == 'datetime' || $option_query->row['type'] == 'time') {
							
								$option_data[] = array(
									'name'                    => $option_query->row['name'],
									'option_value'            => $value,
									'price'                   => '',
									'price_prefix'            => ''
								);
							}
						}
					}
					
					$customer_info = $this->model_customer_customer->getCustomer($this->request->get['customer_id']);
					$price = $product_query->row['price'];
					
					// Product Discounts
					$discount_quantity = 0;

					$cust_cart_2_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cart WHERE customer_id = '" . $this->request->get['customer_id'] . "'");

					foreach ($cust_cart_2_query->rows as $cust_cart_2) {
						if ($cust_cart_2['product_id'] == $cust_cart['product_id']) {
							$discount_quantity += $cust_cart_2['quantity'];
						}
					}

					$product_discount_query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$cust_cart['product_id'] . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND quantity <= '" . (int)$discount_quantity . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity DESC, priority ASC, price ASC LIMIT 1");

					if ($product_discount_query->num_rows) {
						$price = $product_discount_query->row['price'];
					}

					// Product Specials
					$product_special_query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$cust_cart['product_id'] . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY priority ASC, price ASC LIMIT 1");

					if ($product_special_query->num_rows) {
						$price = $product_special_query->row['price'];
					}
					
					// Stock
					if (!$product_query->row['quantity'] || ($product_query->row['quantity'] < $cust_cart['quantity'])) {
						$stock = false;
					}

					if (isset($product_query->row['name'])) {
						$clear_cart = array();
						$clear_cart[] = array(
							'text' => $this->language->get('text_clear_cart'),
							'href' => $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&clear_cart', true)
						);
		
						if ($product_query->row['image']) {
							$image_cart = $this->model_tool_image->resize($product_query->row['image'], 40, 40);
						} else {
							$image_cart = $this->model_tool_image->resize('no_image.jpg', 40, 40);
						}	

						$data['cart_products'][] = array(
							'image'      			=> $image_cart,
							'product_name'			=> $product_query->row['name'],
							'product_sku'			=> $product_query->row['sku'],
							'product_model'			=> $product_query->row['model'],						
							'product_id'			=> $product_query->row['product_id'],
							'product_options'		=> $option_data,
							'quantity'				=> $cust_cart['quantity'],
							'price'           		=> $this->currency->format(($price + $option_price), $this->config->get('config_currency')),
							'total'           		=> $this->currency->format(($price + $option_price) * $cust_cart['quantity'], $this->config->get('config_currency')),				
							'clear_cart'		    => $clear_cart
						);
					} else {
						$data['error_cart_product'] = $this->language->get('error_cart_product');
					}
																				
				} else {
					$this->model_customer_customer->clearCustomerCart($this->request->get['customer_id']);
				}
		   }
		}

		$data['auth'] = TRUE;
		$data['ldata'] = FALSE;
		$data['adv_ext_name'] = $this->language->get('adv_ext_name');
		$data['adv_ext_short_name'] = 'adv_extended_cust_info';
		$data['adv_ext_version'] = $this->language->get('adv_ext_version');	
		$data['adv_ext_url'] = 'https://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=3292';	

		if (!file_exists(DIR_APPLICATION . 'model/module/adv_settings.php')) {
			$data['module_page'] = $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], true));
		}	
						
		$data['text_confirm_reset'] = $this->language->get('text_confirm_reset');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_all'] = $this->language->get('text_all');
		$data['text_selected'] = $this->language->get('text_selected');
		$data['text_all_status'] = $this->language->get('text_all_status');
				
		$data['column_order_date_added'] = $this->language->get('column_order_date_added');
		$data['column_order_order_id'] = $this->language->get('column_order_order_id');
		$data['column_order_inv_no'] = $this->language->get('column_order_inv_no');	
		$data['column_order_shipping_method'] = $this->language->get('column_order_shipping_method');
		$data['column_order_payment_method'] = $this->language->get('column_order_payment_method');		
		$data['column_order_status'] = $this->language->get('column_order_status');
		$data['column_order_store'] = $this->language->get('column_order_store');
		$data['column_order_currency'] = $this->language->get('column_order_currency');		
		$data['column_order_quantity'] = $this->language->get('column_order_quantity');	
		$data['column_order_sub_total'] = $this->language->get('column_order_sub_total');	
		$data['column_order_shipping'] = $this->language->get('column_order_shipping');
		$data['column_order_tax'] = $this->language->get('column_order_tax');		
		$data['column_order_value'] = $this->language->get('column_order_value');	
		$data['column_total_value'] = $this->language->get('column_total_value');	
		$data['column_sku'] = $this->language->get('column_sku');	
		$data['column_model'] = $this->language->get('column_model');	
		$data['column_image'] = $this->language->get('column_image');	
		$data['column_product'] = $this->language->get('column_product');	
		$data['column_product_options'] = $this->language->get('column_product_options');	
		$data['column_prod_price'] = $this->language->get('column_prod_price');
		$data['column_prod_quantity'] = $this->language->get('column_prod_quantity');
		$data['column_prod_total_excl_vat'] = $this->language->get('column_prod_total_excl_vat');
		$data['column_prod_tax'] = $this->language->get('column_prod_tax');
		$data['column_prod_total_incl_vat'] = $this->language->get('column_prod_total_incl_vat');	
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_prod_total'] = $this->language->get('column_prod_total');
		$data['column_manufacturer'] = $this->language->get('column_manufacturer');
		$data['column_category'] = $this->language->get('column_category');	
		$data['column_unit_price'] = $this->language->get('column_unit_price');	
		$data['column_prod_total'] = $this->language->get('column_prod_total');					
		$data['column_route'] = $this->language->get('column_route');
		$data['column_ip_address'] = $this->language->get('column_ip_address');
		$data['column_current_url'] = $this->language->get('column_current_url');
		$data['column_referrer'] = $this->language->get('column_referrer');
		$data['column_access_date'] = $this->language->get('column_access_date');
		$data['column_access_time'] = $this->language->get('column_access_time');
		$data['column_cust_totals'] = $this->language->get('column_cust_totals');
		
		$data['entry_range'] = $this->language->get('entry_range');
		$data['entry_date_start'] = $this->language->get('entry_date_start');
		$data['entry_date_end'] = $this->language->get('entry_date_end');
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		
    	$data['button_add'] = $this->language->get('button_add');
    	$data['button_remove'] = $this->language->get('button_remove');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_delete_track'] = $this->language->get('button_delete_track');

		$data['tab_order_history'] = $this->language->get('tab_order_history');
		$data['tab_purchased_products'] = $this->language->get('tab_purchased_products');
		$data['tab_cart'] = $this->language->get('tab_cart');	
		$data['tab_wishlist'] = $this->language->get('tab_wishlist');	
		$data['tab_customer_track'] = $this->language->get('tab_customer_track');	
            
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['customer_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_loading'] = $this->language->get('text_loading');
		$data['text_add_ban_ip'] = $this->language->get('text_add_ban_ip');
		$data['text_remove_ban_ip'] = $this->language->get('text_remove_ban_ip');

		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_fax'] = $this->language->get('entry_fax');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_confirm'] = $this->language->get('entry_confirm');
		$data['entry_newsletter'] = $this->language->get('entry_newsletter');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_approved'] = $this->language->get('entry_approved');
		$data['entry_safe'] = $this->language->get('entry_safe');

		$data['entry_note'] = $this->language->get('entry_note');
            
		$data['entry_company'] = $this->language->get('entry_company');
		$data['entry_address_1'] = $this->language->get('entry_address_1');
		$data['entry_address_2'] = $this->language->get('entry_address_2');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_postcode'] = $this->language->get('entry_postcode');
		$data['entry_zone'] = $this->language->get('entry_zone');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_default'] = $this->language->get('entry_default');
		$data['entry_comment'] = $this->language->get('entry_comment');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_amount'] = $this->language->get('entry_amount');
		$data['entry_points'] = $this->language->get('entry_points');

		$data['help_safe'] = $this->language->get('help_safe');
		$data['help_points'] = $this->language->get('help_points');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_address_add'] = $this->language->get('button_address_add');
		$data['button_history_add'] = $this->language->get('button_history_add');
		$data['button_transaction_add'] = $this->language->get('button_transaction_add');
		$data['button_reward_add'] = $this->language->get('button_reward_add');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_upload'] = $this->language->get('button_upload');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_address'] = $this->language->get('tab_address');
		$data['tab_history'] = $this->language->get('tab_history');
		$data['tab_transaction'] = $this->language->get('tab_transaction');
		$data['tab_reward'] = $this->language->get('tab_reward');
		$data['tab_ip'] = $this->language->get('tab_ip');

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['customer_id'])) {
			$data['customer_id'] = $this->request->get['customer_id'];
		} else {
			$data['customer_id'] = 0;
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['firstname'])) {
			$data['error_firstname'] = $this->error['firstname'];
		} else {
			$data['error_firstname'] = '';
		}

		if (isset($this->error['lastname'])) {
			$data['error_lastname'] = $this->error['lastname'];
		} else {
			$data['error_lastname'] = '';
		}

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['telephone'])) {
			$data['error_telephone'] = $this->error['telephone'];
		} else {
			$data['error_telephone'] = '';
		}

		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		if (isset($this->error['confirm'])) {
			$data['error_confirm'] = $this->error['confirm'];
		} else {
			$data['error_confirm'] = '';
		}

		if (isset($this->error['custom_field'])) {
			$data['error_custom_field'] = $this->error['custom_field'];
		} else {
			$data['error_custom_field'] = array();
		}

		if (isset($this->error['address'])) {
			$data['error_address'] = $this->error['address'];
		} else {
			$data['error_address'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_customer_group_id'])) {
			$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_approved'])) {
			$url .= '&filter_approved=' . $this->request->get['filter_approved'];
		}
		
		if (isset($this->request->get['filter_ip'])) {
			$url .= '&filter_ip=' . $this->request->get['filter_ip'];
		}
		
		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['customer_id'])) {
			$data['action'] = $this->url->link('customer/customer/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['customer_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$customer_info = $this->model_customer_customer->getCustomer($this->request->get['customer_id']);
		}

		$this->load->model('customer/customer_group');

		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

		if (isset($this->request->post['customer_group_id'])) {
			$data['customer_group_id'] = $this->request->post['customer_group_id'];
		} elseif (!empty($customer_info)) {
			$data['customer_group_id'] = $customer_info['customer_group_id'];
		} else {
			$data['customer_group_id'] = $this->config->get('config_customer_group_id');
		}

		if (isset($this->request->post['firstname'])) {
			$data['firstname'] = $this->request->post['firstname'];
		} elseif (!empty($customer_info)) {
			$data['firstname'] = $customer_info['firstname'];
		} else {
			$data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$data['lastname'] = $this->request->post['lastname'];
		} elseif (!empty($customer_info)) {
			$data['lastname'] = $customer_info['lastname'];
		} else {
			$data['lastname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (!empty($customer_info)) {
			$data['email'] = $customer_info['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['telephone'])) {
			$data['telephone'] = $this->request->post['telephone'];
		} elseif (!empty($customer_info)) {
			$data['telephone'] = $customer_info['telephone'];
		} else {
			$data['telephone'] = '';
		}

		if (isset($this->request->post['fax'])) {
			$data['fax'] = $this->request->post['fax'];
		} elseif (!empty($customer_info)) {
			$data['fax'] = $customer_info['fax'];
		} else {
			$data['fax'] = '';
		}

		// Custom Fields
		$this->load->model('customer/custom_field');

		$data['custom_fields'] = array();

		$filter_data = array(
			'sort'  => 'cf.sort_order',
			'order' => 'ASC'
		);

		$custom_fields = $this->model_customer_custom_field->getCustomFields($filter_data);

		foreach ($custom_fields as $custom_field) {
			$data['custom_fields'][] = array(
				'custom_field_id'    => $custom_field['custom_field_id'],
				'custom_field_value' => $this->model_customer_custom_field->getCustomFieldValues($custom_field['custom_field_id']),
				'name'               => $custom_field['name'],
				'value'              => $custom_field['value'],
				'type'               => $custom_field['type'],
				'location'           => $custom_field['location'],
				'sort_order'         => $custom_field['sort_order']
			);
		}

		if (isset($this->request->post['custom_field'])) {
			$data['account_custom_field'] = $this->request->post['custom_field'];
		} elseif (!empty($customer_info)) {
			$data['account_custom_field'] = json_decode($customer_info['custom_field'], true);
		} else {
			$data['account_custom_field'] = array();
		}

		if (isset($this->request->post['newsletter'])) {
			$data['newsletter'] = $this->request->post['newsletter'];
		} elseif (!empty($customer_info)) {
			$data['newsletter'] = $customer_info['newsletter'];
		} else {
			$data['newsletter'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($customer_info)) {
			$data['status'] = $customer_info['status'];
		} else {
			$data['status'] = true;
		}

		if (isset($this->request->post['approved'])) {
			$data['approved'] = $this->request->post['approved'];
		} elseif (!empty($customer_info)) {
			$data['approved'] = $customer_info['approved'];
		} else {
			$data['approved'] = true;
		}

		if (isset($this->request->post['safe'])) {
			$data['safe'] = $this->request->post['safe'];
		} elseif (!empty($customer_info)) {
			$data['safe'] = $customer_info['safe'];
		} else {
			$data['safe'] = 0;
		}


		if (isset($this->request->post['note'])) {
			$data['note'] = $this->request->post['note'];
		} elseif (!empty($customer_info)) {
			$data['note'] = $customer_info['note'];
		} else {
			$data['note'] = '';
		}
            
		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}

		if (isset($this->request->post['confirm'])) {
			$data['confirm'] = $this->request->post['confirm'];
		} else {
			$data['confirm'] = '';
		}

		$this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();

		if (isset($this->request->post['address'])) {
			$data['addresses'] = $this->request->post['address'];
		} elseif (isset($this->request->get['customer_id'])) {
			$data['addresses'] = $this->model_customer_customer->getAddresses($this->request->get['customer_id']);
		} else {
			$data['addresses'] = array();
		}

		if (isset($this->request->post['address_id'])) {
			$data['address_id'] = $this->request->post['address_id'];
		} elseif (!empty($customer_info)) {
			$data['address_id'] = $customer_info['address_id'];
		} else {
			$data['address_id'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('customer/customer_form', $data));
	}


	public function delete_track() {
		$this->load->language('customer/customer');
		$this->load->model('customer/customer');
		$this->model_customer_customer->deleteCustomerTrack($this->request->get['customer_id']);
		$furl = '';
		$this->response->redirect($this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . $furl, true));
	}
	
  	public function clear_cart() {
		$this->load->language('customer/customer');
		$this->load->model('customer/customer');
		$this->model_customer_customer->clearCustomerCart($this->request->get['customer_id']);
		$curl = '';
		$this->response->redirect($this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . $curl, true));
	}
	
  	public function delete_wishlist() {
		$this->load->language('customer/customer');
		$this->load->model('customer/customer');
		$this->model_customer_customer->deleteCustomerWishList($this->request->get['customer_id']);
		$wurl = '';
		$this->response->redirect($this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . $wurl, true));
	}	
	
	public function IsInstalled() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE code = 'adv_extended_cust_info'");
		if (empty($query->num_rows)) {
			return false;
		}
		return true;
	}	
            
	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'customer/customer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}

		if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}

		if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error['email'] = $this->language->get('error_email');
		}

		$customer_info = $this->model_customer_customer->getCustomerByEmail($this->request->post['email']);

		if (!isset($this->request->get['customer_id'])) {
			if ($customer_info) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		} else {
			if ($customer_info && ($this->request->get['customer_id'] != $customer_info['customer_id'])) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		}

		if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		// Custom field validation
		$this->load->model('customer/custom_field');

		$custom_fields = $this->model_customer_custom_field->getCustomFields(array('filter_customer_group_id' => $this->request->post['customer_group_id']));

		foreach ($custom_fields as $custom_field) {
			if (($custom_field['location'] == 'account') && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['custom_field_id']])) {
				$this->error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			} elseif (($custom_field['type'] == 'text' && !empty($custom_field['validation']) && $custom_field['location'] == 'account') && !filter_var($this->request->post['custom_field'][$custom_field['custom_field_id']], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $custom_field['validation'])))) {
		        	$this->error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field_validate'), $custom_field['name']);
		        }
		}

		if ($this->request->post['password'] || (!isset($this->request->get['customer_id']))) {
			if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
				$this->error['password'] = $this->language->get('error_password');
			}

			if ($this->request->post['password'] != $this->request->post['confirm']) {
				$this->error['confirm'] = $this->language->get('error_confirm');
			}
		}

		if (isset($this->request->post['address'])) {
			foreach ($this->request->post['address'] as $key => $value) {
				if ((utf8_strlen($value['firstname']) < 1) || (utf8_strlen($value['firstname']) > 32)) {
					$this->error['address'][$key]['firstname'] = $this->language->get('error_firstname');
				}

				if ((utf8_strlen($value['lastname']) < 1) || (utf8_strlen($value['lastname']) > 32)) {
					$this->error['address'][$key]['lastname'] = $this->language->get('error_lastname');
				}

				if ((utf8_strlen($value['address_1']) < 3) || (utf8_strlen($value['address_1']) > 128)) {
					$this->error['address'][$key]['address_1'] = $this->language->get('error_address_1');
				}

				if ((utf8_strlen($value['city']) < 2) || (utf8_strlen($value['city']) > 128)) {
					$this->error['address'][$key]['city'] = $this->language->get('error_city');
				}

				$this->load->model('localisation/country');

				$country_info = $this->model_localisation_country->getCountry($value['country_id']);

				if ($country_info && $country_info['postcode_required'] && (utf8_strlen($value['postcode']) < 2 || utf8_strlen($value['postcode']) > 10)) {
					$this->error['address'][$key]['postcode'] = $this->language->get('error_postcode');
				}

				if ($value['country_id'] == '') {
					$this->error['address'][$key]['country'] = $this->language->get('error_country');
				}

				if (!isset($value['zone_id']) || $value['zone_id'] == '') {
					$this->error['address'][$key]['zone'] = $this->language->get('error_zone');
				}

				foreach ($custom_fields as $custom_field) {
					if (($custom_field['location'] == 'address') && $custom_field['required'] && empty($value['custom_field'][$custom_field['custom_field_id']])) {
						$this->error['address'][$key]['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
					} elseif (($custom_field['type'] == 'text') && !empty($custom_field['validation']) && ($custom_field['location'] == 'address') && !filter_var($value['custom_field'][$custom_field['custom_field_id']], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $custom_field['validation'])))) {
                        			$this->error['address'][$key]['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field_validate'), $custom_field['name']);
                    			}
				}
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'customer/customer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateApprove() {
		if (!$this->user->hasPermission('modify', 'customer/customer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateUnlock() {
		if (!$this->user->hasPermission('modify', 'customer/customer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function login() {
		if (isset($this->request->get['customer_id'])) {
			$customer_id = $this->request->get['customer_id'];
		} else {
			$customer_id = 0;
		}

		$this->load->model('customer/customer');

		$customer_info = $this->model_customer_customer->getCustomer($customer_id);

		if ($customer_info) {
			// Create token to login with
			$token = token(64);

			$this->model_customer_customer->editToken($customer_id, $token);

			if (isset($this->request->get['store_id'])) {
				$store_id = $this->request->get['store_id'];
			} else {
				$store_id = 0;
			}

			$this->load->model('setting/store');

			$store_info = $this->model_setting_store->getStore($store_id);

			if ($store_info) {
				$this->response->redirect($store_info['url'] . 'index.php?route=account/login&token=' . $token);
			} else {
				$this->response->redirect(HTTP_CATALOG . 'index.php?route=account/login&token=' . $token);
			}
		} else {
			$this->load->language('error/not_found');

			$this->document->setTitle($this->language->get('heading_title'));

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_not_found'] = $this->language->get('text_not_found');

			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('error/not_found', 'token=' . $this->session->data['token'], true)
			);

			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}

	public function history() {
		$this->load->language('customer/customer');

		$this->load->model('customer/customer');

		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_comment'] = $this->language->get('column_comment');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['histories'] = array();

		$results = $this->model_customer_customer->getHistories($this->request->get['customer_id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {
			$data['histories'][] = array(
				'comment'    => $result['comment'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$history_total = $this->model_customer_customer->getTotalHistories($this->request->get['customer_id']);

		$pagination = new Pagination();
		$pagination->total = $history_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('customer/customer/history', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($history_total - 10)) ? $history_total : ((($page - 1) * 10) + 10), $history_total, ceil($history_total / 10));

		$this->response->setOutput($this->load->view('customer/customer_history', $data));
	}

	public function addHistory() {
		$this->load->language('customer/customer');

		$json = array();

		if (!$this->user->hasPermission('modify', 'customer/customer')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('customer/customer');

			$this->model_customer_customer->addHistory($this->request->get['customer_id'], $this->request->post['comment']);

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function transaction() {
		$this->load->language('customer/customer');

		$this->load->model('customer/customer');

		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_balance'] = $this->language->get('text_balance');

		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_description'] = $this->language->get('column_description');
		$data['column_amount'] = $this->language->get('column_amount');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['transactions'] = array();

		$results = $this->model_customer_customer->getTransactions($this->request->get['customer_id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {
			$data['transactions'][] = array(
				'amount'      => $this->currency->format($result['amount'], $this->config->get('config_currency')),
				'description' => $result['description'],
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$data['balance'] = $this->currency->format($this->model_customer_customer->getTransactionTotal($this->request->get['customer_id']), $this->config->get('config_currency'));

		$transaction_total = $this->model_customer_customer->getTotalTransactions($this->request->get['customer_id']);

		$pagination = new Pagination();
		$pagination->total = $transaction_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('customer/customer/transaction', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($transaction_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($transaction_total - 10)) ? $transaction_total : ((($page - 1) * 10) + 10), $transaction_total, ceil($transaction_total / 10));

		$this->response->setOutput($this->load->view('customer/customer_transaction', $data));
	}

	public function addTransaction() {
		$this->load->language('customer/customer');

		$json = array();

		if (!$this->user->hasPermission('modify', 'customer/customer')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('customer/customer');

			$this->model_customer_customer->addTransaction($this->request->get['customer_id'], $this->request->post['description'], $this->request->post['amount']);

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function reward() {
		$this->load->language('customer/customer');

		$this->load->model('customer/customer');

		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_balance'] = $this->language->get('text_balance');

		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_description'] = $this->language->get('column_description');
		$data['column_points'] = $this->language->get('column_points');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['rewards'] = array();

		$results = $this->model_customer_customer->getRewards($this->request->get['customer_id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {
			$data['rewards'][] = array(
				'points'      => $result['points'],
				'description' => $result['description'],
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$data['balance'] = $this->model_customer_customer->getRewardTotal($this->request->get['customer_id']);

		$reward_total = $this->model_customer_customer->getTotalRewards($this->request->get['customer_id']);

		$pagination = new Pagination();
		$pagination->total = $reward_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('customer/customer/reward', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($reward_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($reward_total - 10)) ? $reward_total : ((($page - 1) * 10) + 10), $reward_total, ceil($reward_total / 10));

		$this->response->setOutput($this->load->view('customer/customer_reward', $data));
	}

	public function addReward() {
		$this->load->language('customer/customer');

		$json = array();

		if (!$this->user->hasPermission('modify', 'customer/customer')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('customer/customer');

			$this->model_customer_customer->addReward($this->request->get['customer_id'], $this->request->post['description'], $this->request->post['points']);

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function ip() {
		$this->load->language('customer/customer');

		$this->load->model('customer/customer');

		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['column_ip'] = $this->language->get('column_ip');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_date_added'] = $this->language->get('column_date_added');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['ips'] = array();

		$results = $this->model_customer_customer->getIps($this->request->get['customer_id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {
			$data['ips'][] = array(
				'ip'         => $result['ip'],
				'total'      => $this->model_customer_customer->getTotalCustomersByIp($result['ip']),
				'date_added' => date('d/m/y', strtotime($result['date_added'])),
				'filter_ip'  => $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&filter_ip=' . $result['ip'], true)
			);
		}

		$ip_total = $this->model_customer_customer->getTotalIps($this->request->get['customer_id']);

		$pagination = new Pagination();
		$pagination->total = $ip_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('customer/customer/ip', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($ip_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($ip_total - 10)) ? $ip_total : ((($page - 1) * 10) + 10), $ip_total, ceil($ip_total / 10));

		$this->response->setOutput($this->load->view('customer/customer_ip', $data));
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_email'])) {
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_email'])) {
				$filter_email = $this->request->get['filter_email'];
			} else {
				$filter_email = '';
			}

			$this->load->model('customer/customer');

			$filter_data = array(
				'filter_name'  => $filter_name,
				'filter_email' => $filter_email,
				'start'        => 0,
				'limit'        => 5
			);

			
$results = $this->model_customer_customer->getCustomersForAutocomplete($filter_data);
            

			foreach ($results as $result) {
				$json[] = array(
					'customer_id'       => $result['customer_id'],
					'customer_group_id' => $result['customer_group_id'],
					'name'              => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'customer_group'    => $result['customer_group'],
					'firstname'         => $result['firstname'],
					'lastname'          => $result['lastname'],
					'email'             => $result['email'],
					'telephone'         => $result['telephone'],
					'fax'               => $result['fax'],
					'custom_field'      => json_decode($result['custom_field'], true),
					'address'           => $this->model_customer_customer->getAddresses($result['customer_id'])
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function customfield() {
		$json = array();

		$this->load->model('customer/custom_field');

		// Customer Group
		if (isset($this->request->get['customer_group_id'])) {
			$customer_group_id = $this->request->get['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$custom_fields = $this->model_customer_custom_field->getCustomFields(array('filter_customer_group_id' => $customer_group_id));

		foreach ($custom_fields as $custom_field) {
			$json[] = array(
				'custom_field_id' => $custom_field['custom_field_id'],
				'required'        => empty($custom_field['required']) || $custom_field['required'] == 0 ? false : true
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function address() {
		$json = array();

		if (!empty($this->request->get['address_id'])) {
			$this->load->model('customer/customer');

			$json = $this->model_customer_customer->getAddress($this->request->get['address_id']);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
