<?php
require_once "./class.MysqlExt.php";

if(!isset($_GET['user'])) exit('请在域名后加上?user=你的name');
define("TABLENAME", 'clock_data_'.$_GET['user']);
// echo TABLENAME;

$db = new MysqlExt;
if (!$db->isTableExisting(TABLENAME)){
	$sql = "CREATE TABLE ".TABLENAME."(
			  `ID` int(11) NOT NULL AUTO_INCREMENT,
			  `clock_status` enum('in','out','NULL') NOT NULL DEFAULT 'NULL',
			  `clock_date` int(11) NOT NULL,
			  `clock_day` date NOT NULL,
			  `clock_week` int(11) NOT NULL,
			  PRIMARY KEY (`ID`)
			) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8";
	$db->query($sql);
}
$datetime = time();
$date = date("Y-m-d");
$week = date("W");
if (isset($_POST['method'])){
	$method = $_POST['method'];
// 	$_POST['islogin'] == false ? exit("<script>alert('please loign first!')</script>") : $userId = $_POST['user_id'];
	switch ($method){
		case "clock_in":
			$sql = "INSERT INTO ".TABLENAME."(clock_status,clock_date,clock_day,clock_week) VALUES('in','$datetime','$date','$week') ";
			$db->query($sql);
			echo "<script>alert('记录成功');window.location.href='./index.php?user=".$_GET['user']."';</script> ";
			break;
			
		case  "clock_out":
			$sql = "INSERT INTO ".TABLENAME."(clock_status,clock_date,clock_day,clock_week) VALUES('out','$datetime','$date','$week') ";
			$db->query($sql);
			echo "<script>alert('记录成功');window.location.href='./index.php?user=".$_GET['user']."';</script> ";
			break;
	}
}

//今天上班时间
$in_time = $db->getTimeByDate($date,TABLENAME,"in");

//今天下班时间
$out_time =$db->getTimeByDate($date,TABLENAME,"out");

//今天工作时间
$work_time=$db->getWorktimeByDate($date);

//一周汇总
$week_result = $db->getWeekResult($week);


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
<br><br><br>
<h2 align="center"><?php echo date("Y-m-d H:i:s")." 星期". mb_substr( "日一二三四五六",date("w"),1,"utf-8" ); ?>
</h2><br>
	<form action="#" method="post">
	<div align="center">
		<input type="radio" name="method" value="clock_in" >上班 &nbsp;&nbsp;&nbsp;&nbsp;
		<input type="radio" name="method" value="clock_out">下班<br><br>
		<input type="submit" value="打卡"><br><br>
		<a href='./crud.php?user=<?php echo $_GET['user']?>'>编辑打卡记录</a><br><br>
	</div>
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
				if ($in_time === null){
					echo "<td>还没上班</td>";
				}else {
					$time_in = date('H:i:s',$in_time);
					echo "<td>$time_in</td>";
				}
			?>
			<?php 
				if ($out_time === null){
					echo "<td>还没下班</td>";
				}else {
					$time_out = date('H:i:s',$out_time);
					echo "<td>$time_out</td>";
				}
			?>
			<td><?php echo $work_time?></td>
		</tr>
	</table>
	<h3 align="center">本周上班时长总计</h3>
	<table>
		<tr>
			<th>week</th>
			<th>上班时间</th>
			<th>下班时间</th>
			<th>工作时间</th>
			<th>工作时间偏差</th>
		</tr>
		<?php 
			foreach ($week_result as $key => $value){
				echo "<tr>";
				echo "<td>星期".mb_substr( "日一二三四五六",$key,1,"utf-8" )."</td>";
				isset($value['in']) ? $week_in_time = date("H:i:s" , $value['in']['clock_date']) : $week_in_time = '';
				isset($value['out']) ? $week_out_time = date("H:i:s" , $value['out']['clock_date']) : $week_out_time = '';
				echo "<td>$week_in_time</td>";
				echo "<td>$week_out_time</td>";
				if (isset($value['in']) && isset($value['out'])){
					$week_work_time = $db->getWorktimeByDate($value['in']['clock_day']);
					$week_work_time_min = $db->getWorktimeByDate($value['in']['clock_day'],TABLENAME,'min');
					$week_work_time_min -= 9*60;
					echo "<td>$week_work_time</td>";
					echo "<td>".$week_work_time_min."分钟</td>";
				}else {
					echo "<td></td>";
					echo "<td></td>";
				}
				echo "</tr>";
			}
		
		?>
	
	</table>
</body>
</html>






















