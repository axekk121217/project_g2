<?php
include('../Lib/Util.php'); 

$ID = $_GET['product_NAME'];
$number = json_decode($ID);

$sql = "SELECT * FROM ITINERARY WHERE `ID` = ?";
$statement = getPDO() -> prepare($sql);
$statement -> bindValue(1, $number);
$statement -> execute();
$data = $statement -> fetchAll();
echo json_encode($data);


?>