<?php
    include "../Lib/Util.php";
    include "../Lib/Member.php";

   // ------------------------ 更新 MEMBER 資料庫 PICTURE 欄位 ------------------------
   $PICTURE = $_POST["PICTURE"];
   $ID = getMemberID();
   $sql = "UPDATE CAMPION.MEMBER 
        SET 
            PICTURE = ?
        WHERE ID = ?";
  
    $statement = getPDO()->prepare($sql);
    $statement->bindValue(1, $PICTURE);
    $statement->bindValue(2, $ID);
    $statement->execute();

   
?>