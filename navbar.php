    <nav class="navbar navbar-expand-lg <?php if($is_home) echo "navbar-home"; ?>">

      <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <a href="./index.php" class="navbar-brand">
        <img src="./images/image-(11).png" alt="icon" style="width: 60px;
    margin-left: 16px;">
    &copy
      </a>
 
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

          
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            
          <?php
                     if(isset($_SESSION['name'])){
                          if($_SESSION['userType'] == "user"){
                            //appears only in case of user Logged in
                            echo "<button type='button' class='btn btn-outline-dark ' >
                            <a href='./contact.php' class='nav-link'>Contact</a>
                          </button>";
                          echo " <button type='button' class='btn btn-outline-dark ' >
                          <a href='profile.php' class='nav-link'>Profile</a>
                          </button>
                          ";
                          } else if($_SESSION['userType'] == "admin"){
                            echo " <button type='button' class='btn btn-outline-dark ' >
                            <a href='admin.php' class='nav-link'>admin</a>
                            </button>
                            ";
                    
                       }
                     }
                    
                    ?>

          <button type="button" class="btn btn-outline-dark">
            <a href="#cta" class="nav-link">Download</a>
          </button>
          <button type="button" class="btn btn-outline-dark">
            <a href="./Product_Page.php" class="nav-link">Content</a></button>
          </li>
        </ul>
      </div>

    </nav>
