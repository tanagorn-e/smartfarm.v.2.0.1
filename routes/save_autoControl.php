<?php
    session_start();
    require "connectdb.php";
    require '../public/plugins/phpMQTT-master/phpMQTT.php';
    $house_master = $_POST["house_master"];
    $channel = $_POST["channel"];
// print_r($_POST);
// echo json_encode($_POST["json"]);
// exit();
// ---------------------------------------------
   if($channel == 9){
        $post_data = [
            "sw_1" => $_POST["sw_1"],
            "sw_2" => $_POST["sw_2"],
            "sw_3" => $_POST["sw_3"],
            "sw_4" => $_POST["sw_4"],
            "sw_5" => $_POST["sw_5"],
            "sw_6" => $_POST["sw_6"],
            "sw_7" => $_POST["sw_7"],
            "s_1"  => $_POST["s_1"],
            "s_2"  => $_POST["s_2"],
            "s_3"  => $_POST["s_3"],
            "s_4"  => $_POST["s_4"],
            "s_5"  => $_POST["s_5"],
            "s_6"  => $_POST["s_6"],
            "s_7"  => $_POST["s_7"],
            "e_1"  => $_POST["e_1"],
            "e_2"  => $_POST["e_2"],
            "e_3"  => $_POST["e_3"],
            "e_4"  => $_POST["e_4"],
            "e_5"  => $_POST["e_5"],
            "e_6"  => $_POST["e_6"],
            "e_7"  => $_POST["e_7"],
            "on_7"  => $_POST["on_7"],
            "off_7"  => $_POST["off_7"]
        ];
    }else if($channel == 11){
        $post_data = [
            "sw_1" => $_POST["sw_1"],
            "sw_2" => $_POST["sw_2"],
            "sw_3" => $_POST["sw_3"],
            "sw_4" => $_POST["sw_4"],
            "sw_5" => $_POST["sw_5"],
            "sw_6" => $_POST["sw_6"],
            "s_1"  => $_POST["s_1"],
            "s_2"  => $_POST["s_2"],
            "s_3"  => $_POST["s_3"],
            "s_4"  => $_POST["s_4"],
            "s_5"  => $_POST["s_5"],
            "s_6"  => $_POST["s_6"],
            "e_1"  => $_POST["se_1"],
            "e_2"  => $_POST["se_2"],
            "e_3"  => $_POST["se_3"],
            "e_4"  => $_POST["se_4"],
            "e_5"  => $_POST["se_5"],
            "e_6"  => $_POST["se_6"]
        ];
    }else{
        $post_data = [
            "sw_1" => $_POST["sw_1"],
            "sw_2" => $_POST["sw_2"],
            "sw_3" => $_POST["sw_3"],
            "sw_4" => $_POST["sw_4"],
            "sw_5" => $_POST["sw_5"],
            "sw_6" => $_POST["sw_6"],
            "s_1"  => $_POST["s_1"],
            "s_2"  => $_POST["s_2"],
            "s_3"  => $_POST["s_3"],
            "s_4"  => $_POST["s_4"],
            "s_5"  => $_POST["s_5"],
            "s_6"  => $_POST["s_6"],
            "e_1"  => $_POST["e_1"],
            "e_2"  => $_POST["e_2"],
            "e_3"  => $_POST["e_3"],
            "e_4"  => $_POST["e_4"],
            "e_5"  => $_POST["e_5"],
            "e_6"  => $_POST["e_6"]
        ];
    }
// print_r($post_data);
//     exit();
    $tb_name = 'tb3_load_'.$channel;
    $wh_sn = 'load_'.$channel.'_sn';
    if($channel == 9){    
        $colume = '(load_'.$channel.'_sn,
                    load_'.$channel.'_user,
                    load_'.$channel.'_st_1,
                    load_'.$channel.'_st_2,
                    load_'.$channel.'_st_3,
                    load_'.$channel.'_st_4,
                    load_'.$channel.'_st_5,
                    load_'.$channel.'_st_6,
                    load_'.$channel.'_st_7,
                    load_'.$channel.'_time_s_1,
                    load_'.$channel.'_time_s_2,
                    load_'.$channel.'_time_s_3,
                    load_'.$channel.'_time_s_4,
                    load_'.$channel.'_time_s_5,
                    load_'.$channel.'_time_s_6,
                    load_'.$channel.'_time_s_7,
                    load_'.$channel.'_time_e_1,
                    load_'.$channel.'_time_e_2,
                    load_'.$channel.'_time_e_3,
                    load_'.$channel.'_time_e_4,
                    load_'.$channel.'_time_e_5,
                    load_'.$channel.'_time_e_6,
                    load_'.$channel.'_time_e_7,
                    load_'.$channel.'_time_on_7,
                    load_'.$channel.'_time_off_7)';
        $value = '( :load_sn, :losd_user,
                    :sw_1, :sw_2, :sw_3, :sw_4, :sw_5, :sw_6, :sw_7,
                    :s_1, :s_2, :s_3, :s_4, :s_5, :s_6, :s_7,
                    :e_1, :e_2, :e_3, :e_4, :e_5, :e_6, :e_7, :on_7, :off_7 )';
    }else{
        $colume = '(load_'.$channel.'_sn,
                    load_'.$channel.'_user,
                    load_'.$channel.'_st_1,
                    load_'.$channel.'_st_2,
                    load_'.$channel.'_st_3,
                    load_'.$channel.'_st_4,
                    load_'.$channel.'_st_5,
                    load_'.$channel.'_st_6,
                    load_'.$channel.'_time_s_1,
                    load_'.$channel.'_time_s_2,
                    load_'.$channel.'_time_s_3,
                    load_'.$channel.'_time_s_4,
                    load_'.$channel.'_time_s_5,
                    load_'.$channel.'_time_s_6,
                    load_'.$channel.'_time_e_1,
                    load_'.$channel.'_time_e_2,
                    load_'.$channel.'_time_e_3,
                    load_'.$channel.'_time_e_4,
                    load_'.$channel.'_time_e_5,
                    load_'.$channel.'_time_e_6)';
        $value = '( :load_sn, :losd_user,
                    :sw_1, :sw_2, :sw_3, :sw_4, :sw_5, :sw_6,
                    :s_1, :s_2, :s_3, :s_4, :s_5, :s_6,
                    :e_1, :e_2, :e_3, :e_4, :e_5, :e_6 )';
    }
    $post_data["load_sn"] = $house_master;
    $post_data["losd_user"] = $_SESSION["Username"];
    // echo json_encode($post_data);
    $tb_name = 'tb3_load_'.$channel.' '.$colume;
    // $wh_sn = 'load_'.$channel.'_sn';
    // echo $post_data;
    // exit();
    
    $stmt = "INSERT INTO $tb_name VALUES $value";
    if ($dbcon->prepare($stmt)->execute($post_data) === TRUE) {
        if($channel == 9){
            if($_POST["sw_7"] ==  1){
                $s_7 = intval(explode(":",$_POST["s_7"])[0]);
                $e_7 = intval(explode(":",$_POST["e_7"])[0]);
                $on_7 = $_POST["on_7"];
                $off_7 = $_POST["off_7"];
                $hour = $e_7-$s_7;
                $data = [];
                // echo intval($s_7);
                // exit();
                
                if($s_7 < 10){ $ns_7 = "0".strval($s_7);}else{$ns_7 = $s_7;}
                if(($s_7+1) < 10){ $ns2_7 = "0".strval(($s_7+1));}else{$ns2_7 = ($s_7+1);}
                if(($s_7+2) < 10){ $ns3_7 = "0".strval(($s_7+2));}else{$ns3_7 = ($s_7+2);}
                if(($s_7+3) < 10){ $ns4_7 = "0".strval(($s_7+3));}else{$ns4_7 = ($s_7+3);}
                if(($s_7+4) < 10){ $ns5_7 = "0".strval(($s_7+4));}else{$ns5_7 = ($s_7+4);}
                if(($s_7+5) < 10){ $ns6_7 = "0".strval(($s_7+5));}else{$ns6_7 = ($s_7+5);}
                if(($s_7+6) < 10){ $ns7_7 = "0".strval(($s_7+6));}else{$ns7_7 = ($s_7+6);}
                if(($s_7+7) < 10){ $ns8_7 = "0".strval(($s_7+7));}else{$ns8_7 = ($s_7+7);}
                if(($s_7+8) < 10){ $ns9_7 = "0".strval(($s_7+8));}else{$ns9_7 = ($s_7+8);}
                if(($s_7+9) < 10){ $ns10_7 = "0".strval(($s_7+9));}else{$ns10_7 = ($s_7+9);}
                if(($s_7+10) < 10){ $ns11_7 = "0".strval(($s_7+10));}else{$ns11_7 = ($s_7+10);}
                if(($s_7+11) < 10){ $ns12_7 = "0".strval(($s_7+11));}else{$ns12_7 = ($s_7+11);}
                if(($s_7+12) < 10){ $ns13_7 = "0".strval(($s_7+12));}else{$ns13_7 = ($s_7+12);}
            
                if($on_7 == 5){
                    if($off_7 == 5){
                        $num = 6;
                        for($i = 1; $i <= $hour; $i++){
                            if($i == 1){
                                if($s_7 < 10){ $nsf_7 = "0".strval($s_7); }else{$nsf_7 = $s_7;}
                            }else{
                                if($s_7+($i-1) < 10){ $nsf_7 = "0".strval($s_7+($i-1)); }else{$nsf_7 = $s_7+($i-1);}
                            }
                            $data2["a"][] = $nsf_7.":00";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":05";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":10";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":15";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":20";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":25";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":30";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":35";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":40";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":45";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":50";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":55";
                            $data2["b"][] = 5;
                        }
                        for($i = 1; $i <= ($num*$hour); $i++){
                            if($data2["b"][(($i-1)+$i)] == 5){
                                $zz = "E_".$i;
                            }
                            if($data2["b"][(($i-2)+$i)] == 0){
                                $zx = "S_".$i;
                            }
                            $data[$zx] =  $data2["a"][(($i-2)+$i)];
                            $data[$zz] =  $data2["a"][(($i-1)+$i)];
                        }
                    }
                    if($off_7 == 10){
                        $num = 4;
                        for($i = 1; $i <= $hour; $i++){
                            if($i == 1){
                                if($s_7 < 10){ $nsf_7 = "0".strval($s_7); }else{$nsf_7 = $s_7;}
                            }else{
                                if($s_7+($i-1) < 10){ $nsf_7 = "0".strval($s_7+($i-1)); }else{$nsf_7 = $s_7+($i-1);}
                            }
                            $data2["a"][] = $nsf_7.":00";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":05";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":15";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":20";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":30";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":35";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":45";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":50";
                            $data2["b"][] = 5;
                        }
                        for($i = 1; $i <= ($num*$hour); $i++){
                            if($data2["b"][(($i-1)+$i)] == 5){
                                $zz = "E_".$i;
                            }
                            if($data2["b"][(($i-2)+$i)] == 0){
                                $zx = "S_".$i;
                            }
                            $data[$zx] =  $data2["a"][(($i-2)+$i)];
                            $data[$zz] =  $data2["a"][(($i-1)+$i)];
                        }
                    }
                    if($off_7 == 15){
                        $num = 3;
                        for($i = 1; $i <= $hour; $i++){
                            if($i == 1){
                                if($s_7 < 10){ $nsf_7 = "0".strval($s_7); }else{$nsf_7 = $s_7;}
                            }else{
                                if($s_7+($i-1) < 10){ $nsf_7 = "0".strval($s_7+($i-1)); }else{$nsf_7 = $s_7+($i-1);}
                            }
                            $data2["a"][] = $nsf_7.":00";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":05";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":20";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":25";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":40";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":45";
                            $data2["b"][] = 5;
                        }
                        for($i = 1; $i <= ($num*$hour); $i++){
                            if($data2["b"][(($i-1)+$i)] == 5){
                                $zz = "E_".$i;
                            }
                            if($data2["b"][(($i-2)+$i)] == 0){
                                $zx = "S_".$i;
                            }
                            $data[$zx] =  $data2["a"][(($i-2)+$i)];
                            $data[$zz] =  $data2["a"][(($i-1)+$i)];
                        }
                    }
                    if($off_7 == 20){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":05";
                            $data["S_2"] = $ns_7.":25";
                            $data["E_2"] = $ns_7.":30";
                            $data["S_3"] = $ns_7.":50";
                            $data["E_3"] = $ns_7.":55";
                        }if($hour >= 2){
                            $data["S_4"] = $ns2_7.":15";
                            $data["E_4"] = $ns2_7.":20";
                            $data["S_5"] = $ns2_7.":40";
                            $data["E_5"] = $ns2_7.":45";
                        }if($hour >= 3){
                            $data["S_6"] = $ns3_7.":05";
                            $data["E_6"] = $ns3_7.":10";
                            $data["S_7"] = $ns3_7.":30";
                            $data["E_7"] = $ns3_7.":35";
                            $data["S_8"] = $ns3_7.":55";
                            $data["E_8"] = $ns4_7.":00";
                        }if($hour >= 4){
                            $data["S_9"] = $ns4_7.":20";
                            $data["E_9"] = $ns4_7.":25";
                            $data["S_10"] = $ns4_7.":45";
                            $data["E_10"] = $ns4_7.":50";
                        }if($hour >= 5){
                            $data["S_11"] = $ns5_7.":10";
                            $data["E_11"] = $ns5_7.":15";
                            $data["S_12"] = $ns5_7.":35";
                            $data["E_12"] = $ns5_7.":40";
                        }if($hour >= 6){
                            $data["S_13"] = $ns6_7.":00";
                            $data["E_13"] = $ns6_7.":05";
                            $data["S_14"] = $ns6_7.":25";
                            $data["E_14"] = $ns6_7.":30";
                            $data["S_15"] = $ns6_7.":50";
                            $data["E_15"] = $ns6_7.":55";
                        }if($hour >= 7){
                            $data["S_16"] = $ns7_7.":15";
                            $data["E_16"] = $ns7_7.":20";
                            $data["S_17"] = $ns7_7.":40";
                            $data["E_17"] = $ns7_7.":45";
                        }if($hour >= 8){
                            $data["S_18"] = $ns8_7.":05";
                            $data["E_18"] = $ns8_7.":10";
                            $data["S_19"] = $ns8_7.":30";
                            $data["E_19"] = $ns8_7.":35";
                            $data["S_20"] = $ns8_7.":55";
                            $data["E_20"] = $ns9_7.":00";
                        }if($hour >= 9){
                            $data["S_21"] = $ns9_7.":20";
                            $data["E_21"] = $ns9_7.":25";
                            $data["S_22"] = $ns9_7.":45";
                            $data["E_22"] = $ns9_7.":50";
                        }if($hour >= 10){
                            $data["S_23"] = $ns10_7.":10";
                            $data["E_23"] = $ns10_7.":15";
                            $data["S_24"] = $ns10_7.":35";
                            $data["E_24"] = $ns10_7.":40";
                        }if($hour >= 11){
                            $data["S_25"] = $ns11_7.":00";
                            $data["E_25"] = $ns11_7.":05";
                            $data["S_26"] = $ns11_7.":25";
                            $data["E_26"] = $ns11_7.":30";
                            $data["S_27"] = $ns11_7.":50";
                            $data["E_27"] = $ns11_7.":55";
                        }if($hour >= 12){
                            $data["S_28"] = $ns12_7.":15";
                            $data["E_28"] = $ns12_7.":20";
                            $data["S_29"] = $ns12_7.":40";
                            $data["E_29"] = $ns12_7.":45";
                        }
                    }
                    if($off_7 == 25){
                        $num = 2;
                        for($i = 1; $i <= $hour; $i++){
                            if($i == 1){
                                if($s_7 < 10){ $nnsf_7s_7 = "0".strval($s_7); }else{$nsf_7 = $s_7;}
                            }else{
                                if($s_7+($i-1) < 10){ $nsf_7 = "0".strval($s_7+($i-1)); }else{$nsf_7 = $s_7+($i-1);}
                            }
                            $data2["a"][] = $nsf_7.":00";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":05";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":30";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":35";
                            $data2["b"][] = 5;
                        }
                        for($i = 1; $i <= ($num*$hour); $i++){
                            if($data2["b"][(($i-1)+$i)] == 5){
                                $zz = "E_".$i;
                            }
                            if($data2["b"][(($i-2)+$i)] == 0){
                                $zx = "S_".$i;
                            }
                            $data[$zx] =  $data2["a"][(($i-2)+$i)];
                            $data[$zz] =  $data2["a"][(($i-1)+$i)];
                        }
                    }
                    if($off_7 == 30){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":05";
                            $data["S_2"] = $ns_7.":35";
                            $data["E_2"] = $ns_7.":40";
                        }if($hour >= 2){
                            $data["S_3"] = $ns2_7.":10";
                            $data["E_3"] = $ns2_7.":15";
                            $data["S_4"] = $ns2_7.":45";
                            $data["E_4"] = $ns2_7.":50";
                        }if($hour >= 3){
                            $data["S_5"] = $ns3_7.":20";
                            $data["E_5"] = $ns3_7.":25";
                            $data["S_6"] = $ns3_7.":55";
                            $data["E_6"] = $ns4_7.":00";
                        }if($hour >= 4){
                            $data["S_7"] = $ns4_7.":30";
                            $data["E_7"] = $ns4_7.":35";
                        }if($hour >= 5){
                            $data["S_8"] = $ns5_7.":05";
                            $data["E_8"] = $ns5_7.":10";
                            $data["S_9"] = $ns5_7.":40";
                            $data["E_9"] = $ns5_7.":45";
                        }if($hour >= 6){
                            $data["S_10"] = $ns6_7.":15";
                            $data["E_10"] = $ns6_7.":20";
                            $data["S_11"] = $ns6_7.":50";
                            $data["E_11"] = $ns6_7.":55";
                        }if($hour >= 7){
                            $data["S_12"] = $ns7_7.":25";
                            $data["E_12"] = $ns7_7.":30";
                        }if($hour >= 8){
                            $data["S_13"] = $ns8_7.":00";
                            $data["E_13"] = $ns8_7.":05";
                            $data["S_14"] = $ns8_7.":35";
                            $data["E_14"] = $ns8_7.":40";
                        }if($hour >= 9){
                            $data["S_15"] = $ns9_7.":10";
                            $data["E_15"] = $ns9_7.":15";
                            $data["S_16"] = $ns9_7.":45";
                            $data["E_16"] = $ns9_7.":50";
                        }if($hour >= 10){
                            $data["S_17"] = $ns10_7.":20";
                            $data["E_17"] = $ns10_7.":25";
                            $data["S_18"] = $ns10_7.":55";
                            $data["E_18"] = $ns11_7.":00";
                        }if($hour >= 11){
                            $data["S_19"] = $ns11_7.":30";
                            $data["E_19"] = $ns11_7.":35";
                        }if($hour >= 12){
                            $data["S_20"] = $ns12_7.":05";
                            $data["E_20"] = $ns12_7.":10";
                            $data["S_21"] = $ns12_7.":40";
                            $data["E_21"] = $ns12_7.":45";
                        }
                    }
                }if($on_7 == 10){
                    if($off_7 == 5){
                        $num = 4;
                        for($i = 1; $i <= $hour; $i++){
                            if($i == 1){
                                if($s_7 < 10){ $nsf_7 = "0".strval($s_7); }else{$nsf_7 = $s_7;}
                            }else{
                                if($s_7+($i-1) < 10){ $nsf_7 = "0".strval($s_7+($i-1)); }else{$nsf_7 = $s_7+($i-1);}
                            }
                            $data2["a"][] = $nsf_7.":00";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":10";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":15";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":25";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":30";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":40";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":45";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":55";
                            $data2["b"][] = 5;
                        }
                        for($i = 1; $i <= ($num*$hour); $i++){
                            if($data2["b"][(($i-1)+$i)] == 5){
                                $zz = "E_".$i;
                            }
                            if($data2["b"][(($i-2)+$i)] == 0){
                                $zx = "S_".$i;
                            }
                            $data[$zx] =  $data2["a"][(($i-2)+$i)];
                            $data[$zz] =  $data2["a"][(($i-1)+$i)];
                        }
                    }
                    if($off_7 == 10){
                        $num = 3;
                        for($i = 1; $i <= $hour; $i++){
                            if($i == 1){
                                if($s_7 < 10){ $nsf_7 = "0".strval($s_7); }else{$nsf_7 = $s_7;}
                            }else{
                                if($s_7+($i-1) < 10){ $nsf_7 = "0".strval($s_7+($i-1)); }else{$nsf_7 = $s_7+($i-1);}
                            }
                            $data2["a"][] = $nsf_7.":00";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":10";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":20";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":30";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":40";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":50";
                            $data2["b"][] = 5;
                        }
                        for($i = 1; $i <= ($num*$hour); $i++){
                            if($data2["b"][(($i-1)+$i)] == 5){
                                $zz = "E_".$i;
                            }
                            if($data2["b"][(($i-2)+$i)] == 0){
                                $zx = "S_".$i;
                            }
                            $data[$zx] =  $data2["a"][(($i-2)+$i)];
                            $data[$zz] =  $data2["a"][(($i-1)+$i)];
                        }
                    }
                    if($off_7 == 15){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":10";
                            $data["S_2"] = $ns_7.":25";
                            $data["E_2"] = $ns_7.":35";
                            $data["S_3"] = $ns_7.":50";
                            $data["E_3"] = $ns2_7.":00";
                        }if($hour >= 2){
                            $data["S_4"] = $ns2_7.":15";
                            $data["E_4"] = $ns2_7.":25";
                            $data["S_5"] = $ns2_7.":40";
                            $data["E_5"] = $ns2_7.":50";
                        }if($hour >= 3){
                            $data["S_6"] = $ns3_7.":05";
                            $data["E_6"] = $ns3_7.":15";
                            $data["S_7"] = $ns3_7.":30";
                            $data["E_7"] = $ns3_7.":40";
                        }if($hour >= 4){
                            $data["S_8"] = $ns3_7.":55";
                            $data["E_8"] = $ns4_7.":05";
                            $data["S_9"] = $ns4_7.":20";
                            $data["E_9"] = $ns4_7.":30";
                            $data["S_10"] = $ns4_7.":45";
                            $data["E_10"] = $ns4_7.":55";
                        }if($hour >= 5){
                            $data["S_11"] = $ns5_7.":10";
                            $data["E_11"] = $ns5_7.":20";
                            $data["S_12"] = $ns5_7.":35";
                            $data["E_12"] = $ns5_7.":45";
                        }if($hour >= 6){
                            $data["S_13"] = $ns6_7.":00";
                            $data["E_13"] = $ns6_7.":10";
                            $data["S_14"] = $ns6_7.":25";
                            $data["E_14"] = $ns6_7.":35";
                            $data["S_15"] = $ns6_7.":50";
                            $data["E_15"] = $ns7_7.":00";
                        }if($hour >= 7){
                            $data["S_16"] = $ns7_7.":15";
                            $data["E_16"] = $ns7_7.":25";
                            $data["S_17"] = $ns7_7.":40";
                            $data["E_17"] = $ns7_7.":50";
                        }if($hour >= 8){
                            $data["S_18"] = $ns8_7.":05";
                            $data["E_18"] = $ns8_7.":15";
                            $data["S_19"] = $ns8_7.":30";
                            $data["E_19"] = $ns8_7.":40";
                        }if($hour >= 9){
                            $data["S_20"] = $ns8_7.":55";
                            $data["E_20"] = $ns9_7.":05";
                            $data["S_21"] = $ns9_7.":20";
                            $data["E_21"] = $ns9_7.":30";
                            $data["S_22"] = $ns9_7.":45";
                            $data["E_22"] = $ns9_7.":55";
                        }if($hour >= 10){
                            $data["S_23"] = $ns10_7.":10";
                            $data["E_23"] = $ns10_7.":20";
                            $data["S_24"] = $ns10_7.":35";
                            $data["E_24"] = $ns10_7.":45";
                        }if($hour >= 11){
                            $data["S_25"] = $ns11_7.":00";
                            $data["E_25"] = $ns11_7.":10";
                            $data["S_26"] = $ns11_7.":25";
                            $data["E_26"] = $ns11_7.":35";
                            $data["S_27"] = $ns11_7.":50";
                            $data["E_27"] = $ns12_7.":00";
                        }if($hour >= 12){
                            $data["S_28"] = $ns12_7.":15";
                            $data["E_28"] = $ns12_7.":25";
                            $data["S_29"] = $ns12_7.":40";
                            $data["E_29"] = $ns12_7.":50";
                        }
                    }
                    if($off_7 == 20){
                        $num = 2;
                        for($i = 1; $i <= $hour; $i++){
                            if($i == 1){
                                if($s_7 < 10){ $nsf_7 = "0".strval($s_7); }else{$nsf_7 = $s_7;}
                            }else{
                                if($s_7+($i-1) < 10){ $nsf_7 = "0".strval($s_7+($i-1)); }else{$nsf_7 = $s_7+($i-1);}
                            }
                            $data2["a"][] = $nsf_7.":00";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":10";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":30";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":40";
                            $data2["b"][] = 5;
                        }
                        for($i = 1; $i <= ($num*$hour); $i++){
                            if($data2["b"][(($i-1)+$i)] == 5){
                                $zz = "E_".$i;
                            }
                            if($data2["b"][(($i-2)+$i)] == 0){
                                $zx = "S_".$i;
                            }
                            $data[$zx] =  $data2["a"][(($i-2)+$i)];
                            $data[$zz] =  $data2["a"][(($i-1)+$i)];
                        }
                    }
                    if($off_7 == 25){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":10";
                            $data["S_2"] = $ns_7.":35";
                            $data["E_2"] = $ns_7.":45";
                        }if($hour >= 2){
                            $data["S_3"] = $ns2_7.":10";
                            $data["E_3"] = $ns2_7.":20";
                            $data["S_4"] = $ns2_7.":45";
                            $data["E_4"] = $ns2_7.":55";
                        }if($hour >= 3){
                            $data["S_5"] = $ns3_7.":20";
                            $data["E_5"] = $ns3_7.":30";
                        }if($hour >= 4){
                            $data["S_6"] = $ns3_7.":55";
                            $data["E_6"] = $ns4_7.":05";
                            $data["S_7"] = $ns4_7.":30";
                            $data["E_7"] = $ns4_7.":40";
                        }if($hour >= 5){
                            $data["S_8"] = $ns5_7.":05";
                            $data["E_8"] = $ns5_7.":15";
                            $data["S_9"] = $ns5_7.":40";
                            $data["E_9"] = $ns5_7.":50";
                        }if($hour >= 6){
                            $data["S_10"] = $ns6_7.":15";
                            $data["E_10"] = $ns6_7.":25";
                            $data["S_11"] = $ns6_7.":50";
                            $data["E_11"] = $ns7_7.":00";
                        }if($hour >= 7){
                            $data["S_12"] = $ns7_7.":25";
                            $data["E_12"] = $ns7_7.":35";
                        }if($hour >= 8){
                            $data["S_13"] = $ns8_7.":00";
                            $data["E_13"] = $ns8_7.":10";
                            $data["S_14"] = $ns8_7.":35";
                            $data["E_14"] = $ns8_7.":45";
                        }if($hour >= 9){
                            $data["S_15"] = $ns9_7.":10";
                            $data["E_15"] = $ns9_7.":20";
                            $data["S_16"] = $ns9_7.":45";
                            $data["E_16"] = $ns9_7.":55";
                        }if($hour >= 10){
                            $data["S_17"] = $ns10_7.":20";
                            $data["E_17"] = $ns10_7.":30";
                        }if($hour >= 11){
                            $data["S_18"] = $ns10_7.":55";
                            $data["E_18"] = $ns11_7.":05";
                            $data["S_19"] = $ns11_7.":30";
                            $data["E_19"] = $ns11_7.":40";
                        }if($hour >= 12){
                            $data["S_20"] = $ns12_7.":05";
                            $data["E_20"] = $ns12_7.":15";
                            $data["S_21"] = $ns12_7.":40";
                            $data["E_21"] = $ns12_7.":50";
                        }
                    }
                    if($off_7 == 30){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":10";
                            $data["S_2"] = $ns_7.":40";
                            $data["E_2"] = $ns_7.":50";
                        }if($hour >= 2){
                            $data["S_3"] = $ns2_7.":20";
                            $data["E_3"] = $ns2_7.":30";
                        }if($hour >= 3){
                            $data["S_4"] = $ns3_7.":00";
                            $data["E_4"] = $ns3_7.":10";
                            $data["S_5"] = $ns3_7.":40";
                            $data["E_5"] = $ns3_7.":50";
                        }if($hour >= 4){
                            $data["S_6"] = $ns4_7.":20";
                            $data["E_6"] = $ns4_7.":30";
                        }if($hour >= 5){
                            $data["S_7"] = $ns5_7.":00";
                            $data["E_7"] = $ns5_7.":10";
                            $data["S_8"] = $ns5_7.":40";
                            $data["E_8"] = $ns5_7.":50";
                        }if($hour >= 6){
                            $data["S_9"] = $ns6_7.":20";
                            $data["E_9"] = $ns6_7.":30";
                        }if($hour >= 7){
                            $data["S_10"] = $ns7_7.":00";
                            $data["E_10"] = $ns7_7.":10";
                            $data["S_11"] = $ns7_7.":40";
                            $data["E_11"] = $ns7_7.":50";
                        }if($hour >= 8){
                            $data["S_12"] = $ns8_7.":20";
                            $data["E_12"] = $ns8_7.":30";
                        }if($hour >= 9){
                            $data["S_13"] = $ns9_7.":00";
                            $data["E_13"] = $ns9_7.":10";
                            $data["S_14"] = $ns9_7.":40";
                            $data["E_14"] = $ns9_7.":50";
                        }if($hour >= 10){
                            $data["S_15"] = $ns10_7.":20";
                            $data["E_15"] = $ns10_7.":30";
                        }if($hour >= 11){
                            $data["S_16"] = $ns11_7.":00";
                            $data["E_16"] = $ns11_7.":10";
                            $data["S_17"] = $ns11_7.":40";
                            $data["E_17"] = $ns11_7.":50";
                        }if($hour >= 12){
                            $data["S_18"] = $ns12_7.":20";
                            $data["E_18"] = $ns12_7.":30";
                        }
                    }
                }if($on_7 == 15){
                    if($off_7 == 5){
                        $num = 3;
                        for($i = 1; $i <= $hour; $i++){
                            if($i == 1){
                                if($s_7 < 10){ $nsf_7 = "0".strval($s_7); }else{$nsf_7 = $s_7;}
                            }else{
                                if($s_7+($i-1) < 10){ $nsf_7 = "0".strval($s_7+($i-1)); }else{$nsf_7 = $s_7+($i-1);}
                            }
                            $data2["a"][] = $nsf_7.":00";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":15";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":20";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":35";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":40";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":55";
                            $data2["b"][] = 5;
                        }
                        for($i = 1; $i <= ($num*$hour); $i++){
                            if($data2["b"][(($i-1)+$i)] == 5){
                                $zz = "E_".$i;
                            }
                            if($data2["b"][(($i-2)+$i)] == 0){
                                $zx = "S_".$i;
                            }
                            $data[$zx] =  $data2["a"][(($i-2)+$i)];
                            $data[$zz] =  $data2["a"][(($i-1)+$i)];
                        }
                    }
                    if($off_7 == 10){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":15";
                            $data["S_2"] = $ns_7.":25";
                            $data["E_2"] = $ns_7.":40";
                        }if($hour >= 2){
                            $data["S_3"] = $ns_7.":50";
                            $data["E_3"] = $ns2_7.":05";
                            $data["S_4"] = $ns2_7.":15";
                            $data["E_4"] = $ns2_7.":30";
                            $data["S_5"] = $ns2_7.":40";
                            $data["E_5"] = $ns2_7.":55";
                        }if($hour >= 3){
                            $data["S_6"] = $ns3_7.":05";
                            $data["E_6"] = $ns3_7.":20";
                            $data["S_7"] = $ns3_7.":30";
                            $data["E_7"] = $ns3_7.":45";
                        }if($hour >= 4){
                            $data["S_8"] = $ns3_7.":55";
                            $data["E_8"] = $ns4_7.":10";
                            $data["S_9"] = $ns4_7.":20";
                            $data["E_9"] = $ns4_7.":35";
                            $data["S_10"] = $ns4_7.":45";
                            $data["E_10"] = $ns5_7.":00";
                        }if($hour >= 5){
                            $data["S_11"] = $ns5_7.":10";
                            $data["E_11"] = $ns5_7.":25";
                            $data["S_12"] = $ns5_7.":35";
                            $data["E_12"] = $ns5_7.":50";
                        }if($hour >= 6){
                            $data["S_13"] = $ns6_7.":00";
                            $data["E_13"] = $ns6_7.":15";
                            $data["S_14"] = $ns6_7.":25";
                            $data["E_14"] = $ns6_7.":40";
                        }if($hour >= 7){
                            $data["S_15"] = $ns6_7.":50";
                            $data["E_15"] = $ns7_7.":05";
                            $data["S_16"] = $ns7_7.":15";
                            $data["E_16"] = $ns7_7.":30";
                            $data["S_17"] = $ns7_7.":40";
                            $data["E_17"] = $ns7_7.":55";
                        }if($hour >= 8){
                            $data["S_18"] = $ns8_7.":05";
                            $data["E_18"] = $ns8_7.":20";
                            $data["S_19"] = $ns8_7.":30";
                            $data["E_19"] = $ns8_7.":45";
                        }if($hour >= 9){
                            $data["S_20"] = $ns8_7.":55";
                            $data["E_20"] = $ns9_7.":10";
                            $data["S_21"] = $ns9_7.":20";
                            $data["E_21"] = $ns9_7.":35";
                            $data["S_22"] = $ns9_7.":45";
                            $data["E_22"] = $ns10_7.":00";
                        }if($hour >= 10){
                            $data["S_23"] = $ns10_7.":10";
                            $data["E_23"] = $ns10_7.":25";
                            $data["S_24"] = $ns10_7.":35";
                            $data["E_24"] = $ns10_7.":50";
                        }if($hour >= 11){
                            $data["S_25"] = $ns11_7.":00";
                            $data["E_25"] = $ns11_7.":15";
                            $data["S_26"] = $ns11_7.":25";
                            $data["E_26"] = $ns11_7.":40";
                        }if($hour >= 12){
                            $data["S_27"] = $ns11_7.":50";
                            $data["E_27"] = $ns12_7.":05";
                            $data["S_28"] = $ns12_7.":15";
                            $data["E_28"] = $ns12_7.":30";
                            $data["S_29"] = $ns12_7.":40";
                            $data["E_29"] = $ns12_7.":55";
                        }
                    }
                    if($off_7 == 15){
                        $num = 2;
                        for($i = 1; $i <= $hour; $i++){
                            if($i == 1){
                                if($s_7 < 10){ $nsf_7 = "0".strval($s_7); }else{$nsf_7 = $s_7;}
                            }else{
                                if($s_7+($i-1) < 10){ $nsf_7 = "0".strval($s_7+($i-1)); }else{$nsf_7 = $s_7+($i-1);}
                            }
                            $data2["a"][] = $nsf_7.":00";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":15";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":30";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":45";
                            $data2["b"][] = 5;
                        }
                        for($i = 1; $i <= ($num*$hour); $i++){
                            if($data2["b"][(($i-1)+$i)] == 5){
                                $zz = "E_".$i;
                            }
                            if($data2["b"][(($i-2)+$i)] == 0){
                                $zx = "S_".$i;
                            }
                            $data[$zx] =  $data2["a"][(($i-2)+$i)];
                            $data[$zz] =  $data2["a"][(($i-1)+$i)];
                        }
                    }
                    if($off_7 == 20){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":15";
                            $data["S_2"] = $ns_7.":35";
                            $data["E_2"] = $ns_7.":50";
                        }if($hour >= 2){
                            $data["S_3"] = $ns2_7.":10";
                            $data["E_3"] = $ns2_7.":25";
                            $data["S_4"] = $ns2_7.":45";
                            $data["E_4"] = $ns3_7.":00";
                        }if($hour >= 3){
                            $data["S_5"] = $ns3_7.":20";
                            $data["E_5"] = $ns3_7.":30";
                        }if($hour >= 4){
                            $data["S_6"] = $ns3_7.":55";
                            $data["E_6"] = $ns4_7.":10";
                            $data["S_7"] = $ns4_7.":30";
                            $data["E_7"] = $ns4_7.":45";
                        }if($hour >= 5){
                            $data["S_8"] = $ns5_7.":05";
                            $data["E_8"] = $ns5_7.":20";
                            $data["S_9"] = $ns5_7.":40";
                            $data["E_9"] = $ns5_7.":55";
                        }if($hour >= 6){
                            $data["S_10"] = $ns6_7.":15";
                            $data["E_10"] = $ns6_7.":30";
                        }if($hour >= 7){
                            $data["S_11"] = $ns6_7.":50";
                            $data["E_11"] = $ns7_7.":05";
                            $data["S_12"] = $ns7_7.":25";
                            $data["E_12"] = $ns7_7.":40";
                        }if($hour >= 8){
                            $data["S_13"] = $ns8_7.":00";
                            $data["E_13"] = $ns8_7.":15";
                            $data["S_14"] = $ns8_7.":35";
                            $data["E_14"] = $ns8_7.":50";
                        }if($hour >= 9){
                            $data["S_15"] = $ns9_7.":10";
                            $data["E_15"] = $ns9_7.":25";
                            $data["S_16"] = $ns9_7.":45";
                            $data["E_16"] = $ns10_7.":00";
                        }if($hour >= 10){
                            $data["S_17"] = $ns10_7.":20";
                            $data["E_17"] = $ns10_7.":35";
                        }if($hour >= 11){
                            $data["S_18"] = $ns10_7.":55";
                            $data["E_18"] = $ns11_7.":10";
                            $data["S_19"] = $ns11_7.":30";
                            $data["E_19"] = $ns11_7.":45";
                        }if($hour >= 12){
                            $data["S_20"] = $ns12_7.":05";
                            $data["E_20"] = $ns12_7.":20";
                            $data["S_21"] = $ns12_7.":40";
                            $data["E_21"] = $ns12_7.":55";
                        }
                    }
                    if($off_7 == 25){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":15";
                            $data["S_2"] = $ns_7.":40";
                            $data["E_2"] = $ns_7.":55";
                        }if($hour >= 2){
                            $data["S_3"] = $ns2_7.":20";
                            $data["E_3"] = $ns2_7.":35";
                        }if($hour >= 3){
                            $data["S_4"] = $ns3_7.":00";
                            $data["E_4"] = $ns3_7.":15";
                            $data["S_5"] = $ns3_7.":40";
                            $data["E_5"] = $ns3_7.":55";
                        }if($hour >= 4){
                            $data["S_6"] = $ns4_7.":20";
                            $data["E_6"] = $ns4_7.":35";
                        }if($hour >= 5){
                            $data["S_7"] = $ns5_7.":00";
                            $data["E_7"] = $ns5_7.":15";
                            $data["S_8"] = $ns5_7.":40";
                            $data["E_8"] = $ns5_7.":55";
                        }if($hour >= 6){
                            $data["S_9"] = $ns6_7.":20";
                            $data["E_9"] = $ns6_7.":35";
                        }if($hour >= 7){
                            $data["S_10"] = $ns7_7.":00";
                            $data["E_10"] = $ns7_7.":15";
                            $data["S_11"] = $ns7_7.":40";
                            $data["E_11"] = $ns7_7.":55";
                        }if($hour >= 8){
                            $data["S_12"] = $ns8_7.":20";
                            $data["E_12"] = $ns8_7.":35";
                        }if($hour >= 9){
                            $data["S_13"] = $ns9_7.":00";
                            $data["E_13"] = $ns9_7.":15";
                            $data["S_14"] = $ns9_7.":40";
                            $data["E_14"] = $ns9_7.":55";
                        }if($hour >= 10){
                            $data["S_15"] = $ns10_7.":20";
                            $data["E_15"] = $ns10_7.":35";
                        }if($hour >= 11){
                            $data["S_16"] = $ns11_7.":00";
                            $data["E_16"] = $ns11_7.":15";
                            $data["S_17"] = $ns11_7.":40";
                            $data["E_17"] = $ns11_7.":55";
                        }if($hour >= 12){
                            $data["S_18"] = $ns12_7.":20";
                            $data["E_18"] = $ns12_7.":35";
                        }
                    }
                    if($off_7 == 30){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":15";
                            $data["S_2"] = $ns_7.":45";
                            $data["E_2"] = $ns2_7.":00";
                        }if($hour >= 2){
                            $data["S_3"] = $ns2_7.":30";
                            $data["E_3"] = $ns2_7.":45";
                        }if($hour >= 3){
                            $data["S_4"] = $ns3_7.":15";
                            $data["E_4"] = $ns3_7.":30";
                        }if($hour >= 4){
                            $data["S_5"] = $ns4_7.":00";
                            $data["E_5"] = $ns4_7.":15";
                            $data["S_6"] = $ns4_7.":45";
                            $data["E_6"] = $ns5_7.":00";
                        }if($hour >= 5){
                            $data["S_7"] = $ns5_7.":30";
                            $data["E_7"] = $ns5_7.":45";
                        }if($hour >= 6){
                            $data["S_8"] = $ns6_7.":15";
                            $data["E_8"] = $ns6_7.":30";
                        }if($hour >= 7){
                            $data["S_9"] = $ns7_7.":00";
                            $data["E_9"] = $ns7_7.":15";
                            $data["S_10"] = $ns7_7.":45";
                            $data["E_10"] = $ns8_7.":00";
                        }if($hour >= 8){
                            $data["S_11"] = $ns8_7.":30";
                            $data["E_11"] = $ns8_7.":45";
                        }if($hour >= 9){
                            $data["S_12"] = $ns9_7.":15";
                            $data["E_12"] = $ns9_7.":30";
                        }if($hour >= 10){
                            $data["S_13"] = $ns10_7.":00";
                            $data["E_13"] = $ns10_7.":15";
                            $data["S_14"] = $ns10_7.":45";
                            $data["E_14"] = $ns11_7.":00";
                        }if($hour >= 11){
                            $data["S_15"] = $ns11_7.":30";
                            $data["E_15"] = $ns11_7.":45";
                        }if($hour >= 12){
                            $data["S_16"] = $ns12_7.":15";
                            $data["E_16"] = $ns12_7.":30";
                        }
                    }
                }if($on_7 == 20){
                    if($off_7 == 5){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":20";
                            $data["S_2"] = $ns_7.":25";
                            $data["E_2"] = $ns_7.":45";
                        }if($hour >= 2){
                            $data["S_3"] = $ns_7.":50";
                            $data["E_3"] = $ns2_7.":10";
                            $data["S_4"] = $ns2_7.":15";
                            $data["E_4"] = $ns2_7.":35";
                            $data["S_5"] = $ns2_7.":40";
                            $data["E_5"] = $ns3_7.":00";
                        }if($hour >= 3){
                            $data["S_6"] = $ns3_7.":05";
                            $data["E_6"] = $ns3_7.":25";
                            $data["S_7"] = $ns3_7.":30";
                            $data["E_7"] = $ns3_7.":50";
                        }if($hour >= 4){
                            $data["S_8"] = $ns3_7.":55";
                            $data["E_8"] = $ns4_7.":15";
                            $data["S_9"] = $ns4_7.":20";
                            $data["E_9"] = $ns4_7.":40";
                        }if($hour >= 5){
                            $data["S_10"] = $ns4_7.":45";
                            $data["E_10"] = $ns5_7.":05";
                            $data["S_11"] = $ns5_7.":10";
                            $data["E_11"] = $ns5_7.":30";
                            $data["S_12"] = $ns5_7.":35";
                            $data["E_12"] = $ns5_7.":55";
                        }if($hour >= 6){
                            $data["S_13"] = $ns6_7.":00";
                            $data["E_13"] = $ns6_7.":20";
                            $data["S_14"] = $ns6_7.":25";
                            $data["E_14"] = $ns6_7.":45";
                        }if($hour >= 7){
                            $data["S_15"] = $ns6_7.":50";
                            $data["E_15"] = $ns7_7.":10";
                            $data["S_16"] = $ns7_7.":15";
                            $data["E_16"] = $ns7_7.":35";
                            $data["S_17"] = $ns7_7.":40";
                            $data["E_17"] = $ns8_7.":00";
                        }if($hour >= 8){
                            $data["S_18"] = $ns8_7.":05";
                            $data["E_18"] = $ns8_7.":25";
                            $data["S_19"] = $ns8_7.":30";
                            $data["E_19"] = $ns8_7.":50";
                        }if($hour >= 9){
                            $data["S_20"] = $ns8_7.":55";
                            $data["E_20"] = $ns9_7.":15";
                            $data["S_21"] = $ns9_7.":20";
                            $data["E_21"] = $ns9_7.":40";
                        }if($hour >= 10){
                            $data["S_22"] = $ns9_7.":45";
                            $data["E_22"] = $ns10_7.":05";
                            $data["S_23"] = $ns10_7.":10";
                            $data["E_23"] = $ns10_7.":30";
                            $data["S_24"] = $ns10_7.":35";
                            $data["E_24"] = $ns10_7.":55";
                        }if($hour >= 11){
                            $data["S_25"] = $ns11_7.":00";
                            $data["E_25"] = $ns11_7.":20";
                            $data["S_26"] = $ns11_7.":25";
                            $data["E_26"] = $ns11_7.":45";
                        }if($hour >= 12){
                            $data["S_27"] = $ns11_7.":50";
                            $data["E_27"] = $ns12_7.":10";
                            $data["S_28"] = $ns12_7.":15";
                            $data["E_28"] = $ns12_7.":35";
                            $data["S_29"] = $ns12_7.":40";
                            $data["E_29"] = $ns13_7.":00";
                        }
                    }
                    if($off_7 == 10){
                        $num = 2;
                        for($i = 1; $i <= $hour; $i++){
                            if($i == 1){
                                if($s_7 < 10){ $nsf_7 = "0".strval($s_7); }else{$nsf_7 = $s_7;}
                            }else{
                                if($s_7+($i-1) < 10){ $nsf_7 = "0".strval($s_7+($i-1)); }else{$nsf_7 = $s_7+($i-1);}
                            }
                            $data2["a"][] = $nsf_7.":00";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":20";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":30";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":50";
                            $data2["b"][] = 5;
                        }
                        for($i = 1; $i <= ($num*$hour); $i++){
                            if($data2["b"][(($i-1)+$i)] == 5){
                                $zz = "E_".$i;
                            }
                            if($data2["b"][(($i-2)+$i)] == 0){
                                $zx = "S_".$i;
                            }
                            $data[$zx] =  $data2["a"][(($i-2)+$i)];
                            $data[$zz] =  $data2["a"][(($i-1)+$i)];
                        }
                    }
                    if($off_7 == 15){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":20";
                            $data["S_2"] = $ns_7.":35";
                            $data["E_2"] = $ns_7.":55";
                        }if($hour >= 2){
                            $data["S_3"] = $ns2_7.":10";
                            $data["E_3"] = $ns2_7.":30";
                        }if($hour >= 3){
                            $data["S_4"] = $ns2_7.":45";
                            $data["E_4"] = $ns3_7.":05";
                            $data["S_5"] = $ns3_7.":20";
                            $data["E_5"] = $ns3_7.":40";
                        }if($hour >= 4){
                            $data["S_6"] = $ns3_7.":55";
                            $data["E_6"] = $ns4_7.":15";
                            $data["S_7"] = $ns4_7.":30";
                            $data["E_7"] = $ns4_7.":50";
                        }if($hour >= 5){
                            $data["S_8"] = $ns5_7.":05";
                            $data["E_8"] = $ns5_7.":25";
                            $data["S_9"] = $ns5_7.":40";
                            $data["E_9"] = $ns6_7.":00";
                        }if($hour >= 6){
                            $data["S_10"] = $ns6_7.":15";
                            $data["E_10"] = $ns6_7.":35";
                        }if($hour >= 7){
                            $data["S_11"] = $ns6_7.":50";
                            $data["E_11"] = $ns7_7.":10";
                            $data["S_12"] = $ns7_7.":25";
                            $data["E_12"] = $ns7_7.":45";
                        }if($hour >= 8){
                            $data["S_13"] = $ns8_7.":00";
                            $data["E_13"] = $ns8_7.":20";
                            $data["S_14"] = $ns8_7.":35";
                            $data["E_14"] = $ns8_7.":55";
                        }if($hour >= 9){
                            $data["S_15"] = $ns9_7.":10";
                            $data["E_15"] = $ns9_7.":30";
                        }if($hour >= 10){
                            $data["S_16"] = $ns9_7.":45";
                            $data["E_16"] = $ns10_7.":05";
                            $data["S_17"] = $ns10_7.":20";
                            $data["E_17"] = $ns10_7.":40";
                        }if($hour >= 11){
                            $data["S_18"] = $ns10_7.":55";
                            $data["E_18"] = $ns11_7.":15";
                            $data["S_19"] = $ns11_7.":30";
                            $data["E_19"] = $ns11_7.":50";
                        }if($hour >= 12){
                            $data["S_20"] = $ns12_7.":05";
                            $data["E_20"] = $ns12_7.":25";
                            $data["S_21"] = $ns12_7.":40";
                            $data["E_21"] = $ns13_7.":00";
                        }
                    }
                    if($off_7 == 20){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":20";
                            $data["S_2"] = $ns_7.":40";
                            $data["E_2"] = $ns2_7.":00";
                        }if($hour >= 2){
                            $data["S_3"] = $ns2_7.":20";
                            $data["E_3"] = $ns2_7.":40";
                        }if($hour >= 3){
                            $data["S_4"] = $ns3_7.":00";
                            $data["E_4"] = $ns3_7.":20";
                            $data["S_5"] = $ns3_7.":40";
                            $data["E_5"] = $ns4_7.":00";
                        }if($hour >= 4){
                            $data["S_6"] = $ns4_7.":20";
                            $data["E_6"] = $ns4_7.":40";
                        }if($hour >= 5){
                            $data["S_7"] = $ns5_7.":00";
                            $data["E_7"] = $ns5_7.":20";
                            $data["S_8"] = $ns5_7.":40";
                            $data["E_8"] = $ns6_7.":00";
                        }if($hour >= 6){
                            $data["S_9"] = $ns6_7.":20";
                            $data["E_9"] = $ns6_7.":40";
                        }if($hour >= 7){
                            $data["S_10"] = $ns7_7.":00";
                            $data["E_10"] = $ns7_7.":20";
                            $data["S_11"] = $ns7_7.":40";
                            $data["E_11"] = $ns8_7.":00";
                        }if($hour >= 8){
                            $data["S_12"] = $ns8_7.":20";
                            $data["E_12"] = $ns8_7.":40";
                        }if($hour >= 9){
                            $data["S_13"] = $ns9_7.":00";
                            $data["E_13"] = $ns9_7.":20";
                            $data["S_14"] = $ns9_7.":40";
                            $data["E_14"] = $ns10_7.":00";
                        }if($hour >= 10){
                            $data["S_15"] = $ns10_7.":20";
                            $data["E_15"] = $ns10_7.":40";
                        }if($hour >= 11){
                            $data["S_16"] = $ns11_7.":00";
                            $data["E_16"] = $ns11_7.":20";
                            $data["S_17"] = $ns11_7.":40";
                            $data["E_17"] = $ns12_7.":00";
                        }if($hour >= 12){
                            $data["S_18"] = $ns12_7.":20";
                            $data["E_18"] = $ns12_7.":40";
                        }
                    }
                    if($off_7 == 25){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":20";
                        }if($hour >= 2){
                            $data["S_2"] = $ns_7.":45";
                            $data["E_2"] = $ns2_7.":05";
                            $data["S_3"] = $ns2_7.":30";
                            $data["E_3"] = $ns2_7.":50";
                        }if($hour >= 3){
                            $data["S_4"] = $ns3_7.":15";
                            $data["E_4"] = $ns3_7.":35";
                        }if($hour >= 4){
                            $data["S_5"] = $ns4_7.":00";
                            $data["E_5"] = $ns4_7.":20";
                        }if($hour >= 5){
                            $data["S_6"] = $ns4_7.":45";
                            $data["E_6"] = $ns5_7.":05";
                            $data["S_7"] = $ns5_7.":30";
                            $data["E_7"] = $ns5_7.":50";
                        }if($hour >= 6){
                            $data["S_8"] = $ns6_7.":15";
                            $data["E_8"] = $ns6_7.":35";
                        }if($hour >= 7){
                            $data["S_9"] = $ns7_7.":00";
                            $data["E_9"] = $ns7_7.":20";
                        }if($hour >= 8){
                            $data["S_10"] = $ns7_7.":45";
                            $data["E_10"] = $ns8_7.":05";
                            $data["S_11"] = $ns8_7.":30";
                            $data["E_11"] = $ns8_7.":50";
                        }if($hour >= 9){
                            $data["S_12"] = $ns9_7.":15";
                            $data["E_12"] = $ns9_7.":35";
                        }if($hour >= 10){
                            $data["S_13"] = $ns10_7.":00";
                            $data["E_13"] = $ns10_7.":20";
                        }if($hour >= 11){
                            $data["S_14"] = $ns10_7.":45";
                            $data["E_14"] = $ns11_7.":05";
                            $data["S_15"] = $ns11_7.":30";
                            $data["E_15"] = $ns11_7.":50";
                        }if($hour >= 12){
                            $data["S_16"] = $ns12_7.":15";
                            $data["E_16"] = $ns12_7.":35";
                        }
                    }
                    if($off_7 == 30){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":20";
                        }if($hour >= 2){
                            $data["S_2"] = $ns_7.":50";
                            $data["E_2"] = $ns2_7.":10";
                            $data["S_3"] = $ns2_7.":40";
                            $data["E_3"] = $ns3_7.":00";
                        }if($hour >= 3){
                            $data["S_4"] = $ns3_7.":30";
                            $data["E_4"] = $ns3_7.":50";
                        }if($hour >= 4){
                            $data["S_5"] = $ns4_7.":20";
                            $data["E_5"] = $ns4_7.":40";
                        }if($hour >= 5){
                            $data["S_6"] = $ns5_7.":10";
                            $data["E_6"] = $ns5_7.":30";
                        }if($hour >= 6){
                            $data["S_7"] = $ns6_7.":00";
                            $data["E_7"] = $ns6_7.":20";
                        }if($hour >= 7){
                            $data["S_8"] = $ns6_7.":50";
                            $data["E_8"] = $ns7_7.":10";
                            $data["S_9"] = $ns7_7.":40";
                            $data["E_9"] = $ns8_7.":00";
                        }if($hour >= 8){
                            $data["S_10"] = $ns8_7.":30";
                            $data["E_10"] = $ns8_7.":50";
                        }if($hour >= 9){
                            $data["S_11"] = $ns9_7.":20";
                            $data["E_11"] = $ns9_7.":40";
                        }if($hour >= 10){
                            $data["S_12"] = $ns10_7.":10";
                            $data["E_12"] = $ns10_7.":30";
                        }if($hour >= 11){
                            $data["S_13"] = $ns11_7.":00";
                            $data["E_13"] = $ns11_7.":20";
                        }if($hour >= 12){
                            $data["S_14"] = $ns11_7.":50";
                            $data["E_14"] = $ns12_7.":10";
                            $data["S_15"] = $ns12_7.":40";
                            $data["E_15"] = $ns13_7.":00";
                        }
                    }
                }if($on_7 == 25){
                    if($off_7 == 5){
                        $num = 2;
                        for($i = 1; $i <= $hour; $i++){
                            if($i == 1){
                                if($s_7 < 10){ $nsf_7 = "0".strval($s_7); }else{$nsf_7 = $s_7;}
                            }else{
                                if($s_7+($i-1) < 10){ $nsf_7 = "0".strval($s_7+($i-1)); }else{$nsf_7 = $s_7+($i-1);}
                            }
                            $data2["a"][] = $nsf_7.":00";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":25";
                            $data2["b"][] = 5;
                            $data2["a"][] = $nsf_7.":30";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":55";
                            $data2["b"][] = 5;
                        }
                        for($i = 1; $i <= ($num*$hour); $i++){
                            if($data2["b"][(($i-1)+$i)] == 5){
                                $zz = "E_".$i;
                            }
                            if($data2["b"][(($i-2)+$i)] == 0){
                                $zx = "S_".$i;
                            }
                            $data[$zx] =  $data2["a"][(($i-2)+$i)];
                            $data[$zz] =  $data2["a"][(($i-1)+$i)];
                        }
                    }
                    if($off_7 == 10){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":25";
                            $data["S_2"] = $ns_7.":35";
                            $data["E_2"] = $ns2_7.":00";
                        }if($hour >= 2){
                            $data["S_3"] = $ns2_7.":10";
                            $data["E_3"] = $ns2_7.":35";
                        }if($hour >= 3){
                            $data["S_4"] = $ns2_7.":45";
                            $data["E_4"] = $ns3_7.":10";
                            $data["S_5"] = $ns3_7.":20";
                            $data["E_5"] = $ns3_7.":45";
                        }if($hour >= 4){
                            $data["S_6"] = $ns3_7.":55";
                            $data["E_6"] = $ns4_7.":20";
                            $data["S_7"] = $ns4_7.":30";
                            $data["E_7"] = $ns4_7.":55";
                        }if($hour >= 5){
                            $data["S_8"] = $ns5_7.":05";
                            $data["E_8"] = $ns5_7.":30";
                        }if($hour >= 6){
                            $data["S_9"] = $ns5_7.":40";
                            $data["E_9"] = $ns6_7.":05";
                            $data["S_10"] = $ns6_7.":15";
                            $data["E_10"] = $ns6_7.":40";
                        }if($hour >= 7){
                            $data["S_11"] = $ns6_7.":50";
                            $data["E_11"] = $ns7_7.":15";
                            $data["S_12"] = $ns7_7.":25";
                            $data["E_12"] = $ns7_7.":50";
                        }if($hour >= 8){
                            $data["S_13"] = $ns8_7.":00";
                            $data["E_13"] = $ns8_7.":25";
                            $data["S_14"] = $ns8_7.":35";
                            $data["E_14"] = $ns9_7.":00";
                        }if($hour >= 9){
                            $data["S_15"] = $ns9_7.":10";
                            $data["E_15"] = $ns9_7.":35";
                        }if($hour >= 10){
                            $data["S_16"] = $ns9_7.":45";
                            $data["E_16"] = $ns10_7.":10";
                            $data["S_17"] = $ns10_7.":20";
                            $data["E_17"] = $ns10_7.":45";
                        }if($hour >= 11){
                            $data["S_18"] = $ns10_7.":55";
                            $data["E_18"] = $ns11_7.":20";
                            $data["S_19"] = $ns11_7.":30";
                            $data["E_19"] = $ns11_7.":55";
                        }if($hour >= 12){
                            $data["S_20"] = $ns12_7.":05";
                            $data["E_20"] = $ns12_7.":30";
                        }
                    }
                    if($off_7 == 15){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":25";
                        }if($hour >= 2){
                            $data["S_2"] = $ns_7.":40";
                            $data["E_2"] = $ns2_7.":05";
                            $data["S_3"] = $ns2_7.":20";
                            $data["E_3"] = $ns2_7.":45";
                        }if($hour >= 3){
                            $data["S_4"] = $ns3_7.":00";
                            $data["E_4"] = $ns3_7.":25";
                        }if($hour >= 4){
                            $data["S_5"] = $ns3_7.":40";
                            $data["E_5"] = $ns4_7.":05";
                            $data["S_6"] = $ns4_7.":20";
                            $data["E_6"] = $ns4_7.":45";
                        }if($hour >= 5){
                            $data["S_7"] = $ns5_7.":00";
                            $data["E_7"] = $ns5_7.":25";
                        }if($hour >= 6){
                            $data["S_8"] = $ns5_7.":40";
                            $data["E_8"] = $ns6_7.":05";
                            $data["S_9"] = $ns6_7.":20";
                            $data["E_9"] = $ns6_7.":45";
                        }if($hour >= 7){
                            $data["S_10"] = $ns7_7.":00";
                            $data["E_10"] = $ns7_7.":25";
                        }if($hour >= 8){
                            $data["S_11"] = $ns7_7.":40";
                            $data["E_11"] = $ns8_7.":05";
                            $data["S_12"] = $ns8_7.":20";
                            $data["E_12"] = $ns8_7.":45";
                        }if($hour >= 9){
                            $data["S_13"] = $ns9_7.":00";
                            $data["E_13"] = $ns9_7.":25";
                        }if($hour >= 10){
                            $data["S_14"] = $ns9_7.":40";
                            $data["E_14"] = $ns10_7.":05";
                            $data["S_15"] = $ns10_7.":20";
                            $data["E_15"] = $ns10_7.":45";
                        }if($hour >= 11){
                            $data["S_16"] = $ns11_7.":00";
                            $data["E_16"] = $ns11_7.":25";
                        }if($hour >= 12){
                            $data["S_17"] = $ns11_7.":40";
                            $data["E_17"] = $ns12_7.":05";
                            $data["S_18"] = $ns12_7.":20";
                            $data["E_18"] = $ns12_7.":45";
                        }
                    }
                    if($off_7 == 20){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":25";
                        }if($hour >= 2){
                            $data["S_2"] = $ns_7.":45";
                            $data["E_2"] = $ns2_7.":10";
                            $data["S_3"] = $ns2_7.":30";
                            $data["E_3"] = $ns2_7.":55";
                        }if($hour >= 3){
                            $data["S_4"] = $ns3_7.":15";
                            $data["E_4"] = $ns3_7.":40";
                        }if($hour >= 4){
                            $data["S_5"] = $ns4_7.":00";
                            $data["E_5"] = $ns4_7.":25";
                        }if($hour >= 5){
                            $data["S_6"] = $ns4_7.":45";
                            $data["E_6"] = $ns5_7.":10";
                            $data["S_7"] = $ns5_7.":30";
                            $data["E_7"] = $ns5_7.":55";
                        }if($hour >= 6){
                            $data["S_8"] = $ns6_7.":15";
                            $data["E_8"] = $ns6_7.":40";
                        }if($hour >= 7){
                            $data["S_9"] = $ns7_7.":00";
                            $data["E_9"] = $ns6_7.":25";
                        }if($hour >= 8){
                            $data["S_10"] = $ns7_7.":45";
                            $data["E_10"] = $ns8_7.":10";
                            $data["S_11"] = $ns8_7.":30";
                            $data["E_11"] = $ns8_7.":55";
                        }if($hour >= 9){
                            $data["S_12"] = $ns9_7.":15";
                            $data["E_12"] = $ns9_7.":40";
                        }if($hour >= 10){
                            $data["S_13"] = $ns10_7.":00";
                            $data["E_13"] = $ns10_7.":25";
                        }if($hour >= 11){
                            $data["S_14"] = $ns10_7.":45";
                            $data["E_14"] = $ns11_7.":10";
                            $data["S_15"] = $ns11_7.":30";
                            $data["E_15"] = $ns11_7.":55";
                        }if($hour >= 12){
                            $data["S_16"] = $ns12_7.":15";
                            $data["E_16"] = $ns12_7.":40";
                        }
                    }
                    if($off_7 == 25){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":25";
                        }if($hour >= 2){
                            $data["S_2"] = $ns_7.":50";
                            $data["E_2"] = $ns2_7.":15";
                        }if($hour >= 3){
                            $data["S_3"] = $ns2_7.":40";
                            $data["E_3"] = $ns3_7.":05";
                            $data["S_4"] = $ns3_7.":30";
                            $data["E_4"] = $ns3_7.":55";
                        }if($hour >= 4){
                            $data["S_5"] = $ns4_7.":20";
                            $data["E_5"] = $ns4_7.":45";
                        }if($hour >= 5){
                            $data["S_6"] = $ns5_7.":10";
                            $data["E_6"] = $ns5_7.":35";
                        }if($hour >= 6){
                            $data["S_7"] = $ns6_7.":00";
                            $data["E_7"] = $ns6_7.":25";
                        }if($hour >= 7){
                            $data["S_8"] = $ns6_7.":50";
                            $data["E_8"] = $ns7_7.":15";
                        }if($hour >= 8){
                            $data["S_9"] = $ns7_7.":40";
                            $data["E_9"] = $ns8_7.":05";
                            $data["S_10"] = $ns8_7.":30";
                            $data["E_10"] = $ns8_7.":55";
                        }if($hour >= 9){
                            $data["S_11"] = $ns9_7.":20";
                            $data["E_11"] = $ns9_7.":45";
                        }if($hour >= 10){
                            $data["S_12"] = $ns10_7.":10";
                            $data["E_12"] = $ns10_7.":35";
                        }if($hour >= 11){
                            $data["S_13"] = $ns11_7.":00";
                            $data["E_13"] = $ns11_7.":25";
                        }if($hour >= 12){
                            $data["S_14"] = $ns11_7.":50";
                            $data["E_14"] = $ns12_7.":15";
                        }
                    }
                    if($off_7 == 30){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":25";
                        }if($hour >= 2){
                            $data["S_2"] = $ns_7.":55";
                            $data["E_2"] = $ns2_7.":20";
                        }if($hour >= 3){
                            $data["S_3"] = $ns2_7.":50";
                            $data["E_3"] = $ns3_7.":15";
                        }if($hour >= 4){
                            $data["S_4"] = $ns3_7.":45";
                            $data["E_4"] = $ns4_7.":10";
                        }if($hour >= 5){
                            $data["S_5"] = $ns4_7.":40";
                            $data["E_5"] = $ns5_7.":05";
                            $data["S_6"] = $ns5_7.":35";
                            $data["E_6"] = $ns6_7.":00";
                        }if($hour >= 6){
                            $data["S_7"] = $ns6_7.":30";
                            $data["E_7"] = $ns6_7.":55";
                        }if($hour >= 7){
                            $data["S_8"] = $ns7_7.":25";
                            $data["E_8"] = $ns7_7.":50";
                        }if($hour >= 8){
                            $data["S_9"] = $ns8_7.":20";
                            $data["E_9"] = $ns8_7.":45";
                        }if($hour >= 9){
                            $data["S_10"] = $ns9_7.":15";
                            $data["E_10"] = $ns9_7.":40";
                        }if($hour >= 10){
                            $data["S_11"] = $ns10_7.":10";
                            $data["E_11"] = $ns10_7.":35";
                        }if($hour >= 11){
                            $data["S_12"] = $ns11_7.":05";
                            $data["E_12"] = $ns11_7.":30";
                        }if($hour >= 12){
                            $data["S_13"] = $ns12_7.":00";
                            $data["E_13"] = $ns12_7.":25";
                        }
                    }
                }if($on_7 == 30){
                    if($off_7 == 5){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":30";
                        }if($hour >= 2){
                            $data["S_2"] = $ns_7.":35";
                            $data["E_2"] = $ns2_7.":05";
                            $data["S_3"] = $ns2_7.":10";
                            $data["E_3"] = $ns2_7.":40";
                        }if($hour >= 3){
                            $data["S_4"] = $ns2_7.":45";
                            $data["E_4"] = $ns3_7.":15";
                            $data["S_5"] = $ns3_7.":20";
                            $data["E_5"] = $ns3_7.":50";
                        }if($hour >= 4){
                            $data["S_6"] = $ns3_7.":55";
                            $data["E_6"] = $ns4_7.":25";
                            $data["S_7"] = $ns4_7.":30";
                            $data["E_7"] = $ns5_7.":00";
                        }if($hour >= 5){
                            $data["S_8"] = $ns5_7.":05";
                            $data["E_8"] = $ns5_7.":35";
                        }if($hour >= 6){
                            $data["S_9"] = $ns5_7.":40";
                            $data["E_9"] = $ns6_7.":10";
                            $data["S_10"] = $ns6_7.":15";
                            $data["E_10"] = $ns6_7.":45";
                        }if($hour >= 7){
                            $data["S_11"] = $ns6_7.":50";
                            $data["E_11"] = $ns7_7.":20";
                            $data["S_12"] = $ns7_7.":25";
                            $data["E_12"] = $ns7_7.":55";
                        }if($hour >= 8){
                            $data["S_13"] = $ns8_7.":00";
                            $data["E_13"] = $ns8_7.":30";
                        }if($hour >= 9){
                            $data["S_14"] = $ns8_7.":35";
                            $data["E_14"] = $ns9_7.":05";
                            $data["S_15"] = $ns9_7.":10";
                            $data["E_15"] = $ns9_7.":40";
                        }if($hour >= 10){
                            $data["S_16"] = $ns9_7.":45";
                            $data["E_16"] = $ns10_7.":15";
                            $data["S_17"] = $ns10_7.":20";
                            $data["E_17"] = $ns10_7.":50";
                        }if($hour >= 11){
                            $data["S_18"] = $ns10_7.":55";
                            $data["E_18"] = $ns11_7.":25";
                            $data["S_19"] = $ns11_7.":30";
                            $data["E_19"] = $ns12_7.":00";
                        }if($hour >= 12){
                            $data["S_20"] = $ns12_7.":05";
                            $data["E_20"] = $ns12_7.":35";
                        }
                    }
                    if($off_7 == 10){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":30";
                        }if($hour >= 2){
                            $data["S_2"] = $ns_7.":40";
                            $data["E_2"] = $ns2_7.":10";
                            $data["S_3"] = $ns2_7.":20";
                            $data["E_3"] = $ns2_7.":50";
                        }if($hour >= 3){
                            $data["S_4"] = $ns3_7.":00";
                            $data["E_4"] = $ns3_7.":30";
                        }if($hour >= 4){
                            $data["S_5"] = $ns3_7.":40";
                            $data["E_5"] = $ns4_7.":10";
                            $data["S_6"] = $ns4_7.":20";
                            $data["E_6"] = $ns4_7.":50";
                        }if($hour >= 5){
                            $data["S_7"] = $ns5_7.":00";
                            $data["E_7"] = $ns5_7.":30";
                        }if($hour >= 6){
                            $data["S_8"] = $ns5_7.":40";
                            $data["E_8"] = $ns6_7.":10";
                            $data["S_9"] = $ns6_7.":20";
                            $data["E_9"] = $ns6_7.":50";
                        }if($hour >= 7){
                            $data["S_10"] = $ns7_7."00";
                            $data["E_10"] = $ns7_7.":30";
                        }if($hour >= 8){
                            $data["S_11"] = $ns7_7.":40";
                            $data["E_11"] = $ns8_7.":10";
                            $data["S_12"] = $ns8_7.":20";
                            $data["E_12"] = $ns8_7.":50";
                        }if($hour >= 9){
                            $data["S_13"] = $ns9_7.":00";
                            $data["E_13"] = $ns9_7.":30";
                        }if($hour >= 10){
                            $data["S_14"] = $ns9_7.":40";
                            $data["E_14"] = $ns10_7.":10";
                            $data["S_15"] = $ns10_7.":20";
                            $data["E_15"] = $ns10_7.":50";
                        }if($hour >= 11){
                            $data["S_16"] = $ns11_7.":00";
                            $data["E_16"] = $ns11_7.":30";
                        }if($hour >= 12){
                            $data["S_17"] = $ns11_7.":40";
                            $data["E_17"] = $ns12_7.":10";
                            $data["S_18"] = $ns12_7.":20";
                            $data["E_18"] = $ns12_7.":50";
                        }
                    }
                    if($off_7 == 15){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":30";
                        }if($hour >= 2){
                            $data["S_2"] = $ns_7.":45";
                            $data["E_2"] = $ns2_7.":15";
                            $data["S_3"] = $ns2_7.":30";
                            $data["E_3"] = $ns3_7.":00";
                        }if($hour >= 3){
                            $data["S_4"] = $ns3_7.":15";
                            $data["E_4"] = $ns3_7.":45";
                        }if($hour >= 4){
                            $data["S_5"] = $ns4_7.":00";
                            $data["E_5"] = $ns4_7.":30";
                        }if($hour >= 5){
                            $data["S_6"] = $ns4_7.":45";
                            $data["E_6"] = $ns5_7.":15";
                            $data["S_7"] = $ns5_7.":30";
                            $data["E_7"] = $ns6_7.":00";
                        }if($hour >= 6){
                            $data["S_8"] = $ns6_7.":15";
                            $data["E_8"] = $ns6_7.":45";
                        }if($hour >= 7){
                            $data["S_9"] = $ns7_7.":00";
                            $data["E_9"] = $ns7_7.":30";
                        }if($hour >= 8){
                            $data["S_10"] = $ns7_7.":45";
                            $data["E_10"] = $ns8_7.":15";
                            $data["S_11"] = $ns8_7.":30";
                            $data["E_11"] = $ns9_7.":00";
                        }if($hour >= 9){
                            $data["S_12"] = $ns9_7.":15";
                            $data["E_12"] = $ns9_7.":45";
                        }if($hour >= 10){
                            $data["S_13"] = $ns10_7.":00";
                            $data["E_13"] = $ns10_7.":30";
                        }if($hour >= 11){
                            $data["S_14"] = $ns10_7.":45";
                            $data["E_14"] = $ns11_7.":15";
                            $data["S_15"] = $ns11_7.":30";
                            $data["E_15"] = $ns12_7.":00";
                        }if($hour >= 12){
                            $data["S_16"] = $ns12_7.":15";
                            $data["E_16"] = $ns12_7.":45";
                        }
                    }
                    if($off_7 == 20){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":30";
                        }if($hour >= 2){
                            $data["S_2"] = $ns_7.":50";
                            $data["E_2"] = $ns2_7.":20";
                        }if($hour >= 3){
                            $data["S_3"] = $ns2_7.":40";
                            $data["E_3"] = $ns3_7.":10";
                            $data["S_4"] = $ns3_7.":30";
                            $data["E_4"] = $ns4_7.":00";
                        }if($hour >= 4){
                            $data["S_5"] = $ns4_7.":20";
                            $data["E_5"] = $ns4_7.":50";
                        }if($hour >= 5){
                            $data["S_6"] = $ns5_7.":10";
                            $data["E_6"] = $ns5_7.":40";
                        }if($hour >= 6){
                            $data["S_7"] = $ns6_7.":00";
                            $data["E_7"] = $ns6_7.":30";
                        }if($hour >= 7){
                            $data["S_8"] = $ns6_7.":50";
                            $data["E_8"] = $ns7_7.":20";
                        }if($hour >= 8){
                            $data["S_9"] = $ns7_7.":40";
                            $data["E_9"] = $ns8_7.":10";
                            $data["S_10"] = $ns8_7.":30";
                            $data["E_10"] = $ns9_7.":00";
                        }if($hour >= 9){
                            $data["S_11"] = $ns9_7.":20";
                            $data["E_11"] = $ns9_7.":50";
                        }if($hour >= 10){
                            $data["S_12"] = $ns10_7.":10";
                            $data["E_12"] = $ns10_7.":40";
                        }if($hour >= 11){
                            $data["S_13"] = $ns11_7.":00";
                            $data["E_13"] = $ns11_7.":30";
                        }if($hour >= 12){
                            $data["S_14"] = $ns11_7.":50";
                            $data["E_14"] = $ns12_7.":20";
                        }
                    }
                    if($off_7 == 25){
                        if($hour >= 1){
                            $data["S_1"] = $ns_7.":00";
                            $data["E_1"] = $ns_7.":30";
                        }if($hour >= 2){
                            $data["S_2"] = $ns_7.":55";
                            $data["E_2"] = $ns2_7.":25";
                        }if($hour >= 3){
                            $data["S_3"] = $ns2_7.":50";
                            $data["E_3"] = $ns3_7.":20";
                        }if($hour >= 4){
                            $data["S_4"] = $ns3_7.":45";
                            $data["E_4"] = $ns4_7.":15";
                        }if($hour >= 5){
                            $data["S_5"] = $ns4_7.":40";
                            $data["E_5"] = $ns5_7.":10";
                        }if($hour >= 6){
                            $data["S_6"] = $ns5_7.":35";
                            $data["E_6"] = $ns6_7.":05";
                            $data["S_7"] = $ns6_7.":30";
                            $data["E_7"] = $ns7_7.":00";
                        }if($hour >= 7){
                            $data["S_8"] = $ns7_7.":25";
                            $data["E_8"] = $ns7_7.":55";
                        }if($hour >= 8){
                            $data["S_9"] = $ns8_7.":20";
                            $data["E_9"] = $ns8_7.":50";
                        }if($hour >= 9){
                            $data["S_10"] = $ns9_7.":15";
                            $data["E_10"] = $ns9_7.":45";
                        }if($hour >= 10){
                            $data["S_11"] = $ns10_7.":10";
                            $data["E_11"] = $ns10_7.":40";
                        }if($hour >= 11){
                            $data["S_12"] = $ns11_7.":05";
                            $data["E_12"] = $ns11_7.":35";
                        }if($hour >= 12){
                            $data["S_13"] = $ns12_7.":00";
                            $data["E_13"] = $ns12_7.":30";
                        }
                    }
                    if($off_7 == 30){
                        $num = 1;
                        for($i = 1; $i <= $hour; $i++){
                            if($i == 1){
                                if($s_7 < 10){ $nsf_7 = "0".strval($s_7); }else{$nsf_7 = $s_7;}
                            }else{
                                if($s_7+($i-1) < 10){ $nsf_7 = "0".strval($s_7+($i-1)); }else{$nsf_7 = $s_7+($i-1);}
                            }
                            $data2["a"][] = $nsf_7.":00";
                            $data2["b"][] = 0;
                            $data2["a"][] = $nsf_7.":30";
                            $data2["b"][] = 5;
                        }
                        for($i = 1; $i <= ($num*$hour); $i++){
                            if($data2["b"][(($i-1)+$i)] == 5){
                                $zz = "E_".$i;
                            }
                            if($data2["b"][(($i-2)+$i)] == 0){
                                $zx = "S_".$i;
                            }
                            $data[$zx] =  $data2["a"][(($i-2)+$i)];
                            $data[$zz] =  $data2["a"][(($i-1)+$i)];
                        }
                    }
                }
            }else{  //sw_7 =0
                if($_POST["sw_1"] == 1){
                    $S_1 = $_POST["s_1"];
                    $E_1 = $_POST["e_1"];
                }else{
                    $S_1 = "99:99";
                    $E_1 = "99:99";
                }
                if($_POST["sw_2"] == 1){
                    $S_2 = $_POST["s_2"];
                    $E_2 = $_POST["e_2"];
                }else{
                    $S_2 = "99:99";
                    $E_2 = "99:99";
                }
                if($_POST["sw_3"] == 1){
                    $S_3 = $_POST["s_3"];
                    $E_3 = $_POST["e_3"];
                }else{
                    $S_3 = "99:99";
                    $E_3 = "99:99";
                }
                if($_POST["sw_4"] == 1){
                    $S_4 = $_POST["s_4"];
                    $E_4 = $_POST["e_4"];
                }else{
                    $S_4 = "99:99";
                    $E_4 = "99:99";
                }
                if($_POST["sw_5"] == 1){
                    $S_5 = $_POST["s_5"];
                    $E_5 = $_POST["e_5"];
                }else{
                    $S_5 = "99:99";
                    $E_5 = "99:99";
                }
                if($_POST["sw_6"] == 1){
                    $S_6 = $_POST["s_6"];
                    $E_6 = $_POST["e_6"];
                }else{
                    $S_6 = "99:99";
                    $E_6 = "99:99";
                }
                $data = [];
                $data["S_1"] = $S_1;
                $data["E_1"] = $E_1;
                $data["S_2"] = $S_2;
                $data["E_2"] = $E_2;
                $data["S_3"] = $S_3;
                $data["E_3"] = $E_3;
                $data["S_4"] = $S_4;
                $data["E_4"] = $E_4;
                $data["S_5"] = $S_5;
                $data["E_5"] = $E_5;
                $data["S_6"] = $S_6;
                $data["E_6"] = $E_6;
            }
            $load_data_mqtt = ['foggy'=> $data];
        }elseif($channel == 11){
            if($_POST["sw_1"] == 1){
                $S_1 = $_POST["s_1"];
                $E_1 = $_POST["se_1"];
            }else{
                $S_1 = "99:99";
                $E_1 = "0";
            }
            if($_POST["sw_2"] == 1){
                $S_2 = $_POST["s_2"];
                $E_2 = $_POST["se_2"];
            }else{
                $S_2 = "99:99";
                $E_2 = "0";
            }
            if($_POST["sw_3"] == 1){
                $S_3 = $_POST["s_3"];
                $E_3 = $_POST["se_3"];
            }else{
                $S_3 = "99:99";
                $E_3 = "0";
            }
            if($_POST["sw_4"] == 1){
                $S_4 = $_POST["s_4"];
                $E_4 = $_POST["se_4"];
            }else{
                $S_4 = "99:99";
                $E_4 = "0";
            }
            if($_POST["sw_5"] == 1){
                $S_5 = $_POST["s_5"];
                $E_5 = $_POST["se_5"];
            }else{
                $S_5 = "99:99";
                $E_5 = "0";
            }
            if($_POST["sw_6"] == 1){
                $S_6 = $_POST["s_6"];
                $E_6 = $_POST["se_6"];
            }else{
                $S_6 = "99:99";
                $E_6 = "0";
            }
            $load_data_mqtt = [
                'shader'  => [
                    'S_1' => [ 'T' => $S_1, 'L' => $E_1 ],
                    'S_2' => [ 'T' => $S_2, 'L' => $E_2 ],
                    'S_3' => [ 'T' => $S_3, 'L' => $E_3 ],
                    'S_4' => [ 'T' => $S_4, 'L' => $E_4 ],
                    'S_5' => [ 'T' => $S_5, 'L' => $E_5 ],
                    'S_6' => [ 'T' => $S_6, 'L' => $E_6 ]
                ]
            ];
        }else{  // channel 1-8 and 10
            if($_POST["sw_1"] == 1){
                $S_1 = $_POST["s_1"];
                $E_1 = $_POST["e_1"];
            }else{
                $S_1 = "99:99";
                $E_1 = "99:99";
            }
            if($_POST["sw_2"] == 1){
                $S_2 = $_POST["s_2"];
                $E_2 = $_POST["e_2"];
            }else{
                $S_2 = "99:99";
                $E_2 = "99:99";
            }
            if($_POST["sw_3"] == 1){
                $S_3 = $_POST["s_3"];
                $E_3 = $_POST["e_3"];
            }else{
                $S_3 = "99:99";
                $E_3 = "99:99";
            }
            if($_POST["sw_4"] == 1){
                $S_4 = $_POST["s_4"];
                $E_4 = $_POST["e_4"];
            }else{
                $S_4 = "99:99";
                $E_4 = "99:99";
            }
            if($_POST["sw_5"] == 1){
                $S_5 = $_POST["s_5"];
                $E_5 = $_POST["e_5"];
            }else{
                $S_5 = "99:99";
                $E_5 = "99:99";
            }
            if($_POST["sw_6"] == 1){
                $S_6 = $_POST["s_6"];
                $E_6 = $_POST["e_6"];
            }else{
                $S_6 = "99:99";
                $E_6 = "99:99";
            }
            $data = [];
            $data["S_1"] = $S_1;
            $data["E_1"] = $E_1;
            $data["S_2"] = $S_2;
            $data["E_2"] = $E_2;
            $data["S_3"] = $S_3;
            $data["E_3"] = $E_3;
            $data["S_4"] = $S_4;
            $data["E_4"] = $E_4;
            $data["S_5"] = $S_5;
            $data["E_5"] = $E_5;
            $data["S_6"] = $S_6;
            $data["E_6"] = $E_6;
            if($channel == 1){
                $load_data_mqtt = ['dripper_1'=> $data];
            }elseif($channel == 2){
                $load_data_mqtt = ['dripper_2'=> $data];
            }elseif($channel == 3){
                $load_data_mqtt = ['dripper_3'=> $data];
            }elseif($channel == 4){
                $load_data_mqtt = ['dripper_4'=> $data];
            }elseif($channel == 5){
                $load_data_mqtt = ['dripper_5'=> $data];
            }elseif($channel == 6){
                $load_data_mqtt = ['dripper_6'=> $data];
            }elseif($channel == 7){
                $load_data_mqtt = ['dripper_7'=> $data];
            }elseif($channel == 8){
                $load_data_mqtt = ['dripper_8'=> $data];
            }elseif($channel == 10){
                $load_data_mqtt = ['fan'=> $data];
            }
        }
        echo json_encode(['status' => "Insert_Success", 'data' => $load_data_mqtt ], JSON_UNESCAPED_UNICODE );
    }else{
        echo json_encode(['status' => "Insert_Error tb3_load_".$channel, 'data' => '' ], JSON_UNESCAPED_UNICODE );
    }