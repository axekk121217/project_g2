<?php
    $item_ID = $_POST["item_ID"];
    $name = $_POST["name"];
    $context = $_POST["context"];
    $category = $_POST["category"];
    $theme = $_POST["theme"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $age = $_POST["age"];
    $batch = $_POST["batch"];
    $price = $_POST["price"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $img = $_POST["img"];
    $status = $_POST["status"];
    
    // 連線資料庫
    include('../Lib/Util.php'); 

    // 新增各欄位行程資訊至資料庫
    $sql = "INSERT INTO CAMPION.ITINERARY(
        ID, 
        NAME, 
        CONTEXT, 
        CATEGORY, 
        THEME, 
        COUNTRY, 
        CITY, 
        AGE, 
        IMG, 
        PRICE, 
        BATCH, 
        START_DATE, 
        END_DATE,
        STATUS,
        CREATE_DATE) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $statement = getPDO()->prepare($sql);
    $statement->bindValue(1, $item_ID);
    $statement->bindValue(2, $name);
    $statement->bindValue(3, $context);
    $statement->bindValue(4, $category);
    $statement->bindValue(5, $theme);
    $statement->bindValue(6, $country);
    $statement->bindValue(7, $city);
    $statement->bindValue(8, $age);
    $statement->bindValue(9, $img);
    $statement->bindValue(10, $price);
    $statement->bindValue(11, $batch);
    $statement->bindValue(12, $start_date);
    $statement->bindValue(13, $end_date);
    $statement->bindValue(14, $status);
    $statement->execute();
    
?>