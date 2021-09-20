
<?php
    // $s_master = $_POST['house_master'];
    $dashStatus = $_POST['dashStatus'];
    $dashName = $_POST['dashName'];
    $dashSncanel = $_POST["dashSncanel"];
    $dashMode = $_POST["dashMode"];
    $dashUnit = $_POST["dashUnit"];
    // $count_dash = array_count_values($dashMode)['1'];
    // print_r( array_count_values($dashStatus) );
    // print_r($dashUnit);
// echo array_count_values($controlstatus)['0'];
// exit();
?>
<style>
    .report_chart{
    height:400px;
    }
</style>
<div class="d-sm-flex">
    <div class="col-lg-6 col-xl-6 col-sm-12">
        <div class="row">
            <button type="button" class="col-sm-3 btn btn-outline-secondary px-2 all_day">1 วัน</button>
            <button type="button" class="col-sm-3 btn btn-outline-secondary px-2 all_week">1 สัปดาห์</button>
            <button type="button" class="col-sm-3 btn btn-outline-secondary px-2 all_month">1 เดือน</button>
            <button type="button" class="col-sm-3 btn btn-outline-secondary px-2 all_from_to">กำหนดเอง</button>
        </div>
    </div>
    <div class="ms-auto d-none d-sm-block">
        <!-- <div class="btn-group">
			<button type="button" class="col-sm-6 btn btn-primary"><i class="fadeIn animated bx bx-line-chart"></i> กราฟ</button>
            <button type="button" class="btn btn-primary"><i class="fadeIn animated bx bx-table"></i> ตาราง</button>
		</div> -->
        
        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active re_ch" data-bs-toggle="pill" href="#p-chart" role="tab" aria-selected="true" style="border: 1px solid transparent; border-color: #6c757d;">
                    <i class="fadeIn animated bx bx-line-chart"></i> กราฟ
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link re_tb" data-bs-toggle="pill" href="#p-table" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                    <i class="fadeIn animated bx bx-table"></i> ตาราง
                </a>
            </li>
        </ul>
    </div>
    <ul class="nav nav-pills d-sm-none" role="tablist">
        <li class="nav-item col-sm-6" role="presentation">
            <a class="nav-link active text-center re_ch" data-bs-toggle="pill" href="#p-chart" role="tab" aria-selected="true" style="border: 1px solid transparent; border-color: #6c757d;">
                <i class="fadeIn animated bx bx-line-chart"></i> กราฟ
            </a>
        </li>
        <li class="nav-item col-sm-6" role="presentation">
            <a class="nav-link text-center re_tb" data-bs-toggle="pill" href="#p-table" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                <i class="fadeIn animated bx bx-table"></i> ตาราง
            </a>
        </li>
    </ul>
</div><br>
<!-- Modal_select_sn -->
<div class="modal fade" id="Modal_select_sn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title">
                    <b class="title_mod"></b>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row hide_dwm">
                    <div class="col-lg-6 col-xl-6 col-sm-12">
                        <div class="input-group mb-3"> 
                            <span class="input-group-text col-sm-4" id="basic-addon3">เวลาเริ่ม</span>
                            <input type="text" class="form-control text-center val_start" placeholder="วันเวลาเริ่มต้น" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <div class="invalid-feedback">กรุณาระบุเวลาเริ่ม</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-sm-12">
                        <div class="input-group mb-3"> 
                            <span class="input-group-text col-sm-4" id="basic-addon3">เวลาสิ้นสุด</span>
                            <input type="text" class="form-control text-center val_end" placeholder="วันเวลาสิ้นสุด" aria-label="วันเวลาสิ้นสุด" aria-describedby="button-addon2">
                            <div class="invalid-feedback">กรุณาระบุเวลาสิ้นสุด</div>
                        </div>
                    </div>
                </div>
                
                <!-- เลือกเซ็นเซอร์ -->
                <!-- <div class="Collapse_tb_sel"> -->
                <h4 class="card-title text-center">
                    <b>เลือกเซ็นเซอร์</b>
                </h4><hr/>
                <div class="d-flex mb-2">
                    <div class="form-check mb-3">
                        <h5 style="margin-left:40px">
                        <!-- <input type="checkbox" class="form-check-input" id="checkbox_all_sn"> -->
                        <!-- <label class="form-check-label">เลือกทุกประเภท</label></h5> -->
                        <input type="hidden" class="house_master" value="<?= $_POST['house_master'] ?>">
                        <input type="hidden" class="mode_dwm">
                    </div>
                    <div class="ms-auto">
                        <label class="form-check-label" for="flexSwitchCheckCheckedDanger">แสดงข้อมูล : </label>
                        <select id="sel_all_every" class="form-check-label">
                            <option value="1">ทุก ๆ 1 นาที</option>
                            <option value="5">ทุก ๆ 5 นาที</option>
                            <option value="10">ทุก ๆ 10 นาที</option>
                            <option value="15">ทุก ๆ 15 นาที</option>
                            <option value="30">ทุก ๆ 30 นาที</option>
                            <option value="60">ทุก ๆ 1 ชั่วโมง</option>
                        </select>
                    </div>
                </div>
                <?php
                for($i=1; $i <= 40; $i++ ){
                    if($dashStatus[$i] == 1){
                        if($dashMode[$i] == 1){
                            $data_count1[] = $i;
                        }
                    }
                }
                for($i=1; $i <= 40; $i++ ){
                    if($dashStatus[$i] == 1){
                        if($dashMode[$i] == 2){
                            $data_count2[] = $i;
                        }
                    }
                }
                for($i=1; $i <= 40; $i++ ){
                    if($dashStatus[$i] == 1){
                        if($dashMode[$i] == 3){
                            $data_count3[] = $i;
                        }
                    }
                }
                for($i=1; $i <= 40; $i++ ){
                    if($dashStatus[$i] == 1){
                        if($dashMode[$i] == 4 || $dashMode[$i] == 5 || $dashMode[$i] == 6 || $dashMode[$i] == 7){
                            $data_count4[] = $i;
                        }
                    }
                }
                // echo $count_dash);
                if(isset($data_count1)){
                    $c_count1 = 1;
                }else{$c_count1 = 0;}
                if(isset($data_count2)){
                    $c_count2 = 2;
                }else{$c_count2 = 0;}
                if(isset($data_count3)){
                    $c_count3 = 3;
                }else{$c_count3 = 0;}
                if(isset($data_count4)){
                    $c_count4 = 4;
                }else{$c_count4 = 0;}
                // echo  $c_count1;
                
                // print_r($data_count1);
                // print_r($data_count2);
                // print_r($data_count3);
                // print_r($data_count4);
                // print_r($data_count0);
                ?>

                <div class="row">
                    <?php if(isset($data_count1)){?>
                        <div class="col-lg-3 col-xl-3 col-sm-12 d-flex">
                            <div class="card-body border radius-10 shadow-none mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="radio_c" id="radio_temp" type="radio" onchange="ch_radio('temp')" <?php if($c_count1 == 1){echo 'checked';}?>>
                                    <h5>อุณหภูมิ</h5>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" name="checkbox_all_temp" onchange="checkbox_all('temp')" <?php if($c_count1 == 1){echo 'checked';}?>>
                                        <label class="form-check-label">เลือกทั้งหมด</label>
                                    </div>
                                    <hr/>
                                    <?php for($i=1; $i <= 40; $i++ ){
                                        if($dashStatus[$i] == 1){
                                            if($dashMode[$i] == 1){ ?>
                                                <div class="form-check mb-3"> 
                                                    <input type="checkbox" class="form-check-input" name="checkbox_temp[]" value="<?= $dashSncanel[$i] ?>" d_name="<?= $dashName[$i]." (℃)" ?>" d_mode="<?= $dashMode[$i] ?>" onchange="checkbox_check(<?= count($data_count1) ?> ,'temp')" checked>
                                                    <label class="form-check-label"><?= $dashName[$i] ?></label>
                                                </div>
                                    <?php } } } ?>
                                </div>
                            </div>
                        </div>
                    <?php } if(isset($data_count2)){?>
                        <div class="col-lg-3 col-xl-3 col-sm-12 d-flex">
                            <div class="card-body border radius-10 shadow-none mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="radio_c" id="radio_hum" type="radio" onchange="ch_radio('hum')" <?php if($c_count1 == 0 && $c_count2 == 2){echo 'checked';}?>>
                                    <h5>ความชื้นอากาศ</h5>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" name="checkbox_all_hum" onchange="checkbox_all('hum')" <?php if($c_count1 == 0 && $c_count2 == 2){echo 'checked';}?>>
                                        <label class="form-check-label">เลือกทั้งหมด</label>
                                    </div>
                                    <hr/>
                                    <?php for($i=1; $i <= 40; $i++ ){
                                        if($dashStatus[$i] == 1){
                                            if($dashMode[$i] == 2){ ?>
                                                <div class="form-check mb-3"> 
                                                    <input type="checkbox" class="form-check-input" name="checkbox_hum[]" value="<?= $dashSncanel[$i] ?>" d_name="<?= $dashName[$i]." (".$dashUnit[$i].")" ?>" d_mode="<?= $dashMode[$i] ?>" onchange="checkbox_check(<?= count($data_count2) ?> ,'hum')" <?php if($c_count1 == 0 && $c_count2 == 2){echo 'checked';}?>>
                                                    <label class="form-check-label"><?= $dashName[$i] ?></label>
                                                </div>
                                    <?php } } } ?>
                                </div>
                            </div>
                        </div>
                    <?php } if(isset($data_count3)){?>
                        <div class="col-lg-3 col-xl-3 col-sm-12 d-flex">
                            <div class="card-body border radius-10 shadow-none mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="radio_c" id="radio_soil" type="radio" onchange="ch_radio('soil')" <?php if($c_count1 == 0 && $c_count2 == 0 && $c_count3 == 3){echo 'checked';}?>>
                                    <h5>ความชื้นในดิน</h5>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" name="checkbox_all_soil" onchange="checkbox_all('soil')" <?php if($c_count1 == 0 && $c_count2 == 0 && $c_count3 == 3){echo 'checked';}?>>
                                        <label class="form-check-label">เลือกทั้งหมด</label>
                                    </div>
                                    <hr/>
                                    <?php for($i=1; $i <= 40; $i++ ){
                                        if($dashStatus[$i] == 1){
                                            if($dashMode[$i] == 3){ ?>
                                                <div class="form-check mb-3"> 
                                                    <input type="checkbox" class="form-check-input" name="checkbox_soil[]" value="<?= $dashSncanel[$i] ?>" d_name="<?= $dashName[$i]." (".$dashUnit[$i].")" ?>" d_mode="<?= $dashMode[$i] ?>" onchange="checkbox_check(<?= count($data_count3) ?> ,'soil')" <?php if($c_count1 == 0 && $c_count2 == 0 && $c_count3 == 3){echo 'checked';}?>>
                                                    <label class="form-check-label"><?= $dashName[$i] ?></label>
                                                </div>
                                    <?php } } } ?>
                                </div>
                            </div>
                        </div>
                    <?php } if(isset($data_count4)){?>
                        <div class="col-lg-3 col-xl-3 col-sm-12 d-flex">
                            <div class="card-body border radius-10 shadow-none mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="radio_c" id="radio_light" type="radio" onchange="ch_radio('light')" <?php if($c_count4 == 4){echo 'checked';}?>>
                                    <h5>ความเข้มแสง</h5>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" name="checkbox_all_light" onchange="checkbox_all('light')" <?php if($c_count4 == 4){echo 'checked';}?>>
                                        <label class="form-check-label">เลือกทั้งหมด</label>
                                    </div>
                                    <hr/>
                                    <?php for($i=1; $i <= 40; $i++ ){
                                        if($dashStatus[$i] == 1){
                                            if($dashMode[$i] == 4){
                                                echo '<div class="form-check mb-3"> 
                                                        <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="'. $dashSncanel[$i] .'" d_name="'. $dashName[$i].' (KLux)" d_mode="'. $dashMode[$i] .'" onchange="checkbox_check('. count($data_count4) .' ,"light")" ';
                                                        if($c_count1 == 0 && $c_count2 == 0 && $c_count3 == 0 && $c_count4 == 4){echo 'checked';} echo '>';
                                                        echo '<label class="form-check-label">'.$dashName[$i].'</label>
                                                    </div>';
                                            }else if($dashMode[$i] == 5){
                                                echo '<div class="form-check mb-3"> 
                                                        <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="'. $dashSncanel[$i] .'" d_name="'. $dashName[$i].'" d_mode="'. $dashMode[$i] .'" onchange="checkbox_check('. count($data_count4) .' ,"light")" ';
                                                        if($c_count1 == 0 && $c_count2 == 0 && $c_count3 == 0 && $c_count4 == 4){echo 'checked';} echo '>';
                                                        echo '<label class="form-check-label">'.$dashName[$i].'</label>
                                                    </div>';
                                            }else if($dashMode[$i] == 6){
                                                echo '<div class="form-check mb-3"> 
                                                        <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="'. $dashSncanel[$i] .'" d_name="'. $dashName[$i].' (KLux)" d_mode="'. $dashMode[$i] .'" onchange="checkbox_check('. count($data_count4) .' ,"light")" ';
                                                        if($c_count1 == 0 && $c_count2 == 0 && $c_count3 == 0 && $c_count4 == 4){echo 'checked';} echo '>';
                                                        echo '<label class="form-check-label">'.$dashName[$i].'</label>
                                                    </div>';
                                            }else if($dashMode[$i] == 7){ 
                                                echo '<div class="form-check mb-3"> 
                                                        <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="'. $dashSncanel[$i] .'" d_name="'. $dashName[$i].'" d_mode="'. $dashMode[$i] .'" onchange="checkbox_check('. count($data_count4) .' ,"light")" ';
                                                        if($c_count1 == 0 && $c_count2 == 0 && $c_count3 == 0 && $c_count4 == 4){echo 'checked';} echo '>';
                                                        echo '<label class="form-check-label">'.$dashName[$i].'</label>
                                                    </div>';
                                            } 
                                        } 
                                    } ?>
                                </div>
                            </div>
                        </div>
                    <?php } if(isset($data_count0)){?>
                        <div class="col-lg-3 col-xl-3 col-sm-12 d-flex">
                            <div class="card-body border radius-10 shadow-none mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="radio_c" id="radio_other" type="radio" onchange="ch_radio('other')">
                                    <h5>อื่นๆ</h5>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" name="checkbox_all_other" onchange="checkbox_all('other')">
                                        <label class="form-check-label">เลือกทั้งหมด</label>
                                    </div>
                                    <hr/>
                                    <?php for($i=1; $i <= 40; $i++ ){
                                        if($dashStatus[$i] == 1){
                                            if($dashMode[$i] != 1 || $dashMode[$i] != 2 || $dashMode[$i] != 3 || $dashMode[$i] != 4 || $dashMode[$i] != 5 || $dashMode[$i] != 6 || $dashMode[$i] != 7){ ?>
                                                <div class="form-check mb-3"> 
                                                    <input type="checkbox" class="form-check-input" name="checkbox_other[]" value="<?= $dashSncanel[$i] ?>" d_name="<?= $dashName[$i] ?>" d_mode="<?= $dashMode[$i] ?>" onchange="checkbox_check(<?= count($data_count0) ?> ,'other')" checked>
                                                    <label class="form-check-label"><?= $dashName[$i] ?></label>
                                                </div>
                                    <?php } } } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- </div> -->
            </div>
            <div class="modal-footer text-right">
                <button type="button" id="submit_select_sn_Modal" class="btn btn-success waves-light">
                <i class="fadeIn animated bx bx-check"></i> ตกลง
                </button>
                <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">
                    <i class="fadeIn animated bx bx-window-close"></i> ยกเลิก
                </button>
            </div>
        </div>
    </div>
</div>
<!-- exit Modal_select_sn -->
<div class="tab-content">
    <div class="tab-pane fade show active" id="p-chart" role="tabpanel">
        <div id="report_chart" style=""></div>
    </div>
    <div class="tab-pane fade" id="p-table" role="tabpanel">
        
        <!-- <div class="table-responsive m-t-10"> -->
            <div id="report_table"></div>
        <!-- </div> -->
    </div>
</div>

<script>
    $('.val_start').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        timePicker: true,
        timePicker24Hour: true,
        minYear: 2016,
        // maxYear: parseInt(moment().format('YYYY'), 10),
        locale: {
            cancelLabel: 'Close'
        }
    });
    $('.val_start').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD - HH:mm'));
    });

    $('.val_end').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        timePicker: true,
        timePicker24Hour: true,
        minYear: 2016,
        // maxYear: parseInt(moment().format('YYYY'), 10),
        locale: {
            cancelLabel: 'Close'
        }
    });
    $('.val_end').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD - HH:mm'));
    });

    // ch_radio('temp');
    $(".all_day").click(function() {
        $(".title_mod").html('แสดงข้อมูลย้อนหลัง 1 วัน');
        $(".mode_dwm").val('day');
        $(".hide_dwm").hide();
        $("#Modal_select_sn").modal("show");
    });
    $(".all_week").click(function() {
        $(".title_mod").html('แสดงข้อมูลย้อนหลัง 7 วัน');
        $(".mode_dwm").val('week');
        $(".hide_dwm").hide();
        $("#Modal_select_sn").modal("show");
    });
    $(".all_month").click(function() {
        $(".title_mod").html('แสดงข้อมูลย้อนหลัง 30 วัน');
        $(".mode_dwm").val('month');
        $(".hide_dwm").hide();
        $("#Modal_select_sn").modal("show");
    });
    $(".all_from_to").click(function() {
        $(".title_mod").html('แสดงข้อมูลย้อนหลัง &nbsp; &nbsp;&nbsp;');
        $(".mode_dwm").val('from_to');
        $(".hide_dwm").show();
        $("#Modal_select_sn").modal("show");
    });
    
    $("#checkbox_all_sn").change(function () { 
        if($(this).prop( "checked") == true){
            $("#radio_temp").attr("disabled", true);
            $("#radio_hum").attr("disabled", true);
            $("#radio_light").attr("disabled", true);
            $("#radio_soil").attr("disabled", true);
            $("#radio_other").attr("disabled", true);
            $("input[name='checkbox_temp[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_temp']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_hum[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_hum']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_light[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_light']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_soil[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_soil']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_other[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_other']").attr("disabled", false).prop( "checked", true );   
        }else{
            $("#radio_temp").attr("disabled", false);
            $("#radio_hum").attr("disabled", false);
            $("#radio_light").attr("disabled", false);
            $("#radio_soil").attr("disabled", false);
            $("#radio_other").attr("disabled", false);
            if ($("#radio_temp").prop('checked') == true) {ch_radio('temp');}
            if ($("#radio_hum").prop('checked') == true) {ch_radio('hum');}
            if ($("#radio_light").prop('checked') == true) {ch_radio('light');}
            if ($("#radio_soil").prop('checked') == true) {ch_radio('soil');}
            if ($("#radio_other").prop('checked') == true) {ch_radio('other');}
        }
    });

    $("#submit_select_sn_Modal").click(function() {
        sumbit_report();
    });
    
    $(".re_ch").click(function () { 
        $(".re_ch").addClass("active");
        $(".re_tb").removeClass("active");
        if($("#p-chart").hasClass("active") == false){
            if( $(".all_day").hasClass("active") != false || 
                $(".all_week").hasClass("active") != false ||
                $(".all_month").hasClass("active") != false ||
                $(".all_from_to").hasClass("active") != false
            ){ sumbit_report(); }
        }
    });
    $(".re_tb").click(function () { 
        $(".re_ch").removeClass("active");
        $(".re_tb").addClass("active");
        if($("#p-table").hasClass("active") == false){
            if( $(".all_day").hasClass("active") != false || 
                $(".all_week").hasClass("active") != false ||
                $(".all_month").hasClass("active") != false ||
                $(".all_from_to").hasClass("active") != false
            ){sumbit_report();}
        }
    });
    
    function ch_radio(){
        if ($("#radio_temp").prop('checked') == true) {
            $("input[name='checkbox_temp[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_temp']").attr("disabled", false).prop( "checked", true );
        }else{
            $("input[name='checkbox_temp[]']").attr("disabled", true).prop( "checked", false );
            $("input[name='checkbox_all_temp']").attr("disabled", true).prop( "checked", false );
        }
        if ($("#radio_hum").prop('checked') == true) {
            $("input[name='checkbox_hum[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_hum']").attr("disabled", false).prop( "checked", true );
        }else{
            $("input[name='checkbox_hum[]']").attr("disabled", true).prop( "checked", false );
            $("input[name='checkbox_all_hum']").attr("disabled", true).prop( "checked", false );
        }
        if ($("#radio_soil").prop('checked') == true) {
            $("input[name='checkbox_soil[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_soil']").attr("disabled", false).prop( "checked", true );
        }else{
            $("input[name='checkbox_soil[]']").attr("disabled", true).prop( "checked", false );
            $("input[name='checkbox_all_soil']").attr("disabled", true).prop( "checked", false );
        }
        if ($("#radio_light").prop('checked') == true) {
            $("input[name='checkbox_light[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_light']").attr("disabled", false).prop( "checked", true );
        }else{
            $("input[name='checkbox_light[]']").attr("disabled", true).prop( "checked", false );
            $("input[name='checkbox_all_light']").attr("disabled", true).prop( "checked", false );
        }
        if ($("#radio_other").prop('checked') == true) {
            $("input[name='checkbox_other[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_other']").attr("disabled", false).prop( "checked", true );
        }else{
            $("input[name='checkbox_other[]']").attr("disabled", true).prop( "checked", false );
            $("input[name='checkbox_all_other']").attr("disabled", true).prop( "checked", false );
        }
    }
    function checkbox_all(val){
        // $("input[name='checkbox_"+ val.value+"[]']").attr("disabled", false);
        // alert(val.prop('checked'));
        
        if ($("input[name='checkbox_all_"+val+"']").prop('checked') == true) {
            $("input[name='checkbox_"+ val+"[]']").prop( "checked", true );
        }else{
            $("input[name='checkbox_"+ val+"[]']").prop( "checked", false );
        }
    }
    function checkbox_check(count,mode){
        var count_ch = [];
        $("input[name='checkbox_"+mode+"[]']:checked").map(function (){
            count_ch.push($(this).val());
        });//
        // alert(count_ch.length)
        if(count_ch.length === count){
            $("input[name='checkbox_all_"+mode+"']").prop( "checked", true );
        }else{
            $("input[name='checkbox_all_"+mode+"']").prop( "checked", false );
        }
        // alert("cl "+count_ch.length+" +all "+count)
    }
    function sumbit_report(){
        var ch_value = [];
        var checked = [];
        var d_name = [];
        var d_mode = [];
        if($("#checkbox_all_sn").prop("checked") == true){
            // ch_value.push("all");
            // $("input[name='checkbox_temp[]']:checked").each(function (){
            //     checked.push($(this).val());
            // });
            // $("input[name='checkbox_hum[]']:checked").each(function (){
            //     checked.push($(this).val());
            // });
            // ch_value.push(checked)
        }else{
            if ($("#radio_temp").prop('checked') == true) {
                ch_value.push("อุณหภูมิ");
                $("input[name='checkbox_temp[]']:checked").map(function (){
                    checked.push($(this).val());
                    d_name.push($(this).attr("d_name"));
                    d_mode.push($(this).attr("d_mode"));
                });
                ch_value.push(checked);
                ch_value.push(d_name);
                ch_value.push(d_mode);
            }
            if ($("#radio_hum").prop('checked') == true) {
                ch_value.push("ความชื้นอากาศ");
                $("input[name='checkbox_hum[]']:checked").map(function (){
                    checked.push($(this).val());
                    d_name.push($(this).attr("d_name"));
                    d_mode.push($(this).attr("d_mode"));
                });
                ch_value.push(checked);
                ch_value.push(d_name);
                ch_value.push(d_mode);
            }
            if ($("#radio_soil").prop('checked') == true) {
                ch_value.push("ความชื้นดิน");
                $("input[name='checkbox_soil[]']:checked").map(function (){
                    checked.push($(this).val());
                    d_name.push($(this).attr("d_name"));
                    d_mode.push($(this).attr("d_mode"));
                });
                ch_value.push(checked);
                ch_value.push(d_name);
                ch_value.push(d_mode);
            }
            if ($("#radio_light").prop('checked') == true) {
                ch_value.push("ความเข้มแสง");
                $("input[name='checkbox_light[]']:checked").map(function (){
                    checked.push($(this).val());
                    if($(this).attr("d_mode") == 5 || $(this).attr("d_mode") == 7){
                        d_name.push($(this).attr("d_name")+" (µmol m^2 s^-1)");//(µmol m[baseline-shift: super; font-size: 10;]-2[baseline-shift: baseline;]s[baseline-shift: super; font-size: 10;]-1[baseline-shift: baseline;])");
                    }else{
                        d_name.push($(this).attr("d_name"));
                    }
                    d_mode.push($(this).attr("d_mode"));
                });
                ch_value.push(checked);
                ch_value.push(d_name);
                ch_value.push(d_mode);
            }
            if ($("#radio_other").prop('checked') == true) {
                ch_value.push("other");
                $("input[name='checkbox_other[]']:checked").map(function (){
                    checked.push($(this).val());
                    d_name.push($(this).attr("d_name"));
                    d_mode.push($(this).attr("d_mode"));
                });
                ch_value.push(checked);
                ch_value.push(d_name);
                ch_value.push(d_mode);
            }
        }
        
        if (checked.length == 0) {
            Swal({
                type: "warning",
                title: "กรุณาเลือกเซ็นเซอร์",
                // html: text,
                allowOutsideClick: false
            });
            return false;
        }
        if($(".mode_dwm").val() === "from_to"){
            if ($(".val_start").val() === "") {
                $(".val_start").addClass('is-invalid');
                return false;
            }else{
                $(".val_start").removeClass('is-invalid');
            }
            if ($(".val_end").val() === "") {
                $(".val_end").addClass('is-invalid');
                return false;
            }else{
                $(".val_end").removeClass('is-invalid');
            }
            if ($(".val_start").val() >= $(".val_end").val()) {
                $(".val_start").addClass('is-invalid');
                $(".val_end").addClass('is-invalid');
                Swal({
                    type: "warning",
                    html: "เวลาเริ่มต้น <b>ต้องน้อยกว่า</b> เวลาสิ้นสุด",
                    // html: text,
                    allowOutsideClick: false
                });
                return false;
            }else{
                $(".val_start").removeClass('is-invalid');
                $(".val_end").removeClass('is-invalid');
            }
        }
        // alert($("#mode_dwm").val())
        // alert(ch_value)
        // console.log(ch_value)
        // return false;
        
        var loading = verticalNoTitle();
        active_btn();
        function report_chart(){
            $("#report_chart").addClass("report_chart");
            $.ajax({
                type: "POST",
                url: "routes/report_allChart.php",
                data: {
                    house_master: $(".house_master").val(),
                    mode : $(".mode_dwm").val(),
                    ch_value : ch_value,
                    val_start : $(".val_start").val(),
                    val_end : $(".val_end").val(),
                    sel_all_every : $("#sel_all_every").val()
                },
                dataType: 'json',
                success: function(res) {
                    if(res.theme === "dark-theme"){
                        var theme = 'dark';
                    }else{
                        var theme = '';
                    }
                    // console.log(res[1])
                    // alert(ch_value[1][1])
                    var data_chart = [];
                    // var c_unit = [];
                    for(var k =1; k<=ch_value[1].length; k++){
                        data_chart.push({
                                name: ch_value[2][(k-1)],
                                type: 'line',
                                showSymbol: false,
                                areaStyle: {},
                                data: res.data['data_'+k]
                        })
                    }
                    if(ch_value[0] === "other"){
                        var chart_name = 'other';
                    }else{
                        var chart_name = ch_value[0];
                    }
                    // console.log(data_chart)
                    // return false;
                    var myChart = echarts.init(document.getElementById('report_chart'), theme);
                    // var unt = "µmol m[baseline-shift: super; font-size: 10;]-2[baseline-shift: baseline;]s[baseline-shift: super; font-size: 10;]-1[baseline-shift: baseline;]";
                    // specify chart configuration item and data
                    var option = {
                        title: {
                            text: chart_name
                        },
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'cross',
                                label: {
                                    backgroundColor: '#6a7985'
                                }
                            }
                        },
                        legend: {
                            data: ch_value[2]
                        },
                        xAxis: {
                            type: 'category',
                            data: res.data.timestamp,
                            boundaryGap: false
                        },
                        yAxis: {
                            type: 'value',
                            // name: unt//'µmol m<sup>-2</sup>s<sup>-1</sup>',
                            // axisLabel : {
                            //     formatter: '{value} (µmol m<sup>-2</sup>s<sup>-1</sup>)'
                            // }
                        },
                        toolbox: {
                            feature: {
                                saveAsImage: {}
                            }
                        },
                        dataZoom: [{
                            type: 'inside',
                            start: 0,
                            end: 100
                        }, {
                            start: 0,
                            end: 100
                        }],
                        grid: {
                            left: '2%',
                            right: '1%',
                            bottom: '2%',
                            containLabel: true
                        },
                        series:data_chart
                    };

                    // use configuration item and data specified to show chart
                    myChart.setOption(option);
                    loadingOut(loading);
                }
            });
        }
        function report_table(){
            $.ajax({
                type: "POST",
                url: "routes/report_allTable.php",
                data: {
                    house_master: $(".house_master").val(),
                    mode : $(".mode_dwm").val(),
                    ch_value : ch_value,
                    val_start : $(".val_start").val(),
                    val_end : $(".val_end").val(),
                    sel_all_every : $("#sel_all_every").val()
                },
                // dataType: 'json',
                success: function(res) {
                    $("#report_table").html(res);
                    loadingOut(loading);
                }
            });
        }
        function active_btn(){
            if($(".mode_dwm").val() === 'day'){
                $(".all_day").addClass("active");
                $(".all_week").removeClass("active");
                $(".all_month").removeClass("active");
                $(".all_from_to").removeClass("active");
            }else if($(".mode_dwm").val() === 'week'){
                $(".all_day").removeClass("active");
                $(".all_week").addClass("active");
                $(".all_month").removeClass("active");
                $(".all_from_to").removeClass("active");
            }else if($(".mode_dwm").val() === 'month'){
                $(".all_day").removeClass("active");
                $(".all_week").removeClass("active");
                $(".all_month").addClass("active");
                $(".all_from_to").removeClass("active");
            }else{
                $(".all_day").removeClass("active");
                $(".all_week").removeClass("active");
                $(".all_month").removeClass("active");
                $(".all_from_to").addClass("active");
            }
            $("#Modal_select_sn").modal("hide");
        }
        // alert($(".re_tb").hasClass("active"))
        // return false
        if($(".re_ch").hasClass("active") == true){
            report_chart();
        }else if($(".re_tb").hasClass("active") == true){
            report_table();
        }
    }
</script>