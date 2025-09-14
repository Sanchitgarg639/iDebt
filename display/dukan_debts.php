<?php
    include '_dbconnect.php';
    error_reporting(0);
?>

    <!-- Deleteing record -->
    <?php
        $user_id = $_GET['uid'];
        $del = $_GET['delete'];
        if(isset($del)){
            if($del == 'true'){
                $query = "DELETE FROM `debt` WHERE id='$user_id'";
                $result = mysqli_query($conn, $query);
                if($result)
                   $delete = true;
                else
                    echo 'Error in deleting record';
            }
            else
                echo 'Error';
        }
    ?>
<!doctype html>
<html lang="en">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    	<link href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css" rel="stylesheet">
        
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
		<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

        <title>iDebt - display registered users.</title>
		<link rel="shortcut icon" href="logo.png" type="image/png">

        <style>
				@import url('https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&family=Josefin+Sans&family=Lobster&family=Montserrat:wght@500&family=PT+Serif&family=Tangerine:wght@700&display=swap');
				*{
				padding: 0;
				margin: 0;
				text-decoration: none;
				list-style: none;
				box-sizing: border-box;
				font-family: 'Montserrat', sans-serif;
				}
				body{
					padding: 30px;
				}
				h3{
					font-family: 'Cinzel Decorative', cursive;
				}
				i{
					padding: 6px; font-size: 25px;
				}
				
				a{
                    text-decoration: none;
                }
		</style>
</head>
<body>
    <?php
			if($delete){
				echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
				<strong>Done!</strong> Your record has been deleted successfully.
				<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
				</div>";
			}
		?>

    <table class="table" id="myTable">
        <thead>
            <tr>
                <th class = "text-center">Serial No.</th>
                <th class = "text-center">Customer</th>
                <th class = "text-center">Phone</th>
                <th class = "text-center">Items</th>
                <th class = "text-center">Total Amt</th>
                <th class = "text-center">Time</th>
                <th class = "text-center">Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $ph = $_GET['ph'];
                $query = "SELECT * FROM `debt` where `dukan_number` = '$ph'";
                $result = mysqli_query($conn, $query);
                $rows = mysqli_num_rows($result);
                $no = 1;
                echo "<div style = 'padding : 10px'> $rows records found in database </div> <br>";
                if($rows > 0){
                    while($data = mysqli_fetch_assoc($result)){
                        $dukanwala = $data['dukanwala'];
                        $content = $data['debt_content'];
                        $content = str_replace("%20", " ", $content);
                        echo '<tr>
                            <td class = "text-center">'.$no.'</td>
                            <td class = "text-center">'.$data['debt_customer'].'</td>
                            <td class = "text-center">'.$data['debt_phone'].'</td>
                            <td class = "text-center">'.$content.'</td>
                            <td class = "text-center">'.$data['debt_amt'].'</td>
                            <td class = "text-center">'.$data['tstamp'].'</td>
                            <td class = "text-center">
                                <a href="dukan_debts.php?ph='.$ph.'&delete=true&uid='.$data['id'].'" style=" cursor: pointer; color:red; font-weight: 600;">
                                    Delete
                                </a>
                            </td>
                        </tr>';
                        $no = $no+1;
                    }
                }
                echo '<b><em style="padding: 15px;">'.$dukanwala.'</em></b>';
            ?>
        </tbody>
    </table>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
		<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" > </script>
		<script>
			$(document).ready( function () {
			$('#myTable').DataTable();
			} );
		</script>
</body>
</html>
