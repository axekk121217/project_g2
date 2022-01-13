<?php

    $orderID = $_POST['OID']; // 取得訂單編號

    include('../Lib/Util.php'); 
    
    $sql = "
        select 
            o.ID OID, #訂單編號
            ord.ODID, #訂單明細編號
            ord.ITINERARY_ID, #行程編號
            i.INAME,
            i.PRICE,
            ord.ATTENDEES, #各行程參與人數
            (i.PRICE * ord.ATTENDEES) TOTAL #總金額
        from CAMPION.ORDER o
        -- join ORDER_DETAILS
        join
            (select 
                ID ODID, ORDER_ID, ITINERARY_ID, ATTENDEES
            from ORDER_DETAILS
            group by ODID, ORDER_ID, ITINERARY_ID, ATTENDEES) ord
        on o.ID = ord.ORDER_ID
        -- join CAMPION.ITINERARY
        join
            (select 
                ID, NAME INAME, PRICE
            from ITINERARY) i
        on i.ID = ord.ITINERARY_ID
        #order by OID
        where o.ID = ?
        ;
    ";
    $statement = getPDO()->prepare($sql); // 預載
    $statement->bindValue(1, $orderID); // (第n個?, 值 || 變數)
    $statement->execute(); // 執行

    $data = $statement->fetchAll();
    echo json_encode($data); // 打包成 json 格式

?>