<?php
	include "../inc/mysql.class.php";
	include "../inc/myfunction.inc";
	$mysql = new mysql();
	$super = $_SESSION['super'];

	$info = [];
	$info['user'] = $super['name'];
	$info['created_at'] = date("Y-m-d H:i:s",time());
	$info['ip'] = $_SERVER['REMOTE_ADDR'];
	$info['action'] = "注销成功";
	$mysql -> insert("super_log",$info);

	$_SESSION['super'] = null;
	exit(json_encode(array('tag' => 0,'msg' => '登出成功')));
?>