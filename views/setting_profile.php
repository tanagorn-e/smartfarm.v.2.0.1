<?php
    session_start();
    require "../routes/connectdb.php";
    $user_id = $_SESSION['user_id'];
    $query = $dbcon->query("SELECT * FROM tb2_login WHERE login_id = '$user_id' ")->fetch();
    // print_r($query);
    // echo $query;
// echo array_count_values($controlstatus)['0'];
// exit();
?>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">ตั้งค่า</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="-alt"></i></a>
                    </li>
                    <!-- <li class="breadcrumb-item" aria-current="page"></li> -->
                    <li class="breadcrumb-item title_ht" aria-current="page"></li>
                    <!-- <li class="breadcrumb-item" aria-current="page"> ข้อมูลผู้ใช้งาน </li> -->
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <!-- <h6 class="mb-0 text-uppercase">Horizontal Card</h6> -->
    <hr/>
    <div class="row">
        <div class="col-12 col-lg-2 col-xl-2 d-flex">
            <div class="card w-100 radius-10">
                <div class="card-body"> 
                    <ul class="nav nav-pills flex-column" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-center pt_pt" data-bs-toggle="pill" href="#p-pt" role="tab" aria-selected="true" style="border: 1px solid transparent; border-color: #6c757d;">
                                ข้อมูลผู้ใช้งาน
                            </a>
                        </li>
                        <?php if($_SESSION['count_statusUser'] != 0){
                            echo '<li class="nav-item6" role="presentation">
                                <a class="nav-link text-center pt_st" data-bs-toggle="pill" href="#p-st" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                                    สถานที่
                                </a>
                            </li>
                            <li class="nav-item6" role="presentation">
                                <a class="nav-link text-center pt_ht" data-bs-toggle="pill" href="#p-ht" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                                    โรงเรือน
                                </a>
                            </li>
                            <li class="nav-item6" role="presentation">
                                <a class="nav-link text-center pt_ust" data-bs-toggle="pill" href="#p-ust" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                                    กำหนดสิทธิ์ผู้ใช้งาน
                                </a>
                            </li>';
                        }?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-10 col-xl-10 d-flex">
            <div class="card w-100 radius-10">
                <div class="tab-content">
                    <div class="tab-pane fade" id="p-pt" role="tabpanel">
                        <div class="card radius-10 border shadow-none">
                            <div class="card-body p-5">
                                <div class="row g-3">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <?php if($query["login_image"] === ""){echo '<img src="public/images/users/user.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">';
                                        }else{ echo '<img src="public/images/users/'. $query["login_image"] .'" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">';} ?>
                                    </div>
                                    <hr>
                                    <div class="col-12">
                                        <label for="Username" class="form-label">ชื่อผู้ใช้งาน</label>
                                        <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                            <input type="text" class="form-control border-start-0" placeholder="ชื่อผู้ใช้งาน" value="<?= $query["login_user"] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="E-mail" class="form-label">อีเมลล์</label>
                                        <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="fadeIn animated bx bx-mail-send"></i></span>
                                            <input type="email" class="form-control border-start-0" placeholder="อีเมลล์" value="<?= $query['login_email'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="Mobite" class="form-label">โทรศัพท์</label>
                                        <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="fadeIn animated bx bx-mobile"></i></span>
                                            <input type="tel" class="form-control border-start-0" placeholder="โทรศัพท์" value="<?= $query['login_tel'] ?>" disabled>
                                        </div>
                                    </div>
                                    <!-- <div class="col-12"> -->
                                        <!-- <label for="Mobite" class="form-label">สถานะผู้ใช้งาน</label> -->
                                        <!-- <div class="input-group input-group-lg"> 
                                            <span class="input-group-text bg-transparent"><i class="bx bx-menu"></i></span> -->
                                            <!-- <input type="tel" class="form-control border-start-0" placeholder="โทรศัพท์" value="<?// $query['login_tel'] ?>" disabled> -->
                                            <!-- <select class="form-control border-start-0" value="<?// $query['login_status'] ?>" disabled >
                                                <option value="1">Supper Admin</option>
                                                <option value="2">Admin</option>
                                                <option value="3">User</option>
                                                <option value="4">Viwer</option>
                                            </select>
                                        </div> -->
                                    <!-- </div> -->
                                    <div class="text-center">
                                        <button type="button" class="btn btn-info px-5 edit_p"><i class="fadeIn animated bx bx-message-square-edit"></i>แก้ไข</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modal_profile" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">แก้ไขข้อมูลผู้ใช้งาน</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3" id="profile_from" enctype="multipart/form-data" onSubmit="return false;">
                                            <div class="d-flex flex-column align-items-center text-center">
                                                <img class="rounded-circle p-1 bg-primary p_img" width="110">
                                                <div class="mt-3 input-group">
                                                        <!-- <label class="input-group-text" for="inputGroupFile01"></label> -->
                                                    <input type="file" class="form-control" name="p_img" id="p_img" onchange="Showimg_profile(this)">
                                                    <input type="hidden" name="mode_insert" value="edit_profile">
                                                    <input type="hidden" name="p_imgDF" value="<?= $query['login_image'] ?>">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-12">
                                                <label for="Username" class="form-label">ชื่อผู้ใช้งาน <span class="text-danger">*</span></label>
                                                <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                                    <input type="text" class="form-control border-start-0 p_name" name="p_name" placeholder="ชื่อผู้ใช้งาน">
                                                    <div class="invalid-feedback bp_name"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="Password" class="form-label">รหัสผ่าน</label>
                                                <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="bx bxs-lock-open"></i></span>
                                                    <input type="text" class="form-control border-start-0 p_pass" name="p_pass" placeholder="รหัสผ่าน">
                                                    <input type="hidden" name="p_passDF" value="<?= $query['login_pass'] ?>">
                                                    <input type="hidden" name="p_passDF2" value="<?= $query['login_pa'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="E-mail" class="form-label">อีเมลล์ <span class="text-danger">*</span></label>
                                                <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="fadeIn animated bx bx-mail-send"></i></span>
                                                    <input type="email" class="form-control border-start-0 p_email" name="p_email" placeholder="อีเมลล์">
                                                    <input type="hidden" name="p_emailDF" value="<?= $query['login_email'] ?>">
                                                    <div class="invalid-feedback bp_email"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="Mobite" class="form-label">โทรศัพท์</label>
                                                <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="fadeIn animated bx bx-mobile"></i></span>
                                                    <input type="tel" class="form-control border-start-0 p_tel" name="p_tel" placeholder="โทรศัพท์">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success submit_p"><i class="fadeIn animated bx bx-save"></i>บันทึก</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fadeIn animated bx bx-window-close"></i>ยกเลิก</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($_SESSION['count_statusUser'] != 0){?>
                        <div class="tab-pane fade" id="p-st" role="tabpanel">
                            <div class="card radius-10 border shadow-none">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-outline-success me-1 s_add mb-3"><i class="bi bi-plus-square"></i> เพิ่มสถานที่</button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="table1" class="table table-striped table-bordered dataTable" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Images</th>
                                                    <th class="text-center">ชื่อสถานที่</th>
                                                    <th class="text-center">ที่อยู่</th>
                                                    <th class="text-center">ละติจูด</th>
                                                    <th class="text-center">ลองจิจูด</th>
                                                    <th class="text-center">อินเตอร์เน็ต</th>
                                                    <th class="text-center">วันอินเตอร์เน็ตหมด</th>
                                                    <th class="text-center">ผู้บันทึกล่าสุด</th>
                                                    <th class="text-center">วัน-เวลาอัพเดท</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($_SESSION["login_status"] == 1) {
                                                    $stmt = $dbcon->prepare("SELECT * FROM tb2_site INNER JOIN tb2_login ON tb2_site.site_userST_id = tb2_login.login_id ");
                                                } else {
                                                    $stmt = $dbcon->prepare("SELECT * FROM tb3_userst INNER JOIN tb2_site ON tb3_userst.userST_siteID = tb2_site.site_id INNER JOIN tb2_login ON tb2_site.site_userST_id = tb2_login.login_id WHERE userST_loginID = '$user_id' GROUP BY tb3_userst.userST_siteID ");
                                                }
                                                $stmt->execute();
                                                $count = $stmt->rowCount();

                                                // if($count != 0){
                                                $inc = 1;
                                                $data0 = array();
                                                while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                                                    echo '<tr>
                                                                <td class="text-center">' . $inc . '</td>';
                                                    if ($row["site_img"] == "") {
                                                        echo '<td class="text-center"><img src="public/images/default.jpg" width="50"  height="50" alt="..."></td>';
                                                    } else {
                                                        echo '<td class="text-center"><img src="public/images/site/' . $row["site_img"] . '" width="50"  height="50" alt="..."></td>';
                                                    }
                                                    echo '  <td class="text-center">' . $row["site_name"] . '</td>
                                                                <td class="text-center">' . $row["site_address"] . '</td>
                                                                <td class="text-center">' . $row["site_Latitude"] . '</td>
                                                                <td class="text-center">' . $row["site_Longitude"] . '</td>
                                                                <td class="text-center">' . $row["site_internet"] . '</td>
                                                                <td class="text-center">' . $row["site_internetO"] . '</td>
                                                                <td class="text-center">' . $row["login_user"] . '</td>
                                                                <td class="text-center">' . $row["sote_timestamp"] . '</td>
                                                                <td  class="text-center">
                                                                    <div class="buttons">
                                                                        <a href="javascript:void(0)" class="text-info edit_site" 
                                                                            site_id="' . $row["site_id"] . '" 
                                                                            img="' . $row["site_img"] . '" 
                                                                            name="' . $row["site_name"] . '" 
                                                                            adss="' . $row["site_address"] . '"
                                                                            la="' . $row["site_Latitude"] . '" 
                                                                            long="' . $row["site_Longitude"] . '"
                                                                            inte="' . $row["site_internet"] . '"
                                                                            inteO="' . $row["site_internetO"] . '">
                                                                            <i class="fadeIn animated bx bx-message-square-edit"></i>
                                                                        </a>';
                                                                    if($_SESSION["login_status"] == 1 || $row["userST_user_status"] == 2){
                                                                        echo '<a href="javascript:void(0)" class="text-danger delete_site" 
                                                                            site_id="' . $row["site_id"] . '" 
                                                                            name="' . $row["site_name"] . '"
                                                                            img="' . $row["site_img"] . '">
                                                                            <i class="fadeIn animated bx bx-trash"></i>
                                                                        </a>';
                                                                    }else{echo '<a class="text-secondary" onclick="return false;"><i class="fadeIn animated bx bx-trash"></i></a>';}
                                                                    echo '</div>
                                                                </td>
                                                            </tr>';
                                                    $inc++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <div class="modal fade text-left" id="modal_site" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title title_mSite"> </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" id="site_form" enctype="multipart/form-data" onSubmit="return false;">
                                                            <div class="text-center">
                                                                <img class="w-25 s_img mb-2" alt="...">
                                                                <input type="hidden" name="mode_insert" class="mode_insert">
                                                                <input type="hidden" name="site_id" class="mode_siteID">
                                                                <input type="hidden" name="s_imgDF" class="s_imgDF">
                                                            </div>
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <!-- <label class="col-md-4">Images </label> -->
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="file" class="form-control" name="s_img" id="s_img" onchange="Showimg_site(this)">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>ชื่อสถานที่ <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group has-icon-left">
                                                                            <div class="position-relative">
                                                                                <input type="text" class="form-control s_name" name="s_name" placeholder="ชื่อสถานที่">
                                                                                <input type="hidden" name="s_nameDF" class="s_nameDF">
                                                                                <div class="invalid-feedback bs_name"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>ที่อยู่ <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group has-icon-left">
                                                                            <div class="position-relative">
                                                                                <textarea type="text" class="form-control s_address" name="s_address" placeholder="ที่อยู่" rows="3"></textarea>
                                                                                <div class="invalid-feedback">กรุณาระบุที่อยู่</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>ละติจูด <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group has-icon-left">
                                                                            <div class="position-relative">
                                                                                <input type="number" class="form-control s_la" name="s_la" placeholder="ละติจูด">
                                                                                <div class="invalid-feedback">กรุณาระบุละติจูด</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>ลองจิจูด <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group has-icon-left">
                                                                            <div class="position-relative">
                                                                                <input type="number" class="form-control s_long" name="s_long" placeholder="ลองจิจูด">
                                                                                <div class="invalid-feedback">กรุณาระบุลองจิจูด</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>อินเตอร์เน็ต </label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group has-icon-left">
                                                                            <div class="position-relative">
                                                                                <input type="text" class="form-control s_internet" name="s_internet" placeholder="อินเตอร์เน็ต">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>อินเตอร์เน็ตหมดอายุ </label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group has-icon-left">
                                                                            <div class="position-relative">
                                                                                <input type="text" class="form-control s_internetO" name="s_internetO" placeholder="อินเตอร์เน็ตหมดอายุ" aria-label="อินเตอร์เน็ตหมดอายุ" aria-describedby="button-addon2">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success submit_s"><i class="fadeIn animated bx bx-save"></i>บันทึก</button>
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fadeIn animated bx bx-window-close"></i>ยกเลิก</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="p-ht" role="tabpanel">
                            <div class="card radius-10 border shadow-none">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-outline-success me-1 h_add mb-3"><i class="bi bi-plus-square"></i> เพิ่มโรงเรือน</button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="table2" class="table table-striped table-bordered dataTable" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">สถานที่</th>
                                                    <th class="text-center">ชื่อโรงเรือน</th>
                                                    <th class="text-center">หมายเลขซีเรียล</th>
                                                    <th class="text-center">โรงเรือน</th>
                                                    <th class="text-center">จุดติดตั้งเซ็นเซอร์ทั้งหมด</th>
                                                    <th class="text-center">ผู้บันทึกล่าสุด</th>
                                                    <th class="text-center">วัน-เวลาอัพเดท</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($_SESSION["login_status"] == 1) {
                                                    $stmt = $dbcon->prepare("SELECT * FROM tb2_house INNER JOIN tb2_site ON tb2_house.house_siteID = tb2_site.site_id INNER JOIN tb2_login ON tb2_house.house_userST_id = tb2_login.login_id ORDER BY house_siteID");
                                                } else {
                                                    // $stmt = $dbcon->prepare("SELECT * FROM tb2_site INNER JOIN tb3_userst ON tb2_site.site_id = tb3_userst.userST_id WHERE site_id = '$user_id' ");
                                                    $stmt = $dbcon->prepare("SELECT * FROM tb3_userst INNER JOIN tb2_site ON tb3_userst.userST_siteID = tb2_site.site_id INNER JOIN tb2_house ON tb3_userst.userST_houseID = tb2_house.house_id INNER JOIN tb2_login ON tb2_site.site_userST_id = tb2_login.login_id WHERE userST_loginID = '$user_id' GROUP BY tb3_userst.userST_siteID ORDER BY tb3_userst.userST_siteID");
                                                }
                                                $stmt->execute();
                                                $count = $stmt->rowCount();

                                                // if($count != 0){
                                                $inc = 1;
                                                $data0 = array();
                                                while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                                                    echo '<tr>
                                                                <td class="text-center">' . $inc . '</td>
                                                                <td class="text-center">' . $row["site_name"] . '</td>
                                                                <td class="text-center">' . $row["house_name"] . '</td>
                                                                <td class="text-center">' . $row["house_master"] . '</td>';
                                                    if ($row["house_img"] == "") {
                                                        echo '<td class="text-center"><img src="public/images/default.jpg" width="50" height="50" alt="..."></td>';
                                                    } else {
                                                        echo '<td class="text-center"><img src="public/images/house/' . $row["house_img"] . '" width="50"  height="50" alt="..."></td>';
                                                    }
                                                    if ($row["house_img_map"] == "") {
                                                        echo '<td class="text-center"><img src="public/images/default.jpg" width="50" height="50" alt="..."></td>';
                                                    } else {
                                                        echo '<td class="text-center"><img src="public/images/img_map/' . $row["house_img_map"] . '" width="50"  height="50" alt="..."></td>';
                                                    }
                                                    echo   '<td class="text-center">' . $row["login_user"] . '</td>
                                                            <td class="text-center">' . $row["house_timpstamp"] . '</td>
                                                            <td  class="text-center">
                                                                <div class="buttons">
                                                                    <a href="javascript:void(0)" class="text-info h_edit" 
                                                                        house_id="' . $row["house_id"] . '" 
                                                                        site_id="' . $row["house_siteID"] . '" 
                                                                        name="' . $row["house_name"] . '" 
                                                                        sn="' . $row["house_master"] . '"
                                                                        img="' . $row["house_img"] . '" 
                                                                        img_map="' . $row["house_img_map"] . '">
                                                                        <i class="fadeIn animated bx bx-message-square-edit"></i>
                                                                    </a>';
                                                                    if($_SESSION["login_status"] == 1 || $row["userST_user_status"] == 2){
                                                                        echo '<a href="javascript:void(0)" class="text-danger delete_house" 
                                                                            house_id="' . $row["house_id"] . '" 
                                                                            sn="' . $row["house_master"] . '" 
                                                                            name="' . $row["house_name"] . '"
                                                                            img="' . $row["house_img"] . '"
                                                                            img_map="'. $row["house_img_map"] . '">
                                                                            <i class="fadeIn animated bx bx-trash"></i>
                                                                        </a>';
                                                                    }else{echo '<a class="text-secondary" onclick="return false;"><i class="fadeIn animated bx bx-trash"></i></a>';}
                                                            echo '</div>
                                                            </td>
                                                        </tr>';
                                                    $inc++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <div class="modal fade text-left" id="modal_house" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title title_mHouse"> </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" id="house_form" enctype="multipart/form-data" onSubmit="return false;">
                                                            <div class="text-center">
                                                                <img src="" class="w-25 h_img mb-2" alt="...">
                                                                <input type="hidden" name="mode_insert" class="mode_insert">
                                                                <input type="hidden" name="house_id" class="mode_houseID">
                                                                <input type="hidden" name="h_imgDF" class="h_imgDF">
                                                            </div>
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label class="col-md-4">โรงเรือน </label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="file" class="form-control" name="h_img" id="h_img" onchange="Showimg_house(this)">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>สถานที่ <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group has-icon-left">
                                                                            <div class="position-relative">
                                                                                <select class="form-control h_site" name="h_site">
                                                                                    <?php 
                                                                                        echo '<option value="0">เลือกสถานที่</option>';
                                                                                        if ($_SESSION["login_status"] != 1) {
                                                                                            $site_stmt = $dbcon->prepare("SELECT * FROM `tb3_userst` INNER JOIN tb2_site ON tb3_userst.userST_siteID = tb2_site.site_id WHERE tb3_userst.userST_loginID = '$user_id' GROUP BY userST_siteID ");
                                                                                        } else {
                                                                                            $site_stmt = $dbcon->prepare("SELECT * FROM tb2_site ");
                                                                                        }
                                                                                        $site_stmt->execute();
                                                                                        while ($row_site = $site_stmt->fetch(PDO::FETCH_BOTH)) {
                                                                                            echo '<option value="'.$row_site["site_id"].'">'.$row_site["site_name"].'</option>';
                                                                                        } ?>
                                                                                </select>
                                                                                <div class="invalid-feedback">กรุณาระบุสถานที่</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>ชื่อโรงเรือน <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group has-icon-left">
                                                                            <div class="position-relative">
                                                                                <input type="text" class="form-control h_name" name="h_name" placeholder="ชื่อโรงเรือน">
                                                                                <div class="invalid-feedback">กรุณ่ระบุชื่อโรงเรือน</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>หมายเลขซีเรียล <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="form-group has-icon-left">
                                                                            <div class="position-relative">
                                                                                <input type="text" class="form-control h_sn" name="h_sn" placeholder="หมายเลขซีเรียล">
                                                                                <input type="hidden" name="h_snDF" class="h_snDF">
                                                                                <div class="invalid-feedback bh_sn"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-center">
                                                                <img src="" class="w-25 h_img_map mb-2" alt="...">
                                                                <input type="hidden" name="h_img_mapDF" class="h_img_mapDF">
                                                            </div>
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label class="col-md-4">จุดติดตั้งเซ็นเซอร์ทั้งหมด </label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="file" class="form-control" name="h_img_map" id="h_img_map" onchange="Showimg_house_map(this)">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success submit_h"><i class="fadeIn animated bx bx-save"></i>บันทึก</button>
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fadeIn animated bx bx-window-close"></i>ยกเลิก</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="p-ust" role="tabpanel">
                            <div class="card-body">
                                <div class="d-sm-flex">
                                    <div class="ps-3">
                                        <label for="">เลือกสถานที่</label>
                                        <select class="btn btn-outline-info me-1 mb-3 sel_main_site">
                                            <?php 
                                                if ($_SESSION["login_status"] != 1) {
                                                    $site_stmt = $dbcon->prepare("SELECT * FROM `tb3_userst` INNER JOIN tb2_site ON tb3_userst.userST_siteID = tb2_site.site_id WHERE tb3_userst.userST_loginID = '$user_id' GROUP BY userST_siteID ");
                                                } else {
                                                    $site_stmt = $dbcon->prepare("SELECT * FROM tb2_site ");
                                                }
                                                $site_stmt->execute();
                                                while ($row_site = $site_stmt->fetch(PDO::FETCH_BOTH)) {
                                                    echo '<option value="'.$row_site["site_id"].'">'.$row_site["site_name"].'</option>';
                                                } ?>
                                        </select>
                                    </div>
                                    <div class="ms-auto">
                                        <button class="btn btn-outline-success me-1 u_add mb-3"><i class="bi bi-plus-square"></i> เพิ่มผู้ใช้งานใหม่</button>
                                        <button class="btn btn-outline-success me-1 u_Suser mb-3"><i class="bi bi-plus-square"></i> เพิ่มผู้ใช้งานจากที่มีอยู่</button>
                                    </div>
                                </div>
                                <div id="user_access"></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div><!--end row-->
    
</div>
<script>
    var pt = '<?= $_POST["pt"] ?>';
    if (pt == 1) {
        $(".title_ht").html("ข้อมูลผู้ใช้งาน");
        $(".pt_pt").addClass("active");
        $(".pt_st").removeClass("active");
        $(".pt_ht").removeClass("active");
        $(".pt_ust").removeClass("active");
        // 
        $("#p-pt").addClass("show active");
        $("#p-st").removeClass("show active");
        $("#p-ht").removeClass("show active");
        $("#p-ust").removeClass("show active");
    }else if (pt == 2){
        $(".title_ht").html("สถานที่");
        $(".pt_pt").removeClass("active");
        $(".pt_st").addClass("active");
        $(".pt_ht").removeClass("active");
        $(".pt_ust").removeClass("active");
        // 
        $("#p-pt").removeClass("show active");
        $("#p-st").addClass("show active");
        $("#p-ht").removeClass("show active");
        $("#p-ust").removeClass("show active");
    }else if (pt == 3){
        $(".title_ht").html("โรงเรือน");
        $(".pt_pt").removeClass("active");
        $(".pt_st").removeClass("active");
        $(".pt_ht").addClass("active");
        $(".pt_ust").removeClass("active");
        // 
        $("#p-pt").removeClass("show active");
        $("#p-st").removeClass("show active");
        $("#p-ht").addClass("show active");
        $("#p-ust").removeClass("show active");
    }else if (pt == 4){
        $(".title_ht").html("กำหนดสิทธิ์ผู้ใช้งาน");
        $(".pt_pt").removeClass("active");
        $(".pt_st").removeClass("active");
        $(".pt_ht").removeClass("active");
        $(".pt_ust").addClass("active");
        // 
        $("#p-pt").removeClass("show active");
        $("#p-st").removeClass("show active");
        $("#p-ht").removeClass("show active");
        $("#p-ust").addClass("show active");
        table_user();
    }
    function table_user(){
        var loading = verticalNoTitle();
        $("#user_access").load("views/load_tableUser.php?siteID="+$(".sel_main_site").val());
        loadingOut(loading);
    }
    $(".sel_main_site").change(function () { 
        table_user();
    });
    $(".pt_ust").click(function () { 
        table_user();
    });
    
    $(".edit_p").click(function () {
        $(".p_img").attr('src','public/images/users/<?= $_SESSION["login_image"] ?>');
        $("#p_img").val("");
        $(".p_name").val('<?= $query["login_user"] ?>');
        $(".p_pass").val("");
        $(".p_email").val('<?= $query['login_email'] ?>');
        $(".p_tel").val('<?= $query['login_tel'] ?>');
        $("#modal_profile").modal("show");    
    });
    function Showimg_profile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.p_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".submit_p").click(function () {
        if($(".p_name").val() === ""){
            $(".p_name").addClass("is-invalid");
            $(".bp_name").html("กรถณาระบุชื่อผู้ใช้งาน");
            return false;
        }else{
            $(".p_name").removeClass("is-invalid");
        }
        if($(".p_email").val() === ""){
            $(".p_email").addClass("is-invalid");
            $(".bp_email").html("กรถณาระบุแีเมลล์");
            return false;
        }else{
            $(".p_email").removeClass("is-invalid");
        }
        var loading = verticalNoTitle();
        $.ajax({
            type: "POST",
            url: "routes/insert_setting.php",
            data: new FormData($("#profile_from")[0]), 
            contentType: false, 
            cache: false,
            processData: false,
            success: function(res) {
                loadingOut(loading);
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
                    $(".p_name").addClass("is-invalid");
                    $(".bp_name").html("กรถณาระบุชื่อผู้ใช้งานใหม่");
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
                    $(".p_email").addClass("is-invalid");
                    $(".bp_email").html('กรถณาระบุแีเมลล์ใหม่');
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
                    $(".p_email").addClass("is-invalid");
                    $(".bp_email").html('กรถณาระบุแีเมลล์ใหม่');
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
                    $(".user-img").attr("src", "public/images/users/" + parseJSON.data.image);
                    $(".user_name").html(parseJSON.data.user);
                    $.ajax({
                        url: "views/setting_profile.php",
                        method: "post",
                        data: {
                            pt: 1
                        },
                        success: function(resp) {
                            $("#pills-profile").html(resp);
                        }
                    });
                    swal({
                        title: 'บันทึกข้อมูลสำเร็จ.',
                        // text: "" + sw_name + " ?",
                        type: 'success',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $("#modal_profile").modal("hide");
                }
            }
        });
    });
</script>

<script>
    // $('.s_internetO').daterangepicker({
    //     autoUpdateInput: false,
    //     singleDatePicker: true,
    //     showDropdowns: true,
    //     orientation: 'top right',
    //     timePicker: true,
    //     timePicker24Hour: true,
    //     minYear: 2016,
    //     // maxYear: parseInt(moment().format('YYYY'), 10),
    //     locale: {
    //         cancelLabel: 'Close'
    //     }
    // });
    // $('.s_internetO').on('apply.daterangepicker', function(ev, picker) {
    //     $(this).val(picker.startDate.format('YYYY/MM/DD'));
    // });
    $(".s_add").click(function() {
        $(".title_mSite").html("เพิ่มสถานที่");
        $('.s_img').attr("src", "public/images/default.jpg");
        $("#s_img").val("");
        $(".s_imgDF").val("");
        $(".mode_insert").val("add_site");
        $(".mode_siteID").val("");
        $(".s_name").removeClass("is-invalid").val("");
        $(".s_nameDF").val("");
        $(".s_address").removeClass("is-invalid").val("");
        $(".s_la").removeClass("is-invalid").val("");
        $(".s_long").removeClass("is-invalid").val("");
        $(".s_internet").val("");
        $(".s_internetO").val("");
        $("#modal_site").modal("show");
    });
    $(".edit_site").click(function(){
        $(".title_mSite").html("แก้สถานที่");
        var img = $(this).attr("img");
        // alert(img);
        if(img === ""){
        $('.s_img').attr("src", "public/images/default.jpg");
        }else{
        $('.s_img').attr("src", "public/images/site/"+img);
        }
        $(".s_imgDF").val(img);
        $("#s_img").val("");
        $(".mode_insert").val("edit_site");
        $(".mode_siteID").val($(this).attr("site_id"));
        $(".s_name").removeClass("is-invalid").val($(this).attr("name"));
        $(".s_nameDF").val($(this).attr("name"));
        $(".s_address").removeClass("is-invalid").val($(this).attr("adss"));
        $(".s_la").removeClass("is-invalid").val($(this).attr("la"));
        $(".s_long").removeClass("is-invalid").val($(this).attr("long"));
        $(".s_internet").val($(this).attr("inte"));
        $(".s_internetO").val($(this).attr("inteO"));
        $("#modal_site").modal("show");
    });
    $(".submit_s").click(function() {
        if($(".s_name").val() === ""){
            $(".s_name").addClass("is-invalid");
            $(".bs_name").html('กรุณาระบุชื่อสถานที่');
            return false;
        }else{
            $(".s_name").removeClass("is-invalid");
        }
        if($(".s_address").val() === ""){
            $(".s_address").addClass("is-invalid");
            return false;
        }else{
            $(".s_address").removeClass("is-invalid");
        }
        if($(".s_la").val() === ""){
            $(".s_la").addClass("is-invalid");
            return false;
        }else{
            $(".s_la").removeClass("is-invalid");
        }
        if($(".s_long").val() === ""){
            $(".s_long").addClass("is-invalid");
            return false;
        }else{
            $(".s_long").removeClass("is-invalid");
        }
        var loading = verticalNoTitle();
        $.ajax({
            type: "POST",
            url: "routes/insert_setting.php",
            data: new FormData($("#site_form")[0]), 
            contentType: false, 
            cache: false,
            processData: false,
            success: function(res) {
                loadingOut(loading);
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
                    $(".s_name").addClass("is-invalid");
                    $(".bs_name").html('กรุณาระบุชื่อสถานที่ใหม่');
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
                    $.ajax({
                        url: "views/setting_profile.php",
                        method: "post",
                        data: {
                            pt: 2
                        },
                        success: function(resp) {
                            $("#pills-profile").html(resp);
                        }
                    });
                    swal({
                        title: 'บันทึกข้อมูลสำเร็จ.',
                        // text: "" + sw_name + " ?",
                        type: 'success',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $("#modal_site").modal("hide");
                }
            }
        });
    });
    $(".delete_site").click(function(){
        swal({
            title: 'Delete !',
            text: "คุณต้องการที่จะลบสถานที่ : "+$(this).attr("name")+" หรือไม่ ?",
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#00CC33',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ไช่',
            cancelButtonText: 'ยกเลิก'
            }).then((result) => {
            if (result.value) {
                var loading = verticalNoTitle();
                $.ajax({
                    url: 'routes/insert_setting.php',
                    type: 'POST',
                    data: {
                        site_id : $(this).attr("site_id"),
                        mode_insert : "delete_site",
                        img : $(this).attr("img")
                    },
                    dataType: 'json',
                    success: function(data) {
                        loadingOut(loading);
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
                            $.ajax({
                                url: "views/setting_profile.php",
                                method: "post",
                                data: {
                                    pt: 2
                                },
                                success: function(resp) {
                                    $("#pills-profile").html(resp);
                                }
                            });
                            swal({
                                title: 'ลบข้อมูลสำเร็จ.',
                                // text: "" + sw_name + " ?",
                                type: 'success',
                                allowOutsideClick: false,
                                confirmButtonColor: '#32CD32'
                            });
                            $("#modal_site").modal("hide");
                        }
                    }
                });
            }
        });
    });
    function Showimg_site(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.s_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    // --------------------------
    $(".h_add").click(function() {
        $(".title_mHouse").html("เพิ่มโรงเรือน");
        $('.h_img').attr("src", "public/images/default.jpg");
        $("#h_imgDF").val("");
        $(".mode_insert").val("add_house");
        $(".mode_houseID").val("");
        $("#h_img").val("");
        $(".h_site").val("0");
        $(".h_name").removeClass("is-invalid").val("");
        $(".h_sn").removeClass("is-invalid").val("");
        $(".h_snDF").val("");
        $('.h_img_map').attr("src", "public/images/default.jpg");
        $(".h_img_mapDF").val("");
        $("#h_img_mapDF").val("");
        $("#modal_house").modal("show");
    });
    $(".h_edit").click(function() {
        $(".title_mHouse").html("แก้ไขโรงเรือน");
        var img = $(this).attr("img");
        if(img === ""){
        $('.h_img').attr("src", "public/images/default.jpg");
        }else{
        $('.h_img').attr("src", "public/images/house/"+img);
        }
        $(".h_imgDF").val(img);
        $(".mode_insert").val("edit_house");
        $(".mode_houseID").val($(this).attr("house_id"));
        $("#h_img").val("");
        $(".h_site").val($(this).attr("site_id"));
        $(".h_name").removeClass("is-invalid").val($(this).attr("name"));
        $(".h_sn").removeClass("is-invalid").val($(this).attr("sn"));
        $(".h_snDF").val($(this).attr("sn"));
        var img_map = $(this).attr("img_map");
        if(img_map === ""){
        $('.h_img_map').attr("src", "public/images/default.jpg");
        }else{
        $('.h_img_map').attr("src", "public/images/img_map/"+img_map);
        }
        $(".h_img_mapDF").val(img_map);
        $("#h_img_mapDF").val("");
        $("#modal_house").modal("show");
    });
    $(".submit_h").click(function() {
        if($(".h_site").val() === "0"){
            $(".h_site").addClass("is-invalid");
            return false;
        }else{
            $(".h_site").removeClass("is-invalid");
        }
        if($(".h_name").val() === ""){
            $(".h_name").addClass("is-invalid");
            return false;
        }else{
            $(".h_name").removeClass("is-invalid");
        }
        if($(".h_sn").val() === ""){
            $(".h_sn").addClass("is-invalid");
            $(".bh_sn").html('กรุณาระบุหมายเลขซีเรียล');
            return false;
        }else{
            $(".h_sn").removeClass("is-invalid");
        }
        var loading = verticalNoTitle();
        $.ajax({
            type: "POST",
            url: "routes/insert_setting.php",
            data: new FormData($("#house_form")[0]), 
            contentType: false, 
            cache: false,
            processData: false,
            success: function(res) {
                var parseJSON = $.parseJSON(res);
                // console.log(parseJSON.status)
                // return false
                if (parseJSON.status === "มีรายชื่อนี้แล้ว") {
                    swal({
                        title: 'มีหมายเลขซีเรียลนี้แล้ว !',
                        // text: "" + sw_name + " ?",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $(".h_sn").addClass("is-invalid");
                    $(".bh_sn").html('กรุณาระบุหมายเลขซีเรียลใหม่');
                    return false;
                }
                if (parseJSON.status === "สกุลไฟล์ไม่ถูกต้อง") {
                    if(parseJSON.img === "img1"){
                        var e_img = "โรงเรือน";
                    }else{
                        var e_img = "จุดติดตั้งเซ็นเซอร์ทั้งหมด";
                    }
                    swal({
                        title: 'รูปภาพไม่ถูกต้อง !',
                        text: e_img+" : โปรดเลือกไฟล์สกุล gif, jpeg, jpg, png หรือ svg",
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
                    $.ajax({
                        url: "views/setting_profile.php",
                        method: "post",
                        data: {
                            pt: 3
                        },
                        success: function(resp) {
                            $("#pills-profile").html(resp);
                        }
                    });
                    // --------------------------------------
                    var house_master = $(".h_sn").val();
                    // Global variables
                    var client = null;
                    // These are configs
                    var hostname = "203.150.37.144"; //'103.2.115.15'; // 203.150.37.144   decccloud.com
                    var port = "8083";
                    var clientId = "mqtt_js_" + parseInt(Math.random() * 100000, 10);
                    var count = 0;

                    function connect() {
                        client = new Paho.MQTT.Client(hostname, Number(port), clientId);
                        console.info('Connecting to Server: Hostname: ', hostname, '. Port: ', port, '. Client ID: ', clientId);

                        client.onConnectionLost = onConnectionLost;
                        client.onMessageArrived = onMessageArrived;

                        var options = {
                            onSuccess: onConnect, // after connected, subscribes
                            onFailure: onFail // useful for logging / debugging
                        };
                        // connect the client
                        client.connect(options);
                        console.info('Connecting...');
                    }
                    // ---------------------------------------------------------------------------------------

                    function onConnect(context) {
                        console.log("Client Connected");
                        // And subscribe to our topics	-- both with the same callback function
                        options = {
                            qos: 1,
                            onSuccess: function(context) {
                                // console.log("ไม่สามารถเชื่อมต่อกับ เครื่อง ได้ !!!!");
                                // setInterval(function() {
                                //     location.reload();
                                // }, 30000);
                                console.log("subscribed");
                            }
                        }
                        client.subscribe("KO7MT001/1/control/mode", options);
                    }
                    function onFail(context) {
                        location.reload();
                    }
                    function onConnectionLost(responseObject) {
                        if (responseObject.errorCode !== 0) {
                            console.log("Connection Lost: " + responseObject.errorMessage);
                            // location.reload();
                            // window.alert("Someone else took my websocket!\nRefresh to take it back.");
                        }
                    }

                    function onMessageArrived(message) {
                        message = new Paho.MQTT.Message("Manual");
                        message.destinationName = house_master + "/1/control/mode";
                        message.retained = true;
                        message.qos = 1;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_1";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_2";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_3";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_4";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_5";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_6";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_7";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_8";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/foggy";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/fan";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("0");
                        message.destinationName = house_master + "/1/control/shader";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/fertilizer";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("Default");
                        message.destinationName = house_master + "/1/control/user_control";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        var jsonstring = {
                            "control_status":{
                                "Mode":"Manual",
                                "fertilizer":"OFF",
                                "dripper_1":"OFF",
                                "dripper_2":"OFF",
                                "dripper_3":"OFF",
                                "dripper_4":"OFF",
                                "dripper_5":"OFF",
                                "dripper_6":"OFF",
                                "dripper_7":"OFF",
                                "dripper_8":"OFF",
                                "foggy":"OFF",
                                "fan":"OFF",
                                "shader":"0",
                                "user_control":"Default"
                            },
                            "control_serial":house_master
                        };
                        message = new Paho.MQTT.Message(JSON.stringify(jsonstring));
                        message.destinationName = house_master + "/1/control/time_control";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        var jsonstring2 = {
                            "dripper_1":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"dripper_2":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"dripper_3":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"dripper_4":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"dripper_5":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"dripper_6":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"dripper_7":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"dripper_8":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"foggy":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"fan":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"shader":{
                                "S_1":{
                                    "T":"99:99",
                                    "L":"0"
                                },"S_2":{
                                    "T":"99:99",
                                    "L":"0"
                                },"S_3":{
                                    "T":"99:99",
                                    "L":"0"
                                },"S_4":{
                                    "T":"99:99",
                                    "L":"0"
                                },"S_5":{
                                    "T":"99:99",
                                    "L":"0"
                                },"S_6":{
                                    "T":"99:99",
                                    "L":"0"
                                }
                            }
                        };
                        message = new Paho.MQTT.Message(JSON.stringify(jsonstring2));
                        message.destinationName = house_master + "/1/control/json_control_filter";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);
                    }
                    connect();
                    // --------------------------------------
                    swal({
                        title: 'บันทึกข้อมูลสำเร็จ',
                        // text: "" + sw_name + " ?",
                        type: 'success',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $("#modal_house").modal("hide");
                }
                loadingOut(loading);
            }
        });
    });
    $(".delete_house").click(function(){
        swal({
            title: 'Delete !',
            text: "คุณต้องการที่จะลบโรงเรือน : "+$(this).attr("name")+" หรือไม่ ?",
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#00CC33',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ไช่',
            cancelButtonText: 'ยกเลิก'
            }).then((result) => {
            if (result.value) {
                var loading = verticalNoTitle();
                $.ajax({
                    url: 'routes/insert_setting.php',
                    type: 'POST',
                    data: {
                        house_id : $(this).attr("house_id"),
                        sn : $(this).attr("sn"),
                        mode_insert : "delete_house",
                        img : $(this).attr("img"),
                        img_map : $(this).attr("img_map")
                    },
                    dataType: 'json',
                    success: function(data) {
                        loadingOut(loading);
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
                            $.ajax({
                                url: "views/setting_profile.php",
                                method: "post",
                                data: {
                                    pt: 3
                                },
                                success: function(resp) {
                                    $("#pills-profile").html(resp);
                                }
                            });
                            swal({
                                title: 'ลบข้อมูลสำเร็จ.',
                                // text: "" + sw_name + " ?",
                                type: 'success',
                                allowOutsideClick: false,
                                confirmButtonColor: '#32CD32'
                            });
                            $("#modal_house").modal("hide");
                        }
                    }
                });
            }
        });
    });
    function Showimg_house(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.h_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function Showimg_house_map(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.h_img_map').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $('#table1').DataTable( {
        "scrollY": 400,
        "scrollX": true,
        "scrollCollapse": false,
        "paging":    false,
        "searching": false,
        "order": [
            [0, "desc"]
        ]
    });
    $('#table2').DataTable( {
        "scrollY": 400,
        "scrollX": true,
        "scrollCollapse": false,
        "paging":    false,
        "searching": false,
        "order": [
            [0, "desc"]
        ]
    });
</script>