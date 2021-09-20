<?php
    session_start();
    require "connectdb.php";
    $house_master = $_POST["house_master"];
    $start_day = date("Y/m/d - H:i:s", strtotime('-1 day'));//'-6 hour'));
    $stop_day = date("Y/m/d - H:i:s");
    $channel = implode(", ", $_POST["array_realCh"]);
    // for($i = 1; $i <= count($_POST["array_realCh"]); $i++){
    //     $channel[] = 'round('.$_POST['array_realCh'][($i-1)].', 1) AS new_'.$i.')';
    // }
    // echo json_encode([$_POST["array_realCh"],$_POST["array_realname"],$channel]);

    $sql = "SELECT data_timestamp, $channel FROM tb_data_sensor WHERE data_sn = '$house_master' AND data_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY data_timestamp ";
    $stmt = $dbcon->query($sql);
    $data0 = [];
    while ($row = $stmt->fetch()) {
       //  echo $row['name']."<br />\n";
       // $data0["count"] = $j;
       $data0[] = $row;
      
    }
    
       echo json_encode([
         'data'=>$data0,
         'theme' => $_SESSION["login_theme"]
      ]);