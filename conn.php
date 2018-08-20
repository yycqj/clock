<?php
$dbms='mysql';     //数据库类型
$host='localhost'; //数据库主机名
$dbName='clock';    //使用的数据库
$user='root';      //数据库连接用户名
$pass='';          //对应的密码
$dsn="$dbms:host=$host;dbname=$dbName";


try {
	$db = new PDO($dsn, $user, $pass); //初始化一个PDO对象

} catch (PDOException $e) {
	die ("Error!: " . $e->getMessage() . "<br/>");
}
