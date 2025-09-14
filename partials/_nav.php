<?php 
    echo'
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 10px;">
      <div class="container-fluid">
        <a class="navbar-brand" href="home.php">iDebt</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="ink ac" style="padding-right:13px;" aria-current="page" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="ink activ" style="padding-right:13px;" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="ink acti" style="padding-right:13px;" href="contact.php">Contact Me</a>
            </li>
            <li class="nav-item">
              <a class="ink act" style="padding-right:13px;" href="debt.php">Debts List</a>
            </li>
          </ul>';
        if((isset($_SESSION['lin']) && $_SESSION['lin'] == true) || (isset($_SESSION['sup']) && $_SESSION['sup'] == true)){
            echo '
              <form class="d-flex" method="GET" action="search.php">
                <input class="form-control me-2" type="search" id="query" name="query" placeholder="Search for debts" autocomplete="off" required>
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
              <li class="nav-item ml-2 py-2 dropdown">
                <a class="text-light navbar-brand dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  '.$_SESSION['dname'].'
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="account.php"><i class="fas fa-user-edit"></i> Edit Profile</a></li>
                  <li><a class="dropdown-item" href="change_pass.php"><i class="fas fa-key"></i> Change Password</a></li>
                  <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="close_acc.php">Close Account</a></li>
                </ul>
              </li>';
        }
        else{
            echo '<a href="login.php" class="btn btn-outline-primary mx-2 my-2">Log-in</a>
                  <a href="signup.php" class="btn btn-outline-primary ml-2 my-2">Sign-up</a>';
        }
        echo '</div>
      </div>
    </nav>';
?>

<!-- debt form greeting -->
<?php
        //success greeting
        if($debt_success){
            echo "<div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
                    <strong>Success! </strong> Your debt form has been submitted.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
        //error greeting
        if($tech_err){
            echo "<div class='alert alert-danger alert-dismissible fade show my-0' role='alert'>
                    <strong>Error! </strong> There is some error in submitting the form.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
?>

<!-- contact greetings -->
<?php
    if($contact_success){
      echo "<div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
              <strong>Success! </strong> Your contact form has been submitted.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    }
?>

<!-- Updated Profile Greetings -->
<?php
  if(isset($_GET['edit_pro']))
    if($_GET['edit_pro'] == 'true'){
      
      $username = $_SESSION['dname'];
      echo "<div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
              <strong> Success! </strong> Your Profile is Updated $username.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    }
?>

<!-- Changed Password Greetings -->
<?php
  if(isset($_GET['pass_c']))
    if($_GET['pass_c'] == 'true'){
      $username = $_SESSION['dname'];
      echo "<div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
              <strong> Success! </strong> Your Password is changed $username.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    }
?>

<!-- debt delete greetings -->
<?php
  if(isset($_GET['delete']) && $_GET['delete'] == 'true'){
    echo "<div class='alert alert-primary alert-dismissible fade show my-0' role='alert'>
            <strong>Done! </strong> Record is deleted successfully.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
  }
  if(isset($_GET['delete']) && $_GET['delete'] == 'false'){
    echo "<div class='alert alert-danger alert-dismissible fade show my-0' role='alert'>
            <strong>Error! </strong> in deleting records, Please check your network connection and try again.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
  }
?>

<!-- login , signup and logout congrats -->
<?php
        //Signup greeting
        if(isset($_GET['signup'])){
            if($_GET['signup'] == 'true'){
                $username = $_SESSION['dname'];
                echo "<div class='alert alert-primary alert-dismissible fade show my-0' role='alert'>
                        <strong>Success! </strong> Your account is created $username.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        }
        //login greeting
        if(isset($_GET['login'])){
            if($_GET['login'] == 'true'){
                $user = $_SESSION['dname'];
                echo "<div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
                        <strong>Welcome! </strong> Nice to see you here $user.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        }

        //logout greeting
        if(isset($_GET['logout'])){
            if($_GET['logout'] == 'true'){
                echo "<div class='alert alert-warning alert-dismissible fade show my-0' role='alert'>
                        <strong>Logged Out! </strong> You are logged out successfully.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        }
?>

<style>
  .alert{
    margin: 10px;
  }
  @media(max-width: 920px){
    .nav-item{ padding-top: 14px; }
  }
</style>