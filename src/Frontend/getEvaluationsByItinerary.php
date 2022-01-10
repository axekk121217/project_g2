<?php 

    // 抓到針對當前頁面行程的評論 (塞在單頁行程頁下方)

    include("../Lib/Util.php");
    
    $itineraryId = $_GET["itineraryId"];

    $sql = "
    SELECT 
        `MEMBER`.`NAME`,
        `MEMBER`.PICTURE,
        EVALUATION.STAR,
        EVALUATION.CONTENT
    FROM
        EVALUATION
            JOIN
        `MEMBER` ON EVALUATION.MEMBER_ID = `MEMBER`.ID
    WHERE
        ITINERARY_ID = ?
    ORDER BY EVALUATION.ID DESC";

    //執行
    $statement = getPDO()->prepare($sql);
    $statement->bindValue(1 , $itineraryId);
    $statement->execute();
    $data = $statement->fetchAll();

    //回傳json
    echo json_encode($data)
?>