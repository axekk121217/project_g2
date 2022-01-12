<?php
    include "../Lib/Util.php";
    include "../Lib/Member.php";

    $memberID = getMemberName();
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];

    $sql = "SELECT `PASSWORD` FROM MEMBER WHERE ID = ?";
    $statement = getPDO()->prepare($sql);
    $statement -> bindValue(1, $memberID);
    $statement -> execute();
    $data = $statement -> fetchAll();
    echo json_encode($data);

    if($data[0][0] == $oldPassword) {
        $sql_Updatepassword = "UPDATE MEMBER SET `PASSWORD` = ? WHERE ID = ?";
        $statement = getPDO() -> prepare($sql_Updatepassword);
        $statement -> bindValue(1, $newPassword);
        $statement -> bindValue(2, $memberID);
        $statement -> execute();
    }
    echo "ok";
?>