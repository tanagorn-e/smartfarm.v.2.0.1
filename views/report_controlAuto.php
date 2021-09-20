<?php
    $controlstatus = $_POST['controlstatus'];
    $conttrolname = $_POST['conttrolname'];
    // $count_dash = array_count_values($dashMode)['1'];
    // print_r( array_count_values($dashStatus) );
// echo array_count_values($controlstatus)['1'];
// exit();
?>
<!-- <div class="d-sm-flex"> -->
    <ul class="nav nav-pills mb-3" role="tablist">
        <?php for($i=1; $i <= 11; $i++){
            if($controlstatus[$i] == 1){
            echo '<li class="nav-item" role="presentation">
                    <a class="nav-link rec_auto" id="'.$i.'" house_master="'. $_POST['house_master'] .'" data-bs-toggle="pill" href="" style="border: 1px solid transparent; border-color: #6c757d;">
                        <div class="d-flex align-items-center">
                            <div class="tab-title">'.$conttrolname[$i].'</div>
                        </div>
                    </a>
                </li>';
            }
        }?>
    </ul>
<!-- </div> -->
<br>
<div id="rept_controlAuto"></div>

<script>
    $(".rec_auto").click(function () { 
        var loading = verticalNoTitle();
        $(this).attr("id")
        $.ajax({
            type: "POST",
            url: "routes/report_controlAutoTable.php",
            data: {
                house_master: $(this).attr("house_master"),
                channel : $(this).attr("id")
            },
            // dataType: 'json',
            success: function(res) {
                $("#rept_controlAuto").html(res);
                loadingOut(loading);
            }
        });
    });
</script>