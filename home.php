<?php
    include 'partials/_dbconnect.php';
    error_reporting(0);
    session_start();
?>
<?php
    $debt_success = false; $tech_err = false;
    $empty_cphone = false; $empty_amt = false; $empty_cname = false;
    $phone_len = false;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $custname = trim($_POST['cname']);
        $custphone = trim($_POST['cphone']);
        $content = trim($_POST['content']);
        $amount = trim($_POST['amt']);
        $dukanwala = $_SESSION['dname'];
        $dukan_number = $_SESSION['dphone'];
        $dukan_address = $_SESSION['daddress'];
        $content = str_replace(" ", "%20", $content);

            if($custname == ' ' || $custname == ''){
                $empty_cname = "Error! Enter Customer's Name.";
            }
            else{
                if($amount == ' ' || $amount == ''){
                    $empty_amt = "Error! Enter Total Amount.";
                }
                else{
                    if($custphone != ''){
                        if(strlen($custphone) != 10){
                            $phone_len = "Error! Enter a valid phone number.";
                        }
                        else{
                            $query = "INSERT INTO `debt` (`dukanwala`, `dukan_number`, `debt_customer`, `debt_phone`, `debt_content`, `debt_amt`, `dukan_address`) VALUES ('$dukanwala', '$dukan_number', '$custname', '$custphone', '$content', '$amount', '$dukan_address')";
                            $result = mysqli_query($conn, $query);
                            if($result){
                                $debt_success = true;
                                
                                // if(isset($_POST['send_whatsapp'])){
                                //     // if contents are written
                                //     if($content != '' || $content !=' '){
                                //         header('Location: https://wa.me/'.$custphone.'?text=Content:%20'.$content.'%0ATotal%20Amount:%20'.$amount.'%0ALalaji:%20'.$dukanwala);
                                //     }
                                //     // if contents aren't written
                                //     else{
                                //         header('Location: https://wa.me/'.$custphone.'?text=Total%20Amount:%20'.$amount.'%0ALalaji:%20'.$dukanwala);
                                //     }
                                // }
                            }
                            else{
                                $tech_err = true;
                            }
                        }
                    }
                    else{
                        $query = "INSERT INTO `debt` (`dukanwala`, `dukan_number`, `debt_customer`, `debt_phone`, `debt_content`, `debt_amt`, `dukan_address`) VALUES ('$dukanwala', '$dukan_number', '$custname', '$custphone', '$content', '$amount', '$dukan_address')";
                        $result = mysqli_query($conn, $query);
                        if($result){
                            $debt_success = true;

                            // if(isset($_POST['send_whatsapp'])){
                            //     header('Location: https://wa.me/'.$custphone.'?text= Content: '.$content.'%0A Total Amount: '.$amount.'%0A Lalaji: '.$dukanwala);
                            // }
                        }
                        else{
                            $tech_err = true;
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
        <link rel="stylesheet" href="css/_footer.css">

        <title>iDebt - Home.</title>
		<link rel="shortcut icon" href="partials/image/idebt_logo.png" type="image/png">

        <style>
            .ac, .ink:hover{ color: white; }
            .act ,.acti ,.activ{ color: grey; }
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
        
        if((isset($_SESSION['lin']) && $_SESSION['lin'] == true) || (isset($_SESSION['sup']) && $_SESSION['sup'] == true)){
            echo '<div class="container my-4">
                <h3 class="px-4" style="padding-top: 20px;"> iDebt Form </h3>
                <h6 class="px-4">( Share to customer and Save your debts here. )</h6>

                <form action="" method="POST" class="py-4 px-4">
                    <div class="mb-3">    
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class=" form-input form-control" id="cname" name="cname" placeholder="Customer Name *" autocomplete="off">
                        </div>
                        <small class="form-text text-muted">';
                            if($empty_cname){ echo " <div class='small'> ".$empty_cname." </div>"; }
                        echo '</small>
                    </div>
                    <div class="mb-3">    
                        <div class="input-group">
                            <span class="input-group-text"><i class="fad fa-mobile"></i></span>
                            <input type="number" class=" form-input form-control" id="cphone" name="cphone" placeholder="Phone Number of customer ">
                        </div>
                        <small class="form-text text-muted">';
                        if($empty_cphone){ echo " <div class='small'> ".$empty_cphone." </div>"; }
                        if($phone_len){ echo " <div class='small'> ".$phone_len." </div>"; }
                    echo '</small>
                    </div>

                    <div class="mb-3">    
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-shopping-cart"></i></span>
                            <textarea type="text" id="content" name="content" class="form-control" placeholder="Items Purchased with their Price" rows="4" cols="56"></textarea>
                        </div>
                    </div>

                    <div class="mb-3">    
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                            <input type="number" class=" form-input form-control" id="amt" name="amt" placeholder="Total Amount *">
                        </div>
                        <small class="form-text text-muted">';
                        if($empty_amt){ echo " <div class='small'> ".$empty_amt." </div>"; }
                    echo '</small>
                    </div>';

                    // Send to whatsapp
                    // echo '<div class="mb-3 form-check">
                    //     <input type="checkbox" class="form-check-input" value="send_whatsapp" name="send_whatsapp"  id="rememberme">
                    //     <label class="form-check-label" style="color: white;">Send to Whatsapp</label>
                    // </div>';

                    echo '<div class="text-center">
                        <input type="submit" value=" SUBMIT " name="submit" id="submit" class="btn bt">
                    </div>
                </form>
            </div>';
        }

        // PROTOTYPE
        else{
            echo '<div class="container my-4">
                <h3 class="px-4" style="padding-top: 20px;"> Sign-in to iDebt </h3>
                <h6 class="px-4">( Sign-in to iDebt to use the form service. )</h6>

                <div class="py-4 px-4">
                    <div class="mb-3">    
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class=" form-input form-control" placeholder="Customer Name">
                        </div>
                        <small class="form-text text-muted">
                            
                        </small>
                    </div>
                    <div class="mb-3">    
                        <div class="input-group">
                            <span class="input-group-text"><i class="fad fa-mobile"></i></span>
                            <input type="number" class=" form-input form-control" placeholder="Phone Number of customer">
                        </div>
                        <small class="form-text text-muted">
                            
                        </small>
                    </div>

                    <div class="mb-3">    
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-shopping-cart"></i></span>
                            <textarea type="text" id="content" name="content" class="form-control" placeholder="Items Purchased with their Price" rows="4" cols="56"></textarea>
                        </div>
                        <small class="form-text text-muted">
                            
                        </small>
                    </div>

                    <div class="mb-3">    
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                            <input type="number" class=" form-input form-control" id="amt" name="amt" placeholder="Total Amount">
                        </div>
                        <small class="form-text text-muted">
                            
                        </small>
                    </div>

                    <div class="text-center">
                        <button class="btn bt" data-bs-toggle="modal" data-bs-target="#makeSureModal">Sign-in To iDebt</button>
                    </div>
                </div>
            </div>';
        }

        require 'partials/_footer.php';
    ?>

    <?php
        $query = "SELECT * FROM `debt`";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        if($rows > 0){
            while($data = mysqli_fetch_assoc($result)){
                
            }
        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>