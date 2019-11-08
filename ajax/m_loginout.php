<?php
	include "../inc/mysql.class.php";
	include "../inc/myfunction.inc";
	$mysql = new mysql();
	$manage = $_SESSION['manage'];

	$info = [];
	$info['user'] = $manage['name'];
	$info['created_at'] = date("Y-m-d H:i:s",time());
	$info['ip'] = $_SERVER['REMOTE_ADDR'];
	$info['action'] = "注销成功";
	$mysql -> insert("manage_log",$info);

	$_SESSION['manage'] = null;
	exit(json_encode(array('tag' => 0,'msg' => '登出成功')));
?>