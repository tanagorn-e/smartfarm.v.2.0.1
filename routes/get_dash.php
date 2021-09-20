<?php
session_start();
require "connectdb.php";
$house_master = $_POST["house_master"];
// $channel = $_POST["channel"];
$row_s_master = $dbcon->query("SELECT * FROM tb2_house INNER JOIN tb2_site ON tb2_house.house_siteID = tb2_site.site_id WHERE house_master = '$house_master'")->fetch();
$row_2 = $dbcon->query("SELECT * FROM tb3_dashstatus WHERE dashstatus_sn = '$house_master'")->fetch();
$row_3 = $dbcon->query("SELECT * FROM tb3_dashname WHERE dashname_sn = '$house_master'")->fetch();
$row_4 = $dbcon->query("SELECT * FROM tb3_sncanel WHERE sncanel_sn = '$house_master'")->fetch();
$row_5 = $dbcon->query("SELECT * FROM tb3_statussn WHERE statussn_sn = '$house_master'")->fetch();

$dashStatus[1] = intval($row_2["dashstatus_1_1"]);
$dashStatus[2] = intval($row_2["dashstatus_1_2"]);
$dashStatus[3] = intval($row_2["dashstatus_1_3"]);
$dashStatus[4] = intval($row_2["dashstatus_1_4"]);
$dashStatus[5] = intval($row_2["dashstatus_2_1"]);
$dashStatus[6] = intval($row_2["dashstatus_2_2"]);
$dashStatus[7] = intval($row_2["dashstatus_2_3"]);
$dashStatus[8] = intval($row_2["dashstatus_2_4"]);
$dashStatus[9] = intval($row_2["dashstatus_3_1"]);
$dashStatus[10] = intval($row_2["dashstatus_3_2"]);
$dashStatus[11] = intval($row_2["dashstatus_3_3"]);
$dashStatus[12] = intval($row_2["dashstatus_3_4"]);
$dashStatus[13] = intval($row_2["dashstatus_4_1"]);
$dashStatus[14] = intval($row_2["dashstatus_4_2"]);
$dashStatus[15] = intval($row_2["dashstatus_4_3"]);
$dashStatus[16] = intval($row_2["dashstatus_4_4"]);
$dashStatus[17] = intval($row_2["dashstatus_5_1"]);
$dashStatus[18] = intval($row_2["dashstatus_5_2"]);
$dashStatus[19] = intval($row_2["dashstatus_5_3"]);
$dashStatus[20] = intval($row_2["dashstatus_5_4"]);
$dashStatus[21] = intval($row_2["dashstatus_6_1"]);
$dashStatus[22] = intval($row_2["dashstatus_6_2"]);
$dashStatus[23] = intval($row_2["dashstatus_6_3"]);
$dashStatus[24] = intval($row_2["dashstatus_6_4"]);
$dashStatus[25] = intval($row_2["dashstatus_7_1"]);
$dashStatus[26] = intval($row_2["dashstatus_7_2"]);
$dashStatus[27] = intval($row_2["dashstatus_7_3"]);
$dashStatus[28] = intval($row_2["dashstatus_7_4"]);
$dashStatus[29] = intval($row_2["dashstatus_8_1"]);
$dashStatus[30] = intval($row_2["dashstatus_8_2"]);
$dashStatus[31] = intval($row_2["dashstatus_8_3"]);
$dashStatus[32] = intval($row_2["dashstatus_8_4"]);
$dashStatus[33] = intval($row_2["dashstatus_9_1"]);
$dashStatus[34] = intval($row_2["dashstatus_9_2"]);
$dashStatus[35] = intval($row_2["dashstatus_9_3"]);
$dashStatus[36] = intval($row_2["dashstatus_9_4"]);
$dashStatus[37] = intval($row_2["dashstatus_10_1"]);
$dashStatus[38] = intval($row_2["dashstatus_10_2"]);
$dashStatus[39] = intval($row_2["dashstatus_10_3"]);
$dashStatus[40] = intval($row_2["dashstatus_10_4"]);

$dashName[1] = $row_3["dashname_1_1"];
$dashName[2] = $row_3["dashname_1_2"];
$dashName[3] = $row_3["dashname_1_3"];
$dashName[4] = $row_3["dashname_1_4"];
$dashName[5] = $row_3["dashname_2_1"];
$dashName[6] = $row_3["dashname_2_2"];
$dashName[7] = $row_3["dashname_2_3"];
$dashName[8] = $row_3["dashname_2_4"];
$dashName[9] = $row_3["dashname_3_1"];
$dashName[10] = $row_3["dashname_3_2"];
$dashName[11] = $row_3["dashname_3_3"];
$dashName[12] = $row_3["dashname_3_4"];
$dashName[13] = $row_3["dashname_4_1"];
$dashName[14] = $row_3["dashname_4_2"];
$dashName[15] = $row_3["dashname_4_3"];
$dashName[16] = $row_3["dashname_4_4"];
$dashName[17] = $row_3["dashname_5_1"];
$dashName[18] = $row_3["dashname_5_2"];
$dashName[19] = $row_3["dashname_5_3"];
$dashName[20] = $row_3["dashname_5_4"];
$dashName[21] = $row_3["dashname_6_1"];
$dashName[22] = $row_3["dashname_6_2"];
$dashName[23] = $row_3["dashname_6_3"];
$dashName[24] = $row_3["dashname_6_4"];
$dashName[25] = $row_3["dashname_7_1"];
$dashName[26] = $row_3["dashname_7_2"];
$dashName[27] = $row_3["dashname_7_3"];
$dashName[28] = $row_3["dashname_7_4"];
$dashName[29] = $row_3["dashname_8_1"];
$dashName[30] = $row_3["dashname_8_2"];
$dashName[31] = $row_3["dashname_8_3"];
$dashName[32] = $row_3["dashname_8_4"];
$dashName[33] = $row_3["dashname_9_1"];
$dashName[34] = $row_3["dashname_9_2"];
$dashName[35] = $row_3["dashname_9_3"];
$dashName[36] = $row_3["dashname_9_4"];
$dashName[37] = $row_3["dashname_10_1"];
$dashName[38] = $row_3["dashname_10_2"];
$dashName[39] = $row_3["dashname_10_3"];
$dashName[40] = $row_3["dashname_10_4"];

$dashSncanel[1] = $row_4["sncanel_1_1"];
$dashSncanel[2] = $row_4["sncanel_1_2"];
$dashSncanel[3] = $row_4["sncanel_1_3"];
$dashSncanel[4] = $row_4["sncanel_1_4"];
$dashSncanel[5] = $row_4["sncanel_2_1"];
$dashSncanel[6] = $row_4["sncanel_2_2"];
$dashSncanel[7] = $row_4["sncanel_2_3"];
$dashSncanel[8] = $row_4["sncanel_2_4"];
$dashSncanel[9] = $row_4["sncanel_3_1"];
$dashSncanel[10] = $row_4["sncanel_3_2"];
$dashSncanel[11] = $row_4["sncanel_3_3"];
$dashSncanel[12] = $row_4["sncanel_3_4"];
$dashSncanel[13] = $row_4["sncanel_4_1"];
$dashSncanel[14] = $row_4["sncanel_4_2"];
$dashSncanel[15] = $row_4["sncanel_4_3"];
$dashSncanel[16] = $row_4["sncanel_4_4"];
$dashSncanel[17] = $row_4["sncanel_5_1"];
$dashSncanel[18] = $row_4["sncanel_5_2"];
$dashSncanel[19] = $row_4["sncanel_5_3"];
$dashSncanel[20] = $row_4["sncanel_5_4"];
$dashSncanel[21] = $row_4["sncanel_6_1"];
$dashSncanel[22] = $row_4["sncanel_6_2"];
$dashSncanel[23] = $row_4["sncanel_6_3"];
$dashSncanel[24] = $row_4["sncanel_6_4"];
$dashSncanel[25] = $row_4["sncanel_7_1"];
$dashSncanel[26] = $row_4["sncanel_7_2"];
$dashSncanel[27] = $row_4["sncanel_7_3"];
$dashSncanel[28] = $row_4["sncanel_7_4"];
$dashSncanel[29] = $row_4["sncanel_8_1"];
$dashSncanel[30] = $row_4["sncanel_8_2"];
$dashSncanel[31] = $row_4["sncanel_8_3"];
$dashSncanel[32] = $row_4["sncanel_8_4"];
$dashSncanel[33] = $row_4["sncanel_9_1"];
$dashSncanel[34] = $row_4["sncanel_9_2"];
$dashSncanel[35] = $row_4["sncanel_9_3"];
$dashSncanel[36] = $row_4["sncanel_9_4"];
$dashSncanel[37] = $row_4["sncanel_10_1"];
$dashSncanel[38] = $row_4["sncanel_10_2"];
$dashSncanel[39] = $row_4["sncanel_10_3"];
$dashSncanel[40] = $row_4["sncanel_10_4"];

$dashMode[1] = $row_5["statussn_1_1"];
$dashMode[2] = $row_5["statussn_1_2"];
$dashMode[3] = $row_5["statussn_1_3"];
$dashMode[4] = $row_5["statussn_1_4"];
$dashMode[5] = $row_5["statussn_2_1"];
$dashMode[6] = $row_5["statussn_2_2"];
$dashMode[7] = $row_5["statussn_2_3"];
$dashMode[8] = $row_5["statussn_2_4"];
$dashMode[9] = $row_5["statussn_3_1"];
$dashMode[10] = $row_5["statussn_3_2"];
$dashMode[11] = $row_5["statussn_3_3"];
$dashMode[12] = $row_5["statussn_3_4"];
$dashMode[13] = $row_5["statussn_4_1"];
$dashMode[14] = $row_5["statussn_4_2"];
$dashMode[15] = $row_5["statussn_4_3"];
$dashMode[16] = $row_5["statussn_4_4"];
$dashMode[17] = $row_5["statussn_5_1"];
$dashMode[18] = $row_5["statussn_5_2"];
$dashMode[19] = $row_5["statussn_5_3"];
$dashMode[20] = $row_5["statussn_5_4"];
$dashMode[21] = $row_5["statussn_6_1"];
$dashMode[22] = $row_5["statussn_6_2"];
$dashMode[23] = $row_5["statussn_6_3"];
$dashMode[24] = $row_5["statussn_6_4"];
$dashMode[25] = $row_5["statussn_7_1"];
$dashMode[26] = $row_5["statussn_7_2"];
$dashMode[27] = $row_5["statussn_7_3"];
$dashMode[28] = $row_5["statussn_7_4"];
$dashMode[29] = $row_5["statussn_8_1"];
$dashMode[30] = $row_5["statussn_8_2"];
$dashMode[31] = $row_5["statussn_8_3"];
$dashMode[32] = $row_5["statussn_8_4"];
$dashMode[33] = $row_5["statussn_9_1"];
$dashMode[34] = $row_5["statussn_9_2"];
$dashMode[35] = $row_5["statussn_9_3"];
$dashMode[36] = $row_5["statussn_9_4"];
$dashMode[37] = $row_5["statussn_10_1"];
$dashMode[38] = $row_5["statussn_10_2"];
$dashMode[39] = $row_5["statussn_10_3"];
$dashMode[40] = $row_5["statussn_10_4"];

if ($dashStatus[1] == 1) {
    $ress_1 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[1]' ")->fetch();
    $dashImg[1] = $ress_1["sensor_imgNor"];
    $dashUnit[1] = $ress_1["sensor_unit"];
}
if ($dashStatus[2] == 1) {
    $ress_2 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[2]' ")->fetch();
    $dashImg[2] = $ress_2["sensor_imgNor"];
    $dashUnit[2] = $ress_2["sensor_unit"];
}
if ($dashStatus[3] == 1) {
    $ress_3 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[3]' ")->fetch();
    $dashImg[3] = $ress_3["sensor_imgNor"];
    $dashUnit[3] = $ress_3["sensor_unit"];
}
if ($dashStatus[4] == 1) {
    $ress_4 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[4]' ")->fetch();
    $dashImg[4] = $ress_4["sensor_imgNor"];
    $dashUnit[4] = $ress_4["sensor_unit"];
}
if ($dashStatus[5] == 1) {
    $ress_5 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[5]' ")->fetch();
    $dashImg[5] = $ress_5["sensor_imgNor"];
    $dashUnit[5] = $ress_5["sensor_unit"];
}
if ($dashStatus[6] == 1) {
    $ress_6 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[6]' ")->fetch();
    $dashImg[6] = $ress_6["sensor_imgNor"];
    $dashUnit[6] = $ress_6["sensor_unit"];
}
if ($dashStatus[7] == 1) {
    $ress_7 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[7]' ")->fetch();
    $dashImg[7] = $ress_7["sensor_imgNor"];
    $dashUnit[7] = $ress_7["sensor_unit"];
}
if ($dashStatus[8] == 1) {
    $ress_8 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[8]' ")->fetch();
    $dashImg[8] = $ress_8["sensor_imgNor"];
    $dashUnit[8] = $ress_8["sensor_unit"];
}
if ($dashStatus[9] == 1) {
    $ress_9 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[9]' ")->fetch();
    $dashImg[9] = $ress_9["sensor_imgNor"];
    $dashUnit[9] = $ress_9["sensor_unit"];
}
if ($dashStatus[10] == 1) {
    $ress_10 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[10]' ")->fetch();
    $dashImg[10] = $ress_10["sensor_imgNor"];
    $dashUnit[10] = $ress_10["sensor_unit"];
}
if ($dashStatus[11] == 1) {
    $ress_11 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[11]' ")->fetch();
    $dashImg[11] = $ress_11["sensor_imgNor"];
    $dashUnit[11] = $ress_11["sensor_unit"];
}
if ($dashStatus[12] == 1) {
    $ress_12 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[12]' ")->fetch();
    $dashImg[12] = $ress_12["sensor_imgNor"];
    $dashUnit[12] = $ress_12["sensor_unit"];
}
if ($dashStatus[13] == 1) {
    $ress_13 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[13]' ")->fetch();
    $dashImg[13] = $ress_13["sensor_imgNor"];
    $dashUnit[13] = $ress_13["sensor_unit"];
}
if ($dashStatus[14] == 1) {
    $ress_14 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[14]' ")->fetch();
    $dashImg[14] = $ress_14["sensor_imgNor"];
    $dashUnit[14] = $ress_14["sensor_unit"];
}
if ($dashStatus[15] == 1) {
    $ress_15 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[15]' ")->fetch();
    $dashImg[15] = $ress_15["sensor_imgNor"];
    $dashUnit[15] = $ress_15["sensor_unit"];
}
if ($dashStatus[16] == 1) {
    $ress_16 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[16]' ")->fetch();
    $dashImg[16] = $ress_16["sensor_imgNor"];
    $dashUnit[16] = $ress_16["sensor_unit"];
}
if ($dashStatus[17] == 1) {
    $ress_17 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[17]' ")->fetch();
    $dashImg[17] = $ress_17["sensor_imgNor"];
    $dashUnit[17] = $ress_17["sensor_unit"];
}
if ($dashStatus[18] == 1) {
    $ress_18 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[18]' ")->fetch();
    $dashImg[18] = $ress_18["sensor_imgNor"];
    $dashUnit[18] = $ress_18["sensor_unit"];
}
if ($dashStatus[19] == 1) {
    $ress_19 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[19]' ")->fetch();
    $dashImg[19] = $ress_19["sensor_imgNor"];
    $dashUnit[19] = $ress_19["sensor_unit"];
}
if ($dashStatus[20] == 1) {
    $ress_20 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[20]' ")->fetch();
    $dashImg[20] = $ress_20["sensor_imgNor"];
    $dashUnit[20] = $ress_20["sensor_unit"];
}
if ($dashStatus[21] == 1) {
    $ress_21 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[21]' ")->fetch();
    $dashImg[21] = $ress_21["sensor_imgNor"];
    $dashUnit[21] = $ress_21["sensor_unit"];
}
if ($dashStatus[22] == 1) {
    $ress_22 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[22]' ")->fetch();
    $dashImg[22] = $ress_22["sensor_imgNor"];
    $dashUnit[22] = $ress_22["sensor_unit"];
}
if ($dashStatus[23] == 1) {
    $ress_23 = $dbcon->query("SELECT * from tb_sensor WHERE sensor_id = '$dashMode[23]' ")->fetch();
    $dashImg[23] = $ress_23["sensor_imgNor"];
    $dashUnit[23] = $ress_23["sensor_unit"];
}
if ($dashStatus[24] == 1) {
    $ress_24 = $dbcon->query("SELECT * from tb_sensor WHERE sensor_id = '$dashMode[24]' ")->fetch();
    $dashImg[24] = $ress_24["sensor_imgNor"];
    $dashUnit[24] = $ress_24["sensor_unit"];
}
if ($dashStatus[25] == 1) {
    $ress_25 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[25]' ")->fetch();
    $dashImg[25] = $ress_25["sensor_imgNor"];
    $dashUnit[25] = $ress_25["sensor_unit"];
}
if ($dashStatus[26] == 1) {
    $ress_26 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[26]' ")->fetch();
    $dashImg[26] = $ress_26["sensor_imgNor"];
    $dashUnit[26] = $ress_26["sensor_unit"];
}
if ($dashStatus[27] == 1) {
    $ress_27 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[27]' ")->fetch();
    $dashImg[27] = $ress_27["sensor_imgNor"];
    $dashUnit[27] = $ress_27["sensor_unit"];
}
if ($dashStatus[28] == 1) {
    $ress_28 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[28]' ")->fetch();
    $dashImg[28] = $ress_28["sensor_imgNor"];
    $dashUnit[28] = $ress_28["sensor_unit"];
}
if ($dashStatus[29] == 1) {
    $ress_29 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[29]' ")->fetch();
    $dashImg[29] = $ress_29["sensor_imgNor"];
    $dashUnit[29] = $ress_29["sensor_unit"];
}
if ($dashStatus[30] == 1) {
    $ress_30 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[30]' ")->fetch();
    $dashImg[30] = $ress_30["sensor_imgNor"];
    $dashUnit[30] = $ress_30["sensor_unit"];
}
if ($dashStatus[31] == 1) {
    $ress_31 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[31]' ")->fetch();
    $dashImg[31] = $ress_31["sensor_imgNor"];
    $dashUnit[31] = $ress_31["sensor_unit"];
}
if ($dashStatus[32] == 1) {
    $ress_32 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[32]' ")->fetch();
    $dashImg[32] = $ress_32["sensor_imgNor"];
    $dashUnit[32] = $ress_32["sensor_unit"];
}
if ($dashStatus[33] == 1) {
    $ress_33 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[33]' ")->fetch();
    $dashImg[33] = $ress_33["sensor_imgNor"];
    $dashUnit[33] = $ress_33["sensor_unit"];
}
if ($dashStatus[34] == 1) {
    $ress_34 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[34]' ")->fetch();
    $dashImg[34] = $ress_34["sensor_imgNor"];
    $dashUnit[34] = $ress_34["sensor_unit"];
}
if ($dashStatus[35] == 1) {
    $ress_35 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[35]' ")->fetch();
    $dashImg[35] = $ress_35["sensor_imgNor"];
    $dashUnit[35] = $ress_35["sensor_unit"];
}
if ($dashStatus[36] == 1) {
    $ress_36 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[36]' ")->fetch();
    $dashImg[36] = $ress_36["sensor_imgNor"];
    $dashUnit[36] = $ress_36["sensor_unit"];
}
if ($dashStatus[37] == 1) {
    $ress_37 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[37]' ")->fetch();
    $dashImg[37] = $ress_37["sensor_imgNor"];
    $dashUnit[37] = $ress_37["sensor_unit"];
}
if ($dashStatus[38] == 1) {
    $ress_38 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[38]' ")->fetch();
    $dashImg[38] = $ress_38["sensor_imgNor"];
    $dashUnit[38] = $ress_38["sensor_unit"];
}
if ($dashStatus[39] == 1) {
    $ress_39 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[39]' ")->fetch();
    $dashImg[39] = $ress_39["sensor_imgNor"];
    $dashUnit[39] = $ress_39["sensor_unit"];
}
if ($dashStatus[40] == 1) {
    $ress_40 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$dashMode[40]' ")->fetch();
    $dashImg[40] = $ress_40["sensor_imgNor"];
    $dashUnit[40] = $ress_40["sensor_unit"];
}

$row_6 = $dbcon->query("SELECT * FROM tb3_controlstatus WHERE controlstatus_sn = '$house_master'")->fetch();
$row_7 = $dbcon->query("SELECT * FROM tb3_conttrolname WHERE conttrolname_sn = '$house_master'")->fetch();
$row_8 = $dbcon->query("SELECT * FROM tb3_controlcanel WHERE controlcanel_sn = '$house_master'")->fetch();
$controlstatus[1] = intval($row_6["controlstatus_1"]);
$controlstatus[2] = intval($row_6["controlstatus_2"]);
$controlstatus[3] = intval($row_6["controlstatus_3"]);
$controlstatus[4] = intval($row_6["controlstatus_4"]);
$controlstatus[5] = intval($row_6["controlstatus_5"]);
$controlstatus[6] = intval($row_6["controlstatus_6"]);
$controlstatus[7] = intval($row_6["controlstatus_7"]);
$controlstatus[8] = intval($row_6["controlstatus_8"]);
$controlstatus[9] = intval($row_6["controlstatus_9"]);
$controlstatus[10] = intval($row_6["controlstatus_10"]);
$controlstatus[11] = intval($row_6["controlstatus_11"]);
$controlstatus[12] = intval($row_6["controlstatus_12"]);

$conttrolname[1] = $row_7["conttrolname_1"];
$conttrolname[2] = $row_7["conttrolname_2"];
$conttrolname[3] = $row_7["conttrolname_3"];
$conttrolname[4] = $row_7["conttrolname_4"];
$conttrolname[5] = $row_7["conttrolname_5"];
$conttrolname[6] = $row_7["conttrolname_6"];
$conttrolname[7] = $row_7["conttrolname_7"];
$conttrolname[8] = $row_7["conttrolname_8"];
$conttrolname[9] = $row_7["conttrolname_9"];
$conttrolname[10] = $row_7["conttrolname_10"];
$conttrolname[11] = $row_7["conttrolname_11"];
$conttrolname[12] = $row_7["conttrolname_12"];

$controlcanel[1] = $row_8["controlcanel_1"];
$controlcanel[2] = $row_8["controlcanel_2"];
$controlcanel[3] = $row_8["controlcanel_3"];
$controlcanel[4] = $row_8["controlcanel_4"];
$controlcanel[5] = $row_8["controlcanel_5"];
$controlcanel[6] = $row_8["controlcanel_6"];
$controlcanel[7] = $row_8["controlcanel_7"];
$controlcanel[8] = $row_8["controlcanel_8"];
$controlcanel[9] = $row_8["controlcanel_9"];
$controlcanel[10] = $row_8["controlcanel_10"];
$controlcanel[11] = $row_8["controlcanel_11"];
$controlcanel[12] = $row_8["controlcanel_12"];

if($controlstatus[1] == 1){
    $rec_1 = $dbcon->query("SELECT * from tb_loard WHERE loard_id = '$controlcanel[1]' ")->fetch();
    $drip_1[0] = $rec_1["loard_imgOn"];
    $drip_1[1] = $rec_1["loard_imgOff"];
}else{$drip_1 = "";}
if($controlstatus[2] == 1){
    $rec_2 = $dbcon->query("SELECT * from tb_loard WHERE loard_id = '$controlcanel[2]' ")->fetch();
    $drip_2[0] = $rec_2["loard_imgOn"];
    $drip_2[1] = $rec_2["loard_imgOff"];
}else{$drip_2 = "";}
if($controlstatus[3] == 1){
    $rec_3 = $dbcon->query("SELECT * from tb_loard WHERE loard_id = '$controlcanel[3]' ")->fetch();
    $drip_3[0] = $rec_3["loard_imgOn"];
    $drip_3[1] = $rec_3["loard_imgOff"];
}else{$drip_3 = "";}
if($controlstatus[4] == 1){
    $rec_4 = $dbcon->query("SELECT * from tb_loard WHERE loard_id = '$controlcanel[4]' ")->fetch();
    $drip_4[0] = $rec_4["loard_imgOn"];
    $drip_4[1] = $rec_4["loard_imgOff"];
}else{$drip_4 = "";}
if($controlstatus[5] == 1){
    $rec_5 = $dbcon->query("SELECT * from tb_loard WHERE loard_id = '$controlcanel[5]' ")->fetch();
    $drip_5[0] = $rec_5["loard_imgOn"];
    $drip_5[1] = $rec_5["loard_imgOff"];
}else{$drip_5 = "";}
if($controlstatus[6] == 1){
    $rec_6 = $dbcon->query("SELECT * from tb_loard WHERE loard_id = '$controlcanel[6]' ")->fetch();
    $drip_6[0] = $rec_6["loard_imgOn"];
    $drip_6[1] = $rec_6["loard_imgOff"];
}else{$drip_6 = "";}
if($controlstatus[7] == 1){
    $rec_7 = $dbcon->query("SELECT * from tb_loard WHERE loard_id = '$controlcanel[7]' ")->fetch();
    $drip_7[0] = $rec_7["loard_imgOn"];
    $drip_7[1] = $rec_7["loard_imgOff"];
}else{$drip_7 = "";}
if($controlstatus[8] == 1){
    $rec_8 = $dbcon->query("SELECT * from tb_loard WHERE loard_id = '$controlcanel[8]' ")->fetch();
    $drip_8[0] = $rec_8["loard_imgOn"];
    $drip_8[1] = $rec_8["loard_imgOff"];
}else{$drip_8 = "";}
if($controlstatus[9] == 1){
    $rec_9 = $dbcon->query("SELECT * from tb_loard WHERE loard_id = '$controlcanel[9]' ")->fetch();
    $foggy[0] = $rec_9["loard_imgOn"];
    $foggy[1] = $rec_9["loard_imgOff"];
}else{$foggy = "";}
if($controlstatus[10] == 1){
    $rec_10 = $dbcon->query("SELECT * from tb_loard WHERE loard_id = '$controlcanel[10]' ")->fetch();
    $fan[0] = $rec_10["loard_imgOn"];
    $fan[1] = $rec_10["loard_imgOff"];
}else{$fan = "";}
if($controlstatus[11] == 1){
    $rec_11 = $dbcon->query("SELECT * from tb_loard WHERE loard_id = '$controlcanel[11]' ")->fetch();
    $shader[0] = $rec_11["loard_imgOn"];
    $shader[1] = $rec_11["loard_imgOff"];
    $shader[2] = $rec_11["loard_img2"];
    $shader[3] = $rec_11["loard_img3"];
    $shader[4] = $rec_11["loard_img4"];
}else{$shader = "";}
if($controlstatus[12] == 1){
    $rec_12 = $dbcon->query("SELECT * from tb_loard WHERE loard_id = '$controlcanel[12]' ")->fetch();
    $fertilizer[0] = $rec_12["loard_imgOn"];
    $fertilizer[1] = $rec_12["loard_imgOff"];
}else{$fertilizer = "";}

$row_9 = $dbcon->query("SELECT * FROM tb3_map_img WHERE map_sn = '$house_master'")->fetch();
$row_10 = $dbcon->query("SELECT * FROM tb3_meter_status WHERE meter_status_sn = '$house_master'")->fetch();
$row_11 = $dbcon->query("SELECT * FROM tb3_meter_chenal_mode WHERE meter_chenal_mode_sn = '$house_master'")->fetch();

$ingMap[1] = $row_9["map_ch_1"];
$ingMap[2] = $row_9["map_ch_2"];
$ingMap[3] = $row_9["map_ch_3"];
$ingMap[4] = $row_9["map_ch_4"];
$ingMap[5] = $row_9["map_ch_5"];
$ingMap[6] = $row_9["map_ch_6"];
$ingMap[7] = $row_9["map_ch_7"];
$ingMap[8] = $row_9["map_ch_8"];
$ingMap[9] = $row_9["map_ch_9"];
$ingMap[10] = $row_9["map_ch_10"];
$ingMap[11] = $row_9["map_ch_11"];
$ingMap[12] = $row_9["map_ch_12"];
$ingMap[13] = $row_9["map_ch_13"];
$ingMap[14] = $row_9["map_ch_14"];
$ingMap[15] = $row_9["map_ch_15"];
$ingMap[16] = $row_9["map_ch_16"];
$ingMap[17] = $row_9["map_ch_17"];
$ingMap[18] = $row_9["map_ch_18"];
$ingMap[19] = $row_9["map_ch_19"];
$ingMap[20] = $row_9["map_ch_20"];
$ingMap[21] = $row_9["map_ch_21"];
$ingMap[22] = $row_9["map_ch_22"];
$ingMap[23] = $row_9["map_ch_23"];
$ingMap[24] = $row_9["map_ch_24"];
$ingMap[25] = $row_9["map_ch_25"];
$ingMap[26] = $row_9["map_ch_26"];
$ingMap[27] = $row_9["map_ch_27"];
$ingMap[28] = $row_9["map_ch_28"];
$ingMap[29] = $row_9["map_ch_29"];
$ingMap[30] = $row_9["map_ch_30"];
$ingMap[31] = $row_9["map_ch_31"];
$ingMap[32] = $row_9["map_ch_32"];
$ingMap[33] = $row_9["map_ch_33"];
$ingMap[34] = $row_9["map_ch_34"];
$ingMap[35] = $row_9["map_ch_35"];
$ingMap[36] = $row_9["map_ch_36"];
$ingMap[37] = $row_9["map_ch_37"];
$ingMap[38] = $row_9["map_ch_38"];
$ingMap[39] = $row_9["map_ch_39"];
$ingMap[40] = $row_9["map_ch_40"];

$meter_status[1] = intval($row_10["meter_status_v"]);
$meter_status[2] = intval($row_10["meter_status_a"]);
$meter_status[3] = intval($row_10["meter_status_p"]);
$meter_status[4] = intval($row_10["meter_status_pf"]);
$meter_status[5] = intval($row_10["meter_status_engy"]);
$meter_status[6] = intval($row_10["meter_status_water"]);
$meter_status[7] = intval($row_10["meter_status_wind_speed"]);
$meter_status[8] = intval($row_10["meter_status_wind_direction"]);

$meter_chenal[1] = $row_11["meter_chenal_1"];
$meter_chenal[2] = $row_11["meter_chenal_2"];
$meter_chenal[3] = $row_11["meter_chenal_3"];
$meter_chenal[4] = $row_11["meter_chenal_4"];
$meter_chenal[5] = $row_11["meter_chenal_5"];
$meter_chenal[6] = $row_11["meter_chenal_6"];
$meter_chenal[7] = $row_11["meter_chenal_7"];
$meter_chenal[8] = $row_11["meter_chenal_8"];

$meter_mode[1] = $row_11["meter_mode_1"];
$meter_mode[2] = $row_11["meter_mode_2"];
$meter_mode[3] = $row_11["meter_mode_3"];
$meter_mode[4] = $row_11["meter_mode_4"];
$meter_mode[5] = $row_11["meter_mode_5"];
$meter_mode[6] = $row_11["meter_mode_6"];
$meter_mode[7] = $row_11["meter_mode_7"];

if ($meter_status[1] == 1) {
    $resm_1 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$meter_mode[1]' ")->fetch();
    $meterImg['Img_v'] = $resm_1["sensor_imgNor"];
    $meterUnit['Unit_v'] = $resm_1["sensor_unit"];
}else{
    $meterImg['Img_v'] = "";
    $meterUnit['Unit_v'] = "";
}
if ($meter_status[2] == 1) {
    $resm_2 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$meter_mode[2]' ")->fetch();
    $meterImg['Img_a'] = $resm_2["sensor_imgNor"];
    $meterUnit['Unit_a'] = $resm_2["sensor_unit"];
}else{
    $meterImg['Img_a'] = "";
    $meterUnit['Unit_a'] = "";
}
if ($meter_status[3] == 1) {
    $resm_3 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$meter_mode[3]' ")->fetch();
    $meterImg['Img_p'] = $resm_3["sensor_imgNor"];
    $meterUnit['Unit_p'] = $resm_3["sensor_unit"];
}else{
    $meterImg['Img_p'] = "";
    $meterUnit['Unit_p'] = "";
}
if ($meter_status[4] == 1) {
    $resm_4 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$meter_mode[4]' ")->fetch();
    $meterImg['Img_pf'] = $resm_4["sensor_imgNor"];
    $meterUnit['Unit_pf'] = $resm_4["sensor_unit"];
}else{
    $meterImg['Img_pf'] = "";
    $meterUnit['Unit_pf'] = "";
}
if ($meter_status[5] == 1) {
    $resm_5 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$meter_mode[5]' ")->fetch();
    $meterImg['Img_engy'] = $resm_5["sensor_imgNor"];
    $meterUnit['Unit_engy'] = $resm_5["sensor_unit"];
}else{
    $meterImg['Img_engy'] = "";
    $meterUnit['Unit_engy'] = "";
}
if ($meter_status[6] == 1) {
    $resm_6 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$meter_mode[6]' ")->fetch();
    $meterImg['Img_water'] = $resm_6["sensor_imgNor"];
    $meterUnit['Unit_water'] = $resm_6["sensor_unit"];
}else{
    $meterImg['Img_water'] = "";
    $meterUnit['Unit_water'] = "";
}
if ($meter_status[7] == 1) {
    $resm_7 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$meter_mode[7]' ")->fetch();
    $meterImg['Img_wind_speed'] = $resm_7["sensor_imgNor"];
    $meterUnit['Unit_wind_speed'] = $resm_7["sensor_unit"];
}else{
    $meterImg['Img_wind_speed'] = "";
    $meterUnit['Unit_wind_speed'] = "";
}
$row_9 = $dbcon->query("SELECT `data_timestamp` FROM `tb_data_sensor` WHERE `data_sn`= '$house_master' ORDER BY `data_id` DESC LIMIT 1")->fetch();
 
echo json_encode([
    's_master'=> $row_s_master,
    'dashStatus'=> $dashStatus,
    'dashName'=> $dashName,
    'dashSncanel'=> $dashSncanel,
    'dashMode'=> $dashMode,
    'dashImg'=> $dashImg,
    'dashUnit'=> $dashUnit,
    'controlstatus'=> $controlstatus,
    'conttrolname'=> $conttrolname,
    'imgCon'=> [
        'drip_1'=> $drip_1,
        'drip_2'=> $drip_2,
        'drip_3'=> $drip_3,
        'drip_4'=> $drip_4,
        'drip_5'=> $drip_5,
        'drip_6'=> $drip_6,
        'drip_7'=> $drip_7,
        'drip_8'=> $drip_8,
        'foggy'=> $foggy,
        'fan'=> $fan,
        'shader'=> $shader,
        'fertilizer'=> $fertilizer
    ],
    'ingMap' => $ingMap,
    'meter_status' => $meter_status,
    'meter_chenal' => $meter_chenal,
    'meter_mode' => $meter_mode,
    'meterImg' => $meterImg,
    'meterUnit' => $meterUnit,
    'time_update' => $row_9[0]
    // 'ddd'=> 'asss'
]);
