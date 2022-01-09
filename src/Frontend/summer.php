<?php
    include('../Lib/Util.php'); 
    // include('./connection.php'); // 這是佩君的連線
    
    $sql = "select * from CAMPION.ITINERARY where CATEGORY = '夏令營'";    
    $statement = getPDO()->prepare($sql); // 預載
    // $statement->bindValue(1, '%'.$name.'%'); // (第n個?, 值 || 變數)
    $statement->execute(); // 執行

    $data = $statement->fetchAll();
    echo json_encode($data); // 打包成 json 格式

?>