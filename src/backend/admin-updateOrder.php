<?php
    // if (isset($_POST['outputData'])) {
    //     $dataFormat = json_decode($_POST['outputData'], true);
    //     print_r($dataFormat['name']);
    // }
    // $json_data = json_decode(file_get_contents('php://input'));
    $orderId = $_POST["orderId"];
    $pay_choose = $_POST["pay_choose"];
    $atm_account = $_POST["atm_account"];
    $pay_date = $_POST["pay_date"];
    $pay_state = $_POST["pay_state"];
    $order_state = $_POST["order_state"];
    $cancel_status = $_POST["cancel_status"];


    //------------------------ 連線DB，將資料更新至資料庫 ------------------------
    include('../Lib/Util.php'); 

    // // 新增各欄位行程資訊至資料庫
    $sql = "UPDATE CAMPION.ORDER 
        SET 
            PAY_CHOOSE = ?, 
            ATM_ACCOUNT = ?, 
            PAY_DATE = ?, 
            PAY_STATE = ?, 
            ORDER_STATE = ?, 
            CANCEL_STATUS = ?
            
        WHERE ID = ?";
  
    $statement = getPDO()->prepare($sql);
    $statement->bindValue(1, $pay_choose);
    $statement->bindValue(2, $atm_account);
    $statement->bindValue(3, $pay_date);
    $statement->bindValue(4, $pay_state);
    $statement->bindValue(5, $order_state);
    $statement->bindValue(6, $cancel_status);
    $statement->bindValue(7, $orderId);
    $statement->execute();
    echo '更新成功!';

  

?>