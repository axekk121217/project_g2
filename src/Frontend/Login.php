<?php
include "../Lib/Util.php";

//建立SQL
$sql = "SELECT * FROM MEMBER WHERE ID > 2 and ACCOUNT = ? and PASSWORD = ?";

//給值
$statement = getPDO()->prepare($sql);
$statement->bindValue(1, $_POST["ACCOUNT"]);
$statement->bindValue(2, $_POST["PASSWORD"]);
$statement->execute();
$data = $statement->fetchAll();

$memberID = "";
$memberName = "";
foreach ($data as $index => $row) {
    $memberID = $row["ID"];
    $memberName = $row["ACCOUNT"];
}

//判斷是否有會員資料?
if ($memberID != "" && $memberName != "") {

    include "../Lib/Member.php";

    //將會員資訊寫入session
    setMemberInfo($memberID, $memberName);

    //導回產品頁
    echo "<script>alert('登入成功!'); location.href = '../member.html';</script>";
    echo ('Correct');

} else {

    //跳出提示停留在登入頁
    echo "<script>alert('帳號或密碼錯誤!'); location.href = '../member_signIn.html';</script>";

}
