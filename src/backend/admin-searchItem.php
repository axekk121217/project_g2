<?php
    $searchId = $_POST['searchId'];
    $searchName = $_POST['searchName'];
    $searchCountry = $_POST['searchName'];
    $searchCity = $_POST['searchName'];
    $searchCategory = $_POST['searchName'];

    include('../Lib/Util.php'); 
    
    $sql = "select * from CAMPION.ITINERARY
        where 
            ID = ? or
            NAME like ? or
            COUNTRY = ? or
            CITY = ? or 
            CATEGORY = ?
           

    ";    
    $statement = getPDO()->prepare($sql); // 預載
    $statement->bindValue(1, $searchId); 
    $statement->bindValue(2, '%'.$searchName.'%'); 
    $statement->bindValue(3, $searchCountry); 
    $statement->bindValue(4, $searchCity); 
    $statement->bindValue(5, $searchCategory); 
    $statement->execute(); // 執行

    $data = $statement->fetchAll();
    echo json_encode($data); // 打包成 json 格式

?>