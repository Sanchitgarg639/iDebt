<?php
    include 'partials/_dbconnect.php';
    error_reporting(0);
    session_start();
?>
<?php
    $empty_pass = false; $pass_len = false; $match_error = false; $old_pass_wrong = false;
    $empty_address = false; 
    $user_len = false; $phone_len = false;  

    //Getting use id
    $ppn = $_SESSION['dphone'];
    $quer = "SELECT * FROM `signup` WHERE `phone`='$ppn'";
    $resul = mysqli_query($conn , $quer);
    $row = mysqli_num_rows($resul);
    if($row > 0){
        while($dat = mysqli_fetch_assoc($resul)){
            $did = $dat['id'];
        }
    }

    // Edit Profile
    if(isset($_POST['editp'])){
        $user = $_POST['user'];
        $phone = $_POST['phone'];
        $mail = $_POST['mail'];

        $house = $_POST['house'];
        $area = $_POST['area'];
        $city = $_POST['city'];
        $pincode = $_POST['pin'];
        $state = $_POST['state'];
        $country = $_POST['country'];

        if($house == ' ' || $house == '' || $city == ' ' || $city == '' || $pincode == ' ' || $pincode == '' || $state == ' ' || $state == '' || $country == ' ' || $country == '' || $area == ' ' || $area == '' ){
            $empty_address = 'Error! Enter your Full Address.';
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
                    $query = "UPDATE `signup` SET `username`='$user',`phone`='$phone',`email`='$mail',`house_no`='$house',`area`='$area',`city`='$city',`pincode`='$pincode',`state`='$state',`country`='$country' WHERE `id` = '$did'";
                    $result = mysqli_query($conn, $query);

                    if($result){
                        $_SESSION['sup'] = true;
                        $_SESSION['dname'] = $user;
                        $_SESSION['dmail'] = $mail;
                        $_SESSION['dphone'] = $phone;
                        $_SESSION['dhouse'] = $house;
                        $_SESSION['darea'] = $area;
                        $_SESSION['dcity'] = $city;
                        $_SESSION['dpincode'] = $pincode;
                        $_SESSION['dstate'] = $state;
                        $_SESSION['dcountry'] = $country;
                        $_SESSION['daddress'] = $house.' '.$area.' '.$city.' '.$pincode.' '.$state.' '.$country;

                        header("Location: home.php?edit_pro=true");
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

        <title>iDebt - <?php echo $_SESSION['dname']; ?></title>
		<link rel="shortcut icon" href="partials/image/idebt_logo.png" type="image/png">
        <style>
            .ink{ color: grey; }
            
        </style>
    </head>
    <body>

    <?php require 'partials/_nav.php'; ?>
    <!-- EDIT PROFILE -->
    <div class="container my-4">
        <h3 class="px-4" style="padding-top: 20px;">Edit Profile</h3>
        <form action="" method="POST" class="py-4 px-4">

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class=" form-input form-control" id="user" name="user" value="<?php echo $_SESSION['dname']; ?>" placeholder="Full Name" autocomplete="off">
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
                    <input type="number" class=" form-input form-control" id="phone" name="phone" value="<?php echo $_SESSION['dphone']; ?>" placeholder="Phone Number">
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
                    <input type="email" class=" form-input form-control" id="mail" name="mail" value="<?php echo $_SESSION['dmail']; ?>" placeholder="Email Address" autocomplete="off">
                </div>
                <small class="form-text text-muted">
                    <?php
                        if($empty_mail){ echo ' <div class="small"> '.$empty_mail.' </div>'; }
                        if($mail_exist){ echo ' <div class="small"> '.$mail_exist.' </div>'; }
                    ?>
                </small>
            </div>

            <div class="mb-3">
                <div class="input-group my-1">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>

                    <input type="text" class=" form-input form-control" id="house" name="house" value="<?php echo $_SESSION['dhouse']; ?>" placeholder="House No." autocomplete="off">

                    <input type="text" class=" form-input form-control" id="area" name="area" value="<?php echo $_SESSION['darea']; ?>" placeholder="Nearby Area" autocomplete="off">

                    <input type="text" class=" form-input form-control" id="city" name="city" value="<?php echo $_SESSION['dcity']; ?>" placeholder="City" autocomplete="off">
                </div>
                <div class="input-group">   
                    <input type="number" class=" form-input form-control" id="pin" name="pin" value="<?php echo $_SESSION['dpincode']; ?>" placeholder="Pincode">

                    <input type="text" class=" form-input form-control" id="state" name="state" value="<?php echo $_SESSION['dstate']; ?>" placeholder="State" autocomplete="off">

                    <input type="text" class=" form-input form-control" id="country" name="country" value="<?php echo $_SESSION['dcountry']; ?>" placeholder="Country" autocomplete="off">
                </div>
                <small class="form-text text-muted">
                <?php
                    if($empty_address){ echo ' <div class="small"> '.$empty_address.' </div>'; }
                ?>
                </small>
            </div>

            <div class="text-center">
                <input type="submit" value=" Edit Profile " name="editp" id="editp" class="btn bt">
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>