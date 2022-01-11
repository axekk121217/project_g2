<?php        	
	include("../Lib/Member.php");
    include("../Lib/Util.php");

    //取得購物車商品--------------------------------------------
    
    //建立SQL
    $sql = "SELECT SHOPPING_CART.ID, 
                SHOPPING_CART.MEMBER_ID, 
                SHOPPING_CART.ITINERARY_ID,
                SHOPPING_CART.BATCH_ID,  
                SHOPPING_CART.ATTENDEES,
                ITINERARY.COUNTRY,
                ITINERARY.CITY,
                ITINERARY.NAME,
                ITINERARY.CONTEXT,
                ITINERARY.BATCH,
                ITINERARY.AGE, 
                ITINERARY.PRICE, 
                ITINERARY.IMG,
                BATCH.PARTICIPANTS,
                BATCH.START_DATE,
                BATCH.END_DATE
            FROM SHOPPING_CART
            JOIN ITINERARY ON SHOPPING_CART.ITINERARY_ID = ITINERARY.ID 
            JOIN BATCH ON SHOPPING_CART.BATCH_ID = BATCH.ID
            where ITINERARY.STATUS = '上架' and SHOPPING_CART.STATUS = 1 and SHOPPING_CART.MEMBER_ID = ? order by SHOPPING_CART.ID";
        
    //執行
    $statement = getPDO()->prepare($sql);
    $statement->bindValue(1 , getMemberID()); 
    $statement->execute();
    $data = $statement->fetchAll();

    //回傳json
    echo json_encode($data); 
?>