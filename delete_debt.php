<?php
    include 'partials/_dbconnect.php';
    error_reporting(0);
    session_start();
?>

<!-- Deleteing record -->
<?php
    echo '<b>DELETEING THE RECORD PLEASE WAIT!</b>';
    $del = $_GET['del'];
    $fid = $_GET['id'];
    if(isset($del)){
        if($del == 'true'){
            $query = "DELETE FROM `debt` WHERE id='$fid'";
            $result = mysqli_query($conn, $query);
            if($result){
                header('Location: debt.php?delete=true');
            }
            else{
                header('Location: debt.php?delete=false');
            }
        }
    }
?>