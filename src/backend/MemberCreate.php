<?php    
    include("../Lib/Util.php");

    //取得POST過來的值
    $memberName = $_POST["account"]; // 會員名稱
    $Status = $_POST["Status"];   //狀態 0:刪除, 1:下架, 2:上架

    //建立SQL
    $sql = "INSERT INTO ec_category(Name, Status, CreateDate) VALUES (?,?,NOW())";
    
    //執行
    $statement = getPDO()->prepare($sql);
    $statement->bindValue(1 , $CateName); 
    $statement->bindValue(2 , $Status);
    $statement->execute();

    //導頁    
    echo "<script>alert('新增分類成功!'); location.href = '../Category.html';</script>";

?>