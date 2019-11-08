<?php
// 引入函数库、类库文件
include "../inc/myfunction.inc";
include "../inc/mysql.class.php";

// 获取变量
$id = (int)$_POST['id'];
$time = date("Y-m-d H:i:s",time());
$name = trim_blank(@$_POST['name']);
$real_name = trim_blank(@$_POST['real_name']);
$password = @$_POST['password'];
$remark = trim_blank(@$_POST['remark']);
// 验证基础变量
if ($name == '') {
	exit_msg("请输入用户名");
}elseif (!$id) {
	exit_msg("未知错误：参数错误");
}elseif ($password == '') {
	$password = "123456";		// 不输入默认为123456
}

// 实例化类库
$mysql = new mysql();

// 查询用户信息是否正确
$row = $mysql -> find("manage","id='{$id}'");
// 如果传递过来的用户名与数据库对应的用户名不一致，则用户想要修改用户名，那么需要判断新用户名是否重复
if ($row['name'] != $name) {
	$row1 = $mysql -> find("manage","name='{$name}'");
	if ($row1) {
		exit_msg("此用户名已存在，请修改");
	}
}
// 修改管理员并记录日志
$data = [];
if ($password != $row['password']) {	// 如果用户输入的密码与数据库不同，即执行密码加密
	$password = pw_md5($name,$password);
}
$data['name'] = $name;
$data['real_name'] = $real_name;
$data['password'] = $password;
$data['updated_at'] = $time;
$data['add_user'] = $_SESSION['super']['name'];
$data['remark'] = $remark;
$mysql -> update("manage",$data,"id=".$id);

$info = [];
$info['user'] = $_SESSION['super']['name'];
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "修改管理员:".$name.($real_name==''?'':"(".$real_name.")")."成功";
$info['sql_cont'] = str_replace('"', "'", $mysql -> getLastSql());
$mysql -> insert("super_log",$info);

exit_msg("修改管理员:".$name.($real_name==''?'':"(".$real_name.")")."成功","success",0);
?>