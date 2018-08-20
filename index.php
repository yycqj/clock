<?php
// require_once './class.Mysql.php';
require_once "./class.MysqlExt.php";
$db = new MysqlExt;

$datetime = time();
$date = date("Y-m-d");
$week = date("W");
if (isset($_POST['method'])){
	$method = $_POST['method'];
// 	$_POST['islogin'] == false ? exit("<script>alert('please loign first!')</script>") : $userId = $_POST['user_id'];
	switch ($method){
		case "clock_in":
			$sql = "INSERT INTO clock_data(clock_status,clock_date,clock_day,clock_week) VALUES('in','$datetime','$date','$week') ";
			$db->query($sql);
			echo "<script>alert('记录成功');window.location.href='./index.php';</script> ";
			break;
			
		case  "clock_out":
			$sql = "INSERT INTO clock_data(clock_status,clock_date,clock_day,clock_week) VALUES('out','$datetime','$date','$week') ";
			$db->query($sql);
			echo "<script>alert('记录成功');window.location.href='./index.php';</script> ";
			break;
	}
}

//今天上班时间
$sql = "SELECT clock_date FROM clock_data WHERE clock_day = '$date' AND clock_status = 'in'";
$result_day = $db->getRows($sql);
if (empty($result_day)){
	$in_time = 0;
}else {
	$in_time = $result_day[0]['clock_date'];
}

//今天下班时间
$sql = "SELECT clock_date FROM clock_data WHERE clock_day = '$date' AND clock_status = 'out'";
$result_day = $db->getRows($sql);
if (empty($result_day)){
	$out_time = 0;
}else {
	$out_time = $result_day[1]['clock_date'];
}

//今天工作时间
round(($out_time-$in_time)/3600,2) <= 0 ? $work_time=0 : $work_time=round(($out_time-$in_time)/3600,2);




// echo $in_time."<br>";
// echo $out_time."<br>";

?>

<html>
<head>
    <title>打卡记录</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
        table
        {
            border-collapse: collapse;
            margin: 0 auto;
            text-align: center;
        }
        table td, table th
        {
            border: 1px solid #cad9ea;
            color: #666;
            height: 30px;
        }
        table thead th
        {
            background-color: #CCE8EB;
            width: 100px;
        }
        table tr:nth-child(odd)
        {
            background: #fff;
        }
        table tr:nth-child(even)
        {
            background: #F5FAFA;
        }
    </style>
</head>
 
<body>
	<form action="#" method="post">
		<input type="radio" name="method" value="clock_in">上班<br>
		<input type="radio" name="method" value="clock_out">下班<br>
		<input type="submit" value="打卡">
		<a href='./crud.php'>编辑打卡记录</a>
	</form>
	<table>
		<tr>
			<th>日期</th>
			<th>上班时间</th>
			<th>下班时间</th>
			<th>工作时间</th>
		</tr>
		<tr>
			<td><?php echo $date?></td>
			<?php 
				if ($in_time === 0){
					echo "<td>还没上班</td>";
				}else {
					$time_in = date('Y-m-d H:i:s',$in_time);
					echo "<td>$time_in</td>";
				}
			?>
			<?php 
				if ($out_time === 0){
					echo "<td>还没下班</td>";
				}else {
					$time_out = date('Y-m-d H:i:s',$out_time);
					echo "<td>$time_out</td>";
				}
			?>
			<td><?php echo $work_time?></td>
		</tr>
	</table>
</body>
</html>