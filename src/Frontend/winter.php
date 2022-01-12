<?php
    include('../Lib/Util.php'); 
    
    $sql = "select * from CAMPION.ITINERARY where CATEGORY = '冬令營' and STATUS = '上架' order by CREATE_DATE desc";    
    $statement = getPDO()->prepare($sql); // 預載
    // $statement->bindValue(1, '%'.$name.'%'); // (第n個?, 值 || 變數)
    $statement->execute(); // 執行

    $data = $statement->fetchAll();
    echo json_encode($data); // 打包成 json 格式

?>