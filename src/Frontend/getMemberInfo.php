<?php
    include "../Lib/Util.php";
    include "../Lib/Member.php";

    $memberID = getMemberID();

    //建立SQL
    $sql = "SELECT * FROM MEMBER WHERE ID = ?";

    //給值
    $statement = getPDO()->prepare($sql);
    $statement->bindValue(1, $memberID);
    $statement->execute();
    $data = $statement->fetchAll();
    //回傳json
    
    echo json_encode($data);
    
?>