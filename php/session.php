<?php
    session_start();
    if(!isset($_SESSION['trial'])){
        unset($_SESSION['coun']);
        $_SESSION['trial'] = array();
        $_SESSION['trial'] = json_decode($_POST['dishData'], true);
        echo "This is the one used";
    }else{
        $_SESSION['beat'] = json_decode($_POST['dishData'], true);
        echo "Done";
        $_SESSION['coun'] = 1;
    }
    // unset($_SESSION['dish']);
?>