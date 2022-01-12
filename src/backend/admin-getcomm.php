<?php

    include("../Lib/Util.php");

    $nowpage = $_POST["page"];

    //建立SQL
    $sql = ("SELECT * FROM MEMBER LIMIT ".(($nowpage-1)*10).",10;");
    // limit ".(0*10).",10;
    //執行
    $statement = getPDO()->prepare($sql);
    $statement->execute();
    $data = $statement->fetchAll();

    //回傳json
    echo json_encode($data);

?>