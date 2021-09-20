<?php
require "connectdb.php";
$user_id = $_POST['user_id'];
$row = $dbcon->query("SELECT * FROM tb2_login WHERE login_id = '$user_id'")->fetch();
echo json_encode($row);