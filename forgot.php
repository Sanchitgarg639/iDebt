<?php
    include 'partials/_dbconnect.php';
    error_reporting(0);
    session_start();
?>
<?php
    $email_send_fail = false; $email_send = false; $empty_mail = false; $email_not_exist = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email_add = $_POST['mail'];

        if($email_add == ' ' || $email_add == ''){ $empty_mail = 'Error! Enter your email address.'; }
        else{
            $query = "SELECT * FROM `signup` WHERE email='$email_add' AND `status`='active'";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);
            if($rows > 0){
                while($data = mysqli_fetch_assoc($result)){
                    $id = $data['id'];
                    $subject = "iDebt - Renew Password";
                    $body = "Hii, This is to varify that this is your email address.
                    Click here to renew your password - http://localhost/php/idebt/forgot_pass.php?eaqidess=".$id." ";
                    $from_email = "From: sanchitgarg639@gmail.com";

                    if (mail($email_add, $subject, $body, $from_email)) { $email_send = true; }
                    else { $email_send_fail = true; }
                }
            }
            else{ $email_not_exist = "Error! This email don't exists."; }
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

        <title>iDebt - Forgot Password.</title>
		<link rel="shortcut icon" href="partials/image/idebt_logo.png" type="image/png">
    </head>
    <body>
        <div class="main-container">
            <div class="logo text-center my-4"><a href="home.php">iDebt</a></div>

            <div class="container my-4">
                <h3 class="px-4" style="padding-top: 20px;">Forgot Password </h3>
                <?php
                // Email sent
                    if($email_send){
                        echo "
                        <div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
                            <strong> Done! </strong> Your Email is sent, please check it out.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }

                    // email not sent
                    if($email_send_fail){
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show my-0' role='alert'>
                            <strong> OOPS! </strong> Something went wrong while sending email, Please try again later.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }
                ?>
                <form action="" method="POST" class="py-4 px-4">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class=" form-input form-control" id="mail" name="mail" placeholder="Email Address" autocomplete="off">
                        </div>
                        <small class="form-text text-muted">
                            <?php
                            if($empty_mail){ echo ' <div class="small"> '.$empty_mail.' </div>'; }
                            if($email_not_exist){ echo ' <div class="small"> '.$email_not_exist.' </div>'; }
                            ?>
                        </small>
                    </div>

                    <div class="text-center">
                        <input type="submit" value=" SUBMIT " name="submit" id="submit" class="btn bt">
                    </div>
                </form>
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