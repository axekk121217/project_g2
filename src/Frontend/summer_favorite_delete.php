<?php 
include "../Lib/Util.php";

 // 操作從ajax傳過來的值
 $item_name = $_POST["name"];

//建立SQL--刪除
// $sql = "DELETE FROM favorite WHERE product_name = ? AND account = ?";
$sql = "DELETE FROM ITINERARY_LIKE WHERE ID = ?";

// 執行刪除
$statement = getPDO()->prepare($sql);
//給值
$statement->bindValue(1 , $item_name);             
$statement->bindValue(2 , $account);
$statement->execute();

?>