<?php
    $searchId = $_POST['searchId'];
    $searchName = $_POST['searchName'];
    // $searchGender = $_POST['searchName'];
    // $searchAccount = $_POST['searchName'];
    // $searchPhone = $_POST['searchName'];

    include('../Lib/Util.php'); 
    
    $sql = "SELECT * from CAMPION.MEMBER 
        where ID like ? or NAME like ? ";
    // or GENDER = ? or
    // ACCOUNT like ? or 
    // PHONE = ?
            
    
    $statement = getPDO()->prepare($sql); // 預載
    $statement->bindValue(1, '%'.$searchId.'%'); 
    $statement->bindValue(2, '%'.$searchName.'%'); 
    // $statement->bindValue(3, $searchGender); 
    // $statement->bindValue(4, '%'.$searchAccount.'%'); 
    // $statement->bindValue(5, $searchPhone); 
    $statement->execute(); // 執行

    $data = $statement->fetchAll();
    echo json_encode($data); // 打包成 json 格式

?>