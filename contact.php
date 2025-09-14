<?php
    include 'partials/_dbconnect.php';
    error_reporting(0);
    session_start();
?>
<?php
    $contact_success = false; $tech_err = false;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['name'];
        $usermail = $_POST['mail'];
        $title = $_POST['title'];
        $description = $_POST['desc'];

        $query = "INSERT INTO `contact` (`user_name`, `user_mail`, `title`, `description`) VALUES ('$username', '$usermail', '$title', '$description')";
        $result = mysqli_query($conn, $query);
        if($result){
            $contact_success = true;
        }
        else{
            $tech_err = true;
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
        <link rel="stylesheet" href="css/_footer.css">

        <title>iDebt - Contact Us.</title>
		<link rel="shortcut icon" href="partials/image/idebt_logo.png" type="image/png">
        <style>
            .acti, .ink:hover{ color: white; }
            .act ,.activ ,.ac{ color: grey; }
        </style>
    </head>
    <body>

    <div class="modal fade" id="makeSureModal" tabindex="-1" aria-labelledby="makeSureModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="makeSureModal">Login to iDebt.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Login or Signup to iDebt to use our services. <br>
                </div>
                <div class="modal-footer">
                    <a href="login.php" class="btn btn-primary">Log-in</a>
                    <a href="signup.php" class="btn btn-primary">Sign-up</a>
                </div>
            </div>
        </div>
    </div>

    <?php
        require 'partials/_nav.php';
    ?>
    <div class="container my-4">
        <h3 class="px-4" style="padding-top: 20px;"> Contact Me </h3>

        <form action="" method="POST" class="py-4 px-4">
            <div class="mb-3">    
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class=" form-input form-control" id="name" name="name" placeholder="Your Name" autocomplete="off">
                </div>
                <small class="form-text text-muted"></small>
            </div>

            <div class="mb-3">    
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="text" class=" form-input form-control" id="mail" name="mail" placeholder="Your Email Address" autocomplete="off">
                </div>
                <small class="form-text text-muted"></small>
            </div>

            <div class="mb-3">    
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lightbulb"></i></span>
                    <input type="text" class=" form-input form-control" id="title" name="title" placeholder="Title of your Question" autocomplete="off">
                </div>
                <small class="form-text text-muted"></small>
            </div>

            <div class="mb-3">    
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-comment-alt-lines"></i></span>
                    <textarea type="text" id="desc" name="desc" class="form-control" placeholder="Describe your Question here" rows="4" cols="56"></textarea>
                </div>
                <small class="form-text text-muted"></small>
            </div>

            <div class="text-center">
                <input type="submit" value=" SUBMIT " name="submit" id="submit" class="btn bt">
            </div>
        </form>
    </div>

    <?php require 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>