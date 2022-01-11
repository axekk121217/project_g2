<?php

include('../Lib/Util.php'); 
include "../Lib/Member.php";

$memberID = getMemberName();
$ITUNERARYID = $_POST['ITUNERARYID'];
$getID = json_decode($ITUNERARYID);
$name = $_POST['name'];

$sql = "INSERT INTO `SHOPPING_CART`(`MEMBER_ID`,`ITINERARY_ID`,`BATCH_ID`,`ATTENDEES`,`Status`,`CreateDate`) VALUES(?, ?, 1, ?, 1, CURDATE())";

$statement = getPDO()->prepare($sql);

$statement->bindValue(1, $memberID);
$statement->bindValue(2, $getID);
$statement->bindValue(3, $name);
$statement->execute();

echo 'ok';

?>