<?php
class ModelModuleAutologin extends Model
{

    public function createTable()
    {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "autologin` (
          `autologin_id` int(11) NOT NULL AUTO_INCREMENT,
          `customer_id` int(11) NOT NULL,
          `email` varchar(96) NOT NULL,
          `token` varchar(40) NOT NULL,
          `ip` varchar(40) NOT NULL,
          `user_agent` varchar(255) NOT NULL,
          `date_added` datetime NOT NULL,
          `date_modified` datetime NOT NULL,
          PRIMARY KEY (`autologin_id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
        );
    }

    public function removeTable()
    {
        $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "autologin'");

        if ($query->num_rows) {
            $this->db->query("DROP TABLE `" . DB_PREFIX . "autologin`;");
        }
    }

    public function deleteCustomer($customer_id)
    {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "autologin` WHERE customer_id = '" . (int) $customer_id . "'");
    }
}
