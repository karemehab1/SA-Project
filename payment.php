
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
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Payment</title>

    <link rel="stylesheet" href="css/payment.css">

</head>

<body>
    <div class="container">
        <h1 class="page-title">Payment Details</h1>
        <form>
            <div class="label1">
                <label>First Name</label>
                <input type="text" name="name" required><br>
                <label>Address</label>
                <input type="text" name="add" required><br>
            </div>
            <div class="label1">
                <label>Last Name</label>
                <input type="text" name="name" required><br>

                <label>E-mail</label>
                <input type="email" name="e-mail" required><br>
            </div>
            <div class="label1">
                <label>Mobile NO</label>
                <input type="tel" name="tel" required><br>
                <label>Country</label>
                <input type="text" name="tel" required><br>
            </div>
            <div class="label1">
                <label>State</label>
                <input type="text" name="tel"><br>
                <label>City</label>
                <input type="text" name="tel" required><br>
            </div>
            <div class="payment">
                <div>
                    <h3>Payment Method</h3>
                </div>
                <div>
                    <label for="radio1" class="flex">
                        <input type="radio" name="name">
                        <span>Paypal</span>
                    </label>
                </div>
                <div>
                    <label for="radio2" class="flex">
                        <input type="radio" name="name">
                        <span>Direct Check</span>
                    </label>
                </div>
                <div>
                    <label for="radio3" class="flex">
                        <input type="radio" name="name">
                        <span>Bank Transfer</span>
                    </label>
                </div>
            </div>

            <input type="submit" name="place" value="Place Order">

        </form>
    </div>
</body>

</html>