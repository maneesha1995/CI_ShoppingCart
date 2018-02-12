<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</head>
<body>
<div class="container">
    <br /><br />

    <div class="col-lg-6 col-md-6">
        <div class="table-responsive">
            <h1 align="center">Shopping Cart Item List</h1><br />
            <?php
            foreach($value as $row)
            {
                echo '
    <div class="panel panel-default">
  <div class="panel-body">
     
     <h3>'.$row->Product_Name.'</h3><br>
     Price : '.$row->Product_price.'<br><br>
     <input type="text" name="quantity" class="form-control quantity" id="'.$row->Product_ID.'" /><br />
     <button type="button" name="add_cart" class="btn btn-success add_cart" data-productname="'.$row->Product_Name.'" data-price="'.$row->Product_price.'" data-productid="'.$row->Product_ID.'" /><span class=\'glyphicon glyphicon-shopping-cart\' aria-hidden=\'true\'></span>  Add to Cart</button>
    </div>
    </div>
    ';
            }
            ?>

        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div id="cart_details">
            <h3 align="center">Cart is Empty</h3>
        </div>
    </div>

</div>
</body>
</html>
<script>
    $(document).ready(function(){

        $('.add_cart').click(function(){
            var product_id = $(this).data("productid");
            var product_name = $(this).data("productname");
            var product_price = $(this).data("price");
            var quantity = $('#' + product_id).val();
            if(quantity != '' && quantity > 0)
            {
                $.ajax({
                    url:"<?php echo base_url(); ?>ShoppingCart/Add",
                    method:"POST",
                    data:{product_id:product_id, product_name:product_name, product_price:product_price, quantity:quantity},
                    success:function(data)
                    {
                        alert("Product Added into Cart");
                        $('#cart_details').html(data);
                        $('#' + product_id).val('');
                    }
                });
            }
            else
            {
                alert("Please Enter quantity");
            }
        });

//        $('#cart_details').load("<?php //echo base_url(); ?>//shopping_cart/load");
//
//        $(document).on('click', '.remove_inventory', function(){
//            var row_id = $(this).attr("id");
//            if(confirm("Are you sure you want to remove this?"))
//            {
//                $.ajax({
//                    url:"<?php //echo base_url(); ?>//shopping_cart/remove",
//                    method:"POST",
//                    data:{row_id:row_id},
//                    success:function(data)
//                    {
//                        alert("Product removed from Cart");
//                        $('#cart_details').html(data);
//                    }
//                });
//            }
//            else
//            {
//                return false;
//            }
//        });
//
//        $(document).on('click', '#clear_cart', function(){
//            if(confirm("Are you sure you want to clear cart?"))
//            {
//                $.ajax({
//                    url:"<?php //echo base_url(); ?>//shopping_cart/clear",
//                    success:function(data)
//                    {
//                        alert("Your cart has been clear...");
//                        $('#cart_details').html(data);
//                    }
//                });
//            }
//            else
//            {
//                return false;
//            }
//        });

    });
</script>
