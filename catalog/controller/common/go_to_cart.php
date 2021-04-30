<?php
class ControllerCommonGoToCart extends Controller {
	public function index($product_id) {
		$this->load->language('product/go_to_cart');

		$cart_product_id=$this->getCartproductid();

		if(in_array($product_id,$cart_product_id)){
			$go_cart=1;
		} else {
			$go_cart=0;
		}

		return $go_cart;
	}
	public function getCartproductid(){
		$products=array();
		foreach ($this->cart->getProducts() as $product) {

			$products[]=$product['product_id'];
		}
		return $products;
	}
	public function getCartButton(){
		$this->load->language('product/go_to_cart');
		$data['go_to_cart_button_text_color'] = $this->config->get('go_to_cart_button_text_color');
		$data['go_to_cart_button_color'] = $this->config->get('go_to_cart_button_color');
		if(VERSION>=2.2) {
		return $this->load->view('common/go_to_cart', $data);
		}
		else
		{
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/go_to_cart.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/go_to_cart.tpl', $data);
		} else {
			return $this->load->view('default/template/common/go_to_cart.tpl', $data);
		}
		}
	}
	public function getCartproductoptionid(){
		$json=array();
		foreach ($this->cart->getProducts() as $product) {
			if($product['product_id']==$this->request->post['product_id']){
				if(!empty($product['option'])){
					foreach ($product['option'] as $option) {
						if ($option['product_option_id'] == $this->request->post['product_option_id'] && $option['product_option_value_id'] == $this->request->post['product_option_value_id']) {
							$json['success']=1;
						}
					}
				}
			}
		}
		$this->load->language('product/go_to_cart');
		$json['go_to_cart']=$this->url->link('checkout/cart');
		$json['text_go_to_cart']=$this->language->get('text_go_to_cart');
		$json['text_loading'] = $this->language->get('text_loading');
		$json['button_cart'] = $this->language->get('button_cart');
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
