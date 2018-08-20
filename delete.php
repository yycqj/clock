<?php
header("content:text/html;charset=utf-8");
require_once "./class.MysqlExt.php";
$db = new MysqlExt;

if (!isset($_GET['id'])){
	echo "<script>alert('请输入需要删除记录ID');window.location.href='./crud.php';</script> ";
}

$id = $_GET['id'];
$sql = "DELETE FROM clock_data WHERE ID={$id}";
$result = $db->query($sql);
if ($result==false){
	die("妈的，你传的啥！");
}
echo "<script>alert('删除记录成功');window.location.href='./crud.php';</script> ";