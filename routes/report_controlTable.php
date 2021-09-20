<?php
    require "connectdb.php";
    $house_master = $_POST["house_master"];
    $status = $_POST["status"];
    $name = $_POST["name"];
    if ($_POST["mode"] == 'all') {
        $sql = "SELECT * FROM `tb3_control` WHERE `control_sn` = '$house_master' ORDER BY control_timestamp DESC ";
    }
    if ($_POST["mode"] == 'day') {
        $start_day = date("Y/m/d H:i:s", strtotime('-1 day'));
        $stop_day = date("Y/m/d H:i:s");
        $sql = "SELECT * FROM `tb3_control` WHERE `control_sn` = '$house_master' AND control_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY control_timestamp DESC ";
    } else if ($_POST["mode"] == 'week') {
        $start_day = date("Y/m/d H:i:s", strtotime('-7 day'));
        $stop_day = date("Y/m/d H:i:s");
        $sql = "SELECT * FROM `tb3_control` WHERE `control_sn` = '$house_master' AND control_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY control_timestamp DESC ";
    } else if ($_POST["mode"] == 'month') {
        $start_day = date("Y/m/d H:i:s", strtotime('-30 day'));
        $stop_day = date("Y/m/d H:i:s");
        $sql = "SELECT * FROM `tb3_control` WHERE `control_sn` = '$house_master' AND control_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY control_timestamp DESC ";
    } else if ($_POST["mode"] == 'from_to') {
        $start_day = $_POST["r_start"].':00';
        $stop_day = $_POST["r_end"].':00';
        $sql = "SELECT * FROM `tb3_control` WHERE `control_sn` = '$house_master' AND control_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY control_timestamp DESC ";
    }

?>
<div class="table-responsive m-t-10">
    <table id="re_tb_con" class="table table-striped table-bordered dataTable" style="width:100%">
        <thead>
        <tr>
                <th class="text-center">#</th>
                <th class="text-center">วัน </th>
                <th class="text-center">เวลา</th>
                <th class="text-center">ผู้ดำเนินการ</th>
                <th class="text-center">โหมด</th>
                <?php 
                    if($status[1] == 1){echo '<th class="text-center">'.$name[1].'</th>';}
                    if($status[2] == 1){echo '<th class="text-center">'.$name[2].'</th>';}
                    if($status[3] == 1){echo '<th class="text-center">'.$name[3].'</th>';}
                    if($status[4] == 1){echo '<th class="text-center">'.$name[4].'</th>';}
                    if($status[5] == 1){echo '<th class="text-center">'.$name[5].'</th>';}
                    if($status[6] == 1){echo '<th class="text-center">'.$name[6].'</th>';}
                    if($status[7] == 1){echo '<th class="text-center">'.$name[7].'</th>';}
                    if($status[8] == 1){echo '<th class="text-center">'.$name[8].'</th>';}
                    if($status[9] == 1){echo '<th class="text-center">'.$name[9].'</th>';}
                    if($status[10] == 1){echo '<th class="text-center">'.$name[10].'</th>';}
                    if($status[11] == 1){echo '<th class="text-center">'.$name[11].'</th>';}
                    if($status[12] == 1){echo '<th class="text-center">'.$name[12].'</th>';}
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
                $stmt = $dbcon->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                    echo '<tr>
                            <td class="text-center">'. $i .'</td>
                            <td class="text-center">'. date_format( date_create( substr($row["control_timestamp"], 0, 10) ), 'Y/m/d' ).'</td>
                            <td class="text-center">'. date_format( date_create(substr($row["control_timestamp"], 10) ), 'H:i:s' ).'</td>
                            <td class="text-center">'. $row["control_user"] .'</td>
                            <td class="text-center">'. $row["control_mode"] .'</td>';
                            if($status[1] == 1){echo '<td class="text-center">'.$row["control_dripper_1"].'</td>';}
                            if($status[2] == 1){echo '<td class="text-center">'.$row["control_dripper_2"].'</td>';}
                            if($status[3] == 1){echo '<td class="text-center">'.$row["control_dripper_3"].'</td>';}
                            if($status[4] == 1){echo '<td class="text-center">'.$row["control_dripper_4"].'</td>';}
                            if($status[5] == 1){echo '<td class="text-center">'.$row["control_dripper_5"].'</td>';}
                            if($status[6] == 1){echo '<td class="text-center">'.$row["control_dripper_6"].'</td>';}
                            if($status[7] == 1){echo '<td class="text-center">'.$row["control_dripper_7"].'</td>';}
                            if($status[8] == 1){echo '<td class="text-center">'.$row["control_dripper_8"].'</td>';}
                            if($status[9] == 1){echo '<td class="text-center">'.$row["control_foggy"].'</td>';}
                            if($status[10] == 1){echo '<td class="text-center">'.$row["control_fan"].'</td>';}
                            if($status[11] == 1){echo '<td class="text-center">'.$row["control_shader"].'</td>';}
                            if($status[12] == 1){echo '<td class="text-center">'.$row["control_fertilizer"].'</td>';}
                    echo '</tr>';
                    $i++;
                }?>
        </tbody>
        <!-- <tfoot>
            <tr>
                <th>#</th>
                <th>วัน-เวลา</th>
                <th>วัน</th>
                <th>เวลา</th>
                <?php 
                    // for($i=0; $i<count($ch_value[3]); $i++ ){
                    //     echo '<th>'.$ch_value[2][$i].'</th>';
                    // }
                ?>
            </tr>
        </tfoot> -->
    </table>
</div>
<script>
    var currentdate = new Date(); 
    var datetime = currentdate.getFullYear() + "-"
                + (currentdate.getMonth()+1)  + "-" 
                + currentdate.getDate() + "_"  
                + currentdate.getHours() + "."  
                + currentdate.getMinutes(); //+ ":" 
                // + currentdate.getSeconds();
    $('#re_tb_con').DataTable( {
        "scrollY": 330,
        "scrollX": true,
        "scrollCollapse": false,
        "paging":    false,
        "searching": false,
        "order": [
            [0, "desc"]
        ],
        "columnDefs": [
            {
            // "targets": [ 1 ],
            // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
            // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
            "visible": false,
            "searchable": false
            },
            
        ],
        dom: '<"floatRight"B><"clear">frtip',
        buttons: [{
                text: 'Export csv',
                title: "Smart Farm - Control History",
                charset: 'utf-8',
                extension: '.csv',
                // exportOptions: {
                //    columns: [ 0, 2, 5 ]
                // },
                className:'btn btn-outline-success px-5',
                extend: 'csv',
                format: 'YYYY/MM/dd',
                // fieldSeparator: ';',
                // fieldBoundary: '',
                filename: 'smart_farm_control_'+datetime,
                // className: 'btn-info',
                bom: true
            }
        ]
    });
</script>