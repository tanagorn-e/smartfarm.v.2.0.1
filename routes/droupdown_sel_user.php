<?php
    session_start();
require "connectdb.php";
$houseID = $_GET["houseID"];
    echo '<option value="0">เลือกผู้ใช้งาน</option>';
    if ($_SESSION["login_status"] == 1) {
        $stmtUser = $dbcon->prepare("SELECT * FROM tb3_userst INNER JOIN tb2_login ON tb3_userst.userST_loginID = tb2_login.login_id WHERE userST_houseID != '$houseID' GROUP BY userST_loginID");
    } else {
        $stmtUser = $dbcon->prepare("SELECT * FROM tb3_userst INNER JOIN tb2_login ON tb3_userst.userST_loginID = tb2_login.login_id WHERE userST_main='$user_id' AND userST_houseID != '$houseID' ");
    }
    $stmtUser->execute();
    while ($rowUser = $stmtUser->fetch(PDO::FETCH_BOTH)) {
        if($rowUser["login_status"] != 1 || $rowUser["userST_houseID"] != $houseID){
            echo '<option value="'.$rowUser["login_id"].'">'.$rowUser["login_user"].'</option>';
        }
    }