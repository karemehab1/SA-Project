<?php
    session_start();
    if(!isset($_SESSION['User_name'])){
            header("Location: index.php");
    }
    include "connect_db.php";
    $username=$_SESSION['User_name'];
    $is_admin=($username=="admin");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User's profile</title>
    <?php include "head.php"; ?>
    <link rel="stylesheet" href="./css/feedback.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div>
      <div>
        <div id="main-cont">

        </div>
      </div>
    </div>
    <script>
    let posts=[
      <?php

              $sql = !$is_admin?"SELECT * FROM `feedback` WHERE `Username` LIKE '$username' ":"SELECT * FROM `feedback`";
              $result = mysqli_query($db , $sql);


              while($row = mysqli_fetch_assoc($result)){

                echo "{id:'" . $row['id']. "',Name:'".$row['Name']."',Username:'".$row['Username']."',Email:'".$row['Email']. "',Subject:'".$row['Subject']."',Feedback:'".$row['Feedback']."',Response:'".$row['Response']."'},";


              }

        ?>
    ];
    function get_item(data){
      let responded=(data['Response'] !== "");
      return " \
                <a href = 'feedback-view.php?Id=" + data['id']+ "' style = 'text-decoration: none; color:#000' class = 'card_link' > \
                <div class='card_body_feedback'> \
                <header class='card_body_feedback-header'> \
                  <h3 class='card_body_feedback-header-subtitle'>Subject: "+data['Subject']+"</h3> \
                </header> \
                <p class='card_body_feedback-text'>"+data['Feedback'].substring(0,60)+((data['Feedback'].length>60)?"...":"")+ "</p> \
                <p class='card_body_feedback-response'>"+((responded)?"Admin responded":"Witing for response")+ "</p> \
              </div> \
                </a>";
    }
    function get_item_admin(data){
      let responded=(data['Response'] !== "");
      return " \
                <a href = 'feedback-view.php?Id=" + data['id']+ "' class = 'card_link' > \
                <div class='card_body_feedback'> \
                <header class='card_body_feedback-header'> \
                  <h3 class='card_body_feedback-header-subtitle'>"+data['Subject']+"</h3> \
                </header> \
                <p class='card_body_feedback-text'>"+data['Feedback'].substring(0,60)+((data['Feedback'].length>60)?"...":"")+ "</p> \
                <p class='card_body_feedback-details'>Name: "+data['Name']+"&nbsp;&nbsp;&nbsp;&nbsp; Username: "+data['Username']+"&nbsp;&nbsp;&nbsp;&nbsp; Email: "+data['Email']+"</p> \
                <p class='card_body_feedback-response'>"+((responded)?"Responded":"Witing for response")+ "</p> \
              </div> \
                </a>";
    }
    for(post of posts){
      document.getElementById("main-cont").innerHTML+=get_item<?php echo $is_admin?"_admin":"" ?>(post);
    }
    </script>
    <?php include "cta+footer.php"; ?>
</body>
</html>
