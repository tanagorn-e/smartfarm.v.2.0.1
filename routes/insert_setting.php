<?php
    session_start();
    require "connectdb.php";
    $user_id = $_SESSION['user_id'];
    // echo $_POST["mode_insert"];
    if($_POST["mode_insert"] == "edit_profile"){
        // chack_user
        if($_POST["p_name"] != $_SESSION["Username"]){
            $post_name = $_POST["p_name"];
            $chack_user = $dbcon->query("SELECT COUNT('login_id') FROM tb2_login WHERE login_user = '$post_name' ")->fetch();
            if($chack_user[0] > 0){
                echo json_encode(['status' => "มีรายชื่อนี้แล้ว"], JSON_UNESCAPED_UNICODE );
                exit();
            }
            $n_name = $_POST["p_name"];
        }else{
            $n_name = $_POST["p_name"];
        }
        // chack_pass
        if($_POST["p_pass"] == ""){
            $n_pass = $_POST["p_passDF"];
            $n_pass2 = $_POST["p_passDF2"];
        }else{
            //เข้ารหัส รหัสผ่าน
            $salt = 'tikde78uj4ujuhlaoikiksakeidke';
            $n_pass = hash_hmac('sha256', $_POST["p_pass"], $salt);
            $n_pass2 = $_POST["p_pass"];
        }
        // chack_mail
        if(!filter_var($_POST["p_email"], FILTER_VALIDATE_EMAIL)){
            echo json_encode(['status' => "รูปแบบ email ไม่ถูกต้อง"], JSON_UNESCAPED_UNICODE );
            exit();
        }
        if($_POST["p_email"] != $_POST["p_emailDF"]){
            $post_email = $_POST["p_email"];
            $chack_email = $dbcon->query("SELECT COUNT('login_id') FROM tb2_login WHERE login_email = '$post_email' ")->fetch();
            if($chack_email[0] > 0){
                echo json_encode(['status' => "มี email นี้แล้ว"], JSON_UNESCAPED_UNICODE );
                exit();
            }
            $n_email = $_POST["p_email"];
        }else{
            $n_email = $_POST["p_email"];
        }
        
        // chack_image
        $file = $_FILES['p_img']['name'];
        if($file == ""){
            $n_img = $_POST["p_imgDF"];
        }else{
            if($_POST["p_imgDF"] != ""){
                $img_user_del = "../public/images/users/".$_POST["p_imgDF"];
                unlink($img_user_del);
            }

            $infoExt = getimagesize($_FILES['p_img']['tmp_name']);
            if(strtolower($infoExt['mime']) == 'image/gif' || strtolower($infoExt['mime']) == 'image/jpeg' || strtolower($infoExt['mime']) == 'image/jpg' || strtolower($infoExt['mime']) == 'image/png' || strtolower($infoExt['mime']) == 'image/svg'){
                $img_part = pathinfo(basename($file),PATHINFO_EXTENSION); // ่สกุล
                $n_img = "img_user_".$user_id.".".$img_part;
                $location = "../public/images/users/".$n_img;
                move_uploaded_file($_FILES['p_img']['tmp_name'],$location);
            }else{
                echo json_encode(['status' => "สกุลไฟล์ไม่ถูกต้อง"], JSON_UNESCAPED_UNICODE );
                exit();
            }
        }
        $data = [
            'p1' => $n_name,
            'p2' => $n_pass,
            'p3' => $n_email,
            'p4' => $_POST["p_tel"],
            'p5' => $n_img,
            'p6' => $n_pass2,
            'p7' => $user_id
        ];
        $sql = "UPDATE `tb2_login` SET `login_user`=:p1, `login_pass`=:p2, `login_email`=:p3, `login_tel`=:p4, `login_image`=:p5, `login_pa`=:p6 WHERE `login_id`=:p7";
        if ($dbcon->prepare($sql)->execute($data) === TRUE) {
            $_SESSION["Username"] = $n_name;
            if ($n_img === "") {
                $_SESSION["login_image"] = "user.png";
            } else {
                $_SESSION["login_image"] = $n_img;
            }
            $return = [
                'user' => $_SESSION["Username"],
                'image' => $_SESSION["login_image"]
            ];
            echo json_encode(['status' => "Insert_success", "data" => $return], JSON_UNESCAPED_UNICODE );
            exit();
        }else{
            echo json_encode(['status' => "Insert_Error"], JSON_UNESCAPED_UNICODE );
            exit();
        }
    }

    if($_POST["mode_insert"] == "add_site"){
        $n_name = $_POST["s_name"];
        $file	= $_FILES['s_img']['name'];
        
        $chack_name = $dbcon->query("SELECT count(site_id) FROM tb2_site WHERE site_name = '$n_name' ")->fetch();
        if($chack_name[0] > 0){
            echo json_encode(['status' => "มีรายชื่อนี้แล้ว"], JSON_UNESCAPED_UNICODE );
            exit();
        }
        if($file == ""){
            $n_img = "";
        }else{
            $cont_img = $dbcon->query("SELECT site_id FROM tb2_site ORDER BY site_id DESC LIMIT 1 ")->fetch();
            // echo $cont_img[0]+1;
            // exit();
            $infoExt = getimagesize($_FILES['s_img']['tmp_name']);
            if(strtolower($infoExt['mime']) == 'image/gif' || strtolower($infoExt['mime']) == 'image/jpeg' || strtolower($infoExt['mime']) == 'image/jpg' || strtolower($infoExt['mime']) == 'image/png' || strtolower($infoExt['mime']) == 'image/svg'){
                $img_part = pathinfo(basename($file),PATHINFO_EXTENSION); // ่สกุล
                $n_img = "img_site_".($cont_img[0]+1).".".$img_part;
                $location = "../public/images/site/".$n_img;
                move_uploaded_file($_FILES['s_img']['tmp_name'],$location);
            }else{
                echo json_encode(['status' => "สกุลไฟล์ไม่ถูกต้อง"], JSON_UNESCAPED_UNICODE );
                exit();
            }
        }
        $data = [
            'p1' => $n_name,
            'p2' => $_POST["s_address"],
            'p3' => $_POST["s_la"],
            'p4' => $_POST["s_long"],
            'p5' => $n_img,
            'p6' => $_POST["s_internet"],
            'p7' => $_POST["s_internetO"],
            'p8' => $user_id
        ];
        $sql = "INSERT INTO `tb2_site`(`site_name`, `site_address`, `site_Latitude`, `site_Longitude`, `site_img`, `site_internet`, `site_internetO`, `site_userST_id`) VALUES (:p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8)";
        if ($dbcon->prepare($sql)->execute($data) === TRUE) {
            // $last_id = $dbcon->lastInsertId();
            echo json_encode(['status' => "Insert_success"], JSON_UNESCAPED_UNICODE );
            exit();
        }else{
            echo json_encode(['status' => "Insert_Error"], JSON_UNESCAPED_UNICODE );
            exit();
        }
    }
    if($_POST["mode_insert"] == "edit_site"){
        $file	= $_FILES['s_img']['name'];
        if($_POST["s_name"] == $_POST["s_nameDF"]){
            $n_name = $_POST["s_name"];
        }else{
            $post_name = $_POST["s_name"];
            $chack_name = $dbcon->query("SELECT count(site_id) FROM tb2_site WHERE site_name = '$post_name' ")->fetch();
            if($chack_name[0] > 0){
                echo json_encode(['status' => "มีรายชื่อนี้แล้ว"], JSON_UNESCAPED_UNICODE );
                exit();
            }
            $n_name = $_POST["s_name"];
        }
        if($file == ""){
            $n_img = $_POST["s_imgDF"];
        }else{
            if($_POST["s_imgDF"] != ""){
                $img_user_del = "../public/images/site/".$_POST["s_imgDF"];
                unlink($img_user_del);
            }
            $infoExt = getimagesize($_FILES['s_img']['tmp_name']);
            if(strtolower($infoExt['mime']) == 'image/gif' || strtolower($infoExt['mime']) == 'image/jpeg' || strtolower($infoExt['mime']) == 'image/jpg' || strtolower($infoExt['mime']) == 'image/png' || strtolower($infoExt['mime']) == 'image/svg'){
                $img_part = pathinfo(basename($file),PATHINFO_EXTENSION); // ่สกุล
                $n_img = "img_site_".$_POST["site_id"].".".$img_part;
                $location = "../public/images/site/".$n_img;
                move_uploaded_file($_FILES['s_img']['tmp_name'],$location);
            }else{
                echo json_encode(['status' => "สกุลไฟล์ไม่ถูกต้อง"], JSON_UNESCAPED_UNICODE );
                exit();
            }
        }
        
        $data = [
            'p1' => $n_name,
            'p2' => $_POST["s_address"],
            'p3' => $_POST["s_la"],
            'p4' => $_POST["s_long"],
            'p5' => $n_img,
            'p6' => $_POST["s_internet"],
            'p7' => $_POST["s_internetO"],
            'p8' => $user_id,
            'p_id' => $_POST["site_id"],
        ];
        $sql = "UPDATE `tb2_site` SET `site_name`=:p1, `site_address`=:p2, `site_Latitude`=:p3, `site_Longitude`=:p4, `site_img`=:p5, `site_internet`=:p6, `site_internetO`=:p7, `site_userST_id`=:p8 WHERE `site_id`=:p_id ";
        if ($dbcon->prepare($sql)->execute($data) === TRUE) {
            // $last_id = $dbcon->lastInsertId();
            echo json_encode(['status' => "Insert_success"], JSON_UNESCAPED_UNICODE );
            exit();
        }else{
            echo json_encode(['status' => "Insert_Error"], JSON_UNESCAPED_UNICODE );
            exit();
        }
    }
    if($_POST["mode_insert"] == "delete_site"){
        $site_img = $_POST["img"];
        if($site_img != ""){
            $Delete_image = "../public/images/site/".$site_img;
            unlink($Delete_image);
        }
        // ---------------- delete img house
        $siteID = $_POST['site_id'];
        $stmt = $dbcon->query("SELECT house_img, house_img_map FROM tb2_house WHERE house_siteID = '$siteID' ");
        while ($row = $stmt->fetch()) {
            if($row["house_img"] != ""){
                $Delete_image2 = "../public/images/house/".$row["house_img"];
                unlink($Delete_image2);
            }
            if($row["house_img_map"] != ""){
                $Delete_image3 = "../public/images/img_map/".$row["house_img_map"];
                unlink($Delete_image3);
            }
        }
        // ----------------
        $data = ['site_id'=> $siteID];
        if ($dbcon->prepare("DELETE FROM tb2_site WHERE site_id = :site_id")->execute($data) === TRUE) {
            // ---------------------------------------------
            if ($dbcon->prepare("DELETE FROM `tb2_house` WHERE `house_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb2_house'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_userst` WHERE `userST_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_userst'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_control` WHERE `control_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_control'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_controlcanel` WHERE `controlcanel_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_controlcanel'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_controlstatus` WHERE `controlstatus_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_controlstatus'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_conttrolname` WHERE `conttrolname_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_conttrolname'], JSON_UNESCAPED_UNICODE );
                exit();
            }

            if ($dbcon->prepare("DELETE FROM `tb3_dashname` WHERE `dashname_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_dashname'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_dashstatus` WHERE `dashstatus_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_dashstatus'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_sncanel` WHERE `sncanel_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_sncanel'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_statussn` WHERE `statussn_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_statussn'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_map_img` WHERE `map_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_map_img'], JSON_UNESCAPED_UNICODE );
                exit();
            }

            if ($dbcon->prepare("DELETE FROM `tb3_meter_chenal_mode` WHERE `meter_chenal_mode_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_meter_chenal_mode'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_meter_status` WHERE `meter_status_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_meter_status'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_1` WHERE `load_1_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_1'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_2` WHERE `load_2_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_2'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_3` WHERE `load_3_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_3'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_4` WHERE `load_4_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_4'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_5` WHERE `load_5_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_5'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_6` WHERE `load_6_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_6'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_7` WHERE `load_7_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_7'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_8` WHERE `load_8_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_8'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_9` WHERE `load_9_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_9'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_10` WHERE `load_10_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_10'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_11` WHERE `load_11_siteID` = :site_id")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_11'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            echo json_encode(['status' => "Delete_success"], JSON_UNESCAPED_UNICODE );
            exit();
        }
    }

    if($_POST["mode_insert"] == "add_house"){
        $n_sn = $_POST["h_sn"];
        $file	= $_FILES['h_img']['name'];
        $file2  = $_FILES['h_img_map']['name'];
        
        $chack_name = $dbcon->query("SELECT count(house_id) FROM tb2_house WHERE house_master = '$n_sn' ")->fetch();
        if($chack_name[0] > 0){
            echo json_encode(['status' => "มีรายชื่อนี้แล้ว"], JSON_UNESCAPED_UNICODE );
            exit();
        }
        if($file == ""){
            $n_img = "";
        }else{
            $cont_img = $dbcon->query("SELECT house_id FROM tb2_house ORDER BY house_id DESC LIMIT 1 ")->fetch();
            // echo $cont_img[0]+1;
            // exit();
            $infoExt = getimagesize($_FILES['h_img']['tmp_name']);
            if(strtolower($infoExt['mime']) == 'image/gif' || strtolower($infoExt['mime']) == 'image/jpeg' || strtolower($infoExt['mime']) == 'image/jpg' || strtolower($infoExt['mime']) == 'image/png' || strtolower($infoExt['mime']) == 'image/svg'){
                $img_part = pathinfo(basename($file),PATHINFO_EXTENSION); // ่สกุล
                $n_img = "img_house_".($cont_img[0]+1).".".$img_part;
                $location = "../public/images/house/".$n_img;
                move_uploaded_file($_FILES['h_img']['tmp_name'],$location);
            }else{
                echo json_encode(['status' => "สกุลไฟล์ไม่ถูกต้อง", 'img'=>'img1'], JSON_UNESCAPED_UNICODE );
                exit();
            }
        }
        if($file2 == ""){
            $n_img2 = "";
        }else{
            $cont_img2 = $dbcon->query("SELECT house_id FROM tb2_house ORDER BY house_id DESC LIMIT 1 ")->fetch();
            $infoExt2 = getimagesize($_FILES['h_img_map']['tmp_name']);
            if(strtolower($infoExt2['mime']) == 'image/gif' || strtolower($infoExt2['mime']) == 'image/jpeg' || strtolower($infoExt2['mime']) == 'image/jpg' || strtolower($infoExt2['mime']) == 'image/png' || strtolower($infoExt2['mime']) == 'image/svg'){
                $img_part2 = pathinfo(basename($file),PATHINFO_EXTENSION); // ่สกุล
                $n_img2 = "img_map_".($cont_img2[0]+1).".".$img_part2;
                $location2 = "../public/images/img_map/".$n_img2;
                move_uploaded_file($_FILES['h_img_map']['tmp_name'],$location2);
            }else{
                echo json_encode(['status' => "สกุลไฟล์ไม่ถูกต้อง", 'img'=>'img2'], JSON_UNESCAPED_UNICODE );
                exit();
            }
        }
        $data = [
            'p1' => $_POST["h_site"],
            'p2' => $_POST["h_name"],
            'p3' => $n_sn,
            'p4' => $n_img,
            'p5' => $n_img2,
            'p_id' => $user_id
        ];
        $sql = "INSERT INTO `tb2_house`(`house_siteID`, `house_name`, `house_master`, `house_img`, `house_img_map`, `house_userST_id`) VALUES (:p1, :p2, :p3, :p4, :p5, :p_id)";
        if ($dbcon->prepare($sql)->execute($data) === TRUE) {
            $last_id = $dbcon->lastInsertId();
            $data2 = [
                'p1' => $user_id,
                'p2' => $_POST["h_site"],
                'p3' => $last_id,
                'p4' => 2,
                'p5' => $user_id
            ];
            $sql2 = "INSERT INTO `tb3_userst`(`userST_loginID`, `userST_siteID`, `userST_houseID`, `userST_user_status`, `userST_main`) VALUES (:p1, :p2, :p3, :p4, :p5)";
            if ($dbcon->prepare($sql2)->execute($data2) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_userst'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            $data3 = ['siteID' => $last_id, 'sn' => $n_sn];
            if ($dbcon->prepare("INSERT INTO `tb3_control`(`control_siteID`, `control_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_control'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_controlcanel`(`controlcanel_siteID`, `controlcanel_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_controlcanel'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_controlstatus`(`controlstatus_siteID`, `controlstatus_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_controlstatus'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_conttrolname`(`conttrolname_siteID`, `conttrolname_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_conttrolname'], JSON_UNESCAPED_UNICODE );
                exit();
            }

            if ($dbcon->prepare("INSERT INTO `tb3_dashname`(`dashname_siteID`, `dashname_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_dashname'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_dashstatus`(`dashstatus_siteID`, `dashstatus_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_dashstatus'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_sncanel`(`sncanel_siteID`, `sncanel_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_sncanel'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_statussn`(`statussn_siteID`, `statussn_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_statussn'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_map_img`(`map_siteID`, `map_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_map_img'], JSON_UNESCAPED_UNICODE );
                exit();
            }

            if ($dbcon->prepare("INSERT INTO `tb3_meter_chenal_mode`(`meter_chenal_mode_siteID`, `meter_chenal_mode_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_meter_chenal_mode'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_meter_status`(`meter_status_siteID`, `meter_status_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_meter_status'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_load_1`(`load_1_siteID`, `load_1_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_1'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_load_2`(`load_2_siteID`, `load_2_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_2'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_load_3`(`load_3_siteID`, `load_3_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_3'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_load_4`(`load_4_siteID`, `load_4_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_4'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_load_5`(`load_5_siteID`, `load_5_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_5'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_load_6`(`load_6_siteID`, `load_6_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_6'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_load_7`(`load_7_siteID`, `load_7_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_7'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_load_8`(`load_8_siteID`, `load_8_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_8'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_load_9`(`load_9_siteID`, `load_9_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_9'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_load_10`(`load_10_siteID`, `load_10_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_10'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("INSERT INTO `tb3_load_11`(`load_11_siteID`, `load_11_sn`) VALUES (:siteID, :sn)")->execute($data3) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_11'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            echo json_encode(['status' => "Insert_success"], JSON_UNESCAPED_UNICODE );
            exit();
        }else{
            echo json_encode(['status' => "Insert_Error",'tb'=>'tb2_house'], JSON_UNESCAPED_UNICODE );
            exit();
        }
    }
    if($_POST["mode_insert"] == "edit_house"){
        $file	= $_FILES['h_img']['name'];
        $file2  = $_FILES['h_img_map']['name'];
        // echo $_POST["h_imgDF"];
        // exit();
        if($_POST["h_sn"] == $_POST["h_snDF"]){
            $n_sn = $_POST["h_sn"];
        }else{
            $post_sn = $_POST["h_sn"];
            $chack_name = $dbcon->query("SELECT count(house_id) FROM tb2_house WHERE house_master = '$post_sn' ")->fetch();
            if($chack_name[0] > 0){
                echo json_encode(['status' => "มีรายชื่อนี้แล้ว"], JSON_UNESCAPED_UNICODE );
                exit();
            }
            $n_sn = $_POST["h_sn"];
        }
        if($file == ""){
            $n_img = $_POST["h_imgDF"];
        }else{
            if($_POST["h_imgDF"] != ""){
                $img_user_del = "../public/images/house/".$_POST["h_imgDF"];
                unlink($img_user_del);
            }
            $infoExt = getimagesize($_FILES['h_img']['tmp_name']);
            if(strtolower($infoExt['mime']) == 'image/gif' || strtolower($infoExt['mime']) == 'image/jpeg' || strtolower($infoExt['mime']) == 'image/jpg' || strtolower($infoExt['mime']) == 'image/png' || strtolower($infoExt['mime']) == 'image/svg'){
                $img_part = pathinfo(basename($file),PATHINFO_EXTENSION); // ่สกุล
                $n_img = "img_house_".$_POST["house_id"].".".$img_part;
                $location = "../public/images/house/".$n_img;
                move_uploaded_file($_FILES['h_img']['tmp_name'],$location);
            }else{
                echo json_encode(['status' => "สกุลไฟล์ไม่ถูกต้อง"], JSON_UNESCAPED_UNICODE );
                exit();
            }

        }
        if($file2 == ""){
            $n_img2 = $_POST["h_img_mapDF"];
        }else{
            if($_POST["h_img_mapDF"] != ""){
                $img_user_del2 = "../public/images/img_map/".$_POST["h_img_mapDF"];
                unlink($img_user_del2);
            }
            $infoExt2 = getimagesize($_FILES['h_img_map']['tmp_name']);
            if(strtolower($infoExt2['mime']) == 'image/gif' || strtolower($infoExt2['mime']) == 'image/jpeg' || strtolower($infoExt2['mime']) == 'image/jpg' || strtolower($infoExt2['mime']) == 'image/png' || strtolower($infoExt2['mime']) == 'image/svg'){
                $img_part2 = pathinfo(basename($file2),PATHINFO_EXTENSION); // ่สกุล
                $n_img2 = "img_map_".$_POST["house_id"].".".$img_part2;
                $location2 = "../public/images/img_map/".$n_img2;
                move_uploaded_file($_FILES['h_img_map']['tmp_name'],$location2);
            }else{
                echo json_encode(['status' => "สกุลไฟล์ไม่ถูกต้อง", 'img'=>'img2'], JSON_UNESCAPED_UNICODE );
                exit();
            }
        }
        $data = [
            'p1' => $_POST["h_site"],
            'p2' => $_POST["h_name"],
            'p3' => $n_sn,
            'p4' => $n_img,
            'p5' => $n_img2,
            'p6' => $user_id,
            'p_id' => $_POST["house_id"]
        ];
        // echo json_encode($data);
        // exit();
        $sql = "UPDATE `tb2_house` SET `house_siteID`=:p1, `house_name`=:p2, `house_master`=:p3, `house_img`=:p4, `house_img_map`=:p5, `house_userST_id`=:p6 WHERE `house_id`=:p_id ";
        if ($dbcon->prepare($sql)->execute($data) === TRUE) {
            echo json_encode(['status' => "Insert_success"], JSON_UNESCAPED_UNICODE );
            exit();
        }else{
            echo json_encode(['status' => "Insert_Error"], JSON_UNESCAPED_UNICODE );
            exit();
        }
    }
    if($_POST["mode_insert"] == "delete_house"){
        $house_img = $_POST["img"];
        if($house_img != ""){
            $Delete_image = "../public/images/house/".$house_img;
            unlink($Delete_image);
        }
        $house_img_map = $_POST["img_map"];
        if($house_img_map != ""){
            $Delete_image2 = "../public/images/img_map/".$house_img_map;
            unlink($Delete_image2);
        }
        //---------------
        $data = ['sn'=> $_POST["sn"]];
        if ($dbcon->prepare("DELETE FROM tb2_house WHERE house_master = :sn")->execute($data) === TRUE) {
            // ---------------------------------------------
            if ($dbcon->prepare("DELETE FROM `tb3_userst` WHERE `userST_houseID`= :house_id")->execute(['house_id'=> $_POST["house_id"]]) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_userst'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_control` WHERE `control_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_control'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_controlcanel` WHERE `controlcanel_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_controlcanel'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_controlstatus` WHERE `controlstatus_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_controlstatus'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_conttrolname` WHERE `conttrolname_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_conttrolname'], JSON_UNESCAPED_UNICODE );
                exit();
            }

            if ($dbcon->prepare("DELETE FROM `tb3_dashname` WHERE `dashname_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_dashname'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_dashstatus` WHERE `dashstatus_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_dashstatus'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_sncanel` WHERE `sncanel_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_sncanel'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_statussn` WHERE `statussn_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_statussn'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_map_img` WHERE `map_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_map_img'], JSON_UNESCAPED_UNICODE );
                exit();
            }

            if ($dbcon->prepare("DELETE FROM `tb3_meter_chenal_mode` WHERE `meter_chenal_mode_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_meter_chenal_mode'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_meter_status` WHERE `meter_status_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_meter_status'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_1` WHERE `load_1_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_1'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_2` WHERE `load_2_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_2'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_3` WHERE `load_3_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_3'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_4` WHERE `load_4_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_4'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_5` WHERE `load_5_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_5'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_6` WHERE `load_6_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_6'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_7` WHERE `load_7_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_7'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_8` WHERE `load_8_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_8'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_9` WHERE `load_9_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_9'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_10` WHERE `load_10_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_10'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            if ($dbcon->prepare("DELETE FROM `tb3_load_11` WHERE `load_11_sn` = :sn")->execute($data) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_load_11'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            echo json_encode(['status' => "Delete_success"], JSON_UNESCAPED_UNICODE );
            exit();
        }
    }

    if($_POST["mode_insert"] == "add_user"){
        $n_name = $_POST["u_user"];
        $chack_user = $dbcon->query("SELECT COUNT('login_id') FROM tb2_login WHERE login_user = '$n_name' ")->fetch();
        if($chack_user[0] > 0){
            echo json_encode(['status' => "มีรายชื่อนี้แล้ว"], JSON_UNESCAPED_UNICODE );
            exit();
        }
        //เข้ารหัส รหัสผ่าน
        $salt = 'tikde78uj4ujuhlaoikiksakeidke';
        $n_pass = hash_hmac('sha256', $_POST["u_pass"], $salt);
        $n_pass2 = $_POST["u_pass"];
        // chack_mail
        if(!filter_var($_POST["u_email"], FILTER_VALIDATE_EMAIL)){
            echo json_encode(['status' => "รูปแบบ email ไม่ถูกต้อง"], JSON_UNESCAPED_UNICODE );
            exit();
        }
        $n_email = $_POST["u_email"];
        $chack_email = $dbcon->query("SELECT COUNT('login_id') FROM tb2_login WHERE login_email = '$n_email' ")->fetch();
        if($chack_email[0] > 0){
            echo json_encode(['status' => "มี email นี้แล้ว"], JSON_UNESCAPED_UNICODE );
            exit();
        }
        // chack_image
        $file = $_FILES['u_img']['name'];
        if($file == ""){
            $n_img = "";
        }else{
            $cont_img = $dbcon->query("SELECT login_id FROM tb2_login ORDER BY login_id DESC LIMIT 1 ")->fetch();
            
            $infoExt = getimagesize($_FILES['u_img']['tmp_name']);
            if(strtolower($infoExt['mime']) == 'image/gif' || strtolower($infoExt['mime']) == 'image/jpeg' || strtolower($infoExt['mime']) == 'image/jpg' || strtolower($infoExt['mime']) == 'image/png' || strtolower($infoExt['mime']) == 'image/svg'){
                $img_part = pathinfo(basename($file),PATHINFO_EXTENSION); // ่สกุล
                $n_img = "img_user_".($cont_img[0]+1).".".$img_part;
                $location = "../public/images/users/".$n_img;
                move_uploaded_file($_FILES['u_img']['tmp_name'],$location);
            }else{
                echo json_encode(['status' => "สกุลไฟล์ไม่ถูกต้อง"], JSON_UNESCAPED_UNICODE );
                exit();
            }
        }
        $data = [
            'p1' => $n_name,
            'p2' => $n_pass,
            'p3' => $n_email,
            'p4' => $_POST["u_tel"],
            'p5' => $n_img,
            'p6' => $n_pass2
        ];
        // echo json_encode($_POST["u_site"]);
        // exit();
        $sql = "INSERT INTO `tb2_login` (`login_user`, `login_pass`, `login_email`, `login_tel`, `login_image`, `login_pa`) VALUE (:p1, :p2, :p3,:p4, :p5, :p6)";
        if ($dbcon->prepare($sql)->execute($data) === TRUE) {
            $last_id = $dbcon->lastInsertId();
            $data2 = [
                'p1' => $last_id,
                'p2' => $_POST["u_site"],
                'p3' => $_POST["u_house"],
                'p4' => $_POST["u_status"],
                'p5' => $user_id
            ];
            $sql2 = "INSERT INTO `tb3_userst`(`userST_loginID`, `userST_siteID`, `userST_houseID`, `userST_user_status`, `userST_main`) VALUES (:p1, :p2, :p3, :p4, :p5)";
            if ($dbcon->prepare($sql2)->execute($data2) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_userst'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            echo json_encode(['status' => "Insert_success", "data" => ""], JSON_UNESCAPED_UNICODE );
            exit();
        }else{
            echo json_encode(['status' => "Insert_Error"], JSON_UNESCAPED_UNICODE );
            exit();
        }
    }
    if($_POST["mode_insert"] == "edit_user"){
        $data = [
            'u_status' => $_POST["u_status"],
            'u_stID' => $_POST["userST_id"]
        ];
        if ($dbcon->prepare("UPDATE `tb3_userst` SET `userST_user_status`=:u_status WHERE `userST_id`=:u_stID")->execute($data) === FALSE) {
            echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_userst'], JSON_UNESCAPED_UNICODE );
            exit();
        }
        echo json_encode(['status' => "Insert_success", "data" => ""], JSON_UNESCAPED_UNICODE );
        exit();
    }
    if($_POST["mode_insert"] == "add_user2"){
        $siteID = $_POST["use_site"];
        $houseID = $_POST["use_house"];
        $userID = $_POST["use_userID"];
        // echo json_encode([$houseID,$userID]);
        $chack_user = $dbcon->query("SELECT COUNT('userST_id') FROM tb3_userst WHERE userST_houseID = '$houseID' AND userST_loginID = '$userID' ")->fetch();
        if($chack_user[0] > 0){
            echo json_encode(['status' => "house มีรายชื่อนี้แล้ว"], JSON_UNESCAPED_UNICODE );
            exit();
        }
        $data = [
            'p1' => $userID,
            'p2' => $siteID,
            'p3' => $houseID,
            'p4' => $_POST["u_status"],
            'p5' => $user_id
        ];
        $sql2 = "INSERT INTO `tb3_userst`(`userST_loginID`, `userST_siteID`, `userST_houseID`, `userST_user_status`, `userST_main`) VALUES (:p1, :p2, :p3, :p4, :p5)";
        if ($dbcon->prepare($sql2)->execute($data) === FALSE) {
            echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_userst'], JSON_UNESCAPED_UNICODE );
            exit();
        }
        echo json_encode(['status' => "Insert_success", "data" => ""], JSON_UNESCAPED_UNICODE );
        exit();
    }
    if($_POST["mode_insert"] == "delete_user"){
        $house_img = $_POST["img"];
        if($house_img != ""){
            $Delete_image = "../public/images/users/".$house_img;
            unlink($Delete_image);
        }
        if ($dbcon->prepare("DELETE FROM tb2_login WHERE login_id = :id")->execute(['id'=>$_POST["user_id"]]) === TRUE) {
            if ($dbcon->prepare("DELETE FROM `tb3_userst` WHERE `userST_loginID`= :id")->execute(['id'=>$_POST["user_id"]]) === FALSE) {
                echo json_encode(['status' => "Insert_Error",'tb'=>'tb3_userst'], JSON_UNESCAPED_UNICODE );
                exit();
            }
            echo json_encode(['status' => "Delete_success"], JSON_UNESCAPED_UNICODE );
            exit();
        }
    }