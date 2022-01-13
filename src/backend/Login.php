<?php
    include("../Lib/Util.php");

    //建立SQL
    $sql = "SELECT * FROM MEMBER WHERE ID = 1 and ACCOUNT = ? and password = ?";
    
    //執行
    $statement = getPDO()->prepare($sql);    
    $statement->bindValue(1, $_POST["account"]);
    $statement->bindValue(2, $_POST["password"]);
    $statement->execute();
    $data = $statement->fetchAll();

    //依資料筆數判斷是否為會員
    if(count($data) > 0){

        include("../Lib/Member.php");

        //將登入資訊寫入session
        setSessionB($_POST["account"]);

        //導回後台首頁
        echo "<script>alert('登入成功!'); location.href = '../admin_system.html';</script>";            
        // header("Location: ../admin_system.html");

    }else{

        //跳出提示停留在後台登入頁
        echo "<script>alert('帳號或密碼錯誤!'); location.href = '../admin.html';</script>"; 

    }
?>