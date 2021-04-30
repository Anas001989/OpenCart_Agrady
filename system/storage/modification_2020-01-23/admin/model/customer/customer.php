<?php
class ModelCustomerCustomer extends Model {

	public function getCustomerOrders($data = array(), $customer_id) {		
		$token = $this->session->data['token'];
		
		if (isset($data['filter_orders_date_start']) && $data['filter_orders_date_start']) {
			$date_start = $data['filter_orders_date_start'];
		} else {
			$date_start = '';
		}

		if (isset($data['filter_orders_date_end']) && $data['filter_orders_date_end']) {
			$date_end = $data['filter_orders_date_end'];
		} else {
			$date_end = '';
		}

		if (isset($data['filter_orders_range'])) {
			$range_orders = $data['filter_orders_range'];
		} else {
			$range_orders = 'all_time';
		}
		
		switch($range_orders) 
		{
			case 'custom';
				$date_start = "DATE(date_added) >= '" . $this->db->escape($data['filter_orders_date_start']) . "'";
				$date_end = " AND DATE(date_added) <= '" . $this->db->escape($data['filter_orders_date_end']) . "'";				
				break;
			case 'today';
				$date_start = "DATE(date_added) = CURDATE()";
				$date_end = '';
				break;
			case 'yesterday';
				$date_start = "DATE(date_added) >= DATE_ADD(CURDATE(), INTERVAL -1 DAY)";
				$date_end = " AND DATE(date_added) < CURDATE()";
				break;					
			case 'week';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-7 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";	
				break;			
			case 'month';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-30 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";					
				break;			
			case 'quarter';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-91 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";						
				break;
			case 'year';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-365 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";					
				break;
			case 'current_week';
				$date_start = "DATE(date_added) >= CURDATE() - WEEKDAY(CURDATE())";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";			
				break;	
			case 'current_month';
				$date_start = "YEAR(date_added) = YEAR(CURDATE())";
				$date_end = " AND MONTH(date_added) = MONTH(CURDATE())";			
				break;
			case 'current_quarter';
				$date_start = "QUARTER(date_added) = QUARTER(CURDATE())";
				$date_end = " AND YEAR(date_added) = YEAR(CURDATE())";					
				break;					
			case 'current_year';
				$date_start = "YEAR(date_added) = YEAR(CURDATE())";
				$date_end = '';			
				break;					
			case 'last_week';
				$date_start = "DATE(date_added) >= CURDATE() - INTERVAL DAYOFWEEK(CURDATE())+5 DAY";
				$date_end = " AND DATE(date_added) < CURDATE() - INTERVAL DAYOFWEEK(CURDATE())-2 DAY";				
				break;	
			case 'last_month';
				$date_start = "DATE(date_added) >= DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y/%m/01')";
				$date_end = " AND DATE(date_added) < DATE_FORMAT(CURRENT_DATE, '%Y/%m/01')";				
				break;
			case 'last_quarter';
				$date_start = "QUARTER(date_added) = QUARTER(DATE_ADD(NOW(), INTERVAL -3 MONTH))";
				$date_end = '';				
				break;					
			case 'last_year';
				$date_start = "DATE(date_added) >= DATE_FORMAT(CURRENT_DATE - INTERVAL 1 YEAR, '%Y/01/01')";
				$date_end = " AND DATE(date_added) < DATE_FORMAT(CURRENT_DATE, '%Y/01/01')";				
				break;					
			case 'all_time';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d','0')) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";						
				break;	
		}

		$date = ' AND (' . $date_start . $date_end . ')';

		$order_status = '';
		if (!empty($data['filter_orders_order_status'])) {
			$order_status = " AND (";
			$implode = array();
			foreach ($data['filter_orders_order_status'] as $filter_orders_order_status) {
				$implode[] = "o.order_status_id = '" . (int)$filter_orders_order_status . "'";
			}

			if ($implode) {
				$order_status .= implode(" OR ", $implode) . "";
			}
			$order_status .= ")";
		} else {
		$order_status = ' AND o.order_status_id > 0';
		}

		$sql = "SELECT *, 
		CONCAT(o.invoice_prefix, ' ', o.invoice_no) AS inv_number, 
		(SELECT SUM(op.quantity) FROM `" . DB_PREFIX . "order_product` op WHERE op.order_id = o.order_id GROUP BY op.order_id) AS products, 
		(SELECT SUM(ot.value) FROM `" . DB_PREFIX . "order_total` ot WHERE ot.order_id = o.order_id AND ot.code = 'sub_total' GROUP BY ot.order_id) AS sub_total, 
		(SELECT SUM(ot.value) FROM `" . DB_PREFIX . "order_total` ot WHERE ot.order_id = o.order_id AND ot.code = 'shipping' GROUP BY ot.order_id) AS shipping, 
		(SELECT SUM(ROUND(ot.value, 2)) FROM `" . DB_PREFIX . "order_total` ot WHERE ot.order_id = o.order_id AND ot.code = 'tax' GROUP BY ot.order_id) AS tax, 
		(SELECT os.name FROM `" . DB_PREFIX . "order_status` os WHERE os.order_status_id = o.order_status_id AND os.language_id = '" . (int)$this->config->get('config_language_id') . "') AS os_name, 
		(SELECT SUM(op.quantity) FROM `" . DB_PREFIX . "order` o, `" . DB_PREFIX . "order_product` op WHERE op.order_id = o.order_id AND o.customer_id = '" . $customer_id . "'" . $date . $order_status . " GROUP BY o.customer_id) AS total_products, 
		(SELECT SUM(ot.value) FROM `" . DB_PREFIX . "order` o, `" . DB_PREFIX . "order_total` ot WHERE ot.order_id = o.order_id AND ot.code = 'sub_total' AND o.customer_id = '" . $customer_id . "'" . $date . $order_status . " GROUP BY o.customer_id) AS total_sub_total, 
		(SELECT SUM(ot.value) FROM `" . DB_PREFIX . "order` o, `" . DB_PREFIX . "order_total` ot WHERE ot.order_id = o.order_id AND ot.code = 'shipping' AND o.customer_id = '" . $customer_id . "'" . $date . $order_status . " GROUP BY o.customer_id) AS total_shipping, 
		(SELECT SUM(ot.value) FROM `" . DB_PREFIX . "order` o, `" . DB_PREFIX . "order_total` ot WHERE ot.order_id = o.order_id AND ot.code = 'tax' AND o.customer_id = '" . $customer_id . "'" . $date . $order_status . " GROUP BY o.customer_id) AS total_tax, 
		(SELECT SUM(o.total) FROM `" . DB_PREFIX . "order` o WHERE o.customer_id = '" . $customer_id . "'" . $date . $order_status . " GROUP BY o.customer_id) AS total_value 
		
		FROM `" . DB_PREFIX . "order` o WHERE o.customer_id = '" . $customer_id . "'" . $date . $order_status;
		
		$sql .= " GROUP BY o.order_id";
		
		$sort_data = array(
			'o.order_id',
			'o.date_added',
			'inv_number',
			'o.shipping_method',
			'o.payment_method',
			'os_name',
			'o.store_name',
			'o.currency_code',			
			'products',
			'sub_total',												
			'shipping',
			'tax',
			'o.total'
		);	
			
		if (isset($data['sort_orders']) && in_array($data['sort_orders'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort_orders'];	
		} else {
			$sql .= " ORDER BY order_id";	
		}
			
		if (isset($data['order_orders']) && ($data['order_orders'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
					
		if (isset($data['start_orders']) || isset($data['limit_orders'])) {
			if ($data['start_orders'] < 0) {
				$data['start_orders'] = 0;
			}				

			if ($data['limit_orders'] < 1) {
				$data['limit_orders'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start_orders'] . "," . (int)$data['limit_orders'];
		}
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}	

	public function getCustomerOrdersTotal($data = array(), $customer_id) {
		if (isset($data['filter_orders_date_start']) && $data['filter_orders_date_start']) {
			$date_start = $data['filter_orders_date_start'];
		} else {
			$date_start = '';
		}

		if (isset($data['filter_orders_date_end']) && $data['filter_orders_date_end']) {
			$date_end = $data['filter_orders_date_end'];
		} else {
			$date_end = '';
		}

		if (isset($data['filter_orders_range'])) {
			$range_orders = $data['filter_orders_range'];
		} else {
			$range_orders = 'all_time';
		}
		
		switch($range_orders) 
		{
			case 'custom';
				$date_start = "DATE(date_added) >= '" . $this->db->escape($data['filter_orders_date_start']) . "'";
				$date_end = " AND DATE(date_added) <= '" . $this->db->escape($data['filter_orders_date_end']) . "'";				
				break;
			case 'today';
				$date_start = "DATE(date_added) = CURDATE()";
				$date_end = '';
				break;
			case 'yesterday';
				$date_start = "DATE(date_added) >= DATE_ADD(CURDATE(), INTERVAL -1 DAY)";
				$date_end = " AND DATE(date_added) < CURDATE()";
				break;					
			case 'week';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-7 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";	
				break;			
			case 'month';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-30 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";					
				break;			
			case 'quarter';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-91 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";						
				break;
			case 'year';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-365 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";					
				break;
			case 'current_week';
				$date_start = "DATE(date_added) >= CURDATE() - WEEKDAY(CURDATE())";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";			
				break;	
			case 'current_month';
				$date_start = "YEAR(date_added) = YEAR(CURDATE())";
				$date_end = " AND MONTH(date_added) = MONTH(CURDATE())";			
				break;
			case 'current_quarter';
				$date_start = "QUARTER(date_added) = QUARTER(CURDATE())";
				$date_end = " AND YEAR(date_added) = YEAR(CURDATE())";					
				break;					
			case 'current_year';
				$date_start = "YEAR(date_added) = YEAR(CURDATE())";
				$date_end = '';			
				break;					
			case 'last_week';
				$date_start = "DATE(date_added) >= CURDATE() - INTERVAL DAYOFWEEK(CURDATE())+5 DAY";
				$date_end = " AND DATE(date_added) < CURDATE() - INTERVAL DAYOFWEEK(CURDATE())-2 DAY";				
				break;	
			case 'last_month';
				$date_start = "DATE(date_added) >= DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y/%m/01')";
				$date_end = " AND DATE(date_added) < DATE_FORMAT(CURRENT_DATE, '%Y/%m/01')";				
				break;
			case 'last_quarter';
				$date_start = "QUARTER(date_added) = QUARTER(DATE_ADD(NOW(), INTERVAL -3 MONTH))";
				$date_end = '';				
				break;					
			case 'last_year';
				$date_start = "DATE(date_added) >= DATE_FORMAT(CURRENT_DATE - INTERVAL 1 YEAR, '%Y/01/01')";
				$date_end = " AND DATE(date_added) < DATE_FORMAT(CURRENT_DATE, '%Y/01/01')";				
				break;					
			case 'all_time';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d','0')) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";						
				break;	
		}

		$sql = "SELECT COUNT(o.order_id) AS total FROM `" . DB_PREFIX . "order` o WHERE o.customer_id = '" . (int)$customer_id . "'";

		if (!empty($data['filter_orders_order_status'])) {
			$sql .= " AND (";
			$implode = array();
			foreach ($data['filter_orders_order_status'] as $filter_orders_order_status) {
				$implode[] = "o.order_status_id = '" . (int)$filter_orders_order_status . "'";
			}

			if ($implode) {
				$sql .= implode(" OR ", $implode) . "";
			}
			$sql .= ")";
		} else {
			$sql .= " AND o.order_status_id > '0'";
		}
				
		$sql .= ' AND (' . $date_start . $date_end . ')';
				
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}

	public function getCustomerProducts($data = array(), $customer_id) {		
		$token = $this->session->data['token'];
		
		if (isset($data['filter_products_date_start']) && $data['filter_products_date_start']) {
			$date_start = $data['filter_products_date_start'];
		} else {
			$date_start = '';
		}

		if (isset($data['filter_products_date_end']) && $data['filter_products_date_end']) {
			$date_end = $data['filter_products_date_end'];
		} else {
			$date_end = '';
		}

		if (isset($data['filter_products_range'])) {
			$range_products = $data['filter_products_range'];
		} else {
			$range_products = 'all_time';

		}
		
		switch($range_products) 
		{
			case 'custom';
				$date_start = "DATE(date_added) >= '" . $this->db->escape($data['filter_products_date_start']) . "'";
				$date_end = " AND DATE(date_added) <= '" . $this->db->escape($data['filter_products_date_end']) . "'";				
				break;
			case 'today';
				$date_start = "DATE(date_added) = CURDATE()";
				$date_end = '';
				break;
			case 'yesterday';
				$date_start = "DATE(date_added) >= DATE_ADD(CURDATE(), INTERVAL -1 DAY)";
				$date_end = " AND DATE(date_added) < CURDATE()";
				break;					
			case 'week';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-7 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";	
				break;			
			case 'month';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-30 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";					
				break;			
			case 'quarter';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-91 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";						
				break;
			case 'year';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-365 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";					
				break;
			case 'current_week';
				$date_start = "DATE(date_added) >= CURDATE() - WEEKDAY(CURDATE())";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";			
				break;	
			case 'current_month';
				$date_start = "YEAR(date_added) = YEAR(CURDATE())";
				$date_end = " AND MONTH(date_added) = MONTH(CURDATE())";			
				break;
			case 'current_quarter';
				$date_start = "QUARTER(date_added) = QUARTER(CURDATE())";
				$date_end = " AND YEAR(date_added) = YEAR(CURDATE())";					
				break;					
			case 'current_year';
				$date_start = "YEAR(date_added) = YEAR(CURDATE())";
				$date_end = '';			
				break;					
			case 'last_week';
				$date_start = "DATE(date_added) >= CURDATE() - INTERVAL DAYOFWEEK(CURDATE())+5 DAY";
				$date_end = " AND DATE(date_added) < CURDATE() - INTERVAL DAYOFWEEK(CURDATE())-2 DAY";				
				break;	
			case 'last_month';
				$date_start = "DATE(date_added) >= DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y/%m/01')";
				$date_end = " AND DATE(date_added) < DATE_FORMAT(CURRENT_DATE, '%Y/%m/01')";				
				break;
			case 'last_quarter';
				$date_start = "QUARTER(date_added) = QUARTER(DATE_ADD(NOW(), INTERVAL -3 MONTH))";
				$date_end = '';				
				break;					
			case 'last_year';
				$date_start = "DATE(date_added) >= DATE_FORMAT(CURRENT_DATE - INTERVAL 1 YEAR, '%Y/01/01')";
				$date_end = " AND DATE(date_added) < DATE_FORMAT(CURRENT_DATE, '%Y/01/01')";				
				break;					
			case 'all_time';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d','0')) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";						
				break;	
		}

		$date = ' AND (' . $date_start . $date_end . ')';

		$order_status = '';
		if (!empty($data['filter_products_order_status'])) {
			$order_status = " AND (";
			$implode = array();
			foreach ($data['filter_products_order_status'] as $filter_products_order_status) {
				$implode[] = "o.order_status_id = '" . (int)$filter_products_order_status . "'";
			}

			if ($implode) {
				$order_status .= implode(" OR ", $implode) . "";
			}
			$order_status .= ")";
		} else {
		$order_status = ' AND o.order_status_id > 0';
		}

		$sql = "SELECT 
		(SELECT p.image FROM `" . DB_PREFIX . "product` p WHERE op.product_id = p.product_id) AS image, 
		(SELECT p.sku FROM `" . DB_PREFIX . "product` p WHERE op.product_id = p.product_id) AS sku, 
		op.product_id, 
		op.order_product_id, 
		op.model, 		
		op.name, 
		(SELECT GROUP_CONCAT(CONCAT(oo.name,': ',oo.value) SEPARATOR '; ') FROM `" . DB_PREFIX . "order_option` oo WHERE op.order_product_id = oo.order_product_id AND (oo.type = 'radio' OR oo.type = 'checkbox' OR oo.type = 'select' OR oo.type = 'image' OR oo.type = 'colour' OR oo.type = 'size' OR oo.type = 'multiple') ORDER BY op.order_product_id) AS options, 
		(SELECT GROUP_CONCAT(cd.name SEPARATOR ', ') FROM `" . DB_PREFIX . "category_description` cd, `" . DB_PREFIX . "category` c, `" . DB_PREFIX . "product_to_category` p2c WHERE op.product_id = p2c.product_id AND p2c.category_id = c.category_id AND (c.category_id = cd.category_id OR c.parent_id = cd.category_id) AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status > 0) AS categories, 
		(SELECT m.name FROM `" . DB_PREFIX . "manufacturer` m, `" . DB_PREFIX . "product` p WHERE p.manufacturer_id = m.manufacturer_id AND op.product_id = p.product_id) AS manufacturer, 
		SUM(op.quantity) AS quantity, 
		SUM(op.total) AS total_excl_vat, 
		SUM(op.tax*op.quantity) AS prod_tax, 
		SUM(op.total+(op.tax*op.quantity)) AS total_incl_vat, 
		GROUP_CONCAT('<a href=\"index.php?route=sale/order/info&token=$token&order_id=',op.order_id,'\">',op.order_id,'</a>' ORDER BY op.order_id DESC SEPARATOR '<br>') AS product_order_ord_id, 
		GROUP_CONCAT(op.order_id ORDER BY op.order_id DESC SEPARATOR '<br>') AS product_order_ord_idc, ";
		if ($this->config->get('adveci_date_format') == 'DDMMYYYY') {																																																																																																																																																																																																																																												   			$sql .= "GROUP_CONCAT(DATE_FORMAT(o.date_added, '%d/%m/%Y') ORDER BY op.order_id DESC SEPARATOR '<br>') AS product_order_date, ";
		} else {	
			$sql .= "GROUP_CONCAT(DATE_FORMAT(o.date_added, '%m/%d/%Y') ORDER BY op.order_id DESC SEPARATOR '<br>') AS product_order_date, ";
		}
		$sql .= "GROUP_CONCAT(IFNULL(o.invoice_prefix,'&nbsp;&nbsp;'),IFNULL(o.invoice_no,'&nbsp;&nbsp;') ORDER BY op.order_id DESC SEPARATOR '<br>') AS product_order_inv_no, 
		GROUP_CONCAT(IF (o.shipping_method = '','&nbsp;&nbsp;',o.shipping_method) ORDER BY op.order_id DESC SEPARATOR '<br>') AS product_order_shipping_method, 
		GROUP_CONCAT(IF (o.payment_method = '','&nbsp;&nbsp;',o.payment_method) ORDER BY op.order_id DESC SEPARATOR '<br>') AS product_order_payment_method, 
		GROUP_CONCAT(IFNULL((SELECT os.name FROM `" . DB_PREFIX . "order_status` os WHERE os.order_status_id = o.order_status_id AND os.language_id = '" . (int)$this->config->get('config_language_id') . "'),'&nbsp;&nbsp;') ORDER BY op.order_id DESC SEPARATOR '<br>') AS product_order_status, 
 		GROUP_CONCAT(o.store_name ORDER BY op.order_id DESC SEPARATOR '<br>') AS product_order_store, 
		GROUP_CONCAT(o.currency_code ORDER BY op.order_id DESC SEPARATOR '<br>') AS product_order_currency, 
		GROUP_CONCAT(ROUND(o.currency_value*op.price, 2) ORDER BY op.order_id DESC SEPARATOR '<br>') AS product_order_price, 
		GROUP_CONCAT(op.quantity ORDER BY op.order_id DESC SEPARATOR '<br>') AS product_order_quantity, 
		GROUP_CONCAT(ROUND(o.currency_value*op.total, 2) ORDER BY op.order_id DESC SEPARATOR '<br>') AS product_order_total_excl_vat, 
		GROUP_CONCAT(ROUND(o.currency_value*op.tax*op.quantity, 2) ORDER BY op.order_id DESC SEPARATOR '<br>') AS product_order_tax, 
		GROUP_CONCAT(ROUND(o.currency_value*(op.total+(op.tax*op.quantity)), 2) ORDER BY op.order_id DESC SEPARATOR '<br>') AS product_order_total_incl_vat, 
		(SELECT SUM(op.quantity) FROM `" . DB_PREFIX . "order_product` op, `" . DB_PREFIX . "order` o WHERE op.order_id = o.order_id AND o.customer_id = '" . $customer_id . "'" . $date . $order_status . ") AS total_quantity, 
		(SELECT SUM(op.total) FROM `" . DB_PREFIX . "order_product` op, `" . DB_PREFIX . "order` o WHERE op.order_id = o.order_id AND o.customer_id = '" . $customer_id . "'" . $date . $order_status . ") AS total_total_excl_vat, 
		(SELECT SUM(op.tax*op.quantity) FROM `" . DB_PREFIX . "order_product` op, `" . DB_PREFIX . "order` o WHERE op.order_id = o.order_id AND o.customer_id = '" . $customer_id . "'" . $date . $order_status . ") AS total_prod_tax, 
		(SELECT SUM(op.total+(op.tax*op.quantity)) FROM `" . DB_PREFIX . "order_product` op, `" . DB_PREFIX . "order` o WHERE op.order_id = o.order_id AND o.customer_id = '" . $customer_id . "'" . $date . $order_status . ") AS total_total_incl_vat 
		
		FROM `" . DB_PREFIX . "order` o INNER JOIN `" . DB_PREFIX . "order_product` op ON (o.order_id = op.order_id) LEFT JOIN (SELECT oo.order_product_id, GROUP_CONCAT(oo.name, oo.value, oo.type ORDER BY oo.name, oo.value, oo.type) AS options FROM `" . DB_PREFIX . "order_option` oo WHERE (type != 'textarea' OR type != 'file' OR type != 'date' OR type != 'datetime' OR type != 'time') GROUP BY oo.order_product_id) qa ON (op.order_product_id = qa.order_product_id) WHERE o.customer_id = '" . $customer_id . "'" . $date . $order_status;
		
		$sql .= " GROUP BY op.product_id, options";
		
		$sort_data = array(
			'sku',
			'op.model',
			'op.name',
			'categories',
			'manufacturer',
			'quantity',
			'total_excl_vat',
			'prod_tax',			
			'total_incl_vat'
		);	

		if (isset($data['sort_products']) && in_array($data['sort_products'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort_products'];	
		} else {
			$sql .= " ORDER BY quantity";	
		}
			
		if (isset($data['order_products']) && ($data['order_products'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
					
		if (isset($data['start_products']) || isset($data['limit_products'])) {
			if ($data['start_products'] < 0) {
				$data['start_products'] = 0;
			}				

			if ($data['limit_products'] < 1) {
				$data['limit_products'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start_products'] . "," . (int)$data['limit_products'];
		}
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}	

	public function getCustomerProductsTotal($data = array(), $customer_id) {
		if (isset($data['filter_products_date_start']) && $data['filter_products_date_start']) {
			$date_start = $data['filter_products_date_start'];
		} else {
			$date_start = '';
		}

		if (isset($data['filter_products_date_end']) && $data['filter_products_date_end']) {
			$date_end = $data['filter_products_date_end'];
		} else {
			$date_end = '';
		}

		if (isset($data['filter_products_range'])) {
			$range_products = $data['filter_products_range'];
		} else {
			$range_products = 'all_time';
		}
		
		switch($range_products) 
		{
			case 'custom';
				$date_start = "DATE(date_added) >= '" . $this->db->escape($data['filter_products_date_start']) . "'";
				$date_end = " AND DATE(date_added) <= '" . $this->db->escape($data['filter_products_date_end']) . "'";				
				break;
			case 'today';
				$date_start = "DATE(date_added) = CURDATE()";
				$date_end = '';
				break;
			case 'yesterday';
				$date_start = "DATE(date_added) >= DATE_ADD(CURDATE(), INTERVAL -1 DAY)";
				$date_end = " AND DATE(date_added) < CURDATE()";
				break;					
			case 'week';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-7 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";	
				break;			
			case 'month';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-30 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";					
				break;			
			case 'quarter';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-91 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";						
				break;
			case 'year';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d', strtotime('-365 day'))) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";					
				break;
			case 'current_week';
				$date_start = "DATE(date_added) >= CURDATE() - WEEKDAY(CURDATE())";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";			
				break;	
			case 'current_month';
				$date_start = "YEAR(date_added) = YEAR(CURDATE())";
				$date_end = " AND MONTH(date_added) = MONTH(CURDATE())";			
				break;
			case 'current_quarter';
				$date_start = "QUARTER(date_added) = QUARTER(CURDATE())";
				$date_end = " AND YEAR(date_added) = YEAR(CURDATE())";					
				break;					
			case 'current_year';
				$date_start = "YEAR(date_added) = YEAR(CURDATE())";
				$date_end = '';			
				break;					
			case 'last_week';
				$date_start = "DATE(date_added) >= CURDATE() - INTERVAL DAYOFWEEK(CURDATE())+5 DAY";
				$date_end = " AND DATE(date_added) < CURDATE() - INTERVAL DAYOFWEEK(CURDATE())-2 DAY";				
				break;	
			case 'last_month';
				$date_start = "DATE(date_added) >= DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y/%m/01')";
				$date_end = " AND DATE(date_added) < DATE_FORMAT(CURRENT_DATE, '%Y/%m/01')";				
				break;
			case 'last_quarter';
				$date_start = "QUARTER(date_added) = QUARTER(DATE_ADD(NOW(), INTERVAL -3 MONTH))";
				$date_end = '';				
				break;					
			case 'last_year';
				$date_start = "DATE(date_added) >= DATE_FORMAT(CURRENT_DATE - INTERVAL 1 YEAR, '%Y/01/01')";
				$date_end = " AND DATE(date_added) < DATE_FORMAT(CURRENT_DATE, '%Y/01/01')";				
				break;					
			case 'all_time';
				$date_start = "DATE(date_added) >= '" . $this->db->escape(date('Y-m-d','0')) . "'";
				$date_end = " AND DATE(date_added) <= DATE (NOW())";						
				break;	
		}

		$sql = "SELECT *, op.product_id AS counter FROM `" . DB_PREFIX . "order` o INNER JOIN `" . DB_PREFIX . "order_product` op ON (o.order_id = op.order_id) LEFT JOIN (SELECT oo.order_product_id, GROUP_CONCAT(oo.name, oo.value, oo.type ORDER BY oo.name, oo.value, oo.type) AS options FROM `" . DB_PREFIX . "order_option` oo WHERE (type != 'textarea' OR type != 'file' OR type != 'date' OR type != 'datetime' OR type != 'time') GROUP BY oo.order_product_id) qa ON (op.order_product_id = qa.order_product_id) WHERE o.customer_id = '" . (int)$customer_id . "'";

		if (!empty($data['filter_products_order_status'])) {
			$sql .= " AND (";
			$implode = array();
			foreach ($data['filter_products_order_status'] as $filter_products_order_status) {
				$implode[] = "o.order_status_id = '" . (int)$filter_products_order_status . "'";
			}

			if ($implode) {
				$sql .= implode(" OR ", $implode) . "";
			}
			$sql .= ")";
		} else {
			$sql .= " AND o.order_status_id > '0'";
		}
				
		$sql .= ' AND (' . $date_start . $date_end . ')';
		
		$sql .= " GROUP BY counter, options";
				
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
				
	public function getCustomerTrack($data = array(), $customer_id) {		
		if (isset($data['filter_start_date']) && $data['filter_start_date']) {
			$date_start = $data['filter_start_date'];
		} else {
			$date_start = '';
		}

		if (isset($data['filter_end_date']) && $data['filter_end_date']) {
			$date_end = $data['filter_end_date'];
		} else {
			$date_end = '';
		}

		if (isset($data['filter_range'])) {
			$range = $data['filter_range'];
		} else {
			$range = 'all_time'; //show All Time in Statistical Range by default
		}

		switch($range) 
		{
			case 'custom';
				$date_start = "DATE(ct.access_time) >= '" . $this->db->escape($data['filter_start_date']) . "'";
				$date_end = " AND DATE(ct.access_time) <= '" . $this->db->escape($data['filter_end_date']) . "'";				
				break;
			case 'today';
				$date_start = "DATE(ct.access_time) = CURDATE()";
				$date_end = '';
				break;
			case 'yesterday';
				$date_start = "DATE(ct.access_time) >= DATE_ADD(CURDATE(), INTERVAL -1 DAY)";
				$date_end = " AND DATE(ct.access_time) < CURDATE()";
				break;
			case 'week';
				$date_start = "DATE(ct.access_time) >= '" . $this->db->escape(date('Y-m-d', strtotime('-7 day'))) . "'";
				$date_end = " AND DATE(ct.access_time) <= DATE (NOW())";	
				break;
			case 'month';
				$date_start = "DATE(ct.access_time) >= '" . $this->db->escape(date('Y-m-d', strtotime('-30 day'))) . "'";
				$date_end = " AND DATE(ct.access_time) <= DATE (NOW())";					
				break;			
			case 'quarter';
				$date_start = "DATE(ct.access_time) >= '" . $this->db->escape(date('Y-m-d', strtotime('-91 day'))) . "'";
				$date_end = " AND DATE(ct.access_time) <= DATE (NOW())";						
				break;
			case 'year';
				$date_start = "DATE(ct.access_time) >= '" . $this->db->escape(date('Y-m-d', strtotime('-365 day'))) . "'";
				$date_end = " AND DATE(ct.access_time) <= DATE (NOW())";					
				break;
			case 'current_week';
				$date_start = "DATE(ct.access_time) >= CURDATE() - WEEKDAY(CURDATE())";
				$date_end = " AND DATE(ct.access_time) <= DATE (NOW())";			
				break;	
			case 'current_month';
				$date_start = "YEAR(ct.access_time) = YEAR(CURDATE())";
				$date_end = " AND MONTH(ct.access_time) = MONTH(CURDATE())";			
				break;
			case 'current_quarter';
				$date_start = "QUARTER(ct.access_time) = QUARTER(CURDATE())";
				$date_end = " AND YEAR(ct.access_time) = YEAR(CURDATE())";					
				break;					
			case 'current_year';
				$date_start = "YEAR(ct.access_time) = YEAR(CURDATE())";
				$date_end = '';			
				break;					
			case 'last_week';
				$date_start = "DATE(ct.access_time) >= CURDATE() - INTERVAL DAYOFWEEK(CURDATE())+5 DAY";
				$date_end = " AND DATE(ct.access_time) < CURDATE() - INTERVAL DAYOFWEEK(CURDATE())-2 DAY";				
				break;	
			case 'last_month';
				$date_start = "DATE(ct.access_time) >= DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y/%m/01')";
				$date_end = " AND DATE(ct.access_time) < DATE_FORMAT(CURRENT_DATE, '%Y/%m/01')";				
				break;
			case 'last_quarter';
				$date_start = "QUARTER(ct.access_time) = QUARTER(DATE_ADD(NOW(), INTERVAL -3 MONTH))";
				$date_end = '';
				break;					
			case 'last_year';
				$date_start = "DATE(ct.access_time) >= DATE_FORMAT(CURRENT_DATE - INTERVAL 1 YEAR, '%Y/01/01')";
				$date_end = " AND DATE(ct.access_time) < DATE_FORMAT(CURRENT_DATE, '%Y/01/01')";				
				break;					
			case 'all_time';
				$date_start = "DATE(ct.access_time) >= '" . $this->db->escape(date('Y-m-d','0')) . "'";
				$date_end = " AND DATE(ct.access_time) <= DATE (NOW())";						
				break;	
		}
				
		$sql = "SELECT ct.route, ct.ip_address, ct.customer_id, ct.current_url, ct.referrer, ct.agent_type, ct.access_time FROM `" . DB_PREFIX . "customer_track` ct LEFT OUTER JOIN `" . DB_PREFIX . "customer` cus ON ct.customer_id = cus.customer_id WHERE ct.customer_id = '" . $customer_id . "'";
		
		$sql .= ' AND (' . $date_start . $date_end . ')';
		
		$sort_data = array(
			'route',
			'current_url',
			'referrer',											
			'access_time'
		);	
			
		if (isset($data['sort_track']) && in_array($data['sort_track'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort_track'];	
		} else {
			$sql .= " ORDER BY access_time";	
		}
			
		if (isset($data['order_track']) && ($data['order_track'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
					
		if (isset($data['start_track']) || isset($data['limit_track'])) {
			if ($data['start_track'] < 0) {
				$data['start_track'] = 0;
			}				

			if ($data['limit_track'] < 1) {
				$data['limit_track'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start_track'] . "," . (int)$data['limit_track'];
		}
		
		$query = $this->db->query($sql);
	
		return $query->rows;
	}	

	public function getCustomerTrackTotal($data = array(), $customer_id) {		
		if (isset($data['filter_start_date']) && $data['filter_start_date']) {
			$date_start = $data['filter_start_date'];
		} else {
			$date_start = '';
		}

		if (isset($data['filter_end_date']) && $data['filter_end_date']) {
			$date_end = $data['filter_end_date'];
		} else {
			$date_end = '';
		}

		if (isset($data['filter_range'])) {
			$range = $data['filter_range'];
		} else {
			$range = 'all_time'; //show All Time in Statistical Range by default
		}

		switch($range) 
		{
			case 'custom';
				$date_start = "DATE(ct.access_time) >= '" . $this->db->escape($data['filter_start_date']) . "'";
				$date_end = " AND DATE(ct.access_time) <= '" . $this->db->escape($data['filter_end_date']) . "'";				
				break;
			case 'today';
				$date_start = "DATE(ct.access_time) = CURDATE()";
				$date_end = '';
				break;
			case 'yesterday';
				$date_start = "DATE(ct.access_time) >= DATE_ADD(CURDATE(), INTERVAL -1 DAY)";
				$date_end = " AND DATE(ct.access_time) < CURDATE()";
				break;
			case 'week';
				$date_start = "DATE(ct.access_time) >= '" . $this->db->escape(date('Y-m-d', strtotime('-7 day'))) . "'";
				$date_end = " AND DATE(ct.access_time) <= DATE (NOW())";	
				break;
			case 'month';
				$date_start = "DATE(ct.access_time) >= '" . $this->db->escape(date('Y-m-d', strtotime('-30 day'))) . "'";
				$date_end = " AND DATE(ct.access_time) <= DATE (NOW())";					
				break;			
			case 'quarter';
				$date_start = "DATE(ct.access_time) >= '" . $this->db->escape(date('Y-m-d', strtotime('-91 day'))) . "'";
				$date_end = " AND DATE(ct.access_time) <= DATE (NOW())";						
				break;
			case 'year';
				$date_start = "DATE(ct.access_time) >= '" . $this->db->escape(date('Y-m-d', strtotime('-365 day'))) . "'";
				$date_end = " AND DATE(ct.access_time) <= DATE (NOW())";					
				break;
			case 'current_week';
				$date_start = "DATE(ct.access_time) >= CURDATE() - WEEKDAY(CURDATE())";
				$date_end = " AND DATE(ct.access_time) <= DATE (NOW())";			
				break;	
			case 'current_month';
				$date_start = "YEAR(ct.access_time) = YEAR(CURDATE())";
				$date_end = " AND MONTH(ct.access_time) = MONTH(CURDATE())";			
				break;
			case 'current_quarter';
				$date_start = "QUARTER(ct.access_time) = QUARTER(CURDATE())";
				$date_end = " AND YEAR(ct.access_time) = YEAR(CURDATE())";					
				break;					
			case 'current_year';
				$date_start = "YEAR(ct.access_time) = YEAR(CURDATE())";
				$date_end = '';			
				break;					
			case 'last_week';
				$date_start = "DATE(ct.access_time) >= CURDATE() - INTERVAL DAYOFWEEK(CURDATE())+5 DAY";
				$date_end = " AND DATE(ct.access_time) < CURDATE() - INTERVAL DAYOFWEEK(CURDATE())-2 DAY";				
				break;	
			case 'last_month';
				$date_start = "DATE(ct.access_time) >= DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y/%m/01')";
				$date_end = " AND DATE(ct.access_time) < DATE_FORMAT(CURRENT_DATE, '%Y/%m/01')";				
				break;
			case 'last_quarter';
				$date_start = "QUARTER(ct.access_time) = QUARTER(DATE_ADD(NOW(), INTERVAL -3 MONTH))";
				$date_end = '';
				break;					
			case 'last_year';
				$date_start = "DATE(ct.access_time) >= DATE_FORMAT(CURRENT_DATE - INTERVAL 1 YEAR, '%Y/01/01')";
				$date_end = " AND DATE(ct.access_time) < DATE_FORMAT(CURRENT_DATE, '%Y/01/01')";				
				break;					
			case 'all_time';
				$date_start = "DATE(ct.access_time) >= '" . $this->db->escape(date('Y-m-d','0')) . "'";
				$date_end = " AND DATE(ct.access_time) <= DATE (NOW())";						
				break;	
		}
				
		$sql = "SELECT COUNT(ct.access_time) AS total FROM `" . DB_PREFIX . "customer_track` ct LEFT OUTER JOIN `" . DB_PREFIX . "customer` cus ON ct.customer_id = cus.customer_id WHERE ct.customer_id = '" . $customer_id . "'";
		
		$sql .= ' AND (' . $date_start . $date_end . ')';
		
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}
	
	public function deleteCustomerTrack($customer_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_track` WHERE customer_id = '" . (int)$customer_id . "'");
	}

	public function getCustomerCart($customer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cart WHERE customer_id = '" . (int)$customer_id . "'");
		return $query->rows;
	}

	public function clearCustomerCart($customer_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "cart WHERE customer_id = '" . (int)$customer_id . "'");
	}
	
	public function getCustomerWishList($customer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_wishlist WHERE customer_id = '" . (int)$customer_id . "'");
		return $query->rows;
	}

	public function deleteCustomerWishList($customer_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_wishlist WHERE customer_id = '" . (int)$customer_id . "'");
	}
	
	public function getOrderStatuses($data = array()) {
		$query = $this->db->query("SELECT DISTINCT os.name, os.order_status_id FROM `" . DB_PREFIX . "order_status` os WHERE os.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY LCASE(os.name) ASC");
		
		return $query->rows;	
	}
	
	public function getOrderOptions($order_product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_product_id = '" . (int)$order_product_id . "'");

		return $query->rows;
	}			
            
	public function addCustomer($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$data['customer_group_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "', newsletter = '" . (int)$data['newsletter'] . "', salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', status = '" . (int)$data['status'] . "', approved = '" . (int)$data['approved'] . "', safe = '" . (int)$data['safe'] . "', note = '" . $this->db->escape($data['note']) . "', date_added = NOW()");

		$customer_id = $this->db->getLastId();

		if (isset($data['address'])) {
			foreach ($data['address'] as $address) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$customer_id . "', firstname = '" . $this->db->escape($address['firstname']) . "', lastname = '" . $this->db->escape($address['lastname']) . "', company = '" . $this->db->escape($address['company']) . "', address_1 = '" . $this->db->escape($address['address_1']) . "', address_2 = '" . $this->db->escape($address['address_2']) . "', city = '" . $this->db->escape($address['city']) . "', postcode = '" . $this->db->escape($address['postcode']) . "', country_id = '" . (int)$address['country_id'] . "', zone_id = '" . (int)$address['zone_id'] . "', custom_field = '" . $this->db->escape(isset($address['custom_field']) ? json_encode($address['custom_field']) : '') . "'");

				if (isset($address['default'])) {
					$address_id = $this->db->getLastId();

					$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");
				}
			}
		}
		
		return $customer_id;
	}

	public function editCustomer($customer_id, $data) {
		if (!isset($data['custom_field'])) {
			$data['custom_field'] = array();
		}

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$data['customer_group_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "', newsletter = '" . (int)$data['newsletter'] . "', status = '" . (int)$data['status'] . "', approved = '" . (int)$data['approved'] . "', safe = '" . (int)$data['safe'] . "', note = '" . $this->db->escape($data['note']) . "' WHERE customer_id = '" . (int)$customer_id . "'");

		if ($data['password']) {
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' WHERE customer_id = '" . (int)$customer_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$customer_id . "'");

		if (isset($data['address'])) {
			foreach ($data['address'] as $address) {
				if (!isset($address['custom_field'])) {
					$address['custom_field'] = array();
				}

				$this->db->query("INSERT INTO " . DB_PREFIX . "address SET address_id = '" . (int)$address['address_id'] . "', customer_id = '" . (int)$customer_id . "', firstname = '" . $this->db->escape($address['firstname']) . "', lastname = '" . $this->db->escape($address['lastname']) . "', company = '" . $this->db->escape($address['company']) . "', address_1 = '" . $this->db->escape($address['address_1']) . "', address_2 = '" . $this->db->escape($address['address_2']) . "', city = '" . $this->db->escape($address['city']) . "', postcode = '" . $this->db->escape($address['postcode']) . "', country_id = '" . (int)$address['country_id'] . "', zone_id = '" . (int)$address['zone_id'] . "', custom_field = '" . $this->db->escape(isset($address['custom_field']) ? json_encode($address['custom_field']) : '') . "'");

				if (isset($address['default'])) {
					$address_id = $this->db->getLastId();

					$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");
				}
			}
		}
	}

	public function editToken($customer_id, $token) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET token = '" . $this->db->escape($token) . "' WHERE customer_id = '" . (int)$customer_id . "'");
	}

	public function deleteCustomer($customer_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$customer_id . "'");
	}

	public function getCustomer($customer_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row;
	}

	public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}


	public function getCustomersForAutocomplete($data = array()) {
		$sql = "SELECT *, CONCAT(c.firstname, ' ', c.lastname) AS name, cgd.name AS customer_group FROM " . DB_PREFIX . "customer c LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (c.customer_group_id = cgd.customer_group_id) WHERE cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(c.firstname, ' ', c.lastname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_email'])) {
			$implode[] = "c.email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
		}

		if (isset($data['filter_newsletter']) && $data['filter_newsletter'] !== null) {
			$implode[] = "c.newsletter = '" . (int)$data['filter_newsletter'] . "'";
		}

		if (!empty($data['filter_customer_group_id'])) {
			$implode[] = "c.customer_group_id = '" . (int)$data['filter_customer_group_id'] . "'";
		}

		if (!empty($data['filter_ip'])) {
			$implode[] = "c.customer_id IN (SELECT customer_id FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== null) {
			$implode[] = "c.status = '" . (int)$data['filter_status'] . "'";
		}

		if (isset($data['filter_approved']) && $data['filter_approved'] !== null) {
			$implode[] = "c.approved = '" . (int)$data['filter_approved'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(c.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		$sort_data = array(
			'name',
			'c.email',
			'customer_group',
			'c.status',
			'c.approved',
			'c.ip',
			'c.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}
            
	public function getCustomers($data = array()) {
		
$sql = "SELECT c.*, CONCAT(c.firstname, ' ', c.lastname) AS name, cgd.name AS customer_group";
if ($this->config->get('adveci_order_value_status')) {
	if ($this->config->get('adveci_clist_orders_status') == '1') {
		$sql .= ", (SELECT COUNT(o.order_id) FROM `" . DB_PREFIX . "order` o WHERE o.customer_id = c.customer_id AND o.order_status_id IN (" . implode(",", $this->config->get('adveci_order_value_status')) . ") GROUP BY o.customer_id) AS total_orders";
	} 
	if ($this->config->get('adveci_clist_total_value_status') == '1') {
		$sql .= ", (SELECT SUM(o.total) FROM `" . DB_PREFIX . "order` o WHERE o.customer_id = c.customer_id AND o.order_status_id IN (" . implode(",", $this->config->get('adveci_order_value_status')) . ") GROUP BY o.customer_id) AS total_value";
	} 	
} else {
	if ($this->config->get('adveci_clist_orders_status') == '1') {
		$sql .= ", (SELECT COUNT(o.order_id) FROM `" . DB_PREFIX . "order` o WHERE o.customer_id = c.customer_id AND o.order_status_id > 0 GROUP BY o.customer_id) AS total_orders";
	} 
	if ($this->config->get('adveci_clist_total_value_status') == '1') {
		$sql .= ", (SELECT SUM(o.total) FROM `" . DB_PREFIX . "order` o WHERE o.customer_id = c.customer_id AND o.order_status_id > 0 GROUP BY o.customer_id) AS total_value";
	} 	
}
$sql .= " FROM " . DB_PREFIX . "customer c, " . DB_PREFIX . "customer_group_description cgd WHERE c.customer_group_id = cgd.customer_group_id AND cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
            

		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(c.firstname, ' ', c.lastname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_email'])) {
			$implode[] = "c.email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
		}

		if (isset($data['filter_newsletter']) && !is_null($data['filter_newsletter'])) {
			$implode[] = "c.newsletter = '" . (int)$data['filter_newsletter'] . "'";
		}

		if (!empty($data['filter_customer_group_id'])) {
			$implode[] = "c.customer_group_id = '" . (int)$data['filter_customer_group_id'] . "'";
		}

		if (!empty($data['filter_ip'])) {
			$implode[] = "c.customer_id IN (SELECT customer_id FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "c.status = '" . (int)$data['filter_status'] . "'";
		}

		if (isset($data['filter_approved']) && !is_null($data['filter_approved'])) {
			$implode[] = "c.approved = '" . (int)$data['filter_approved'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(c.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		$sort_data = array(
			'name',
			'c.email',
			'customer_group',
			'c.status',
			'c.approved',
			'c.ip',
			
			'c.date_added',
			'total_orders',
			'total_value'					
            
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function approve($customer_id) {
		$customer_info = $this->getCustomer($customer_id);

		if ($customer_info) {
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET approved = '1' WHERE customer_id = '" . (int)$customer_id . "'");

			$this->load->language('mail/customer');

			$this->load->model('setting/store');

			$store_info = $this->model_setting_store->getStore($customer_info['store_id']);

			if ($store_info) {
				$store_name = $store_info['name'];
				$store_url = $store_info['url'] . 'index.php?route=account/login';
			} else {
				$store_name = $this->config->get('config_name');
				$store_url = HTTP_CATALOG . 'index.php?route=account/login';
			}

			$message  = sprintf($this->language->get('text_approve_welcome'), html_entity_decode($store_name, ENT_QUOTES, 'UTF-8')) . "\n\n";
			$message .= $this->language->get('text_approve_login') . "\n";
			$message .= $store_url . "\n\n";
			$message .= $this->language->get('text_approve_services') . "\n\n";
			$message .= $this->language->get('text_approve_thanks') . "\n";
			$message .= html_entity_decode($store_name, ENT_QUOTES, 'UTF-8');

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($customer_info['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($store_name, ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(sprintf($this->language->get('text_approve_subject'), html_entity_decode($store_name, ENT_QUOTES, 'UTF-8')));
			$mail->setText($message);
			$mail->send();
		}
	}

	public function getAddress($address_id) {
		$address_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "address WHERE address_id = '" . (int)$address_id . "'");

		if ($address_query->num_rows) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$address_query->row['country_id'] . "'");

			if ($country_query->num_rows) {
				$country = $country_query->row['name'];
				$iso_code_2 = $country_query->row['iso_code_2'];
				$iso_code_3 = $country_query->row['iso_code_3'];
				$address_format = $country_query->row['address_format'];
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code_3 = '';
				$address_format = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$address_query->row['zone_id'] . "'");

			if ($zone_query->num_rows) {
				$zone = $zone_query->row['name'];
				$zone_code = $zone_query->row['code'];
			} else {
				$zone = '';
				$zone_code = '';
			}

			return array(
				'address_id'     => $address_query->row['address_id'],
				'customer_id'    => $address_query->row['customer_id'],
				'firstname'      => $address_query->row['firstname'],
				'lastname'       => $address_query->row['lastname'],
				'company'        => $address_query->row['company'],
				'address_1'      => $address_query->row['address_1'],
				'address_2'      => $address_query->row['address_2'],
				'postcode'       => $address_query->row['postcode'],
				'city'           => $address_query->row['city'],
				'zone_id'        => $address_query->row['zone_id'],
				'zone'           => $zone,
				'zone_code'      => $zone_code,
				'country_id'     => $address_query->row['country_id'],
				'country'        => $country,
				'iso_code_2'     => $iso_code_2,
				'iso_code_3'     => $iso_code_3,
				'address_format' => $address_format,
				'custom_field'   => json_decode($address_query->row['custom_field'], true)
			);
		}
	}

	public function getAddresses($customer_id) {
		$address_data = array();

		$query = $this->db->query("SELECT address_id FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$customer_id . "'");

		foreach ($query->rows as $result) {
			$address_info = $this->getAddress($result['address_id']);

			if ($address_info) {
				$address_data[$result['address_id']] = $address_info;
			}
		}

		return $address_data;
	}

	public function getTotalCustomers($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer";

		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_email'])) {
			$implode[] = "email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
		}

		if (isset($data['filter_newsletter']) && !is_null($data['filter_newsletter'])) {
			$implode[] = "newsletter = '" . (int)$data['filter_newsletter'] . "'";
		}

		if (!empty($data['filter_customer_group_id'])) {
			$implode[] = "customer_group_id = '" . (int)$data['filter_customer_group_id'] . "'";
		}

		if (!empty($data['filter_ip'])) {
			$implode[] = "customer_id IN (SELECT customer_id FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "status = '" . (int)$data['filter_status'] . "'";
		}

		if (isset($data['filter_approved']) && !is_null($data['filter_approved'])) {
			$implode[] = "approved = '" . (int)$data['filter_approved'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalCustomersAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE status = '0' OR approved = '0'");

		return $query->row['total'];
	}

	public function getTotalAddressesByCustomerId($customer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function getTotalAddressesByCountryId($country_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE country_id = '" . (int)$country_id . "'");

		return $query->row['total'];
	}

	public function getTotalAddressesByZoneId($zone_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE zone_id = '" . (int)$zone_id . "'");

		return $query->row['total'];
	}

	public function getTotalCustomersByCustomerGroupId($customer_group_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE customer_group_id = '" . (int)$customer_group_id . "'");

		return $query->row['total'];
	}

	public function addHistory($customer_id, $comment) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer_history SET customer_id = '" . (int)$customer_id . "', comment = '" . $this->db->escape(strip_tags($comment)) . "', date_added = NOW()");
	}

	public function getHistories($customer_id, $start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}

		$query = $this->db->query("SELECT comment, date_added FROM " . DB_PREFIX . "customer_history WHERE customer_id = '" . (int)$customer_id . "' ORDER BY date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getTotalHistories($customer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_history WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function addTransaction($customer_id, $description = '', $amount = '', $order_id = 0) {
		$customer_info = $this->getCustomer($customer_id);

		if ($customer_info) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer_transaction SET customer_id = '" . (int)$customer_id . "', order_id = '" . (int)$order_id . "', description = '" . $this->db->escape($description) . "', amount = '" . (float)$amount . "', date_added = NOW()");

			$this->load->language('mail/customer');

			$this->load->model('setting/store');

			$store_info = $this->model_setting_store->getStore($customer_info['store_id']);

			if ($store_info) {
				$store_name = $store_info['name'];
			} else {
				$store_name = $this->config->get('config_name');
			}

			$message  = sprintf($this->language->get('text_transaction_received'), $this->currency->format($amount, $this->config->get('config_currency'))) . "\n\n";
			$message .= sprintf($this->language->get('text_transaction_total'), $this->currency->format($this->getTransactionTotal($customer_id), $this->session->data['currency']));

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($customer_info['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($store_name, ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(sprintf($this->language->get('text_transaction_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')));
			$mail->setText($message);
			$mail->send();
		}
	}

	public function deleteTransaction($order_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_transaction WHERE order_id = '" . (int)$order_id . "'");
	}

	public function getTransactions($customer_id, $start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$customer_id . "' ORDER BY date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getTotalTransactions($customer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total  FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function getTransactionTotal($customer_id) {
		$query = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function getTotalTransactionsByOrderId($order_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_transaction WHERE order_id = '" . (int)$order_id . "'");

		return $query->row['total'];
	}

	public function addReward($customer_id, $description = '', $points = '', $order_id = 0) {
		$customer_info = $this->getCustomer($customer_id);

		if ($customer_info) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer_reward SET customer_id = '" . (int)$customer_id . "', order_id = '" . (int)$order_id . "', points = '" . (int)$points . "', description = '" . $this->db->escape($description) . "', date_added = NOW()");

			$this->load->language('mail/customer');

			$this->load->model('setting/store');

			$store_info = $this->model_setting_store->getStore($customer_info['store_id']);

			if ($store_info) {
				$store_name = $store_info['name'];
			} else {
				$store_name = $this->config->get('config_name');
			}

			$message  = sprintf($this->language->get('text_reward_received'), $points) . "\n\n";
			$message .= sprintf($this->language->get('text_reward_total'), $this->getRewardTotal($customer_id));

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($customer_info['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($store_name, ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(sprintf($this->language->get('text_reward_subject'), html_entity_decode($store_name, ENT_QUOTES, 'UTF-8')));
			$mail->setText($message);
			$mail->send();
		}
	}

	public function deleteReward($order_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_reward WHERE order_id = '" . (int)$order_id . "' AND points > 0");
	}

	public function getRewards($customer_id, $start = 0, $limit = 10) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "' ORDER BY date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getTotalRewards($customer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function getRewardTotal($customer_id) {
		$query = $this->db->query("SELECT SUM(points) AS total FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function getTotalCustomerRewardsByOrderId($order_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_reward WHERE order_id = '" . (int)$order_id . "' AND points > 0");

		return $query->row['total'];
	}

	public function getIps($customer_id, $start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}
		if ($limit < 1) {
			$limit = 10;
		}

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int)$customer_id . "' ORDER BY date_added DESC LIMIT " . (int)$start . "," . (int)$limit);
		
		return $query->rows;
	}

	public function getTotalIps($customer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function getTotalCustomersByIp($ip) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($ip) . "'");

		return $query->row['total'];
	}

	public function getTotalLoginAttempts($email) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_login` WHERE `email` = '" . $this->db->escape($email) . "'");

		return $query->row;
	}

	public function deleteLoginAttempts($email) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_login` WHERE `email` = '" . $this->db->escape($email) . "'");
	}
}
