<?php
    require_once 'config.php';

    function connect(){
        //必要ならば、dbnameとhostを変更してください。
        $dsn = "mysql:host=db-container;dbname=sk1;charset=utf8mb4";
        try{
            $db = new PDO($dsn, DB_USER, DB_PASS);
            
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
            $db->setAttribute(PDO::ATTR_AUTOCOMMIT,false);

            return $db;
        }catch(PDOExeption $e){
            echo $e->getMessage();
            exit;
        }
    }
?>