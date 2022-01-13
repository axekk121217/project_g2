<?php
include "../Lib/Util.php";

//建立SQL
<<<<<<< HEAD
$sql = "INSERT INTO MEMBER(ACCOUNT, PASSWORD, NAME, PICTURE, PHONE, CREATION_DATE, ACCOUNT_STATE, GENDER) VALUES (?, ?, ?, '', ?, now(), '正常', ?)";
=======
$sql = "INSERT INTO MEMBER(ACCOUNT, PASSWORD, NAME, PICTURE, PHONE, CREATION_DATE, ACCOUNT_STATE, GENDER) VALUES (?, ?, ?, './images/admin/logo.png', ?, CURDATE(), '正常', ?)";
>>>>>>> 2a29e82db4760ef771e23c5d7788f6273226c070

//執行
$statement = getPDO()->prepare($sql);

//給值
$statement->bindValue(1, $_POST["ACCOUNT"]);
$statement->bindValue(2, $_POST["PASSWORD"]);
$statement->bindValue(3, $_POST["NAME"]);
$statement->bindValue(4, $_POST["PHONE"]);
$statement->bindValue(5, $_POST["GENDER"]);
$statement->execute();

echo "<script>alert('加入成功，請重新登入!'); location.href = '../member_signIn.html';</script>";
?>