<?php
    require "connectdb.php";
    $house_master = $_POST["house_master"];
    $ch_value = $_POST["ch_value"];
    $sel_all_every = $_POST["sel_all_every"];
    
    if ($_POST["mode"] == 'day') {
        $start_day = date("Y/m/d - H:i:s", strtotime('-1 day'));
        $stop_day = date("Y/m/d - H:i:s");
    } else if ($_POST["mode"] == 'week') {
        $start_day = date("Y/m/d - H:i:s", strtotime('-7 day'));
        $stop_day = date("Y/m/d - H:i:s");
    } else if ($_POST["mode"] == 'month') {
        $start_day = date("Y/m/d - H:i:s", strtotime('-30 day'));
        $stop_day = date("Y/m/d - H:i:s");
    } else if ($_POST["mode"] == 'from_to') {
        $start_day = $_POST["val_start"].':00';
        $stop_day = $_POST["val_end"].':00';
    }
    $data_channel = [];
    for($i=0; $i < count($ch_value[3]); $i++){
        if ($ch_value[3][$i] == 4 || $ch_value[3][$i] == 5) {
            $data_channel[] = 'round('.$ch_value[1][$i].'/1000, 1) AS data_cn'.($i+1);
        } elseif ($ch_value[3][$i] == 6 || $ch_value[3][$i] == 7) {
            $data_channel[] = 'round('.$ch_value[1][$i].'/54, 1) AS data_cn'.($i+1);
        } else {
            $data_channel[] = 'round('.$ch_value[1][$i].', 1) AS data_cn'.($i+1);
        }
    }
    // echo json_encode($data_channel);
    $sting_channrl = implode(", ",$data_channel);
    // echo $sting_channrl;
    // echo count($ch_value[1]);
    // echo $ch_value[3][0];
    // print_r($ch_value[3]);
    // echo $ch_value;
    // exit();
    // echo $a;
?>
<div class="table-responsive m-t-10">
    <table id="example" class="table table-striped table-bordered dataTable" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">วัน-เวลา</th>
                <th class="text-center">วัน</th>
                <th class="text-center">เวลา</th>
                <?php for($i=0; $i<count($ch_value[3]); $i++ ){
                    if($ch_value[3][$i] == 5 || $ch_value[3][$i] == 7){
                        echo '<th class="text-center">'.$ch_value[2][$i].' (µmol m<sup>-2</sup>s<sup>-1</sup>)</th>';
                    }else{
                        echo '<th class="text-center">'.$ch_value[2][$i].'</th>';
                    }
                    
                }?>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
                $sql = "SELECT data_timestamp, $sting_channrl
                FROM tb_data_sensor WHERE data_sn = '$house_master' AND data_timestamp BETWEEN '$start_day' AND '$stop_day' AND mod(minute(`data_time`),'$sel_all_every') = 0
                            ORDER BY data_timestamp ";
                $stmt = $dbcon->query($sql);
                $data0 = [];
                $j=count($ch_value[3]);
                while ($row = $stmt->fetch()) {
                    echo '<tr>
                        <td class="text-center">'.$i.'</td>
                        <td class="text-center">'.substr($row['data_timestamp'], 0 ,18).'</td>
                        <td class="text-center">'.substr($row['data_timestamp'], 0 ,10).'</td>
                        <td class="text-center">'.substr($row['data_timestamp'], 13 ,18).'</td>
                        <td class="text-center">'.$row['data_cn1'].'</td>';
                        if($j >= 2){echo '<td class="text-center">'.$row['data_cn2'].'</td>';}
                        if($j >= 3){echo '<td class="text-center">'.$row['data_cn3'].'</td>';}
                        if($j >= 4){echo '<td class="text-center">'.$row['data_cn4'].'</td>';}
                        if($j >= 5){echo '<td class="text-center">'.$row['data_cn5'].'</td>';}
                        if($j >= 6){echo '<td class="text-center">'.$row['data_cn6'].'</td>';}
                        if($j >= 7){echo '<td class="text-center">'.$row['data_cn7'].'</td>';}
                        if($j >= 8){echo '<td class="text-center">'.$row['data_cn8'].'</td>';}
                        if($j >= 9){echo '<td class="text-center">'.$row['data_cn9'].'</td>';}
                        if($j >= 10){echo '<td class="text-center">'.$row['data_cn10'].'</td>';}
                        if($j >= 11){echo '<td class="text-center">'.$row['data_cn11'].'</td>';}
                        if($j >= 12){echo '<td class="text-center">'.$row['data_cn12'].'</td>';}
                        if($j >= 13){echo '<td class="text-center">'.$row['data_cn13'].'</td>';}
                        if($j >= 14){echo '<td class="text-center">'.$row['data_cn14'].'</td>';}
                        if($j >= 15){echo '<td class="text-center">'.$row['data_cn15'].'</td>';}
                        if($j >= 16){echo '<td class="text-center">'.$row['data_cn16'].'</td>';}
                        if($j >= 17){echo '<td class="text-center">'.$row['data_cn17'].'</td>';}
                        if($j >= 18){echo '<td class="text-center">'.$row['data_cn18'].'</td>';}
                        if($j >= 19){echo '<td class="text-center">'.$row['data_cn19'].'</td>';}
                        if($j >= 20){echo '<td class="text-center">'.$row['data_cn20'].'</td>';}
                        if($j >= 21){echo '<td class="text-center">'.$row['data_cn21'].'</td>';}
                        if($j >= 22){echo '<td class="text-center">'.$row['data_cn22'].'</td>';}
                        if($j >= 23){echo '<td class="text-center">'.$row['data_cn23'].'</td>';}
                        if($j >= 24){echo '<td class="text-center">'.$row['data_cn24'].'</td>';}
                        if($j >= 25){echo '<td class="text-center">'.$row['data_cn25'].'</td>';}
                        if($j >= 26){echo '<td class="text-center">'.$row['data_cn26'].'</td>';}
                        if($j >= 27){echo '<td class="text-center">'.$row['data_cn27'].'</td>';}
                        if($j >= 28){echo '<td class="text-center">'.$row['data_cn28'].'</td>';}
                        if($j >= 29){echo '<td class="text-center">'.$row['data_cn29'].'</td>';}
                        if($j >= 30){echo '<td class="text-center">'.$row['data_cn30'].'</td>';}
                        if($j >= 31){echo '<td class="text-center">'.$row['data_cn31'].'</td>';}
                        if($j >= 32){echo '<td class="text-center">'.$row['data_cn32'].'</td>';}
                        if($j >= 33){echo '<td class="text-center">'.$row['data_cn33'].'</td>';}
                        if($j >= 34){echo '<td class="text-center">'.$row['data_cn34'].'</td>';}
                        if($j >= 35){echo '<td class="text-center">'.$row['data_cn35'].'</td>';}
                        if($j >= 36){echo '<td class="text-center">'.$row['data_cn36'].'</td>';}
                        if($j >= 37){echo '<td class="text-center">'.$row['data_cn37'].'</td>';}
                        if($j >= 38){echo '<td class="text-center">'.$row['data_cn38'].'</td>';}
                        if($j >= 39){echo '<td class="text-center">'.$row['data_cn39'].'</td>';}
                        if($j >= 40){echo '<td class="text-center">'.$row['data_cn40'].'</td>';}
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
        $('#example').DataTable( {
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
                "targets": [ 1 ],
                // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
                // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
                "visible": false,
                "searchable": false
                },
                
            ],
            dom: '<"floatRight"B><"clear">frtip',
            buttons: [{
                    text: 'Export csv',
                    title: "Smart Farm Data Sensor",
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
                    filename: 'smart_farm_'+datetime,
                    // className: 'btn-info',
                    bom: true
                }
            ]
        });
    </script>