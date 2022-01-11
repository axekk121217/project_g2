<?php
    include "../Lib/Member.php";
    include "../Lib/Util.php";
    $ACCOUNT = isset($_POST["ACCOUNT"]) ? $_POST["ACCOUNT"] : "";
    $NAME = isset($_POST["NAME"]) ? $_POST["NAME"] : "";
    $PHONE = isset($_POST["PHONE"]) ? $_POST["PHONE"]:""; 
    $GENDER = isset($_POST["GENDER"]) ? $_POST["GENDER"]:""; 

    // 建立SQL
    if( $ACCOUNT != "" && $NAME != "" && $PHONE != "" && $GENDER != "") {
        $sql_memberNewData = "UPDATE MEMBER SET  `NAME` = ?, PHONE = ?, GENDER = ?, CREATION_DATE = NOW() WHERE ACCOUNT = ?";
        $statement = getPDO() -> prepare($sql_memberNewData);
        $statement -> bindValue(1, $NAME);
        $statement -> bindValue(2, $PHONE);
        $statement -> bindValue(3, $GENDER);
        $statement -> bindValue(4,  $ACCOUNT);
        $statement -> execute();
    }
    echo 'done';
?>