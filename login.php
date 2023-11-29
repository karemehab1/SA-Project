<?php
      session_start();
     //connect database
    include "connect_db.php";
  //  include "Functions.php";
          
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $email = $_POST['email'];
        $pass = $_POST['password'];
         $sql = "SELECT * FROM users WHERE Email = '$email';";
    
  if(!empty($email) && !empty($pass) &&  !is_numeric($email)){

              $result = mysqli_query($db, $sql);
              if($result && mysqli_num_rows($result) > 0){
              $userdata = mysqli_fetch_assoc($result);
      
                if($userdata['Password'] == $pass){
                        ///set the session
                    $_SESSION['name'] = $userdata['Name'];
                    $_SESSION['email'] = $userdata['Email'];    
                    $_SESSION['User_name'] = $userdata['Username'];
                    $_SESSION['pass_word'] = $userdata['Password'];
                    $_SESSION['birthday'] = $userdata['BirthDay'];
                    $_SESSION['gender'] = $userdata['Gender'];
                    $_SESSION['userType'] = $userdata['userType'];

                    header("Location: index.php");
                    
                }else {
                    echo "invalid password ";
                }
                  
              }else {
                echo "invalid username or email";
              }
        }

        else {
                echo "please enter valid input";      
        }             
    }
    //check if the data exist in database
    




?>
<html lang="en">

<?php
include "head.php";
include "navbar.php";
?>
<body>
<style></style>
    <div class="wrapper">
        <div class="login-box">
            <form class="login2" method="POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
                <h2>login</h2>
                <div class="input-box">
                    <sapn class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </sapn>
                    <input type="email" name="email" required>
                    <label for="">Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="locked-clossed"></ion-icon>
                    </span>
                    <input type="password"  name="password" required>
                    <label for="">Password</label>
                </div>
                <div class="remember-forgot">
                    <label for=""><input type="checkbox" name="remember-me">Remember me</label>
                    <a href="#">Forgot password</a>
                </div>
                <button type="submit">login</button>
                <div class="register-link">
                    <p>Dont have an account?<a href="signup.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>
    <style>
      body {
    font-family: 'Arial', sans-serif;
    background-image: url(images/Bull&BearLandingPage.jpg);
    margin: 0;
    padding: 0;
}
.btn {
    margin-left: 2%;
    height: 54px;
}
.nav-item {
    padding: 18px;
    display: flex;
    margin-right: 15px;
}
* {

margin:0;
padding:0;
box-sizing: border-box;
font-family: sans-serif;

}

.wrapper {
display: flex;
justify-content:center;
align-items: center;
height:100vh;
width:100%;
background:url('images/Bull&BearLandingPage.jpg') no-repeat !important;
background-size: cover;
background-position: center;
animation: animateBg 5s infinite;
}

/* @keyframes animateBg { 
    100% { filter:hue-rotate(360deg);
}

} */
.login-box {

position: relative;
width: 400px;
height: 450px;
background: transparent;
border-radius: 15px;
display: flex;
justify-content: center;
align-items: center;
backdrop-filter: blur(15px);
}

h2 {
font-size: 2em;
color:#fff;
text-align:center;
}

.input-box {
position:relative;
 width:310px; 
 margin:30px 0; 
 border-bottom:1px solid #fff;
}
.input-box label {
position:absolute; top:50%;
left:5px;
transform: translateY(-50%);
font-size:1em;
color:#fff;
pointer-events:none;
transition:.5s;
}

.input-box input:focus ~ label,
 .input-box input:valid ~ label { 
top:-5px;
}

.input-box input {
height:50px; 
background: transparent; 
border:none; 
font-size:1em; 
padding:0 35px 0 5px;
outline: none;
color:#fff;
}
.input-box .icon { 
    position:absolute; 
    right:8px; 
    top:50%; 
    color: #fff;
     transform: translateY(-50%);

}

.remember-forgot {
margin:-15px 0 15px; 
font-size:.9em; 
justify-content: space-between;
color:#fff;
display: flex;
}

.remember-forgot label input { margin-right:3px;

}

.remember-forgot a {
text-decoration:none;
color:#fff;
}

.remember-forgot a:hover {
text-decoration:underline; 
}
button {
width:100%;
height:40px; 
background-color:#fff;
border:none;
border-radius: 40px;
cursor:pointer; 
font-size:1em;
color:#000;
font-weight:500;

}

.register-link { 
font-size:.9em; 
color:#fff; 
text-align:center; 
margin:25px 0 10px;
}

.register-link p a { 
color:#fff; 
text-decoration:none; 
font-weight:600;

}

.register-link p a:hover { 
text-decoration:underline; 
}
@media (max-width:500px) {

.login-box {
width:100%;
height:100vh;
border:none;
border-radius:0;
}

.input-box {
width:290px;
}

}




</style>
</body>

</html>