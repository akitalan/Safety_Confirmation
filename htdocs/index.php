<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS_files/login_form.css">
    <title>Document</title>
</head>
<body>
    <header><p id="logo"><img src="images/groupA_logo.png" alt="logo" width = "200" ></p></header>
    <div class="login">
        <div class="login_screen">
            <div class="app-title">
                <h1>ログイン</h1>
            </div>
            <div class="login-form">
               
            <form action ="login_result.php" method = POST>
                <?php if(isset($_SESSION["error_message"])):?>
                    <p class = "error_message"><?php echo $_SESSION['error_message']?></p>
                <?php endif ?>
                <div class="control-group">
                    <input type="text" name="login-name" value="" placeholder="&#x1f464;     社員番号" id="login-name">
                    <label for="login-name"></label>
                </div>

                <div class="control-group">
                    <input type="password" name="login-pass" value="" placeholder="&#x1f512;   パスワード" id="login-pass">
                    <label for="login-pass"></label>
                </div>
                <div>
                    <input type = "submit" class="btn" value = "ログイン"/>
                </div>
            </form>
            
            </div>
        </div>
    </div>

    <script>
		//ここにJavaScriptのコードを記述

	</script>

</body>
</html>
<?php
    $_SESSION = array();
    session_destroy();
?>