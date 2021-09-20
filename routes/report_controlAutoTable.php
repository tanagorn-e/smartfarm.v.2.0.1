<?php
    require "connectdb.php";
    $house_master = $_POST["house_master"];
    $channel = $_POST["channel"];
?>
<div class="table-responsive m-t-10">
    <table id="re_tb_conA" class="table table-striped table-bordered dataTable" style="width:100%">
        <thead>
            <tr>
                <th rowspan="2" class="text-center">#</th>
                <th rowspan="2" class="text-center">วัน </th>
                <th rowspan="2" class="text-center">เวลา</th>
                <th rowspan="2" class="text-center">ผู้บันทึก</th>
                <?php if($channel == 9){echo '<th colspan="4" class="text-center">TIMER Loop</th>';} ?>
                <th colspan="2" class="text-center">Timer 1</th>
                <th colspan="2" class="text-center">Timer 2</th>
                <th colspan="2" class="text-center">Timer 3</th>
                <th colspan="2" class="text-center">Timer 4</th>
                <th colspan="2" class="text-center">Timer 5</th>
                <th colspan="2" class="text-center">Timer 6</th>
            </tr>
            <tr>
            <?php 
                if($channel == 9){
                    echo '
                        <th class="text-center" > Start </th>
                        <th class="text-center" > End</th>
                        <th class="text-center" > On </th>
                        <th class="text-center" > Off </th>'
                    ;
                }
            ?>
                <th class="text-center" > Start </th>
                <th class="text-center" > End</th>
                <th class="text-center" > Start </th>
                <th class="text-center" > End</th>
                <th class="text-center" > Start </th>
                <th class="text-center" > End</th>
                <th class="text-center" > Start </th>
                <th class="text-center" > End</th>
                <th class="text-center" > Start </th>
                <th class="text-center" > End</th>
                <th class="text-center" > Start </th>
                <th class="text-center" > End</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
                // $sql = "SELECT * FROM `tb3_control` WHERE `control_sn` = '$house_master' ORDER BY control_timestamp DESC ";
                
                $tb = "tb3_load_".$channel;
                $sn = "load_".$channel."_sn";
                $timestamp = "load_.$channel._timestamp";
                $sql = "SELECT * FROM `$tb` WHERE `$sn` = '$house_master' ORDER BY '$timestamp' DESC";                
                $stmt = $dbcon->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                    echo '<tr>
                            <td class="text-center">'. $i .'</td>
                            <td class="text-center">'. date_format( date_create( substr($row[1], 0, 10) ), 'Y/m/d' ).'</td>
                            <td class="text-center">'. substr($row[1], 10) .'</td>
                            <td class="text-center">'. $row[5] .'</td>';
                            if($channel == 9){
                                if($row[12] == 0){echo '<td class="text-center">-</td><td class="text-center">-</td>
                                    <td class="text-center">-</td><td class="text-center">-</td>';}
                                else{echo '<td class="text-center">'. $row[19] .'</td><td class="text-center">'. $row[26] .'</td>
                                    <td class="text-center">'. $row[27] .'</td><td class="text-center">'. $row[28] .'</td>';}

                                if($row[6] == 0){echo '<td class="text-center">-</td><td class="text-center">-</td>';}
                                else{echo '<td class="text-center">'. $row[13] .'</td><td class="text-center">'. $row[20] .'</td>';}
                                if($row[7] == 0){echo '<td class="text-center">-</td><td class="text-center">-</td>';}
                                else{echo '<td class="text-center">'. $row[14] .'</td><td class="text-center">'. $row[21] .'</td>';}
                                if($row[8] == 0){echo '<td class="text-center">-</td><td class="text-center">-</td>';}
                                else{echo '<td class="text-center">'. $row[15] .'</td><td class="text-center">'. $row[22] .'</td>';}
                                if($row[9] == 0){echo '<td class="text-center">-</td><td class="text-center">-</td>';}
                                else{echo '<td class="text-center">'. $row[16] .'</td><td class="text-center">'. $row[23] .'</td>';}
                                if($row[10] == 0){echo '<td class="text-center">-</td><td class="text-center">-</td>';}
                                else{echo '<td class="text-center">'. $row[17] .'</td><td class="text-center">'. $row[24] .'</td>';}
                                if($row[11] == 0){echo '<td class="text-center">-</td><td class="text-center">-</td>';}
                                else{echo '<td class="text-center">'. $row[18] .'</td><td class="text-center">'. $row[25] .'</td>';}
                            }else{
                                if($row[6] == 0){echo '<td class="text-center">-</td><td class="text-center">-</td>';}
                                else{echo '<td class="text-center">'. $row[12] .'</td><td class="text-center">'. $row[18] .'</td>';}
                                if($row[7] == 0){echo '<td class="text-center">-</td><td class="text-center">-</td>';}
                                else{echo '<td class="text-center">'. $row[13] .'</td><td class="text-center">'. $row[19] .'</td>';}
                                if($row[8] == 0){echo '<td class="text-center">-</td><td class="text-center">-</td>';}
                                else{echo '<td class="text-center">'. $row[14] .'</td><td class="text-center">'. $row[20] .'</td>';}
                                if($row[9] == 0){echo '<td class="text-center">-</td><td class="text-center">-</td>';}
                                else{echo '<td class="text-center">'. $row[15] .'</td><td class="text-center">'. $row[21] .'</td>';}
                                if($row[10] == 0){echo '<td class="text-center">-</td><td class="text-center">-</td>';}
                                else{echo '<td class="text-center">'. $row[16] .'</td><td class="text-center">'. $row[22] .'</td>';}
                                if($row[11] == 0){echo '<td class="text-center">-</td><td class="text-center">-</td>';}
                                else{echo '<td class="text-center">'. $row[17] .'</td><td class="text-center">'. $row[23] .'</td>';}
                            }
                    echo '</tr>';
                    $i++;
                }?>
        </tbody>
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
    $('#re_tb_conA').DataTable( {
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
        // dom: '<"floatRight"B><"clear">frtip',
        // buttons: [{
        //         text: 'Export csv',
        //         title: "Smart Farm - Control History",
        //         charset: 'utf-8',
        //         extension: '.csv',
        //         // exportOptions: {
        //         //    columns: [ 0, 2, 5 ]
        //         // },
        //         className:'btn btn-outline-success px-5',
        //         extend: 'csv',
        //         format: 'YYYY/MM/dd',
        //         // fieldSeparator: ';',
        //         // fieldBoundary: '',
        //         filename: 'smart_farm_controlAuto_'+datetime,
        //         // className: 'btn-info',
        //         bom: true
        //     }
        // ]
    });
</script>