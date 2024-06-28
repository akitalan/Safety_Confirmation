<?php
    require_once 'dbconnect.php';

    function edit_checker($emp_No){
        $result = false;
        try{
            $sql = "SELECT COUNT(*) FROM Password AS P LEFT OUTER JOIN Edit AS E ON P.EMP_NO = E.EMP_NO WHERE P.EMP_NO = :emp_No AND E.EDIT_RIGHT = 1";

            $stmt = connect()->prepare($sql);
            $stmt -> bindParam('emp_No',$emp_No, PDO::PARAM_STR);

            $stmt -> execute();
            $cnt = $stmt->fetchColumn();
            
            if($cnt == 1){
                $result = true;
            }
        }catch(PDOExeption $e){
            echo $e->getMessage();
            $result = false;
        }
        return $result;
    }

    function department_show(){
        
        try{
            $sql = "SELECT * FROM Department ORDER BY DEP_NO";

            $stmt = connect()->prepare($sql);

            $stmt -> execute();
            while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result[] = $rows;
              }
            //   echo '<pre>';
            //   var_dump($result);
            //   echo '</pre>';
            return $result;
        }catch(PDOExption $e){
            echo $e->getMessage();
        }
    }

    function emp_ini(){
        $result = []; // $result 変数を初期化する
        try{
            if(damage_area_checker()){
                $sql = "SELECT E.EMP_NO, E.Name, C.STATE, C.COMMENT FROM EMPLOYEE01 AS E 
                JOIN Confirm_Safety AS C ON E.EMP_NO = C.EMP_NO ORDER BY E.EMP_NO";
            }else{
                $sql = "SELECT E.EMP_NO, E.Name, C.STATE, C.COMMENT
                        FROM EMPLOYEE01 AS E 
                        JOIN Confirm_Safety AS C ON E.EMP_NO = C.EMP_NO 
                        ORDER BY E.EMP_NO";
            }
            $stmt = connect()->prepare($sql);
            $stmt -> execute();
            while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result[] = $rows;
            }
            return $result;
        }catch(PDOExption $e){
            echo $e->getMessage();
        }
    }

    function damage_area_checker(){
        $result = false;
        try{
            $sql = "SELECT COUNT(*) FROM region WHERE REGION_NO = 0 AND damage_area = 1";
            $stmt = connect()->prepare($sql);
            $stmt -> execute();
            $cnt = $stmt->fetchColumn();
            if($cnt == 1){
                $result = true;
            }
        }catch(PDOExeption $e){
            echo $e->getMessage();
        }
        
        return $result;
    }
    
    function detail_emp($emp_No){

        try{
            $sql = "SELECT E.Name, C.state, C.comment  
            FROM EMPLOYEE01 AS E
            JOIN Confirm_Safety AS C ON E.emp_No = C.emp_No
            WHERE E.emp_No = :emp_No";

            $stmt = connect()->prepare($sql);
            $stmt -> bindParam('emp_No',$emp_No, PDO::PARAM_STR);

            $stmt -> execute();
            while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
                $result = $rows;
              }
            return $result;
        }catch(PDOExeption $e){
            echo $e->getMessage();
        }
    }

    function emp_should($emp_No){
        $db = connect();
        $result = false;
        try{
            $sql =  "SELECT COUNT(*) FROM EMPLOYEE01 AS E 
            JOIN Confirm_Safety AS C ON E.EMP_NO = C.EMP_NO 
            LEFT OUTER JOIN Visit AS V ON E.EMP_NO = V.EMP_NO 
            WHERE (E.address_No in (SELECT region_No FROM region WHERE damage_area = 1) OR V.VISIT_NO in (SELECT region_No FROM region WHERE damage_area = 1) OR (1 = (SELECT COUNT(*) FROM region WHERE region_No = 0 AND damage_area = 1))) 
            AND C.STATE = 0 AND E.EMP_NO = :emp_No";

        $stmt = connect()->prepare($sql);
        $stmt -> bindParam('emp_No',$emp_No, PDO::PARAM_STR);

        $stmt -> execute();
        $cnt = $stmt->fetchColumn();
        if($cnt === 1){
            $result = true;
        }
        }catch(PDOExeption $e){
            echo $e->getMessage();
        }
        return $result;
    }
?>