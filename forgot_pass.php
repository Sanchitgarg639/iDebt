<?php
    include 'partials/_dbconnect.php';
    error_reporting(0);
    session_start();
?>
<?php
    $something_wrong = false; $empty_pass = false; $pass_len = false; $match_error = false;
    $iid = $_GET['eaqidess'];
    if(isset($_POST['change'])){
        $new_pass = $_POST['npass'];
        $confirm_new_pass = $_POST['ncpass'];

        if($new_pass == ' ' || $new_pass == ''){ $empty_pass = 'Error! Set a password.'; }
        else{
            if(strlen($new_pass) <= 6 || strlen($new_pass) >= 21){ $pass_len = "Error! password's length can be between 7 to 20 only."; }
            else{
                if($new_pass == $confirm_new_pass){
                    //to create a secureity for user so in case if our database is hacked, than the hacker can't found any password of any user.
                    $new_hash = password_hash($new_pass , PASSWORD_DEFAULT);

                    $UpdateQuery = "UPDATE `signup` SET `pass`='$new_hash' WHERE `id` = '$iid'";
                    $UpdateResult = mysqli_query($conn, $UpdateQuery);
                    if($UpdateResult){ header("Location: login.php?renew_pass=true"); }
                    else{ $something_wrong = true; }  
                }
                else{ $match_error = "Passwords do not match"; }
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

        <title>iDebt - Renew Password</title>
		<link rel="shortcut icon" href="partials/image/idebt_logo.png" type="image/png">
    </head>
    <body>
    <!-- CHANGE PASSWORD -->
    <div class="logo text-center my-4"><a href="home.php">iDebt</a></div>
    <div class="container my-4">
        <h3 class="px-4" style="padding-top: 20px;">Change Password</h3>
        <?php
            // something went wrong
            if($something_wrong){
                echo "
                <div class='alert alert-danger alert-dismissible fade show my-0' role='alert'>
                    <strong> OOPS! </strong> Something went wrong while sending email, Please try again later.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        ?>
        <form action="" method="POST" class="px-4 py-4">
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class=" form-input form-control" id="npass" name="npass" placeholder="New Password">
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
                    <input type="password" class=" form-input form-control" id="ncpass" name="ncpass" placeholder="Confirm New Password">
                </div>
                <small class="form-text text-muted">
                <?php
                    if($match_error){ echo ' <div class="small"> '.$match_error.' </div>'; }
                ?>
                </small>
            </div>

            <div class="text-center">
                <input type="submit" value=" Set Password " name="change" id="change" class="btn bt">
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>