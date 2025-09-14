<?php
    session_start();
    session_destroy();
    session_unset();
    setcookie('numcookie',$lphone,time()-(86400*31));
    header("Location: login.php?logout=true");

?>