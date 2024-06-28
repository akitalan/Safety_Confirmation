<?php
    session_start();
    
    require_once 'controller.php';

    if(!($emp_No=filter_input(INPUT_POST,'login-name'))|| !($password=filter_input(INPUT_POST,'login-pass'))){
        $_SESSION['error_message'] = "従業員番号とパスワードを入力してください。";
        header('Location: index.php');
        exit;
    }

    if(login($emp_No,$password)){
        $_SESSION['emp_No'] = $emp_No;
        header("Location: overview.php");
        exit;
    }else{
        $_SESSION['error_message'] = "従業員番号またはパスワードが異なります。";
        header('Location: index.php');
        exit;
    }
    
?>