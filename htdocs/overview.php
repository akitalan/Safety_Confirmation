<?php
require_once "db_selecter.php";
session_start();
$emp_No = $_SESSION['emp_No'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS_files/overview.css">
    <link rel="stylesheet" href="CSS_files/BackButton.css">

    <title>安否確認</title>
</head>
<body>
    <header>
        <p id="logo"><img src="images/groupA_logo.png" alt="logo" width="200"></p>
    </header>

        <div class="return">
            <a href = "index.php">ログアウト</a>
        </div> 

    <div class="safecheck">
        <div class="safecheck-screen">
            <div class="app-title">
                <h1>安否確認</h1>
            </div>
            <div class="safecheck-form">
                <h3><img src="./images/mark.png" alt="警告画像" width="300" height="90"></h3>
                <?php if(emp_should($emp_No)):?>
                    <h2>安否状況を入力してください。</h2>
                <?php endif?>
                <a href="safe_show.php" class="button">安否状況を確認する。</a>
                <a href="safe_input.php" class="button">確認状況を入力する。</a>

                <?php if(edit_checker($emp_No)):?>
                    <a href = "foradmin.php" class = "button">管理者ページへ移行</a>
                <?php endif?>
            </div>
        </div>
    </div>

    
</body>
</html>