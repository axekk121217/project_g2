<?php
    $name = $_POST[""];
    $context = $_POST[""];
    $category = $_POST[""];
    $theme = $_POST[""];
    $country = $_POST[""];
    $city = $_POST[""];
    $age = $_POST[""];
    $img = $_POST[""];
    $price = $_POST[""];
    $batch = $_POST[""];
    $start_date = $_POST[""];
    $end_date = $_POST[""];

    // 連線資料庫
    include('../Lib/Util.php'); 
    // include('./connection.php'); // 這是佩君的連線

    // 新增各欄位行程資訊至資料庫
    $sql = "INSERT INTO CAMPIOM.ITINERARY(NAME, CONTEXT, CATEGORY, THEME, COUNTRY, CITY, AGE, IMG, PRICE, BATCH, START_STATE, END_DATE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $statement = getPDO()->prepare($sql);
    $statement->bindValue(1, $name);
    $statement->bindValue(2, $context);
    $statement->bindValue(3, $category);
    $statement->bindValue(4, $theme);
    $statement->bindValue(5, $country);
    $statement->bindValue(6, $city);
    $statement->bindValue(7, $age);
    $statement->bindValue(8, $img);
    $statement->bindValue(9, $price);
    $statement->bindValue(10, $batch);
    $statement->bindValue(11, $start_date);
    $statement->bindValue(12, $end_date);
    $statement->execute();

    // redirect 轉址
    header("Location: Select.php");
    

    // echo json_encode($data); // 打包成 json 格式

    // 1. 先看檔案陣列裡面有什麼
    // print_r($_FILES["file"]); // "" 中間放 input[type="file] 的 name
    // exit(); // 跳出；離開，以下程式碼中斷不執行

    // output:
    // Array ( 
        // [name] => gourmet.jpg 
        // [type] => image/jpeg 
        // [tmp_name] => C:\xampp\tmp\php2244.tmp // 暫存路徑
        // [error] => 0 // 大於 0 為上傳失敗
        // [size] => 2819349 // 檔案大小
        // )
    
    // 通常在上傳到暫存區（暫存區的檔案名稱沒有副檔名） > 到存放的新位置時會將檔案改名

    //=======================================================

    // 2. 判斷是否上傳成功
    if($_FILES["file"]["error"] > 0){ // 陣列
        echo "上傳失敗: 錯誤代碼".$_FILES["file"]["error"];
    }else{
        //取得上傳的檔案資訊=======================================
        $fileName = $_FILES["file"]["name"];    //檔案名稱含副檔名（二維陣列）        
        $filePath_Temp = $_FILES["file"]["tmp_name"];   //Server上的暫存檔路徑含檔名        
        $fileType = $_FILES["file"]["type"];    //檔案種類        
        $fileSize = $_FILES["file"]["size"];    //檔案尺寸
        //=======================================================

    // 3. 開始組裝：（針對需求自行修改的地方）

        //Web根目錄真實路徑（htdocs） // 要放在 Web root 下面!!! 才能以網址的形式被瀏覽
        //不把路徑寫死，因為不同系統（windows / MacOS）的檔案存放相對路徑不同
        $ServerRoot = $_SERVER["DOCUMENT_ROOT"]; // 使用 php 內建的 $_SERVER 變數
        
        // ********* 檔案最終存放位置 ********* 
        // 把 $fileName 寫進資料庫
        $filePath = $ServerRoot."/FileUpload/".$fileName;
  
        //先判斷檔案格式是否正確
        //再將暫存檔搬移到正確位置
        if(getExtensionName($filePath) == 'jpg' || getExtensionName($filePath) == 'png'){
            move_uploaded_file($filePath_Temp, $filePath); // (檔案原本的位置, 要搬移到哪裡)
            
            //顯示檔案資訊
            echo "檔案存放位置：".$filePath;
            echo "<br/>";
            echo "類型：".$fileType;
            echo "<br/>";
            echo "大小：".$fileSize;
            echo "<br/>";
            echo "副檔名：".getExtensionName($filePath);
            echo "<br/>";
            echo "<img style='width: 600' src='/FileUpload/".$fileName."'/>";
        }else{
            echo '檔案格式錯誤，請重新上傳';
            echo '<br>';
            // 但檔案還是會上傳到伺服器的暫存區！apache 定期會清除暫存檔（如果沒有用到的話）
        }

    }

    //取得檔案副檔名：前後端 double check 雙保險：上傳檔案格式是否合乎規定（前端也要先驗證阻擋！）
    function getExtensionName($filePath){
        $path_parts = pathinfo($filePath);
        return $path_parts["extension"];
    }

    // pathinfo_dirname   //完整路徑
    // pathinfo_basename  //完整檔名
    // pathinfo_extension //副檔名
    // pathinfo_filename  //檔名

?>