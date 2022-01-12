<?php
    // if (isset($_POST['outputData'])) {
    //     $dataFormat = json_decode($_POST['outputData'], true);
    //     print_r($dataFormat['name']);
    // }
    // $json_data = json_decode(file_get_contents('php://input'));
    $name = $_POST["name"];
    $context = $_POST["context"];
    $category = $_POST["category"];
    $theme = $_POST["theme"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $img = $_POST["img"];
    $age = $_POST["age"];
    $price = $_POST["price"];
    $batch = $_POST["batch"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $status = $_POST["status"];
    $item_ID = $_POST["item_ID"];


    //------------------------ 連線DB，將資料更新至資料庫 ------------------------
    include('../Lib/Util.php'); 

    // // 新增各欄位行程資訊至資料庫
    $sql = "UPDATE CAMPION.ITINERARY 
        SET 
            NAME = ?, 
            CONTEXT = ?, 
            CATEGORY = ?, 
            THEME = ?, 
            COUNTRY = ?, 
            CITY = ?, 
            AGE = ?, 
            PRICE = ?, 
            BATCH = ?, 
            START_DATE = ?, 
            END_DATE = ?,
            IMG = ?,
            STATUS = ?, 
            UPDATE_DATE = NOW() 
        WHERE ID = ?";
  
    $statement = getPDO()->prepare($sql);
    $statement->bindValue(1, $name);
    $statement->bindValue(2, $context);
    $statement->bindValue(3, $category);
    $statement->bindValue(4, $theme);
    $statement->bindValue(5, $country);
    $statement->bindValue(6, $city);
    $statement->bindValue(7, $age);
    $statement->bindValue(8, $price);
    $statement->bindValue(9, $batch);
    $statement->bindValue(10, $start_date);
    $statement->bindValue(11, $end_date);
    $statement->bindValue(12, $img);
    $statement->bindValue(13, $status);
    $statement->bindValue(14, $item_ID);
    $statement->execute();
    echo '更新成功!';

  

?>