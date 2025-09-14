<?php
    include 'partials/_dbconnect.php';
    session_start();
?>
<?php
    $close_acc_fail = false;
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['close_acc'])){
            $dukan_phone = $_SESSION['dphone'];

            $query = "UPDATE `signup` SET `status` ='inactive' WHERE `phone`='$dukan_phone'";
            $result = mysqli_query($conn , $query);
            if($result){
                // dstroy session
                session_destroy();
                session_unset();
                setcookie('numcookie',$lphone,time()-(86400*31));

                header('Location: signup.php?close_account=true');
            }
            else{
                $close_acc_fail = true;
            }
        }

        if(isset($_POST['cancel'])){
            header('Location: home.php');
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

        <title>iDebt - <?php echo $_SESSION['dname']; ?></title>
		<link rel="shortcut icon" href="partials/image/idebt_logo.png" type="image/png">
        <style>
            .ink{ color: grey; }
            
        </style>
    </head>
    <body>
        <div class="logo text-center my-4"><a href="home.php">iDebt</a></div>
        <div class="container my-4 py-4">
            <?php
                if($close_acc_fail){
                    echo "
                    <div class='alert alert-danger alert-dismissible fade show my-0' role='alert'>
                        <strong> OOPS! </strong> Something went wrong, Please try again later.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
            ?>
            <h3 class="px-4" style="font-size: 22px;">Do you really want to close your account forever?</h3>
            <h6 class="px-4">( If you close your account make sure to save your debts somewhere else from iDebt. )</h6>
            <div class="my-3" style="display:flex; justify-content: space-evenly">
                <form method="POST"> <button class="btn btn-primary" id="cancel" name="cancel">Cancel</button> </form>
                <form method="POST"> <input type="submit" class="btn btn-danger" id="close_acc" name="close_acc" value="Close Account"> </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>