<?php
class ControllerAccountPurchased extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/purchased', '', true);

			$this->response->redirect($this->url->link('account/login', '', true));
		}

		$this->load->language('account/purchased');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', true)
		);
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('account/purchased', $url, true)
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_empty'] = $this->language->get('text_empty');

		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_total'] = $this->language->get('column_total');

		$data['button_continue'] = $this->language->get('button_continue');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['products'] = array();

		$this->load->model('account/purchased');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		
		$purchased_total = $this->model_account_purchased->getTotalPurchased();
		$counter = 0;
		foreach ($purchased_total as $total) {
			$counter += count($total['counter']);
		}
		$total = $counter;
		
		$results = $this->model_account_purchased->getPurchased(($page - 1) * 10, 10);

		foreach ($results as $result) {
			
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image_product = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image_product = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			$option_data = array();
			$options = $this->model_account_purchased->getOrderOptions($result['order_product_id']);

			foreach ($options as $option) {
				if ($option['type'] != 'textarea' or $option['type'] != 'file' or $option['type'] != 'date' or $option['type'] != 'datetime' or $option['type'] != 'time') {
					$option_data[] = array(
						'name'  => $option['name'],
						'value' => $option['value'],
						'type'  => $option['type']
					);
				}
			}

			$product_info = $this->model_catalog_product->getProduct($result['product_id']);

			if ($product_info) {
				$url_product = $this->url->link('product/product', '&product_id=' . $result['product_id'], true);
			} else {
				$url_product = '';
			}
				
			$data['products'][] = array(
				'product_id' 	=> $result['product_id'],
				'order_id' 		=> $result['product_order_id'],
				'image'      	=> $image_product,
				'model'    		=> $result['model'],
				'name'     		=> $result['name'],
				'url_product'  	=> $url_product,
				'option'   		=> $option_data,
				'quantity' 		=> $result['quantity'],
				'total'      	=> $this->currency->format($result['product_total'], $this->session->data['currency'])
			);
		}
		
		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('account/purchased', 'page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($total - 10)) ? $total : ((($page - 1) * 10) + 10), $total, ceil($total / 10));

		$data['continue'] = $this->url->link('account/account', '', true);

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('account/purchased', $data));
	}
}