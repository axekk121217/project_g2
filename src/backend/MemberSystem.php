<?php    
    include("../Lib/Util.php");

    //建立SQL
    $sql = "SELECT * FROM MEMBER WHERE ID > 1 ORDER BY ID";
    //執行
    $statement = getPDO()->prepare($sql);
    $statement->execute();
    $data = $statement->fetchAll();

    //回傳json
    echo json_encode($data);
?>