<?php
    include 'partials/_dbconnect.php';
    error_reporting(0);
    session_start();


    if((isset($_SESSION['lin']) && $_SESSION['lin'] == true) || (isset($_SESSION['sup']) && $_SESSION['sup'] == true)){
        header('Location: home.php');
    }

    $acc_err = false; $pass_err = false;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $lphone = $_POST['lphone'];
        $lpass = $_POST['lpass'];

        $query = "SELECT * FROM `signup` WHERE phone='$lphone' AND `status`='active'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        if($rows == 1){
            while($data = mysqli_fetch_assoc($result)){
                if(password_verify($lpass, $data['pass'])){
                    $_SESSION['lin'] = true;
                    $_SESSION['dname'] = $data['username'];
                    $_SESSION['dmail'] = $data['email'];
                    $_SESSION['dphone'] = $lphone;
                    $_SESSION['dcity'] = $data['city'];
                    $_SESSION['dhouse'] = $data['house_no'];
                    $_SESSION['darea'] = $data['area'];
                    $_SESSION['dcity'] = $data['city'];
                    $_SESSION['dpincode'] = $data['pincode'];
                    $_SESSION['dstate'] = $data['state'];
                    $_SESSION['dcountry'] = $data['country'];
                    $_SESSION['daddress'] = $data['house_no'].' '.$data['area'].' '.$data['city'].' - '.$data['pincode'].' '.$data['state'].' '.$data['country'];
                    
                    if(isset($_POST['rememberme'])){
                        setcookie('numcookie',$lphone,time()+(86400*31));
                    }

                    $user = $_SESSION['dname'];
                    $city = $_SESSION['dcity'];
                    header("Location: home.php?login=true");
                }
                else{
                    $pass_err = "Error! Password is incorrecet. ";
                }
            }
        }
        else{
            $acc_err = "Error! No such account found. ";
        }
    }

?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    	<link href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/formcs.css">

        <title>iDebt - Login.</title>
		<link rel="shortcut icon" href="partials/image/idebt_logo.png" type="image/png">
    </head>
    <body>
        <div class="main-container">
            <div class="logo text-center my-4"><a href="home.php">iDebt</a></div>

            <div class="container my-4">
                <h3 class="px-4" style="padding-top: 20px;">Login </h3>
                <h6 class="px-4">( If you already have an account. )</h6>
                <?php
                    //check mail
                    if(isset($_GET['signup']) && $_GET['signup'] == 'success'){
                        echo "
                        <div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
                            <strong>Almost Done! </strong> ".$_SESSION['mail_varify']."
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }


                    //account activated
                    if(isset($_GET['activate']) && $_GET['activate'] == 'success'){
                        echo "
                        <div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
                            <strong>Success! </strong> Your account is activated. Please login now.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }


                    //logout greeting
                    if(isset($_GET['logout']) && $_GET['logout'] == 'true'){
                        echo "
                        <div class='alert alert-warning alert-dismissible fade show my-0' role='alert'>
                            <strong>Logged Out! </strong> You are logged out successfully.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }

                    //renewed password
                    if(isset($_GET['renew_pass']) && $_GET['renew_pass'] == 'true'){
                        echo "
                        <div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
                            <strong>Done! </strong> Your Password is updated, you may login now.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }
                ?>
                <form action="" method="POST" class="py-4 px-4">
                    <div class="mb-3">    
                        <div class="input-group">
                            <span class="input-group-text"><i class="fad fa-mobile"></i></span>
                            <input type="number" class=" form-input form-control" id="lphone" name="lphone" placeholder="Phone Number" value="<?php if(isset($_COOKIE['numcookie'])){ echo $_COOKIE['numcookie']; } ?>">
                        </div>
                        <small class="form-text text-muted">
                            <?php
                                if($acc_err){ echo ' <div class="small"> '.$acc_err.' </div>'; }
                            ?>
                        </small>
                    </div>

                    <div class="mb-3">    
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class=" form-input form-control" id="lpass" name="lpass" placeholder="Password">
                            <div class="input-group-text eyeopen" onclick="eye()"><i class="fas fa-eye"></i></div>
                        </div>
                        <small class="form-text text-muted">
                            <?php
                                if($pass_err){ echo ' <div class="small"> '.$pass_err.' </div>'; }
                            ?>
                        </small>
                        <a href="forgot.php" class="forgot_pass">Forgot Password </a>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" value="rememberme" name="rememberme"  id="rememberme">
                        <label class="form-check-label" style="color: white;">Remember me</label>
                    </div>
                    <div class="text-center">
                        <input type="submit" value=" LOGIN " name="submit" id="submit" class="btn bt">
                    </div>
                </form>

                <div class="login">
                    <h5 class="account">Don't have an Account?</h5>
                    <div class="center"><a href="signup.php" class="btn bt log" style="width: 150px;">Signup</a> </div>
                </div>
            </div>
        </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        //hide and show password
        function eye() {
            var x = document.getElementById("lpass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    </body>
</html>