<?php
session_start();
require "connectdb.php";
$house_master = $_POST["house_master"];
$ch_value = $_POST["ch_value"];
$sel_all_every = $_POST["sel_all_every"];
if ($_POST["mode"] == 'day') {
    $start_day = date("Y/m/d - H:i:s", strtotime('-1 day'));
    $stop_day = date("Y/m/d - H:i:s");
 } else if ($_POST["mode"] == 'week') {
    $start_day = date("Y/m/d - H:i:s", strtotime('-7 day'));
    $stop_day = date("Y/m/d - H:i:s");
 } else if ($_POST["mode"] == 'month') {
    $start_day = date("Y/m/d - H:i:s", strtotime('-30 day'));
    $stop_day = date("Y/m/d - H:i:s");
 } else if ($_POST["mode"] == 'from_to') {
    $start_day = $_POST["val_start"].':00';
    $stop_day = $_POST["val_end"].':00';
 }
//  echo json_encode([
//       'house_master'=>$_POST["house_master"],
//       'status'=>$_POST["mode"],
//       // 'btn_status'=>$_POST["btn_status"],
//     //   'sel_all_every'=>$_POST["sel_all_every"],
//       '$start_day'=>$start_day,
//       '$stop_day'=>$stop_day]);
   $data_channel = [];
   for($i=0; $i < count($ch_value[3]); $i++){
      if ($ch_value[3][$i] == 4 || $ch_value[3][$i] == 5) {
         $data_channel[] = 'round('.$ch_value[1][$i].'/1000, 1) AS data_cn'.($i+1);
      } elseif ($ch_value[3][$i] == 6 || $ch_value[3][$i] == 7) {
         $data_channel[] = 'round('.$ch_value[1][$i].'/54, 1) AS data_cn'.($i+1);
      } else {
         $data_channel[] = 'round('.$ch_value[1][$i].', 1) AS data_cn'.($i+1);
      }
   }
   // echo json_encode($data_channel);
   $sting_channrl = implode(", ",$data_channel);
   // echo $sting_channrl;
   // echo count($ch_value[1]);
   // echo $ch_value[3][0];
   // exit();
// echo $a;
$sql = "SELECT data_timestamp AS timestamp, $sting_channrl
FROM tb_data_sensor WHERE data_sn = '$house_master' AND data_timestamp BETWEEN '$start_day' AND '$stop_day' AND mod(minute(`data_time`),'$sel_all_every') = 0
               ORDER BY data_timestamp ";
   // $stmt = $dbcon->query($sql)->fetch();
   // foreach ($dbcon->query($sql) as $row) {
      // print $row['name'] . "\t";
      // print $row['color'] . "\t";
      // print $row['calories'] . "\n";
//   }
$stmt = $dbcon->query($sql);
$data0 = [];
$j=count($ch_value[3]);
while ($row = $stmt->fetch()) {
   //  echo $row['name']."<br />\n";
   // $data0["count"] = $j;
   $data0["timestamp"][] = substr($row[0], 0 ,18);
   $data0["data_1"][] = $row[1];
   if($j >= 2){$data0["data_2"][] = $row[2];}
   if($j >= 3){$data0["data_3"][] = $row[3];}
   if($j >= 4){$data0["data_4"][] = $row[4];}
   if($j >= 5){$data0["data_5"][] = $row[5];}
   if($j >= 6){$data0["data_6"][] = $row[6];}
   if($j >= 7){$data0["data_7"][] = $row[7];}
   if($j >= 8){$data0["data_8"][] = $row[8];}
   if($j >= 9){$data0["data_9"][] = $row[9];}
   if($j >= 10){$data0["data_10"][] = $row[10];}
   if($j >= 11){$data0["data_11"][] = $row[11];}
   if($j >= 12){$data0["data_12"][] = $row[12];}
   if($j >= 13){$data0["data_13"][] = $row[13];}
   if($j >= 14){$data0["data_14"][] = $row[14];}
   if($j >= 15){$data0["data_15"][] = $row[15];}
   if($j >= 16){$data0["data_16"][] = $row[16];}
   if($j >= 17){$data0["data_17"][] = $row[17];}
   if($j >= 18){$data0["data_18"][] = $row[18];}
   if($j >= 19){$data0["data_19"][] = $row[19];}
   if($j >= 20){$data0["data_20"][] = $row[20];}
   if($j >= 21){$data0["data_21"][] = $row[21];}
   if($j >= 22){$data0["data_22"][] = $row[22];}
   if($j >= 23){$data0["data_23"][] = $row[23];}
   if($j >= 24){$data0["data_24"][] = $row[24];}
   if($j >= 25){$data0["data_25"][] = $row[25];}
   if($j >= 26){$data0["data_26"][] = $row[26];}
   if($j >= 27){$data0["data_27"][] = $row[27];}
   if($j >= 28){$data0["data_28"][] = $row[28];}
   if($j >= 29){$data0["data_29"][] = $row[29];}
   if($j >= 30){$data0["data_30"][] = $row[30];}
   if($j >= 31){$data0["data_31"][] = $row[31];}
   if($j >= 32){$data0["data_32"][] = $row[32];}
   if($j >= 33){$data0["data_33"][] = $row[33];}
   if($j >= 34){$data0["data_34"][] = $row[34];}
   if($j >= 35){$data0["data_35"][] = $row[35];}
   if($j >= 36){$data0["data_36"][] = $row[36];}
   if($j >= 37){$data0["data_37"][] = $row[37];}
   if($j >= 38){$data0["data_38"][] = $row[38];}
   if($j >= 39){$data0["data_39"][] = $row[39];}
   if($j >= 40){$data0["data_40"][] = $row[40];}
   // $data0[] = $row;
}

   echo json_encode(['data'=>$data0,'theme'=>$_SESSION["login_theme"]]);