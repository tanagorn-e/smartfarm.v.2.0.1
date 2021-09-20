<?php
session_start();
require "../routes/connectdb.php";
$user_id = $_SESSION['user_id'];
$siteID = $_GET["siteID"];
// echo $siteID;
// exit();
// $site_df = $dbcon->query("SELECT * FROM tb_site WHERE site_id = '$user_siteID'")->fetch();
?>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">โรงเรือน</th>
                <th class="text-center">Images</th>
                <th class="text-center">ชื่อผู้ใช้งาน</th>
                <th class="text-center">อีเมลล์</th>
                <th class="text-center">โทรศัพท์</th>
                <!-- <th class="text-center">Site Main</th> -->
                <th class="text-center">ระดับผู้ใช้งาน</th>
                <!-- <th class="text-center">Approval</th> -->
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($_SESSION["login_status"] == 1) {
                $stmt = $dbcon->prepare("SELECT * FROM tb3_userst INNER JOIN tb2_login ON tb3_userst.userST_loginID = tb2_login.login_id INNER JOIN tb2_house ON tb3_userst.userST_houseID = tb2_house.house_id WHERE userST_siteID='$siteID' GROUP BY userST_loginID ");
            } else {
                $stmt = $dbcon->prepare("SELECT * FROM tb3_userst INNER JOIN tb2_login ON tb3_userst.userST_loginID = tb2_login.login_id INNER JOIN tb2_house ON tb3_userst.userST_houseID = tb2_house.house_id WHERE userST_siteID='$siteID' AND userST_main='$user_id' GROUP BY userST_loginID ");
            }
            $stmt->execute();
            $count = $stmt->rowCount();
            // if($count != 0){
            $i = 1;
            $data0 = array();
            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                echo '<tr>
                        <td class="text-center">' . $i . '</td>
                        <td class="text-center">' . $row["house_name"] . '</td>';
                if ($row["login_image"] == "") {
                    echo '<td class="text-center"><img src="public/images/users/user.png" width="50"  height="50" alt="..."></td>';
                } else {
                    echo '<td class="text-center"><img src="public/images/users/' . $row["login_image"] . '" width="50"  height="50" alt="..."></td>';
                }
                echo '  <td class="text-center">' . $row["login_user"] . '</td>
                        <td class="text-center">' . $row["login_email"] . '</td>
                        <td class="text-center">' . $row["login_tel"] . '</td>
                        ';//<td class="text-center">' . $row["site_name"] . '</td>';
                if ($row["userST_user_status"] == 1) {
                    echo '<td class="text-center"><span class="badge bg-info"> Support Admin <span></td>';
                } else if ($row["userST_user_status"] == 2) {
                    echo '<td class="text-center"><span class="badge bg-info"> Admin <span></td>';
                } else if ($row["userST_user_status"] == 3) {
                    echo '<td class="text-center"><span class="badge bg-info"> User <span></td>';
                }
                echo '<td class="text-center">
                        <div class="buttons">
                            <a href="javascript:void(0)" class="text-info u_edit"
                                userST_id="' . $row["userST_id"] . '"
                                houseID="' . $row["userST_houseID"] . '" 
                                name="' . $row["login_user"] . '" 
                                email="' . $row["login_email"] . '" 
                                img="' . $row["login_image"] . '" 
                                tel="' . $row["login_tel"] . '" 
                                status="' . $row["userST_user_status"] . '">
                                <i class="fadeIn animated bx bx-message-square-edit"></i>
                            </a>';
                            if($_SESSION["login_status"] == 1 || $row["userST_user_status"] == 2){
                                echo '<a href="javascript:void(0)" class="text-danger delete_user" 
                                    user_id="' . $row["login_id"] . '" 
                                    name="' . $row["login_user"] . '" 
                                    img="' . $row["login_image"] . '">
                                    <i class="fadeIn animated bx bx-trash"></i>
                                </a>';
                            }else{echo '<a class="text-secondary" onclick="return false;"><i class="fadeIn animated bx bx-trash"></i></a>';}
                        echo '</div>
                    </td>
                </tr>';
                $i++;
            }
            ?>
        </tbody>
    </table>

    <div class="modal fade text-left" id="modal_User" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title title_mUser"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="user_form" enctype="multipart/form-data" onSubmit="return false;">
                        <div class="row us_user_sel">
                            <div class="col-md-4">
                                <label>สถานที่</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="hidden" class="use_site" name="use_site">
                                        <select class="form-control use_site" name="use_site" disabled>
                                            <?php 
                                                $site_stmt = $dbcon->prepare("SELECT * FROM tb2_site ");
                                                $site_stmt->execute();
                                                while ($row_site = $site_stmt->fetch(PDO::FETCH_BOTH)) {
                                                    echo '<option value="'.$row_site["site_id"].'">'.$row_site["site_name"].'</option>';
                                                } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>โรงเรือน <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select class="form-control use_house" name="use_house">
                                            <?php 
                                                echo '<option value="0">เลือกโรงเรือน</option>';
                                                $house_stmt = $dbcon->prepare("SELECT * FROM tb2_house WHERE house_siteID ='$siteID' ");
                                                $house_stmt->execute();
                                                while ($row_house = $house_stmt->fetch(PDO::FETCH_BOTH)) {
                                                    echo '<option value="'.$row_house["house_id"].'">'.$row_house["house_name"].'</option>';
                                                } ?>
                                        </select>
                                        <div class="invalid-feedback">กรุณาระบุโรงเรือน</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>เลือกผู้ใช้งาน</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="use_userID" class="form-control use_userID">
                                            <option value="0">เลือกผู้ใช้งาน</option>
                                        </select>
                                        <div class="invalid-feedback buse_userID"></div><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <img class="w-25 u_img mb-2" alt="...">
                            <input type="hidden" name="mode_insert" class="mode_insert">
                            <input type="hidden" name="userST_id" class="mode_userST_id">
                            <input type="hidden" name="u_imgDF" class="u_imgDF">
                        </div>
                        <div class="form-body">
                            <div class="row">
                                <!-- <div class="input-group mt-3 us_img_user">
                                    <div class="input-group mb-3">
                                        <label class="col-md-4">Images </label>
                                        <label class="input-group-text" style="margin-left: 10px;" for="Showimage_user"><i class="bi bi-upload"></i></label>
                                        <input type="file" class="form-control" name="image_input" id="Showimage_user" onchange="Showimage2(this)">
                                    </div>
                                </div> -->
                                <div class="col-md-4 us_img_user">
                                    <label class="col-md-4">สถานที่ </label>
                                </div>
                                <div class="col-md-8 us_img_user">
                                    <input type="file" class="form-control" name="u_img" id="u_img" onchange="Showimg_user(this)">
                                </div>
                                
                                <div class="col-md-4 us_img_user">
                                    <label>สถานที่</label>
                                </div>
                                <div class="col-md-8 us_img_user">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="hidden" name="u_site" class="u_site">
                                            <select class="form-control u_site" name="u_site" disabled>
                                                <?php 
                                                    $site_stmt = $dbcon->prepare("SELECT * FROM tb2_site ");
                                                    $site_stmt->execute();
                                                    while ($row_site = $site_stmt->fetch(PDO::FETCH_BOTH)) {
                                                        echo '<option value="'.$row_site["site_id"].'">'.$row_site["site_name"].'</option>';
                                                    } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 us_img_user">
                                    <label>โรงเรือน <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-8 us_img_user">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <select class="form-control u_house" name="u_house">
                                                <?php 
                                                    echo '<option value="0">เลือกสถานที่</option>';
                                                    $house_stmt = $dbcon->prepare("SELECT * FROM tb2_house WHERE house_siteID ='$siteID' ");
                                                    $house_stmt->execute();
                                                    while ($row_house = $house_stmt->fetch(PDO::FETCH_BOTH)) {
                                                        echo '<option value="'.$row_house["house_id"].'">'.$row_house["house_name"].'</option>';
                                                    } ?>
                                            </select>
                                            <div class="invalid-feedback">กรุณาระบุโรงเรือน</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>ชื่อผู้ใช้งาน <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control u_user" name="u_user" placeholder="ชื่อผู้ใช้งาน">
                                            <div class="invalid-feedback bu_user"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 us_pass">
                                    <label>รหัสผ่าน <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-8 us_pass">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="password" class="form-control u_pass" name="u_pass" placeholder="รหัสผ่าน" value="">
                                            <div class="invalid-feedback bu_pass"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>อีเมลล์ <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="email" class="form-control u_email" name="u_email" placeholder="อีเมลล์">
                                            <div class="invalid-feedback bu_email"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>หมายเลขโทรศัพท์</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control u_tel" name="u_tel" placeholder="หมายเลขโทรศัพท์">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>ระดับผู้ใช้งาน</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <select name="u_status" class="form-control u_status">
                                                <?php
                                                if ($_SESSION["login_status"] == 1) {
                                                    echo '<option value="3">User</option>
                                                          <option value="2">Admin</option>
                                                          <option value="1">Supper Admin</option>';
                                                } else {
                                                    echo '<option value="3">User</option>
                                                          <option value="2">Admin</option> ';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success submit_u"><i class="fadeIn animated bx bx-save"></i>บันทึก</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fadeIn animated bx bx-window-close"></i>ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function Showimg_user(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.u_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".u_add").click(function() {
        $(".title_mUser").html("ลงทะเบียนผู้ใช้ใหม่");
        $(".us_user_sel").hide();
        $(".us_img_user").show();
        $('.u_img').attr("src", "public/images/default.jpg").removeClass("mb-3");
        $("#u_img").val("");
        $(".mode_insert").val("add_user");
        $(".mode_userST_id").val("");
        $(".u_imgDF").val("");
        $(".u_site").val($(".sel_main_site").val());
        $(".u_house").removeClass("is-invalid").val("0").attr("disabled",false);
        $(".u_user").removeClass("is-invalid").val("").attr("disabled",false);
        $(".us_pass").show();
        $(".u_pass").removeClass("is-invalid").val("");
        $(".u_email").removeClass("is-invalid").val("").attr("disabled",false);
        $(".u_tel").val("").attr("disabled",false);
        $(".u_status").val("3").attr("disabled",false);
        $("#modal_User").modal("show");
    });
    $(".u_edit").click(function(){
        $(".title_mUser").html("แก้ไขผู้ใช้งาน");
        $(".us_user_sel").hide();
        $(".us_img_user").hide();
        var img = $(this).attr("img");
        if(img === ""){
            $('.u_img').attr("src", "public/images/users/user.png").addClass("mb-3");
        }else{
            $('.u_img').attr("src", "public/images/users/"+img).addClass("mb-3");
        }
        $("#u_img").val("");
        $(".mode_insert").val("edit_user");
        $(".mode_userST_id").val($(this).attr("userST_id"));
        $(".u_imgDF").val(img);
        $(".u_site").val($(".sel_main_site").val());
        $(".u_house").removeClass("is-invalid").val($(this).attr("houseID")).attr("disabled",true);
        $(".u_user").removeClass("is-invalid").val($(this).attr("name")).attr("disabled",true);
        $(".us_pass").hide();
        $(".u_pass").removeClass("is-invalid").val("");
        $(".u_email").removeClass("is-invalid").val($(this).attr("email")).attr("disabled",true);
        $(".u_tel").val($(this).attr("tel")).attr("disabled",true);
        $(".u_status").val($(this).attr("status")).attr("disabled",false);
        $("#modal_User").modal("show");
    });
    $(".u_Suser").click(function() {
        $(".title_mUser").html("เพิ่มผู้ใช้งานจากรายชื้อที่มี");
        $(".us_user_sel").show();
        $(".use_site").val($(".sel_main_site").val());
        $(".use_house").val("0");
        $(".use_userID").val("0");
        $(".us_img_user").hide();
        $('.u_img').attr("src", "public/images/default.jpg")
        $("#u_img").val("");
        $(".mode_insert").val("add_user2");
        $(".mode_userID").val("");
        $(".u_imgDF").val("");

        $(".u_site").val($(".sel_main_site").val());
        $(".u_house").removeClass("is-invalid").val("0").attr("disabled",false);
        $(".u_user").removeClass("is-invalid").val("").attr("disabled",true);
        $(".us_pass").hide();
        $(".u_pass").removeClass("is-invalid").val("");
        $(".u_email").removeClass("is-invalid").val("").attr("disabled",true);
        $(".u_tel").val("").attr("disabled",true);
        $(".u_status").val('3').attr("disabled",false);
        $("#modal_User").modal("show");
        // ----------------------------------------
        $(".use_house").change(function () { 
            $(".use_userID").load("routes/droupdown_sel_user.php?houseID="+$(this).val());
        });
        $(".use_userID").change(function() {
            var user_id = $(this).val();
            $.ajax({
                url: "routes/droupdown_user.php",
                method: "post",
                data: {
                    user_id: user_id
                },
                dataType: "json",
                success: function(res) {
                    console.log(res);
                    var img = res.login_image;
                    if(img === ""){
                        $('.u_img').attr("src", "public/images/users/user.png").addClass("mb-3");
                    }else{
                        $('.u_img').attr("src", "public/images/users/"+img).addClass("mb-3");
                    }
                    $(".u_user").val(res.login_user);
                    $(".u_email").val(res.login_email);
                    $(".u_tel").val(res.login_tel);
                }
            });
        });
    });
    $(".submit_u").click(function () { 
        if ($(".mode_insert").val() === "add_user") {
            if($(".u_house").val() === "0"){
                $(".u_house").addClass("is-invalid");
                return false;
            }else{
                $(".u_house").removeClass("is-invalid");
            }
            if($(".u_user").val() === ""){
                $(".u_user").addClass("is-invalid");
                $(".bu_user").html("กรถณาระบุชื่อผู้ใช้งาน");
                return false;
            }else{
                $(".u_user").removeClass("is-invalid");
            }
            if($(".u_pass").val() === ""){
                $(".u_pass").addClass("is-invalid");
                $(".bu_pass").html("กรถณาระบุรหัสผ่าน");
                return false;
            }else{
                $(".u_pass").removeClass("is-invalid");
            }
            if($(".u_email").val() === ""){
                $(".u_email").addClass("is-invalid");
                $(".bu_email").html("กรถณาระบุอีเมลล์");
                return false;
            }else{
                $(".u_email").removeClass("is-invalid");
            }
        }
        if($(".mode_insert").val() === "add_user2") {
            if($(".use_house").val() === "0"){
                $(".use_house").addClass("is-invalid");
                return false;
            }else{
                $(".use_house").removeClass("is-invalid");
            }
            if($(".use_userID").val() === "0"){
                $(".use_userID").addClass("is-invalid");
                $(".buse_userID").html("กรุณาระบุโรงเรือน");
                return false;
            }else{
                $(".use_userID").removeClass("is-invalid");
            }
        }
        // var loading = verticalNoTitle();
        $.ajax({
            type: "POST",
            url: "routes/insert_setting.php",
            data: new FormData($("#user_form")[0]), 
            contentType: false, 
            cache: false,
            processData: false,
            success: function(res) {
                // loadingOut(loading);
                var parseJSON = $.parseJSON(res);
                // console.log(parseJSON.data)
                // return false
                if (parseJSON.status === "มีรายชื่อนี้แล้ว") {
                    swal({
                        title: 'มีรายชื่อนี้แล้ว !',
                        // text: "" + sw_name + " ?",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $(".u_user").addClass("is-invalid");
                    $(".bu_user").html("กรถณาระบุชื่อผู้ใช้งานใหม่");
                    return false;
                }
                if (parseJSON.status === "house มีรายชื่อนี้แล้ว") {
                    swal({
                        title: 'ผู้ใช้งานนี้เข้าถึงโรงเรือนนี้อยู่แล้ว !',
                        text: "กรุณาเลือกผู้ใช้งานใหม่",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $(".use_userID").addClass("is-invalid");
                    $(".buse_userID").html("กรถณาระบุชื่อผู้ใช้งานใหม่");
                    return false;
                }
                if (parseJSON.status === "รูปแบบ email ไม่ถูกต้อง") {
                    swal({
                        title: 'รูปแบบอีเมลล์ไม่ถูกต้อง !',
                        // text: "" + sw_name + " ?",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $(".u_email").addClass("is-invalid");
                    $(".bu_email").html('กรถณาระบุแีเมลล์ใหม่');
                    return false;
                }
                if (parseJSON.status === "มี email นี้แล้ว") {
                    swal({
                        title: 'อีเมลล์นี้ถูกใช้งานแล้ว !',
                        // text: "" + sw_name + " ?",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $(".u_email").addClass("is-invalid");
                    $(".bu_email").html('กรถณาระบุแีเมลล์ใหม่');
                    return false;
                }
                if (parseJSON.status === "สกุลไฟล์ไม่ถูกต้อง") {
                    swal({
                        title: 'รูปภาพไม่ถูกต้อง !',
                        text: "โปรดเลือกไฟล์สกุล gif, jpeg, jpg, png หรือ svg",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    return false;
                }
                if (parseJSON.status == "Insert_Error") {
                    swal({
                        title: 'เกิดข้อผลิดพลาด !',
                        text: "บันทึกไม่สำเร็จ !!!",
                        type: 'error',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                    return false;
                }  
                if (parseJSON.status == "Insert_success"){
                    $("#user_access").load("views/load_tableUser.php?siteID="+$(".sel_main_site").val());
                    swal({
                        title: 'บันทึกข้อมูลสำเร็จ.',
                        // text: "" + sw_name + " ?",
                        type: 'success',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $("#modal_User").modal("hide");
                }
            }
        });
    });
    $(".delete_user").click(function(){
        swal({
            title: 'Delete !',
            text: "คุณต้องการที่จะลบผู้ใช้งาน : "+$(this).attr("name")+" หรือไม่ ?",
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#00CC33',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ไช่',
            cancelButtonText: 'ยกเลิก'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'routes/insert_setting.php',
                    type: 'POST',
                    data: {
                        user_id : $(this).attr("user_id"),
                        mode_insert : "delete_user",
                        img : $(this).attr("img")
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == "Insert_Error") {
                            swal({
                                title: 'เกิดข้อผลิดพลาด !',
                                text: "บันทึกไม่สำเร็จ !!!",
                                type: 'error',
                                allowOutsideClick: false,
                                confirmButtonColor: '#32CD32'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                            return false;
                        }  
                        if (data.status == "Delete_success"){
                            $("#user_access").load("views/load_tableUser.php?siteID="+$(".sel_main_site").val());
                            swal({
                                title: 'ลบข้อมูลสำเร็จ.',
                                // text: "" + sw_name + " ?",
                                type: 'success',
                                allowOutsideClick: false,
                                confirmButtonColor: '#32CD32'
                            });
                        }
                    }
                });
            }
        });
    });
</script>