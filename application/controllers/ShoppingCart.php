<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2/6/2018
 * Time: 10:38 AM
 */

class ShoppingCart extends CI_Controller
{

    public function index(){
        $this->load->model('ShoppingCartModel');// call the Model
        $data['value'] = $this->ShoppingCartModel->GetData();// call theGetData function in the model
        $this->load->view('ViewCart',$data);//load the view
    }

    public function Add(){
        $this->load->library('cart');
        $data=array(
            "id"  => $_POST["product_id"],
            "name"  => $_POST["product_name"],
            "qty"  => $_POST["quantity"],
            "price"  => $_POST["product_price"]
        );
        $this->cart->insert($data);//return rowid
        echo $this->viewCart();
    }

    public function ViewCart(){
        $this->load->library('cart');
        $output='';
        $output.='
        <h3>Shopping Cart</h3><br />
  <div class="table-responsive">
   <div align="right">
    <button type="button" id="clear_cart" class="btn btn-default"><span class=\'glyphicon glyphicon-remove\' aria-hidden=\'true\'></span> Clear Cart</button>
   </div>
   <br />
   <table class="table table-bordered">
    <tr>
     <th width="40%">Name</th>
     <th width="15%">Quantity</th>
     <th width="15%">Price</th>
     <th width="15%">Total</th>
     <th width="15%">Action</th> 
    </tr>
        ';

        $count = 0;
        foreach($this->cart->contents() as $items)
        {
            $count++;
            $output .= '
        <tr> 
            <td>'.$items["name"].'</td>
            <td>'.$items["qty"].'</td>
            <td>'.$items["price"].'</td>
            <td>'.$items["subtotal"].'</td>
            <td><button type="button" name="remove" class="btn btn-danger btn-xs remove_inventory" id="'.$items["rowid"].'"><span class=\'glyphicon glyphicon-trash\' aria-hidden=\'true\'></span>  Remove</button></td>
        </tr>
        ';
        }

        $output .= '
        <tr>
        <td colspan="4" align="right">Total</td>
        <td>'.$this->cart->total().'</td>
        </tr>
        </table>

        </div>
        ';

        if($count == 0)
        {
            $output = '<h3 align="center">Cart is Empty</h3>';
        }
        return $output;
    }



}