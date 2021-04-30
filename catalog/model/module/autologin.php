<?php
class ModelModuleAutologin extends Model
{

    public function addAutologin($data)
    {
        $this->db->query("INSERT INTO " . DB_PREFIX . "autologin SET
            customer_id = '" . $this->db->escape($data['customer_id']) . "',
            email = '" . $this->db->escape($data['email']) . "',
            token = '" . $this->db->escape($data['token']) . "',
            ip = '" . $this->db->escape($data['ip']) . "',
            user_agent = '" . $this->db->escape($data['user_agent']) . "',
            date_added = NOW(),
            date_modified = NOW()"
        );
    }

    public function updateAutologin($token)
    {
        $this->db->query("UPDATE " . DB_PREFIX . "autologin SET date_modified = NOW() WHERE customer_id = '" . (int) $this->customer->getId() . "' AND token = '" . $this->db->escape($token) . "'");
    }

    public function removeAutologin($token)
    {
        $this->db->query("DELETE FROM " . DB_PREFIX . "autologin WHERE token = '" . $this->db->escape($token) . "'");
    }

    public function getAutologinByToken($token)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "autologin WHERE token = '" . $this->db->escape($token) . "' AND token != ''");
        return $query->row;
    }

    public function getAutologinsByCustomerId($customer_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "autologin WHERE customer_id = '" . (int) $customer_id . "'");
        return $query->rows;
    }
}
