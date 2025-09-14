<?php
    include 'partials/_dbconnect.php';
    error_reporting(0);
    session_start();
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

        <title>iDebt - About iDebt.</title>
		<link rel="shortcut icon" href="partials/image/idebt_logo.png" type="image/png">

        <style>
            .activ, .ink:hover{ color: white; }
            .act ,.acti ,.ac{ color: grey; }
        </style>
    </head>
    <body>

    <?php require 'partials/_nav.php'; ?>
    <div class="container">
        <h2 class="text-center py-4"> Welcome to iDebt <i class="far fa-torii-gate"></i></h2>

        <div class="header_text py-2 px-3" style="margin-top: 0px;"> iDebt </div>
        <div class="para_text py-3 px-3"> Here we help you to save your information about your shop's customer's debts they have taken and pass it to your customers as a whatsapp message too , automatically. This is a more effective way to secure your data online , also by helping you all to have a little taste of online bussiness world. </div>

        <div class="header_text py-2 px-3"> How to Use </div>
        <div class="para_text py-3 px-3"> You have to just signup and start using the service we provide. Just signup with your mail and phone number and come back to <a href="home.php"> <em> home </em> </a> page whenever someone take a debt from you, just put the informtion here in the form present at the home page. Your information will be send to that customer automatically as a WhatsApp message and also will be stored only for you in the <a href="debt.php"> <em> Debt List </em> </a> option on this website in case of any emergency backup you need. </div>

        <div class="header_text py-2 px-3"> Debt List Option and Search</div>
        <div class="para_text py-3 px-3"> Here you have all your debts you entered in the form of the <a href="home.php"> <em> home </em> </a> page, secured. You can see them whenever you want also you can search for debts of some perticular person by entering his/her name or phone number or the item the purchased in the search box which you will see when you are signed-in. You can also delete any record you want if the debt is cleared, just by clicking on the delete button just in the last of every record. </div>

        <div class="header_text py-2 px-3"> Any Other Question? (Contact Me)</div>
        <div class="para_text py-3 px-3">If there's any other thing you wanna ask than you can email me on the email address given below or contact me on the number given below or you can also put it on the form in <a href="contact.php"> <em> Contact Me </em> </a> option, present on the NavBar along with its little title and than describe it below there.</div>

        <div class="contactme">
            <a href="mailto:idebt936@gmail.com" class="px-4 py-2 mx-3 text-center"> Email:
                <i class="fas fa-envelope px-4" style="color: #1b9bff;"></i>
            </a>
		  	<a href="tel:9456377982" class="px-4 py-2 mx-3 text-center"> Phone:
                <i class="fad fa-phone-square-alt px-4" style="color: green;"></i>
            </a>
        </div>
    </div>

    <?php require 'partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>