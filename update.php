<?php
require_once "./class.MysqlExt.php";

if(!isset($_GET['user'])) exit('请在域名后加上?user=你的name');
define("TABLENAME", 'clock_data_'.$_GET['user']);

$db = new MysqlExt;
if (!isset($_GET['id'])){
	echo "<script>alert('请输入需要修改记录ID');window.location.href='./crud.php';</script> ";
}

$id = $_GET['id'];
// $sql = "SELECT ID,clock_status,clock_date,clock_week FROM clock_data WHERE ID={$id}";
// $result = $db->getFirstRow($sql);
// print_r($result);exit;
// print_r($_POST);
if (isset($_POST['action'])){ 
	if($_POST['action'] != 'updata' || empty($_POST['time']) || empty($_POST['week']) || empty($_POST['method']))  die('what are you 弄啥嘞？');
	$year_max_week = date("W", mktime(0, 0, 0, 12, 28, date("Y")));
	if ($_POST['week'] <= 0 || $_POST['week'] > $year_max_week){
		echo "<script>alert('请输入正确周数');window.location.href='./update.php?user=".$_GET['user']."&id=$id';</script> ";
	}
	$method = str_replace('clock_', '', $_POST['method']);
	$time = str_replace("T"," ",$_POST['time']).":00";
	$day = date("Y-m-d",strtotime($time));
	$time = strtotime($time);
	$week = $_POST['week'];
	
	$sql = "UPDATE ".TABLENAME." SET clock_status='$method',clock_date='$time',clock_day='$day',clock_week='$week' WHERE ID=$id";
	$result = $db->query($sql);
	if ($result==false){
		die("妈耶，你传的啥！");
	}
	echo "<script>alert('修改记录成功');window.location.href='./crud.php?user=".$_GET['user']."';</script> ";
}


?>
<html>
<head>
<title>打卡记录修改</title>
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
<table>
	<tr>
		<th>记录ID</th><td><?php echo $id?></td>
	</tr>
	<tr>
		<th>打卡类型</th>
		<td>
			<input type="radio" name="method" value="clock_in">上班
			<input type="radio" name="method" value="clock_out">下班<br>
		</td>
	</tr>
	<tr>
		<th>时间</th>
		<td><input type="datetime-local" name="time"></td>
	</tr>
	<tr>
		<th>周数</th>
		<td><input type="number" name="week"> (当前周数：<?php echo date("W")?>)</td>
	</tr>
	<tr>
		<th>操作</th>
		<td><input type="reset"> <input type="submit"><input type="hidden" name='action' value="updata"></td>
	</tr>
</table>
</form>
</body>
</html>