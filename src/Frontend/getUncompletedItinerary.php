<?php 

    // 在會員專區顯示尚未評論行程
    include("../Lib/Util.php");
    include("../Lib/Member.php");
    
    $id = getMemberName();

    $uncompleted_itinerary = getUncompletedItinerary($id);

    //回傳json
    echo json_encode($uncompleted_itinerary);

    //取得用戶未評論行程
    function getUncompletedItinerary($member_id){
        $uncompleted_itinerary_sql = "
        SELECT 
        ITINERARY.ID,
        ITINERARY.`NAME` as 'NAME',
        ITINERARY.IMG as 'IMG',
        ITINERARY.START_DATE,
        ITINERARY.END_DATE,
        ITINERARY.COUNTRY,
        ITINERARY.CITY,
        ITINERARY.PRICE,
        ORDER_DETAILS.ATTENDEES
    FROM
        `ORDER`
            JOIN
        ORDER_DETAILS ON ORDER_DETAILS.ORDER_ID = `ORDER`.ID
            JOIN
        ITINERARY ON ORDER_DETAILS.ITINERARY_ID = ITINERARY.ID
    WHERE
        ITINERARY.END_DATE <= NOW()
            AND ITINERARY.ID NOT IN (SELECT 
                ITINERARY_ID
            FROM
                EVALUATION
            WHERE
                MEMBER_ID = ?)";

    $statement = getPDO()->prepare($uncompleted_itinerary_sql);
    $statement->bindValue(1 , $member_id);
    $statement->execute();
    $data = $statement->fetchAll();

    return $data;
    }
?>