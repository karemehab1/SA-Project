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
<body onchange = calculateTotal();>

  <h1>Shopping Cart</h1>

  <div class="small-container cart-page">
    <table>
      
        <tr>

          <th>Product</th>
          <th>Quantity</th>
          <th>subtotal</th>       
        </tr>

            
            <?php
                   if(!isset($_COOKIE['id']) || $_COOKIE['id'] == ''){
                    echo "<tr><h1>your Cart is Empty !</h1></tr>";
                   }else{
                        
                $AddedToCartIds =  $_COOKIE['id'];                
                $arr = explode("," , $AddedToCartIds);//array contains the ids Addedd to cart

                for($i = 0; $i < count($arr) -1; $i++){
                    
                    $sql = "SELECT name , image , price , id From pro WHERE id = '" . $arr[$i] . "' ";
                    $result = mysqli_query($db , $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo "
                    <tr class = 'row' id = ".$row['id'].">
                    <td>
                    <div class='cart-info'>
                    <img src=".$row['image']." >
                    <div>
                        <p> ".$row['name']." </p>
                        <small> price:$".$row['price']."</small>
                       <a href='#' onclick=clicked(".$i.");>Remove</a>
                    </div>
                    
                </div></td>
                <td style = 'display:flex' onclick = calculateTotal();>
                 <input type='number' value='1'>                           
             </td>
             </tr>
                ";
                            
                }

                   }
                    
                
            ?>
            
            <script>
            
               function clicked(index){
                location.reload();
                let rows = document.querySelectorAll(".row");
                //some important variables
                let ItemId = rows[index].id;
                
                let totalNumberOfRows = rows.length;
                //remove the row from the table              
                rows[index].style.display = "none";
                
                //remove the id from the cookies
                removeFromTheCookie(index , ItemId ,totalNumberOfRows);
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
             

               function removeFromTheCookie(indexOfId, ItemId , totalNumberOfRows){
                  let str = getCookie("id");
                  console.log(str);
                 let startIndexOfitemInCookies =  str.indexOf(ItemId);
                 //console.log(startIndexOfitemInCookies + "start index");
                 //console.log(str.length + "str length");

                 //in case removing last element
                 let newStr = "";
                 if(startIndexOfitemInCookies == str.length - 2){
                  newStr = str.substr(0 , startIndexOfitemInCookies);
                 }else if(startIndexOfitemInCookies == 0){ //in case of the beganing of the str

                  newStr = str.substr(str.indexOf("," , startIndexOfitemInCookies) + 1);
                 }
                 
                 else {
                  newStr = str.substr(0 , startIndexOfitemInCookies) + str.substr(str.indexOf("," , startIndexOfitemInCookies) + 1);
                 }

                 
                  console.log(newStr);
                  document.cookie = "id="+newStr;
               }

                 
                </script>
           
         
           
       
    </table>
    <div class="total-price">
        <table>
            <tr>
                <td> subtotal </td>
                <td id = "subtotal"> $200 </td>

            </tr>
            <tr>
                <td> shipment </td>
                <td id = 'shipment'> 0$ </td>
                
            </tr>
            <tr>
                <td> Discount </td>
                <td id = 'discount'> 0$ </td>
                
            </tr>
            <tr>
                <td> Total</td>
                <td id = "total"> $230.00</td>
                
            </tr>
        </table>
                
    </div>


    <a href = "Product_Page.php"><button id="add-item">Add Item</button></a>
    <?php
    if(!isset($_COOKIE['id']) || $_COOKIE['id'] == ''){
      
                   }else {
                    echo " <a href=  'payment.php'><button id='checkout'>Checkout</button></a>";
                   }
                   ?>
   
  </div>

  

  <script>
    // Function to calculate total price
    function calculateTotal() {
        var rows = document.querySelectorAll('.row'); // Get all rows with class 'row'
        var totalPrice = 0;

        // Iterate through each row
        rows.forEach(function(row) {
            var priceElement = row.querySelector('small'); // Get the element containing the price
            var priceText = priceElement.innerText.split('$')[1]; // Extract the price value (remove 'price:$' text)
            var price = parseFloat(priceText); // Convert the price to a floating-point number
            var quantity = parseFloat(row.querySelector('input').value); // Get the quantity

            // Add the subtotal for this row to the total price
            totalPrice += price * quantity;
        });

        // Display the total price (you can modify this part based on your needs)
     
        let subTotal = totalPrice.toFixed(2);
        document.getElementById("subtotal").innerHTML = subTotal + '$';

        document.getElementById("shipment").innerHTML = '0$';
        
        document.getElementById("total").innerHTML = subTotal + '$';
        
      }
   

        calculateTotal();

    
    // Example of how to call the calculateTotal function
    
</script>

 
</body>
</html>