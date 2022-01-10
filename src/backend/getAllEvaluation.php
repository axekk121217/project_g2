<?php 

    // 拿到該會員所有行程評論(EVALUATION)，最新的在最上面(顯示在後臺)

    include("../Lib/Util.php");
    
    $sql = "SELECT EVALUATION.ID,ITINERARY_ID,MEMBER_ID,STAR,CONTENT,`DATE`,`NAME`,IS_VISIBLE FROM EVALUATION
    JOIN ITINERARY ON ITINERARY.ID = EVALUATION.ITINERARY_ID ORDER BY EVALUATION.ID DESC;";

    //執行
    $statement = getPDO()->prepare($sql);
    $statement->execute();
    $data = $statement->fetchAll();

    //回傳json
    echo json_encode($data)
?>