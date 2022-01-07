<?php

    // ---------- 使用函數的目的：在同一支 php 程式裡連線不同的資料庫 ----------
    // 透過參數 $env，在函式中使用 switch 語法，針對不同 case 建立不同的連線資料
    // 呼叫 getConn() 時，再代入不同的 $env 參數，決定連線資料
    function getPDO(){
        
        //MySQL相關資訊
        $db_host = "127.0.0.1";
        $db_user = "root";
        $db_pass = "Didy0915";
        $db_select = "pdo";
    
        //建立資料庫連線物件
        $dsn = "mysql:host=".$db_host.";dbname=".$db_select;
    
        //建立PDO物件，並放入指定的相關資料
        $pdo = new PDO($dsn, $db_user, $db_pass);
        return $pdo;

    }


?>