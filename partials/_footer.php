<?php
    
    echo"
    <footer>
        <div class='fdiv1'>
            <div class='txt1 text-center'>
                lETS START SECURING YOUR INFORMATION ONlINE.
            </div>
        </div>

        <div class='fdiv2'>	
            <div class='fdiv2a'>
                <div class='text'>
                    <div class='flogo'><a href='home.php' style='color: white; cursor:none;'>iDebt </a></div>
                </div>
            </div>

            <div class='fdiv2bc'>
                <div class='fdiv2b'>
                    <div class='text'>
                        USEFUL LINKS :
                    </div><br>
                    <div class='txt3'><a href='home.php'> Home </a></div>";

                    echo "<div class='txt3'><a href='about.php'> About Us </a></div>
                    <div class='txt3'><a href='contact.php'> Contact Me </a></div>";

                    if((isset($_SESSION['lin']) && $_SESSION['lin'] == true) || (isset($_SESSION['sup']) && $_SESSION['sup'] == true)){
                        echo "<div class='txt3'><a href='debt.php'> Debt List </a></div>
                            <div class='txt3'><a href='logout.php'> Logout </a></div>";
                    }
                    else{
                        echo "<div class='txt3'><a href='login.php'> Login </a></div>
                        <div class='txt3'><a href='signup.php'> Signup </a></div>";
                    }

                echo "</div>

                <div class='fdiv2c'>
                    <div class='text'>
                        CONTACT INFORMATION :
                    </div><br>
                    <div class='txt3'>Email Address:</div>
                    <div class='txt3'><a href='mailto:idebt936@gmail.com'>idebt936@gmail.com</a></div>
                    <div class='txt3'>Phone Number:</div>
                    <div class='txt3'><a href='tel:9456377982'>9456377982</a></div>
                </div>
            </div>
        </div>

        <div class='foot' >
            <div class='copyright text-center'>Copyright © 2021 iDebt 2021 All rights reserved</div>
            <div class='join text-center'>
                Join us on:
                <a href='https://www.instagram.com/sad_success_motivation/' target='_blank' style='color:pink;'>
                    <i class='fab fa-instagram i'></i>
                </a>
                <a href='#' target='_blank' style='color:#1b9bff;'>
                    <i class='fab fa-telegram i'></i>
                </a>
                <a href='#' target='_blank' style='color:#1b9bff;'>
                    <i class='fab fa-facebook i'></i>
                </a>
                <a href='#' target='_blank' style='color:red;'>
                    <i class='fab fa-youtube i'></i>
                </a>
            </div>
        </div>
    </footer>";
?>        