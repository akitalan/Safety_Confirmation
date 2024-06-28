<?php
require_once "controller.php";
$db = connect();
session_start();

if($emp_No = filter_input(INPUT_POST,'login-name')){
    if(create_acc($emp_No) && create_safe($emp_No)){
        // echo "success!";
        $_SESSION['message'] = "アカウントの作成に成功しました！";
        $_SESSION['create'] = true;
    }else{
        $_SESSION['message'] = "アカウントの作成に失敗しました。";
        $_SESSION['create'] = false;
    }
}else{
    $_SESSION['message'] = "アカウントの作成に失敗しました。";
    $_SESSION['create'] = false;
}

header('Location: acccreation.php');
exit;

?>