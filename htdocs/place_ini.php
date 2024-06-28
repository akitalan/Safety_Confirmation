<?php
require_once "controller.php";

session_start();
    
if(place_ini()){
    $_SESSION['message'] = "被害地域の初期化に成功しました！";
    $_SESSION['update'] = true;
}else{
    $_SESSION['message'] = "被害地域の初期化に失敗しました。";
    $_SESSION['update'] = false;
}

header('Location: saferelate.php');
exit;

?>