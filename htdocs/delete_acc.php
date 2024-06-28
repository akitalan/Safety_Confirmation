<?php
require_once "controller.php";

session_start();

if(($emp_No = filter_input(INPUT_POST,'login-name')) && ($password = filter_input(INPUT_POST,'login-pass'))){
    
    if(delete_acc($emp_No,$password) && delete_safe($emp_No)){
        $_SESSION['message'] = "アカウントの削除に成功しました！";
        $_SESSION['delete'] = true;
    }else{
        $_SESSION['message'] = "アカウントの削除に失敗しました。";
        $_SESSION['delete'] = false;
    }
}else{
    $_SESSION['message'] = "アカウントの削除に失敗しました。";
    $_SESSION['delete'] = false;
}

header('Location: accdelete.php');
exit;

?>