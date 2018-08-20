<?php
header("content:text/html;charset=utf-8");
require_once "./class.MysqlExt.php";
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
	if($_POST['action'] != 'updata ')  die('what are you 弄啥嘞？');
	$year_max_week = date($format)
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