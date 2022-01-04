<?php
include "../Lib/Member.php";

//顯示會員資訊
$str = getMemberName();
echo $str == "" ? '<a href="member_signIn.html"><i class="fas fa-user-circle guest_icon" id="showMember"></i></a>' : '<a href="member.html" class="member_icons"><i class="fas fa-user-circle" id="showMember" style="color: #FCB629;"></i></a>';

?>