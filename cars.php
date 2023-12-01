<?php

include "Functions.php";
check_login($db)

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "head.php"; ?>
        <link rel="stylesheet" href="css/cars.css">
        <title>Qmotors</title>
    </head>
    <body>

        <?php include "navbar.php"; ?>
        <!--content-->
        <?php
$newline   = array("\r\n", "\n", "\r");
$replace = '<br />';
$Car_Id =  $_GET['Id'];
setcookie("Last_viewed_car" , $Car_Id , time() + 3600);
$sql = "SELECT * FROM pro WHERE id = '$Car_Id'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
?>

<section id='content-image'>
    <div class='row' style='color:white;'>
        <div class='col-lg-6'>
            <img class='img-section' src='<?php echo $row['image']; ?>' alt=''>
        </div>
        <div class='col-lg-6' style='text-align: left;'>
            <h1><?php echo $row['name']; ?></h1>
            <h3>Starting at <?php echo $row['price']; ?>$</h3>
        </div>
        <h3>Product Description : </h3>
        <p><?php echo str_replace($newline, $replace, $row['description']); ?> </p>

        <!--script add to cart -->
        <script type = 'text/javascript'>
            function getCookie(cname) {
            let name = cname + "=";
            let ca = document.cookie.split(';');
            for(let i = 0; i < ca.length; i++) {
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
   

         function addToCart(){
                        
                  let flag = getCookie("id");
                  let x = window.location.href; //to get the url
                  let product_id = x.substr(x.indexOf("Id=") + 3); //get the id from url string
                    if(flag == ""){                       
                        //first time
                        document.cookie ='id ='+ product_id + ',';
                    }else{

                        if(getCookie("id").includes(product_id) == true){

                        }else{
                            document.cookie = 'id =' + getCookie("id") + product_id + ',';  
                        }
                                           
                    }

               
        }

        </script>
<?php 


if($_SESSION['userType'] != "admin"){
    echo "<a href='cart.php' target = '_blank' class='add-to-cart-btn' onclick = addToCart();>ADD TO CART</a>";
}
        
   ?>
    </div>
</section>

        
     
        
        <div  id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-keyboard="true" style='background-color:#ffffff47' >
  
        <div class="carousel-inner">
    <div class="carousel-item active">
    <img class="testimonial-image img-section col-lg-2" src="<?php echo $row['image']; ?>" style="width:50%">
            <div class="text"><h4><?php echo $row['name'] ?></h4></div> 
        </div>
    <div class="carousel-item">
    <img class="testimonial-image img-section" src="<?php echo $row['image2'];  ?>" style="width:50%">
            <div class="text"><h4><?php echo $row['name'] ?></h4></div> </div>
    <div class="carousel-item">
    <img class="testimonial-image img-section" src="<?php echo $row['image3']; ?>" style="width:50%">
            <div class="text"><h4><?php echo $row['name'] ?></h4></div>
    </div>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" >
    <span  class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
        <?php include "cta+footer.php"; ?>
    </body>

</html>
