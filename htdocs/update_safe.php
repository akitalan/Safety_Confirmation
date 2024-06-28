<?php
require_once "controller.php";

session_start();

$comment = filter_input(INPUT_POST,'impressions');
if(($state = filter_input(INPUT_POST,'know',FILTER_VALIDATE_INT)) && ($emp_No = $_SESSION['emp_No'])){
    if(update_safe($emp_No,$state,$comment)){
        // echo "success!";
        $_SESSION['message'] = "安否の更新に成功しました！";
        $_SESSION['update'] = true;
    }else{
        $_SESSION['message'] = "安否の更新に失敗しました。";
        $_SESSION['update'] = false;
    }
}else{
    $_SESSION['message'] = "安否の更新に失敗しました。";
    $_SESSION['update'] = false;
}

header('Location: safe_input.php');
exit;

?>