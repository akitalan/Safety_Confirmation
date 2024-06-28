<?php
    require_once 'dbconnect.php';

    function login($emp_No,$password){
        $login_result = false;
        if(emp_check_pass($emp_No) && password_check($emp_No,$password) ){
            //ログイン成功 
            $login_result = true;
        }
        return $login_result;
    }

    function password_check($emp_No,$password){
        $result = false;
        
        $sql = "SELECT password_value FROM Password WHERE 1 AND EMP_NO = :emp_No";
        
        $stmt = connect()->prepare($sql);
        $stmt -> bindParam('emp_No',$emp_No, PDO::PARAM_STR);
        $stmt->execute();

        $pass_model = $stmt->fetchColumn();
        if(password_verify($password,$pass_model)){
            $result = true;
        }
        return $result;
    }

    function emp_check_pass($emp_No){
        $result = false;

        $sql = "SELECT COUNT(*) FROM Password WHERE EMP_NO = :emp_No";
        $stmt = connect()->prepare($sql);
        $stmt -> bindParam('emp_No',$emp_No, PDO::PARAM_STR);
        $stmt->execute();

        $cnt = $stmt->fetchColumn();
        if($cnt === 1){
            $result = true;
        }
        return $result;
    }

    function insert_emp($emp_No,$password_value){
        $result = false;

        $sql = "INSERT INTO Password VALUE (:emp_No,:password_value)";

        try{
            $db = connect();
            $stmt = $db->prepare($sql);
            $pass_hash = password_hash($password_value,PASSWORD_DEFAULT);
            $stmt -> bindParam('emp_No',$emp_No, PDO::PARAM_STR);
            $stmt -> bindParam('password_value',$pass_hash, PDO::PARAM_STR);
    
            $stmt->execute();
            
            if(($cnt = $stmt-> rowcount()) === 1){
                $db -> commit();
                $result = true;
            }else{
                $db -> rollback();
                $result = false;
            }
        }catch(PDOExeption $e){
            echo $e->getMessage();
            $result = false;
        }
        return $result;

    }

    function update_safe($emp_No,$state,$comment){

        $result = false;
    try{
        $db = connect();
        $sql = "UPDATE Confirm_Safety SET STATE = :state, COMMENT = :comment WHERE EMP_NO = :emp_No";
        
        $stmt = $db ->prepare($sql);
        $stmt -> bindParam('emp_No',$emp_No, PDO::PARAM_STR);
        $stmt -> bindParam('comment',$comment, PDO::PARAM_STR);
        $stmt -> bindParam('state',$state, PDO::PARAM_INT);

        $stmt->execute();

        if(($cnt = $stmt-> rowcount()) === 1){
            $result = true;
            $db -> commit();

        }else{
            $result = false;
            $db -> rollback();
        }
    }catch(PDOExeption $e){
        echo $e->getMessage();
        $result = false;
    }
        return $result;
    }

    function create_acc($emp_No){
        $result = false;
        if(emp_check_emp($emp_No)){ 
        try{
            $db = connect();
            $sql = "SELECT Birthday FROM EMPLOYEE01 where emp_No = :emp_No";
            $stmt = $db -> prepare($sql);
            $stmt -> bindParam('emp_No',$emp_No, PDO::PARAM_STR);

            $stmt -> execute();
            $birthday = $stmt->fetchColumn();


            if(!$birthday) return $result;

            $replace = str_replace('-','',$birthday);

            if(insert_emp($emp_No,$replace)) $result = true;

        }catch(PDOExeption $e){
            echo $e->getMessage();
            $result = false;
        }
    }
    return $result;   
    }

    function emp_check_emp($emp_No){
        $result = false;
        
        $sql = "SELECT COUNT(*) FROM EMPLOYEE01 WHERE 1 AND EMP_NO = :emp_No";
        $stmt = connect()->prepare($sql);
        $stmt -> bindParam('emp_No',$emp_No, PDO::PARAM_STR);

        $stmt->execute();

        $cnt = $stmt->fetchColumn();
        if($cnt == 1){
            $result = true;
        }
        return $result;
    }

    function delete_acc($emp_No,$password){
        $result = false;
        $db = connect();
        if(emp_check_pass($emp_No) && password_check($emp_No,$password)){
                try{
                    $sql = "DELETE FROM Password WHERE emp_No= :emp_No";
                    $stmt = $db->prepare($sql);
                    $stmt -> bindParam('emp_No',$emp_No, PDO::PARAM_STR);
                    $stmt->execute();

                    if(($cnt = $stmt-> rowcount()) === 1){
                        $db -> commit();
                        $result = true;
                    }else{
                        $db -> rollback();
                        $result = false;
                    }
                }catch(PDOExeption $e){
                    echo $e->getMessage();
                    $result = false;
                }
            }
        return $result;
    }

    function delete_safe($emp_No){
        $result = false;
        $db = connect();
        try{
            $sql = "DELETE FROM Confirm_Safety WHERE emp_No= :emp_No";
                    $stmt = $db->prepare($sql);
                    $stmt -> bindParam('emp_No',$emp_No, PDO::PARAM_STR);
                    $stmt->execute();

            if(($cnt = $stmt-> rowcount()) === 1){
                $db -> commit();
                $result = true;
            }else{
                $db -> rollback();
                $result = false;
            }
        }catch(PDOExeption $e){
            echo $e->getMessage();
            $result = false;
        }
        return $result;
    }

    function state_ini(){
        $result = false;
        $db = connect();
            try{
                $sql = "UPDATE Confirm_Safety SET STATE = 0, Comment = NULL";
                $stmt = $db ->prepare($sql);
                $stmt->execute();

                if(($cnt = $stmt-> rowcount()) > 0){
                    $result = true;
                    $db -> commit();
                }else{
                    $result = false;
                    $db -> rollback();
                }
            }catch(PDOExeption $e){
                echo $e->getMessage();
                $result = false;
            }
        return $result;
    }

    function area_update($place){
        $result = false;
        $db = connect();
            try{
                $sql = "UPDATE region SET damage_area = 1 WHERE 1 AND region_no = :place";
                $stmt = $db ->prepare($sql);
                $stmt -> bindParam('place',$place, PDO::PARAM_INT);
                $stmt->execute();

                if(($cnt = $stmt-> rowcount()) > 0){
                    $result = true;
                    $db -> commit();
                }else{
                    $db -> rollback();
                }
            }catch(PDOExeption $e){
                echo $e->getMessage();
                $result = false;
            }
        return $result;
    }

    function place_ini(){
        $result = false;
        $db = connect();
            try{
                $sql = "UPDATE region SET damage_area = 0";
                $stmt = $db ->prepare($sql);
                $stmt->execute();

                if(($cnt = $stmt-> rowcount()) >0){
                    $result = true;
                    $db -> commit();
                }else{
                    $result = false;
                    $db -> rollback();
                }
            }catch(PDOExeption $e){
                echo $e->getMessage();
                $result = false;
            }
        return $result;
    }

    function create_safe($emp_No){
        $result = false;
        $db = connect();

        try{
            $sql = "INSERT INTO Confirm_Safety VALUE (:emp_No, 0, NULL)";
            $stmt = $db ->prepare($sql);
            $stmt -> bindParam('emp_No',$emp_No, PDO::PARAM_STR);
            $stmt->execute();

            if(($cnt = $stmt -> rowcount()) > 0){
                $result = true;
                $db -> commit();
            }else{
                $result = false;
                $db -> rollback();
            }
        }catch(PDOExeption $e){
            echo $e->getMessage();
            $result = false;
        }
    return $result;
    }

    
?>