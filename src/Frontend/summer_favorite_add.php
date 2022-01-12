<?php
include "../Lib/Util.php";
include "../Lib/Member.php";

$memberID = getMemberName();
$ITINERARY_NUMBER = $_POST['ITINERARY_NUMBER'];

// 建立SQL
$sql = "SELECT * FROM ITINERARY_LIKE WHERE ITINERARY_NUMBER = ?";
$statement = getPDO() -> prepare($sql);
$statement-> bindValue(1, $ITINERARY_NUMBER);
$statement-> execute();
$data = $statement -> fetchAll();

if($data) {
  echo "done";
} else {
  $sql_insert = "INSERT INTO ITINERARY_LIKE(ITINERARY_NUMBER, MEMBER_ID) VALUES (?, ?)";
  $statement_insert = getPDO()->prepare($sql_insert);
  $statement_insert->bindValue(1, $ITINERARY_NUMBER);
  $statement_insert->bindValue(2, $memberID);
  $statement_insert->execute();
}
//建立SQL--新增
