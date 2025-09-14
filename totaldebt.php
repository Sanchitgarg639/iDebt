<?php
    include 'partials/_dbconnect.php';
    error_reporting(0);
    session_start();
?>

<script> $('#makeSureModal').trigger('click'); </script>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    	<link href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/text.css">

        <title>iDebt - Your customer's debt details.</title>
		<link rel="shortcut icon" href="partials/image/idebt_logo.png" type="image/png">
        <style>
            .act, .ink:hover{ color: white; }
            .activ ,.acti ,.ac{ color: grey; }
        </style>
    </head>
    <body>

    <?php
        require 'partials/_nav.php';

        if((isset($_SESSION['lin']) && $_SESSION['lin'] == true) || (isset($_SESSION['sup']) && $_SESSION['sup'] == true)){
            $dukan_number = $_SESSION['dphone'];

            echo "<h2 class='px-4 py-4'> Welcome ".$_SESSION['dname']."! Your customer's debts : </h2> "; //Greetings

            //PRINTING TOTAL DEBT LEFT
            $query = "SELECT * FROM `debt` WHERE `dukan_number`=$dukan_number";
            $result = mysqli_query($conn, $query);
            $rows= mysqli_num_rows($result);
            $s = 0;
            if($rows > 0){
                while($data = mysqli_fetch_assoc($result)){
                    $s = $s + $data['debt_amt'];
                }
                echo "<div class='lead totalr px-4'>Total Amount of debt left: Rs.".$s."</div>"; //total amt. of debts
            }
            
            $query = "SELECT * FROM `debt` WHERE `dukan_number`=$dukan_number";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);
            if($rows > 0){
                while($data = mysqli_fetch_assoc($result)){
                    $custname = $data['debt_customer'];
                    $custname = str_replace("%20", " ", $custname);
                    $arr = array("$custname","wfffw");
                }
            }
            echo "<div style='color:red;'>".$arr[0]."</div>";
            

            $query = "SELECT * FROM `debt` WHERE `dukan_number`=$dukan_number ORDER BY id DESC ";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);
            if($rows > 0){
                echo " <div class='lead totalr px-4' style='color: #0A95E1;'>Total ".$rows." debts found!</div>"; //total no. of debts
                echo "<a href='debt.php' class='lead totalr px-4' style='color: #0A95E1;'>Debt List</a>"; //to totaldebts by name of people
                while($data = mysqli_fetch_assoc($result)){
                    $custname = $data['debt_customer'];
                    $custname = str_replace("%20", " ", $custname);
                    $content = $data['debt_content'];
                    $content = str_replace("%20", " ", $content);
                    // Debts cards
                    echo "
                    <div class='mx-4 lead py-2 my-4 displays'>";
                        echo "<p class='deb'>Customer's Name: <b>".$custname."</b></p>";
                        if($data['debt_phone'] != ''){
                            echo "<p class='deb'>Customer's Phone Number: <span class='rwd-line'><b> ".$data['debt_phone']."</b></span></p>";
                        }
                        if($content != ''){
                            echo "<p class='deb'>Items Purchased: <span class='rwd-line'><b>".$content."</b></span></p>";   
                        }
                        echo "<p class='deb'>Total Amount left: <b>Rs.".$data['debt_amt']."</b></p>";
                        echo "<p class='deb'>Time of submition: <b>".$data['tstamp']."</b></p>";
                        echo "<p class='deb'>Debt Cleared? <button  id= d".$data['id']." class='btn del bt btn-danger'> DELETE </button></p>";
                    echo "</div>";
                }
            }
            else{
                echo " <div class='lead totalr px-4' style='color: #0A95E1;'>Total 0 debts found!</div>";
            }
        }
        else{
            echo'<h2 class="px-4 py-4"> Login or Signup To iDebt To Get Excess to This Page </h2>
                <a href="login.php" class="btn btn-success mx-3 ">Log-in</a>
                <a href="signup.php" class="btn btn-success mx-3 ">Sign-up</a>';
        }
    ?>

    <script>
        deletes = document.getElementsByClassName("del");
        Array.from(deletes).forEach((element) => {
          element.addEventListener('click', (e)=>{
            sno = e.target.id.substr(1, );
            if(confirm("Are you sure to Delete this Record!")){
              window.location = `http://localhost/php/idebt/delete_debt.php?del=true&id=${sno}`;
            }
          })
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>