<?php    
    include("../Lib/Util.php");

    $status = $_POST["status"];
    $memberID = $_POST["memberID"];

    //建立SQL
    $sql = "UPDATE MEMBER SET ACCOUNT_STATE = '$status' WHERE ID = $memberID";

    //執行
    $statement = getPDO()->prepare($sql);
    $statement->execute();
    $data = $statement->fetchAll();

    //執行
    // $pdo->exec($sql);

    //回傳json
    // echo json_encode($data);
?>