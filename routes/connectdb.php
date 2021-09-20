<?php
    // session_start();
    
        $db["host"] = "103.2.115.246";
    $db["user"] = "root2";
    $db["pass"] = "67235520";
    $db["name"] = "new_smartfarm"; //"inet_mqtt_smart_farm"; //"smart_farm_mqtt";

    // $db["host"] = "203.150.37.144/";
    // $db["user"] = "root";
    // $db["pass"] = "67235520";
    // $db["name"] = "test_query_data"; 

    // new decc
    // $db["host"] = "203.150.37.144/";
    // $db["user"] = "root";
    // $db["pass"] = "";
    // $db["name"] = "smart_farm_mqtt";
    try{
        $dbcon = new PDO( "mysql:host=".$db["host"]."; dbname=".$db["name"]."", $db["user"], $db["pass"],
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ));
    }catch(PDOException $ex){
        echo $ex->getMessage();
    }

    //วันที่
    date_default_timezone_set('Asia/Bangkok');
    $today_date=date("d-m-Y");
    $day_date=date("Y/m/d");
    $today_time=date("H:i");
    
    
    



    // https://smartgreenhouse.fuji-innovation.com/Config/HW_insertData.php?sn=1&date=2&time=3&DataST1_1=4&DataST1_2=5&DataST1_3=6&DataST1_4=7&DataST2_1=8&DataST2_2=9&DataST2_3=10&DataST2_4=11&DataST3_1=12&DataST3_2=13&DataST3_3=14&DataST3_4=15&DataST4_1=16&DataST4_2=17&DataST4_3=18&DataST4_4=19&Control01=20&Control02=21&Control03=21&Control04=22