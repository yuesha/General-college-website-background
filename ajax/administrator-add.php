<?php
// 引入函数库、类库文件
include "../inc/myfunction.inc";
include "../inc/mysql.class.php";

// 获取变量
$time = date("Y-m-d H:i:s",time());
$name = trim_blank(@$_POST['name']);
$real_name = trim_blank(@$_POST['real_name']);
$password = @$_POST['password'];
$remark = trim_blank(@$_POST['remark']);
// 验证基础变量
if ($name == '') {
	exit_msg("请输入用户名");
}elseif ($password == '') {
	$password = "123456";		// 不输入默认为123456
}

// 实例化类库
$mysql = new mysql();

// 查询用户信息是否正确
$row = $mysql -> find("manage","name='{$name}'");
if ($row) {
	exit_msg("此用户名已存在，请重新添加");
}

// 新增管理员并记录日志
$data = [];
$password = pw_md5($name,$password);
$data['name'] = $name;
$data['real_name'] = $real_name;
$data['password'] = $password;
$data['created_at'] = $time;
$data['add_user'] = $_SESSION['super']['name'];
$data['remark'] = $remark;
$mysql -> insert("manage",$data);

$info = [];
$info['user'] = $_SESSION['super']['name'];
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "新增管理员:".$name.($real_name==''?'':"(".$real_name.")")."成功";
$info['sql_cont'] = str_replace('"', "'", $mysql -> getLastSql());
$mysql -> insert("super_log",$info);

exit_msg("新增管理员:".$name.($real_name==''?'':"(".$real_name.")")."成功","success",0);
?>