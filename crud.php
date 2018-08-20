<?php
require_once "./class.MysqlExt.php";
$db = new MysqlExt;

$sql = "SELECT ID,clock_status,clock_date,clock_week FROM clock_data";
$result = $db->getRows($sql);
// print_r($result);



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
<table>
<tr>
<th>记录ID</th>
<th>打卡类型</th>
<th>时间</th>
<th>周数</th>
<th>操作</th>
</tr>
<?php 
	foreach ($result as $value){
		echo "<tr>";
		echo "<td>{$value['ID']}</td>";
		echo "<td>{$value['clock_status']}</td>";
		echo "<td>{$value['clock_date']}</td>";
		echo "<td>{$value['clock_week']}</td>";
		echo "<td><a href='./update.php?id=".$value['ID']."'>修改</a>";
		echo " | <a href='./delete.php?id=".$value['ID']."'>删除</a></td>";
		echo "</tr>";
	}
	

?>
</table>
</body>
</html>