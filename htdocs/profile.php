<?php
require_once "db_selecter.php";

if(!($emp_No=filter_input(INPUT_GET,"emp_No"))){
    header("Location:safe_show");
    exit;
}

$emp_info = detail_emp($emp_No);

?>
<!DOCTYPE html>
<html lang="ja">
<head>  

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS_files/profile.css">
    <link rel="stylesheet" href="CSS_files/BackButton.css">
    <title>Document</title>

</head>
<body>
    <header><p id="logo"><img src="images/groupA_logo.png" alt="logo" width = "200" ></p></header>
    <main>
        <div class="profile">
            <div class="scroll-top">
                <a href="safe_show.php">&lt;戻る</a>
            </div>        
            <div class="app-title">
                <h1>安否状況</h1>
            </div>

            <div class="profile-screen">
                <div class="profileform">
                <h2 class = "emp_name">名前：<?= $emp_info["Name"]?></h2>
                    <?php switch($emp_info["state"]): 
                                    case 0:?>
                                    <h2 class = 'unconfirm'>未確認</h2>
                                    <?php break;?>
                                    <?php case 1: ?>
                                        <h2 class = 'damege'>被害あり</h2>
                                    <?php break;?>
                                    <?php case 2: ?>
                                        <h2 class = 'safe'>無事</h2>
                                    <?php break;?>
                                <?php endswitch?>
                </div>
                <div class="box">
                    <textarea name="impressions" id="impressions" readonly　placeholder="備考欄" cols="30" rows="10">
                        <?php if($emp_info["comment"]):?>
                                <?= $emp_info["comment"] ?>
                        <?php else:?>コメントなし<?php endif?>
                    </textarea>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
