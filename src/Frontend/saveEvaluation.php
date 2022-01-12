<?php 
    // 會員發佈評論
    include("../Lib/Util.php");
    include("../Lib/Member.php");
    
    // 取得必要參數
    $account = getMemberName();
    $itineraryId = $_POST["itineraryId"];
    $star = $_POST["star"];
    $content = $_POST["content"];

    $member = getMemberByAccount($account);

    $insertSql = "INSERT INTO `CAMPION`.`EVALUATION` (`ITINERARY_ID`, `MEMBER_ID`, `STAR`, `CONTENT`,`DATE`) VALUES (?,?,?,?,NOW());";

    //執行
    $statement = getPDO()->prepare($insertSql);
    $statement->bindValue(1 , $itineraryId);
    $statement->bindValue(2 , $member["ID"]);
    $statement->bindValue(3 , $star);
    $statement->bindValue(4 , $content);
    $statement->execute();
    $data = $statement->fetchAll();

    //回傳json
    echo "<script>alert('發佈成功!'); location.href = '../member.html';</script>";
?>