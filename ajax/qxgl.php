<?php
// 引用类库
include "../inc/myfunction.inc";
include "../inc/mysql.class.php";
// 接收变量
$manage_id = (int)@$_POST['id'];
$auth = @$_POST['qx'];
$time = date("Y-m-d H:i:s",time());
if (!$manage_id) {
	exit_msg("参数错误，请退回管理员列表页");
}
if (!$auth) {
	exit_msg("请选择权限内容");
}

// 实例化MySQL类库并插入或修改数据
$mysql = new mysql();

$row = $mysql -> find("authority","manage_id={$manage_id}");
$data['manage_id'] = $manage_id;
$data['auth'] = json_encode($auth);
$data['add_user'] = $_SESSION['super']['name'];
if (!$row) {
	// 原先不存在此条记录，则插入
	$data['created_at'] = $time;
	$mysql -> insert2("authority",$data);
}else{
	// 原先存在此条记录，则修改
	$mysql -> update("authority",$data,"id={$row['id']}");
}
// exit_msg($mysql -> getLastSql());
// 记录日志
$info = [];
$info['user'] = $_SESSION['super']['name'];
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "赋权:成功";
$info['sql_cont'] = str_replace('"', "'", $mysql -> getLastSql());
$mysql -> insert("super_log",$info);
exit_msg("权限设置成功","success",0);
?>