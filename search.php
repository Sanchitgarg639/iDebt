<?php
    include 'partials/_dbconnect.php';
    error_reporting(0);
    session_start();
?>

<!-- Deleteing record -->
<?php
    $del = $_GET['delete'];
    $fid = $_GET['id'];
    if(isset($del)){
        if($del == 'true'){
            $query = "DELETE FROM `debt` WHERE id='$fid'";
            $result = mysqli_query($conn, $query);
            if($result)
               $delete = true;
            else
                echo 'Error in deleting record, Please try again later.';
        }
        else
            echo 'Error in deleting record, Please try again later.';
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
        <link rel="stylesheet" href="css/text.css">
        <link rel="stylesheet" href="css/_footer.css">

        <title>iDebt - Your search results.</title>
		<link rel="shortcut icon" href="partials/image/idebt_logo.png" type="image/png">

        <style>
            .act, .ink:hover{ color: white; }
            .activ ,.acti ,.ac{ color: grey; }
        </style>
    </head>
    <body>

    <?php
        require 'partials/_nav.php';

        $searched = trim($_GET['query']);
        $userphone = $_SESSION['dphone'];
        echo '<div class="txt2 my-4 mx-4">Search results for <em>" '.$searched.' "</em></div>';

        //PRINTING TOTAL DEBT LEFT
        $query = "SELECT * FROM `debt` WHERE `dukan_number` = $userphone  AND MATCH (debt_customer, debt_phone, debt_content) against ('$searched')";
        $result = mysqli_query($conn, $query);
        $rows= mysqli_num_rows($result);
        $s = 0;
        if($rows > 0){
            while($data = mysqli_fetch_assoc($result)){
                $s = $s + $data['debt_amt'];
            }
            echo "<div class='lead totalr px-4'>Total Amount of debt left: Rs.".$s."</div>";
        }


        $query = "SELECT * FROM `debt` WHERE `dukan_number` = $userphone  AND MATCH (debt_customer, debt_phone, debt_content) against ('$searched')";
        $result = mysqli_query($conn, $query);
        $rows= mysqli_num_rows($result);
        $s = 0;
        if($rows > 0){
            echo " <div class='lead totalr px-4' style='color: #0A95E1;'>Total ".$rows." debts found!</div>";
            while($data = mysqli_fetch_assoc($result)){
                $custname = $data['debt_customer'];
                $custname = str_replace("%20", " ", $custname);
                $content = $data['debt_content'];
                $content = str_replace("%20", " ", $content);
                $s = $s + $data['debt_amt'];
                echo "<div class='container lead py-2 my-4 displays'>";

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
            echo '
                <div class="container my-4">
                    <p class="no_result text-center lead">No results found for "'.$searched.'"<p>';
            echo "<p class='nor'> 
                    Suggestions: <br>
                    • Make sure the Name is spelled correctly or the Phone Number is correct.<br>
                    • Rewrite it and check the spelling or number one more time.<br>
                    • Try to use other spellings of the name.
                </p>
            </div>";
        }
        
        require 'partials/_footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        deletes = document.getElementsByClassName("del");
        Array.from(deletes).forEach((element) => {
          element.addEventListener('click', (e)=>{
            sno = e.target.id.substr(1, );
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const searched = urlParams.get('query');
            if(confirm("Are you sure to Delete this Record!")){
              window.location = `http://localhost/php/idebt/search.php?query=${searched}&delete=true&id=${sno}`;
            }
          })
        })
    </script>
    </body>
</html>