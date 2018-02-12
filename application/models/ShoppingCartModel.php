<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2/6/2018
 * Time: 11:14 AM
 */

class ShoppingCartModel extends CI_Model
{

    public function GetData(){

        $this->load->database();
        $query=$this->db->query("SELECT * FROM product ORDER BY Product_Name");
        return $query->result();
    }
}