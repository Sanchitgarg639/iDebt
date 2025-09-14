<?php
    include 'partials/_dbconnect.php';
    session_start();

    if((isset($_SESSION['lin']) && $_SESSION['lin'] == true) || (isset($_SESSION['sup']) && $_SESSION['sup'] == true)){
        header('Location: home.php');
    }

    $empty_user = false; $empty_phone = false; $empty_mail= false; $empty_pass = false; $empty_address = false;
    $phone_exist = false; $mail_exist = false; $user_exist = false;
    $user_len = false; $mail_len = false; $pass_len = false; $phone_len = false;
    $match_err = false;
    $email_send = false; $email_send_fail= false;
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $user = mysqli_real_escape_string($conn, $_POST['user']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $mail = mysqli_real_escape_string($conn, $_POST['mail']);

        $pass = mysqli_real_escape_string($conn, $_POST['pass']);
        $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);

        $house = mysqli_real_escape_string($conn, $_POST['house']);
        $area = mysqli_real_escape_string($conn, $_POST['area']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $pincode = mysqli_real_escape_string($conn, $_POST['pin']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);

        $token = bin2hex(random_bytes(15));
        $status = 'inactive';

        if($user == ' ' || $user == ''){
            $empty_user = 'Error! Enter your first name.';
        }
        else{
            if($phone == ' ' || $phone == ''){
                $empty_phone = 'Error! Enter your phone number.';
            }
            else{
                if($mail == ' ' || $mail == ''){
                    $empty_mail = 'Error! Enter your email address.';
                }
                else{
                    if($pass == ' ' || $pass == ''){
                        $empty_pass = 'Error! Set a password.';
                    }
                    else{
                        if($house == ' ' || $house == '' || $city == ' ' || $city == '' || $pincode == ' ' || $pincode == '' || $state == ' ' || $state == '' || $country == ' ' || $country == '' || $area == ' ' || $area == '' ){
                            $empty_address = 'Error! Enter your Full Address.';
                        }
                        else{
                            $phoneSql = "SELECT * FROM `signup` WHERE phone=$phone";
                            $phoneResult = mysqli_query($conn, $phoneSql);
                            $phoneRow = mysqli_num_rows($phoneResult);

                            if($phoneRow > 0){
                                $phone_exist = "Error! This Phone Number already exists.";
                            }
                            else{
                                $mailSql = "SELECT * FROM `signup` WHERE email='$mail'";
                                $mailResult = mysqli_query($conn, $mailSql);
                                $mailRow = mysqli_num_rows($mailResult); 
                                if($mailRow > 0){
                                    $mail_exist = "Error! This Email Address already exists.";
                                }
                                else{
                                        if(strlen($user) >= 61 || strlen($user) <= 3){
                                            $user_len = "Error! Username's length can be between 4 to 60.";
                                        }
                                        else{
                                            if(strlen($phone) != 10){
                                                $phone_len = "Error! Enter a valid phone number.";
                                            }
                                            else{
                                                if(strlen($pass) <= 6 || strlen($pass) >= 21){
                                                    $pass_len = "Error! password's length can be between 7 to 20 only.";
                                                }
                                                else{
                                                        if($pass != $cpass){
                                                            $match_err = "Error! Passwords do not match.";
                                                        }
                                                        else{
                                                            
                                                            //to create a secureity for user so in case if our database is hacked, than the hacker can't found any password of any user.
                                                            $hash = password_hash($pass , PASSWORD_DEFAULT);

                                                            // varify email address by user
            
                                                            $subject = "iDebt - Account Activation";
                                                            $body = "Hii ".$user.". Click here to activate your account - 
                                                            http://localhost/php/idebt/activate.php?token=".$token." ";
                                                            $from_email = "From: sanchitgarg639@gmail.com";

                                                            if (mail($mail, $subject, $body, $from_email)) {
                                                                $email_send = true;
                                                                $_SESSION['mail_varify'] = "".$user." Now, Please check your email to activate your account.";
                                                                
                                                                $query = "INSERT INTO `signup` (`username`, `phone`, `email`, `pass`, `house_no`, `area`, `city`, `pincode`, `state`, `country`, `token`, `status`) VALUES ('$user', '$phone', '$mail', '$hash', '$house', '$area', '$city', '$pincode', '$state', '$country', '$token', '$status')";
                                                                $result = mysqli_query($conn, $query);
                                                                if($result){
                                                                    header('Location: login.php?signup=success');
                                                                }
                                                                // else{
                                                                //     echo 'fail'.mysqli_error($conn);
                                                                // }
                                                            }
                                                            else {
                                                                $email_send_fail = true;
                                                            }
                                                        }
                                                }
                                            }
                                        }
                                }
                            }
                        }
                    }
                }
            }
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

        <title>iDebt - Sign-up for having a great experiance.</title>
		<link rel="shortcut icon" href="partials/image/idebt_logo.png" type="image/png">
    </head>
    <body>
        <div class="main-container">
            <div class="logo text-center my-4"><a href="home.php">iDebt</a></div>

            <div class="container my-4">
                <h3 class="px-4" style="padding-top: 20px;">Register</h3>
                <h6 class="px-4">(Create your account)</h6>

                <?php
                    //close account greeting
                    if(isset($_GET['close_account'])){
                        if($_GET['close_account'] == 'true'){
                            echo "
                            <div class='alert alert-primary alert-dismissible fade show my-0' role='alert'>
                                <div style='color: red;'><strong>Closed! </strong> You account is totally closed.</div>
                                <strong>Thank You!</strong> For being a part of <strong>iDebt</strong> and you may have a good life journey.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                        }
                    }

                    // Something went wrong
                    if($email_send_fail){
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show my-0' role='alert'>
                            <strong> OOPS! </strong> Something went wrong while creating your account, Please try again later.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }
                ?>

                <form action="" method="POST" class="py-4 px-4">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class=" form-input form-control" id="user" name="user" placeholder="Full Name" autocomplete="off">
                        </div>
                        <small class="form-text text-muted">
                            <?php
                                if($empty_user){ echo ' <div class="small"> '.$empty_user.' </div>'; }
                                if($user_len){ echo ' <div class="small"> '.$user_len.' </div>'; }
                            ?>
                        </small>
                    </div>

                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fad fa-mobile"></i></span>
                            <input type="number" class=" form-input form-control" id="phone" name="phone" placeholder="Phone Number">
                        </div>
                        <small class="form-text text-muted">
                            <?php
                                if($empty_phone){ echo ' <div class="small"> '.$empty_phone.' </div>'; }
                                if($phone_exist){ echo ' <div class="small"> '.$phone_exist.' </div>'; }
                                if($phone_len){ echo ' <div class="small"> '.$phone_len.' </div>'; }
                            ?>
                        </small>
                    </div>

                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class=" form-input form-control" id="mail" name="mail" placeholder="Email Address" autocomplete="off">
                        </div>
                        <small class="form-text text-muted">
                            <?php
                                if($empty_mail){ echo ' <div class="small"> '.$empty_mail.' </div>'; }
                                if($mail_exist){ echo ' <div class="small"> '.$mail_exist.' </div>'; }
                            ?>
                        </small>
                    </div>

                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class=" form-input form-control" id="pass" name="pass" placeholder="Set a Strong Password">
                            <div class="input-group-text eyeopen" onclick="eye()"><i class="fas fa-eye"></i></div>
                        </div>
                        <small class="form-text text-muted">
                            <?php
                                if($empty_pass){ echo ' <div class="small"> '.$empty_pass.' </div>'; }
                                if($pass_len){ echo ' <div class="small"> '.$pass_len.' </div>'; }
                            ?>
                        </small>
                    </div>

                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class=" form-input form-control" id="cpass" name="cpass" placeholder="Confirm Password">
                            <div class="input-group-text eyeopen" onclick="oeye()"><i class="fas fa-eye"></i></div>
                        </div>
                        <small class="form-text text-muted">
                            <?php
                                if($match_err){ echo ' <div class="small"> '.$match_err.' </div>'; }
                            ?>
                        </small>
                    </div>
                    
                    <div class="mb-3">
                        <div class="input-group my-1">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" class=" form-input form-control" id="house" name="house" placeholder="House No." autocomplete="off">
                            <input type="text" class=" form-input form-control" id="area" name="area" placeholder="Nearby Area" autocomplete="off">
                            <input type="text" class=" form-input form-control" id="city" name="city" placeholder="City" autocomplete="off">
                        </div>
                        <div class="input-group">   
                            <input type="number" class=" form-input form-control" id="pin" name="pin" placeholder="Pincode">
                            <input type="text" class=" form-input form-control" id="state" name="state" placeholder="State" autocomplete="off">
                            <input type="text" class=" form-input form-control" id="country" name="country" placeholder="Country" autocomplete="off">
                        </div>
                        <small class="form-text text-muted">
                            <?php
                                if($empty_address){ echo ' <div class="small"> '.$empty_address.' </div>'; }
                            ?>
                        </small>
                    </div>
                    
                    <div class="mb-3">
                        <div class="input-group">  
                            <img src="image.php" alt="captcha img" class=" form-input form-control" id="seeCaptcha" name="seeCaptcha" readonly
                            style="margin-right: 10px; border-top-right-radius: 3px;
                            border-bottom-right-radius: 3px;">

                            <input type="text" class=" form-input form-control" id="captcha" name="captcha" placeholder="Enter Captcha " autocomplete="off"
                            style="border-top-left-radius: 3px;
                            border-bottom-left-radius: 3px;" >
                        </div>
                        <small class="form-text text-muted">
                            <?php
                            ?>
                        </small>
                    </div>

                    <div class="text-center">
                        <input type="submit" value=" REGISTER " name="submit" id="submit" class="btn bt">
                    </div>
                </form>

                <div class="login">
                    <h5 class="account">Already have an Account?</h5>
                    <div class="center"><a href="login.php" class="btn bt log" style="width: 150px;">Login</a> </div>
                </div>
            </div>
        </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        //hide and show password and confirm password
        function eye() {
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function oeye() {
            var x = document.getElementById("cpass");
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