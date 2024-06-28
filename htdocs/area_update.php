<?php
    require_once "controller.php";
    session_start();


    if(($place = filter_input(INPUT_POST,'place')) || $place ==="0" ){
        if(area_update($place)){
            // echo "success!";
            $_SESSION['message'] = "被害地域の設定に成功しました！";
            $_SESSION['update'] = true;
        }else{
            $_SESSION['message'] = "被害地域の設定にに失敗しました。";
            $_SESSION['update'] = false;
        }
    }else{
        $_SESSION['message'] = "被害地域の設定に失敗しました。";
        $_SESSION['update'] = false;
    }
    header('Location: saferelate.php');
    exit;

?>