<?php
require_once 'db_selecter.php';
require_once 'dbconnect.php';

$department_select = department_show();

if(isset($_POST["search"])){
    $department =filter_input(INPUT_POST,'department');
    $emp_No = filter_input(INPUT_POST,'emp_No');
    $state = filter_input(INPUT_POST,'state');

    try{
        $all_area = damage_area_checker();
        if($all_area){
            $sql = "SELECT C.EMP_NO, E.Name, C.STATE, C.COMMENT 
            FROM Confirm_Safety AS C 
            JOIN EMPLOYEE01 AS E ON E.EMP_NO = C.EMP_NO";
        }else{
            $sql = "SELECT C.EMP_NO, E.Name, C.STATE, C.COMMENT
            FROM Confirm_Safety AS C 
            JOIN EMPLOYEE01 AS E ON E.EMP_NO = C.EMP_NO 
            LEFT OUTER JOIN AS Visit ON C.EMP_NO = V.EMP_NO 
            WHERE 1";
        }

        if($emp_No) {
            $sql .= " AND C.EMP_NO = :emp_No";
        }else{
            if($all_area){
                if($department){
                    $sql .= " AND (E.DEP_NO = :department)";
                }
                if($state !== ""){
                    $sql .= " AND (C.STATE = :state)";
                }
            }else{
                $sql .= " AND (E.address_No in (SELECT region_No FROM region WHERE damage_area = 1) OR V.VISIT_NO in (SELECT region_No FROM region WHERE damage_area = 1))";
            }
        }
        
        $sql .= " ORDER BY C.EMP_NO";
        $stmt = connect()->prepare($sql);
        if($emp_No) {
            $stmt->bindParam(':emp_No',$emp_No);
        } else {
            if($department){
                $stmt->bindParam(':department', $department);
            }
            if($state !== ""){
                $stmt->bindParam(':state', $state);
            }
        }
        
        $stmt -> execute();
        $emp_No = array();
        while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
            $emp_show[] = $rows;
        }
    }catch(PDOExption $e){
        echo $e->getMessage();
    }
}else{
    $emp_show = emp_ini();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS_files/safeinfo.css">
    <link rel="stylesheet" href="CSS_files/BackButton.css">
    <title>安否状況</title>
</head>
<body>
    <header>
        <p id="logo"><img src="images/groupA_logo.png" alt="logo" width="200"></p>
    </header>
    <main>
        <div class="scroll-top">
            <a href="./overview.php">&lt;戻る</a>
        </div> 
        <div class="app-title">
            <h1>安否状況</h1>
        </div>
        <div class="safeinfro-screen">
            <form action = "safe_show.php" method = "POST">
                <div class="safeinfro-control">
                    
                    <div class="safeinfrocontrol-group">
                        <select name="department" id="place">
                            <option value="">全部署選択</option>
                            <?php foreach($department_select as $d):?>
                                <option value = "<?= ($d['Dep_NO'])?>"><?= $d['Dep_Name']?></option>
                            <?php endforeach?>
                        </select>
                    </div>

                    <div class="safeinfrocontrol-group">
                        <input type="text" name="emp_No" placeholder="社員番号" id="Employee_Number">
                    </div>

                    <div class="safeinfrocontrol-group">
                    <select name="state" id="safe">
                            <option value="">全状況選択</option>
                            <option value="0">未確認</option>
                            <option value="1">被害あり</option>
                            <option value="2">無事</option>
                        </select>
                    </div>
                    <button type="submit" id="search" name = "search">検索</button><br>
                </div>
            </form>    

            <table class = "table-style">
                    <caption>安否表示</caption>
                    <thead>
                        <tr>
                            <th>社員名</th>
                            <th>安否状況</th>
                            <th>コメント有無</th>
                            <th>詳細確認</th>
                        </tr>
                    </thead>
                    <?php if(isset($emp_show)):?>
                    <tbody>
                        <?php foreach($emp_show as $a):?>
                        <tr>
                            <td><?= $a["Name"]?></td>
                            <td>
                                <?php switch($a["STATE"]): 
                                    case 0:?>
                                        <p class = 'unconfirm'>未確認</p>
                                    <?php break;?>
                                    <?php case 1: ?>
                                        <p class = 'damege'>被害あり</p>
                                    <?php break;?>
                                    <?php case 2: ?>
                                        <p class = 'safe'>無事</p>
                                    <?php break;?>
                                <?php endswitch?>
                            </td>
                            <td>
                                <?php if($a["COMMENT"]):?>
                                    <p class = "comment_exist">コメントあり</p>
                                <?php else:?>    
                                    <p>コメントなし</p>
                                <?php endif?>    
                            </td>
                            <td><a href = "profile.php?emp_No=<?= $a["EMP_NO"]?>" class = "button">詳細<a></td>
                        </tr>
                        <?php endforeach?>
                    </tbody>
                   <?php endif?>     
                </table>
        </div>
    </main>
</body>
</html>