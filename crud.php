<?php
require_once "./class.MysqlExt.php";

if(!isset($_GET['user'])) exit('请在域名后加上?user=你的name');
define("TABLENAME", 'clock_data_'.$_GET['user']);

$db = new MysqlExt;
$user_table = TABLENAME;
$sql = "SELECT ID,clock_status,clock_date,clock_week FROM {$user_table}";
$result = $db->getRows($sql);

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
<br><br><br>
<h2 align="center"><?php echo date("Y-m-d H:i:s")." 星期". mb_substr( "日一二三四五六",date("w"),1,"utf-8" ); ?>
</h2><br>
<div align="center"><a href="./index.php?user=<?php echo $_GET['user']?>">返回首页</a></div><br>
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
		echo "<td>".date('Y-m-d H:i:s',$value['clock_date'])."</td>";
		echo "<td>{$value['clock_week']}</td>";
		echo "<td><a href='./update.php?user=".$_GET['user']."&id=".$value['ID']."'>修改</a>";
		echo " | <a href='./delete.php?user=".$_GET['user']."&id=".$value['ID']."'>删除</a></td>";
		echo "</tr>";
	}
	

?>
</table>
</body>
</html>