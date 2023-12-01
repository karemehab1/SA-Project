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

            
            <?php
                   if(!isset($_COOKIE['id'])){
                    echo "<tr><h1>your Cart is Empty !</h1></tr>";
                   }else{
                        
                $AddedToCartIds =  $_COOKIE['id'];                
                $arr = explode("," , $AddedToCartIds);//array contains the ids Addedd to cart

                for($i = 0; $i < count($arr) -1; $i++){
                    
                    $sql = "SELECT name , image , price , id From pro WHERE id = '" . $arr[$i] . "' ";
                    $result = mysqli_query($db , $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo "
                    <tr class = 'row'>
                    <td>
                    <div class='cart-info'>
                    <img src=".$row['image']." >
                    <div>
                        <p> ".$row['name']." </p>
                        <small> price:$".$row['price']."</small>
                       <a href='#' onclick=clicked(".$i.");>Remove</a>
                    </div>
                    
                </div></td>
                <td style = 'display:flex'>
                 <input type='number' value='1'>                           
             </td>
             </tr>
                ";
                            
                }

                   }
                    
                
            ?>
            
            <script>
            
               function clicked(x){
                let rows = document.querySelectorAll(".row");
                //remove the row from the table
                rows[x].style.display = "none";
                //remove the id from the cookies
                removeFromTheCookie(x);
               }
               function getCookie(cname) {
                  let name = cname + "=";
                  let decodedCookie = decodeURIComponent(document.cookie);
                  let ca = decodedCookie.split(';');
                  for(let i = 0; i <ca.length; i++) {
                    let c = ca[i];
                    while (c.charAt(0) == ' ') {
                      c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                      return c.substring(name.length, c.length);
                    }
                  }
                  return "";
              }
             

               function removeFromTheCookie(indexOfId){
                  let str = getCookie("id");               
                  let newstr = str.substr(0 , indexOfId) + str.substr(indexOfId + 2);
                  document.cookie = "id=" + newstr;

                  

               }

                 
                </script>
            
         
           
       
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

    <a href = "Product_Page.php"><button id="add-item">Add Item</button></a>
    <button id="checkout">Checkout</button>
  </div>

  
 
</body>
</html>