<?php
session_start();
require "connectdb.php";

if (isset($_POST['Username'])) {
// if (isset($_POST["mode_user"])) {
//     $mode_user = $_POST["mode_user"];
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    // echo $username." and ".$password;
    //เข้ารหัส รหัสผ่าน
    $salt = 'tikde78uj4ujuhlaoikiksakeidke';
    $new_password = hash_hmac('sha256', $password, $salt);
    // echo $new_password;
    // if ($mode_user == "username") { //login user_mode
        
             // เว็บใหม่
            $query = $dbcon->prepare("SELECT * FROM tb2_login WHERE login_user = '$username' AND login_pass = '$new_password' ");
            $query->execute();
            $row_count = $query->fetch(PDO::FETCH_BOTH);
            // echo $count_User["login_id"];
            // $_SESSION["login_email"] = $row_count["login_email"];
            // $_SESSION["login_tel"] = $row_count["login_tel"];
            if ($row_count == false) {
                echo json_encode(['status_login'  => "No user"], JSON_UNESCAPED_UNICODE);
                exit();
            } elseif ($row_count["login_id"] > 0) {
                $login_userid = $_SESSION['user_id'] = $row_count["login_id"];
                $_SESSION["Username"] = $row_count['login_user'];
                $_SESSION["login_status"] = $row_count["login_status"];
                $_SESSION["login_theme"] = $row_count["login_theme"];
                $_SESSION["time"] = date("d");
                if ($row_count["login_image"] === "") {
                    $_SESSION["login_image"] = "user.png";
                } else {
                    $_SESSION["login_image"] = $row_count["login_image"];
                }
                // $_SESSION["status_login"] = "login";
                // $_SESSION["pages"] = "1";
            }
            if($_SESSION["login_status"] != 1){
                $rowc = $dbcon->query("SELECT COUNT('userST_loginID') FROM `tb3_userst` WHERE `userST_loginID`='$login_userid'")->fetch();
                $rwcstu = $dbcon->query("SELECT COUNT('userST_id') FROM `tb3_userst` WHERE `userST_loginID`='$login_userid' AND userST_user_status=2")->fetch();
                $_SESSION['count_statusUser'] = $rwcstu[0];
            }else{
                $rowc = $dbcon->query("SELECT COUNT(`site_id`) FROM tb2_site ")->fetch();
                $_SESSION['count_statusUser'] = "1";
            }
            $_SESSION['count_house'] = $rowc[0];
            if($rowc[0] == 1){
                $_SESSION['master'] = $dbcon->query("SELECT site_name, house_master, house_name FROM `tb3_userst`
                INNER JOIN tb2_login ON tb3_userst.userST_loginID = tb2_login.login_id 
                INNER JOIN tb2_site ON tb3_userst.userST_siteID = tb2_site.site_id 
                INNER JOIN tb2_house ON tb3_userst.userST_houseID = tb2_house.house_id WHERE tb3_userst.userST_loginID = '$login_userid' ")->fetch();
            }else{$_SESSION['master'] = '';}
    // } elseif ($mode_user == "email") { //login email_mode


    // }
}



if (isset($_POST['logout'])) {
    session_destroy();
    echo json_encode("logout_succress");
    exit();
}

if (isset($_SESSION["Username"])) {           
    echo json_encode([
        'user_id'       => $_SESSION['user_id'],
        'username'      => $_SESSION["Username"],
        'status'        => $_SESSION["login_status"],
        'image'         => $_SESSION["login_image"],
        'date_start'    => $_SESSION["time"],
        'count_house'   => $_SESSION['count_house'],
        'master'        => $_SESSION['master'],
        'count_statusUser' => $_SESSION['count_statusUser'],
        'theme' => $_SESSION["login_theme"]
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['username'  => ""]);
}
