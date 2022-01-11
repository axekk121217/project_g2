<?php
include('../Lib/Util.php'); 

$ID = $_GET['product_NAME'];
$NAME = json_decode($ID);

$sql = "SELECT * FROM ITINERARY WHERE `NAME` = ?";
$statement = getPDO() -> prepare($sql);
$statement -> bindValue(1, $NAME);
$statement -> execute();
$data = $statement -> fetchAll();
echo json_encode($data);


?>