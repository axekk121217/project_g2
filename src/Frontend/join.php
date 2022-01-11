<?php
include "../Lib/Util.php";

//建立SQL
<<<<<<< HEAD
$sql = "INSERT INTO MEMBER(EMAIL, PASSWORD, NAME, PICTURE, PHONE, CREATION_DATE, EMAIL_STATE, GENDER) VALUES (?, ?, ?, 1, ?, now(), '正常', ?)";
=======
$sql = "INSERT INTO MEMBER(ACCOUNT, PASSWORD, NAME, PICTURE, PHONE, CREATION_DATE, ACCOUNT_STATE, GENDER) VALUES (?, ?, ?, './images/admin/logo.png', ?, now(), '正常', ?)";
>>>>>>> 4e27ce13e39c2242a8e0f14f744e446aee48e629

//執行
$statement = getPDO()->prepare($sql);

//給值
$statement->bindValue(1, $_POST["EMAIL"]);
$statement->bindValue(2, $_POST["PASSWORD"]);
$statement->bindValue(3, $_POST["NAME"]);
$statement->bindValue(4, $_POST["PHONE"]);
$statement->bindValue(5, $_POST["GENDER"]);
$statement->execute();

echo "<script>alert('加入成功，請重新登入!'); location.href = '../member_signIn.html';</script>";
?>