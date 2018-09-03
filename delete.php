<?php
require_once "./class.MysqlExt.php";

if(!isset($_GET['user'])) exit('请在域名后加上?user=你的name');
define("TABLENAME", 'clock_data_'.$_GET['user']);

$db = new MysqlExt;
if (!isset($_GET['id'])){
	echo "<script>alert('请输入需要删除记录ID');window.location.href='./crud.php?user=".$_GET['user']."';</script> ";
}

$id = $_GET['id'];
$sql = "DELETE FROM ".TABLENAME." WHERE ID={$id}";
$result = $db->query($sql);
if ($result==false){
	die("妈耶，你传的啥！");
}
echo "<script>alert('删除记录成功');window.location.href='./crud.php?user=".$_GET['user']."';</script> ";