<?php
    // $controlstatus = $_POST['controlstatus'];
    // $conttrolname = $_POST['conttrolname'];
    // $count_dash = array_count_values($dashMode)['1'];
    // print_r( array_count_values($dashStatus) );
// echo array_count_values($controlstatus)['0'];
// exit();
?>
<div class="d-sm-flex">
    <div class="col-lg-7 col-xl-7 col-sm-12">
        <div class="row">
            <button type="button" class="col-xl-2 col-sm-4 btn btn-outline-secondary px-2 r_all" house_master="<?= $_POST['house_master'] ?>" status="<?= $_POST['controlstatus'] ?>" name='<?= $_POST["conttrolname"] ?>' mode="all">ทั้งหมด</button>
            <button type="button" class="col-xl-2 col-sm-4 btn btn-outline-secondary px-2 r_day" house_master="<?= $_POST['house_master'] ?>" status="<?= $_POST['controlstatus'] ?>" name='<?= $_POST["conttrolname"] ?>' mode="day">1 วัน</button>
            <button type="button" class="col-xl-2 col-sm-4 btn btn-outline-secondary px-2 r_week" house_master="<?= $_POST['house_master'] ?>" status="<?= $_POST['controlstatus'] ?>" name='<?= $_POST["conttrolname"] ?>' mode="week">1 สัปดาห์</button>
            <button type="button" class="col-xl-2 col-sm-6 btn btn-outline-secondary px-2 r_month" house_master="<?= $_POST['house_master'] ?>" status="<?= $_POST['controlstatus'] ?>" name='<?= $_POST["conttrolname"] ?>' mode="month">1 เดือน</button>
            <button type="button" class="col-xl-2 col-sm-6 btn btn-outline-secondary px-2 r_from_to">กำหนดเอง</button>
        </div>
    </div>
</div><br>
<!-- Modal -->
<div class="modal fade" id="modal_fromto" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เวลาเริ่มต้น-สิ้นสุด</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-xl-6 input-group mb-1">
                        <span class="input-group-text col-sm-4" id="basic-addon3">เวลาเริ่ม</span>
                        <input type="text" class="form-control text-center r_start" placeholder="วันเวลาเริ่มต้น" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="invalid-feedback">กรุณาระบุเวลาเริ่ม</div>
					</div>
                    <div class="col-lg-6 col-xl-6 input-group mb-1">
                        <span class="input-group-text col-sm-4" id="basic-addon3">เวลาสิ้นสุด</span>
                        <input type="text" class="form-control text-center r_end" type="text" placeholder="วันเวลาสิ้นสุด" aria-label="วันเวลาสิ้นสุด" aria-describedby="button-addon2">
                        <div class="invalid-feedback">กรุณาระบุเวลาสิ้นสุด</div>
					</div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" id="submit_recont_Modal" class="btn btn-success waves-light" house_master="<?= $_POST['house_master'] ?>" status="<?= $_POST['controlstatus'] ?>" name='<?= $_POST["conttrolname"] ?>'>
                <i class="fadeIn animated bx bx-check"></i> ตกลง
                </button>
                <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">
                    <i class="fadeIn animated bx bx-window-close"></i> ยกเลิก
                </button>
            </div>
        </div>
    </div>
</div>
<!-- exit Modal -->
<div id="rept_control"></div>

<script>
    $('.r_start').daterangepicker({
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
    $('.r_start').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD - HH:mm'));
    });

    $('.r_end').daterangepicker({
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
    $('.r_end').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD - HH:mm'));
    });
    // ch_radio('temp');
    $(".r_all").click(function() {
        report_control_table(
        $(this).attr("house_master"),
        $.parseJSON($(this).attr("status")),
        $.parseJSON($(this).attr("name")),
        $(this).attr("mode"),
        $(".r_start").val(),
        $(".r_end").val());
    });
    $(".r_day").click(function() {
        report_control_table(
        $(this).attr("house_master"),
        $.parseJSON($(this).attr("status")),
        $.parseJSON($(this).attr("name")),
        $(this).attr("mode"),
        $(".r_start").val(),
        $(".r_end").val());
    });
    $(".r_week").click(function() {
        report_control_table(
        $(this).attr("house_master"),
        $.parseJSON($(this).attr("status")),
        $.parseJSON($(this).attr("name")),
        $(this).attr("mode"),
        $(".r_start").val(),
        $(".r_end").val());
    });
    $(".r_month").click(function() {
        report_control_table(
        $(this).attr("house_master"),
        $.parseJSON($(this).attr("status")),
        $.parseJSON($(this).attr("name")),
        $(this).attr("mode"),
        $(".r_start").val(),
        $(".r_end").val());
    });
    $(".r_from_to").click(function() {
        $("#modal_fromto").modal("show");
    });
    $("#submit_recont_Modal").click(function() {
        if ($(".r_start").val() === "") {
            $(".r_start").addClass('is-invalid');
            return false;
        }else{
            $(".r_start").removeClass('is-invalid');
        }
        if ($(".r_end").val() === "") {
            $(".r_end").addClass('is-invalid');
            return false;
        }else{
            $(".r_end").removeClass('is-invalid');
        }
        if ($(".r_start").val() >= $(".r_end").val()) {
            $(".r_start").addClass('is-invalid');
            $(".r_end").addClass('is-invalid');
            Swal({
                type: "warning",
                html: "เวลาเริ่มต้น "+$(".r_start").val()+" <b>ต้องน้อยกว่า</b> เวลาสิ้นสุด "+$(".r_end").val(),
                // html: text,
                allowOutsideClick: false
            });
            return false;
        }else{
            $(".r_start").removeClass('is-invalid');
            $(".r_end").removeClass('is-invalid');
        }
        $("#modal_fromto").modal("hide");
        report_control_table( $(this).attr("house_master"),
            $.parseJSON($(this).attr("status")),
            $.parseJSON($(this).attr("name")),
            "from_to", $(".r_start").val(), $(".r_end").val()
        );
    });
    function report_control_table(key1,key2,key3,key4,key5,key6){
        var loading = verticalNoTitle();
        $.ajax({
            type: "POST",
            url: "routes/report_controlTable.php",
            data: {
                house_master: key1,
                status : key2,
                name : key3,
                mode : key4,
                r_start : key5,
                r_end : key6
            },
            // dataType: 'json',
            success: function(res) {
                $("#rept_control").html(res);
                if (key4 === "all") {
                    $(".r_all").addClass("active");
                    $(".r_day").removeClass("active");
                    $(".r_week").removeClass("active");
                    $(".r_month").removeClass("active");
                    $(".r_from_to").removeClass("active");
                }else if(key4 === "day"){
                    $(".r_all").removeClass("active");
                    $(".r_day").addClass("active");
                    $(".r_week").removeClass("active");
                    $(".r_month").removeClass("active");
                    $(".r_from_to").removeClass("active");
                }else if(key4 === "week"){
                    $(".r_all").removeClass("active");
                    $(".r_day").removeClass("active");
                    $(".r_week").addClass("active");
                    $(".r_month").removeClass("active");
                    $(".r_from_to").removeClass("active");
                }else if(key4 === "month"){
                    $(".r_all").removeClass("active");
                    $(".r_day").removeClass("active");
                    $(".r_week").removeClass("active");
                    $(".r_month").addClass("active");
                    $(".r_from_to").removeClass("active");
                }else if(key4 === "from_to"){
                    $(".r_all").removeClass("active");
                    $(".r_day").removeClass("active");
                    $(".r_week").removeClass("active");
                    $(".r_month").removeClass("active");
                    $(".r_from_to").addClass("active");
                }
                loadingOut(loading);
            }
        });
    }
</script>