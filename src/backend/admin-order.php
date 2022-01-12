<?php
    include('../Lib/Util.php'); 
    
    $sql = "
        select 
            o.ID OID, #訂單編號
            m.MID, #會員編號 
            m.MNAME, #會員姓名
            m.EMAIL, #會員信箱
            m.PHONE, #會員電話
            
            o.PAY_CHOOSE, #付款方式
            o.PAY_STATE, #付款狀態
            o.ORDER_DATE, #付款日期
            o.ORDER_STATE, #訂單狀態
            o.ATM_ACCOUNT, #轉帳後五碼
            o.CANCEL_STATUS, #取消狀態
            o.PAY_DATE, #付款日期

            ord.ODID, #訂單明細編號
            ord.ITINERARY_ID, #行程編號
            i.INAME,
            i.PRICE,
            ord.ATTENDEES, #各行程參與人數
            (i.PRICE * ord.ATTENDEES) TOTAL #總金額
        from CAMPION.ORDER o
        -- join MEMBER
        join
            (select 
                ID MID, NAME MNAME, EMAIL, PHONE
            from MEMBER) m
        on o.MEMBER_ID = m.MID
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
        ;
    ";
    $statement = getPDO()->prepare($sql); // 預載
    // $statement->bindValue(1, '%'.$name.'%'); // (第n個?, 值 || 變數)
    $statement->execute(); // 執行

    $data = $statement->fetchAll();
    echo json_encode($data); // 打包成 json 格式

?>