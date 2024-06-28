<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS_files/accdelete.css">
    <link rel="stylesheet" href="CSS_files/BackButton.css">
    <title>Document</title>
</head>
<body>
    <header><p id="logo"><img src="images/groupA_logo.png" alt="logo" width = "200" ></p></header>
    <main>
        <div class="scroll-top">
        <a href="accmanage.php">&lt;戻る</a>
        </div> 
        <div class="app-title">
            <h1>アカウント削除</h1>
        </div>
        <?php if(isset($_SESSION['message'])):?>
            <?php if($_SESSION['delete']):?>
                <p class ="true_message"><?= $_SESSION['message']?></p>
            <?php else:?>
                <p class = "false_message"><?= $_SESSION['message']?></p> 
            <?php endif?>       
        <?php endif?>
        <form action = "delete_acc.php" method = "POST">
            <div class="form">
                <div class="control-group">
                    <input type="text" name="login-name" value="" placeholder="社員番号" id="login-name">
                    <label for="login-name"></label>
                </div>
                <div class="control-group">
                    <input type="password" name="login-pass" value="" placeholder="パスワード" id="login-pass">
                    <label for="login-pass"></label>
                </div>
                <button type ="submit" id="submit">削除</button><br>
            </div>
        </form>
    </main>
</body>
</html>
<?php 
    unset($_SESSION['message']); 
    unset($_SESSION['delete']);
?>