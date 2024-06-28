<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS_files/saferelate.css">
    <link rel="stylesheet" href="CSS_files/BackButton.css">
    <title>Document</title>
</head>
<body>

    <header><p id="logo"><img src="images/groupA_logo.png" alt="logo" width = "200" ></p></header>
    <main>
        <div class="scroll-top">
            <a href ="foradmin.php">&lt;戻る</a>
        </div> 
        <div class="app-title">
            <h1>安否関連</h1>
        </div>

        <?php if(isset($_SESSION['message'])):?>
            <?php if($_SESSION['update']):?>
                <p class ="true_message"><?= $_SESSION['message']?></p>
            <?php else:?>
                <p class = "false_message"><?= $_SESSION['message']?></p> 
            <?php endif?>       
        <?php endif?>

        <div class="form">
            <a href= "state_ini.php" class="initialization">安否の初期化</a><br>
            <a href= "place_ini.php" class="initialization">被害地域の初期化</a><br>
            <div class="targetarea">
                <h2>被害地域の選択</h2>
                <form action = "area_update.php" method = "POST">
                    <select name="place" id="place">
                        <option value="0">全体</option>
                        <option value="1">北海道</option>
                        <option value="2">東北</option>
                        <option value="3">関東</option>
                        <option value="4">中部</option>
                        <option value="5">近畿</option>
                        <option value="6">中国</option>
                        <option value="7">四国</option>
                        <option value="8">九州</option>
                    </select><br>
                    <button type ="submit" id="submit">送信</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
<?php
    unset($_SESSION['message']); 
    unset($_SESSION['update']);
?>