<?php
include "../Lib/Member.php";

//顯示會員資訊
$str = getMemberName();
echo $str == "" ? '<a href="member_signIn.html"><i class="fas fa-user-circle guest_icon" id="showMember"></i></a>' : '<a href="member.html" class="member_icons"><i class="fas fa-user-circle" id="showMember" style="color: #FCB629;"></i></a>';


// $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

// $dataMember = [];

// include "../Lib/Util.php";
// $PDO = getPDO();

// if($keyword != "") {
//     $SQLMember = "SELECT * FROM MEMBER WHERE ACCOUNT = '$keyword'";
// }

// $statement = $PDO-> prepare($SQLMember);
// $statement -> execute();
// $dataMember = $statement -> fetchAll();



?>