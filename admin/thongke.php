<?php
    require('../carbon/autoload.php');
    require('../lib/database.php');

    use Carbon\Carbon;
    use Carbon\CarbonInterval;

    if(isset($_GET['thoigian'])){
        $thoigian = $_GET['thoigian'];
    }else{
        $thoigian = '';
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
    }

    if($thoigian == '7ngay'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
    }else if($thoigian == '28ngay'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(28)->toDateString();
    }else if($thoigian == '90ngay'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(90)->toDateString();
    }else if($thoigian == '365ngay'){
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
    }

    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    $db = new Database();
    $sql = "SELECT * FROM tbl_thongke WHERE created_date BETWEEN '$subdays' AND '$now' ORDER BY created_date ASC";
    $result = $db->select($sql);

    while($row = mysqli_fetch_array($result)){

        $chart_data[] = array(
            'date' => $row['created_date'],
            'total'=> $row['sales'],
            'order'=> $row['orders'],
            'quantity'=> $row['quantity']
        );
    }
    echo $data = json_encode($chart_data);
?>