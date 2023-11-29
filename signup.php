<?php
    session_start();
    //connect database
   
    include "connect_db.php";
    //include "Functions.php";      
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $BirthDay = $_POST['birth-date'];
        $gender = $_POST['gender'];
        $userType = "user";
        

      
        if(!empty($user) && !empty($pass) && !empty($BirthDay) &&  !is_numeric($user) && !is_numeric($name) && !is_numeric($email)){
              $sql = "INSERT INTO users (Name,Username,Email , Password, BirthDay , Gender , userType) VALUES ('$name', '$user', '$email' , '$pass' , '$BirthDay' , '$gender' , '$userType'); ";
              $result = mysqli_query( $db, $sql);
              $_SESSION['name'] = $name;
              $_SESSION['email'] = $email;
              $_SESSION['User_name'] = $user;
              $_SESSION['pass_word'] = $pass;
              $_SESSION['birthday'] = $BirthDay;
              $_SESSION['gender'] = $gender;
              $_SESSION['userType'] = $userType;
              header("Location: index.php");
              exit();
           
        }else {
                echo "please enter valid input";      
        }             
    }
    
            
 ?>



<html lang="en" dir="ltr">
  <head>
    <title>Q Motors</title>
    <?php include "head.php"; ?>
  </head>
  <body>
    <?php include "navbar.php"; ?>
    <!--sign up screen-->
    <div class="login">
      <h1>Sign-up</h1>
      <form class="" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="row row-signup"> 
          <div class=" col-lg-6 col-md-6 col-sm-8"> 
            <label class="label ">Full Name </label><br>
            <label class="label">User name </label><br>
            <label class="label">E-mail: </label><br>
            <label class="label">NEW Password: </label><br>
            <label class="label">confirm Password: </label>
          </div>
          
          <div class=" col-lg-6 col-md-6 col-sm-4 ">
            <input class="input form-control" type="text" name="name" value="" required>
            <input class="input form-control" type="text" name="username" value="" required>
            <input class="input form-control" type="email" name="email" value="" required>
            
            <input class="input form-control" type="password" name="password" value="" required>
            
            <input class="input form-control" type="password" name="confirm-password" value="" required>
          </div>
    
          <br>
        </div> 
        <fieldset>
          <legend>Choose your gender</legend>
          <input type="radio" name="gender" id="gender-male" value="male">
          <label for="gender-male">Male</label>
          <input type="radio" name="gender" id="gender-female" value="female">
          <label for="gender-female">Female</label>
          <input type="radio" name="gender" id="gender-other" value="other">
          <label for="gender-other">Other</label>
          <input type="radio" name="gender" id="gender-none" value="none" checked>
          <label for="gender-none">Prefer not to say</label>
        </fieldset>
        <fieldset>
          <legend>Choose your Birth date</legend>
          <input type="date" name="birth-date" required>
        </fieldset><br>
   
        <input type="submit" name="finish" value="submit" role="button" class="btn btn-lg btn-outline-light">
          <br/><br/>
                 <button  class="btn"><a href = "Login.php">Login</a></button>
      </form>
    </div>
    <?php include "cta+footer.php"; ?>
    <style>
body {
    font-family: 'Arial', sans-serif;
    background-image: url(images/Bull&BearLandingPage.jpg) !important;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

form {
    display: flex;
    flex-wrap: wrap;
}

.label1 {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.label1 label {
    margin-top: 10px;
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.label1 input {
    padding: 10px;
    margin-bottom: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 3px;
    width: calc(100% - 20px);
}

input[type="submit"] {
    background-color: #4caf50;
    color: #fff;
    padding: 15px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    width: 100%;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

h3 {
    margin-top: 20px;
    margin-bottom: 10px;
}

.flex {
    display: flex;
    align-items: center;
}

/* Style radio buttons */
input[type="radio"] {
    margin-right: 5px;
}

</style>
  </body>
</html>
