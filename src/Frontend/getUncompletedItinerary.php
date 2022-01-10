<?php 

    // 在會員專區顯示尚未評論行程
    
    include("../Lib/Util.php");
    
    $account = $_GET["account"];

    $member = getMemberByAccount($account);

    $uncompleted_itinerary = getUncompletedItinerary($member["ID"]);

    //回傳json
    echo json_encode($uncompleted_itinerary);

    //取得用戶未評論行程
    function getUncompletedItinerary($member_id){
        $uncompleted_itinerary_sql = "
        SELECT 
            ITINERARY.ID,
            ITINERARY.`NAME` as 'NAME',
            ITINERARY.IMG as 'IMG',
            BATCH.START_DATE,
            BATCH.END_DATE,
            COUNTRY.`NAME` as 'COUNTRY',
            CITY.`NAME` as 'CITY',
            ITINERARY.PRICE,
            ORDER_DETAILS.ATTENDEES
        FROM
            `ORDER`
                JOIN
            ORDER_DETAILS ON ORDER_DETAILS.ORDER_ID = `ORDER`.ID
                JOIN
            BATCH ON ORDER_DETAILS.BATCH_ID = BATCH.ID
                JOIN
            ITINERARY ON BATCH.ITINERARY_ID = ITINERARY.ID
            JOIN 
            CITY ON ITINERARY.CITY = CITY.ID
            JOIN COUNTRY ON ITINERARY.COUNTRY = COUNTRY.ID
        WHERE
            BATCH.END_DATE <= NOW()
                AND BATCH.ITINERARY_ID NOT IN (SELECT 
                    ITINERARY_ID
                FROM
                    EVALUATION
                WHERE
                    MEMBER_ID = ?)";

    $statement = getDatabase()->prepare($uncompleted_itinerary_sql);
    $statement->bindValue(1 , $member_id);
    $statement->execute();
    $data = $statement->fetchAll();

    return $data;
    }
?>