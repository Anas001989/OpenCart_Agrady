<?php
class ModelAccountPurchased extends Model {
	public function getPurchased($start = 0, $limit = 20) {
		$query = $this->db->query("SET SESSION group_concat_max_len=256000");
		
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 1;
		}
		
		$query = $this->db->query("SELECT *, (SELECT p.image FROM `" . DB_PREFIX . "product` p WHERE op.product_id = p.product_id) AS image, (SELECT GROUP_CONCAT(CONCAT(oo.name,': ',oo.value) SEPARATOR '; ') FROM `" . DB_PREFIX . "order_option` oo WHERE op.order_product_id = oo.order_product_id AND (oo.type = 'radio' OR oo.type = 'checkbox' OR oo.type = 'select' OR oo.type = 'image' OR oo.type = 'colour' OR oo.type = 'size' OR oo.type = 'multiple') ORDER BY op.order_product_id) AS options, SUM(op.quantity) AS quantity, SUM(op.total+(op.tax*op.quantity)) AS product_total, GROUP_CONCAT('<a href=\"index.php?route=account/order/info&order_id=',op.order_id,'\">#',op.order_id,'</a>' ORDER BY op.order_id DESC SEPARATOR ', ') AS product_order_id FROM `" . DB_PREFIX . "order` o INNER JOIN `" . DB_PREFIX . "order_product` op ON (o.order_id = op.order_id) LEFT JOIN (SELECT oo.order_product_id, GROUP_CONCAT(oo.name, oo.value, oo.type ORDER BY oo.name, oo.value, oo.type) AS options FROM `" . DB_PREFIX . "order_option` oo WHERE (type != 'textarea' OR type != 'file' OR type != 'date' OR type != 'datetime' OR type != 'time') GROUP BY oo.order_product_id) qa ON (op.order_product_id = qa.order_product_id) WHERE o.customer_id = '" . (int)$this->customer->getId() . "' AND o.order_status_id > '0' AND o.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY op.product_id, options ORDER BY quantity DESC LIMIT " . (int)$start . "," . (int)$limit);
		
		return $query->rows;
	}	

	public function getTotalPurchased() {
		$query = $this->db->query("SELECT *, op.product_id AS counter FROM `" . DB_PREFIX . "order` o INNER JOIN `" . DB_PREFIX . "order_product` op ON (o.order_id = op.order_id) LEFT JOIN (SELECT oo.order_product_id, GROUP_CONCAT(oo.name, oo.value, oo.type ORDER BY oo.name, oo.value, oo.type) AS options FROM `" . DB_PREFIX . "order_option` oo WHERE (type != 'textarea' OR type != 'file' OR type != 'date' OR type != 'datetime' OR type != 'time') GROUP BY oo.order_product_id) qa ON (op.order_product_id = qa.order_product_id) WHERE o.customer_id = '" . (int)$this->customer->getId() . "' AND o.order_status_id > '0' AND o.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY counter, options");
		
		return $query->rows;
	}
	
	public function getOrderOptions($order_product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_product_id = '" . (int)$order_product_id . "'");

		return $query->rows;
	}	
}