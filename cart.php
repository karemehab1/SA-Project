<?php

session_start();
if(!isset($_SESSION['User_name']) || $_SESSION['userType'] == "admin"){
        header("Location: index.php");
}

include "connect_db.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart</title>
  <link rel="stylesheet" href="css/cart.css">
</head>
<body>
  <h1>Shopping Cart</h1>

  <div class="small-container cart-page">
    <table>
      
        <tr>

          <th>Product</th>
          <th>Quantity</th>
          <th>subtotal</th>       
        </tr>
        <tr>
            <td>
            <?php
                   if(!isset($_COOKIE['id'])){
                    echo "<h1>your Cart is Empty !</h1>";
                   }else{
                        
                $AddedToCartIds =  $_COOKIE['id'];
                //echo $_COOKIE['id'];
                
                $arr = explode("," , $AddedToCartIds);//array contains the ids Addedd to cart
                for($i = 0; $i < count($arr) -1; $i++){
                    
                    $sql = "SELECT name , image , price , id From pro WHERE id = '" . $arr[$i] . "' ";
                    $result = mysqli_query($db , $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo "
                    <div class='cart-info'>
                    <img src=".$row['image']." >
                    <dive>
                        <p> ".$row['name']." </p>
                        <small> price:$".$row['price']."</small>
                       <a href=''>Remove</a>
                    </div>
                    
                </div>
                ";
                            
                }

                   }
                    
                
            ?>
            </td>
            <td style = 'display:flex'> <input type='number' value='1'>
                        <input type='number' value='1'>        
             </td>

            <td>$50.00</td>
            <td></td>
        </tr>
       
    </table>
    <div class="total-price">
        <table>
            <tr>
                <td> subtotal </td>
                <td> $200 </td>

            </tr>
            <tr>
                <td> Tax </td>
                <td> $35.00 </td>
                
            </tr>
            <tr>
                <td> Total</td>
                <td> $230.00</td>
                
            </tr>
        </table>
    </div>

    <button id="add-item">Add Item</button>
    <button id="checkout">Checkout</button>
  </div>

  <script src="script.js"></script>
</body>
</html>