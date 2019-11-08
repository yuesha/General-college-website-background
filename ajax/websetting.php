<?php
// 引入函数库、类库文件
include "../inc/myfunction.inc";
include "../inc/mysql.class.php";

// 获取变量
$time = date("Y-m-d H:i:s",time());
$name = trim_blank(@$_POST['name']);
$subhead = trim_blank(@$_POST['subhead']);
$organizer = trim_blank(@$_POST['organizer']);
$description = trim_blank(@$_POST['description']);
$switch = (int)@$_POST['switch'];

// 验证基础变量
if ($name == '') {
	exit_msg("请输入学院名称");
}elseif ($subhead == '') {
	exit_msg("请输入网站副标题");
}elseif ($organizer == '') {
	exit_msg("请输入承办单位");
}elseif ($description == '') {
	exit_msg("请输入网站说明信息");
}

// 构造$data数组
$data = [];
$info = [];
$data['name'] = $name;
$data['subhead'] = $subhead;
$data['organizer'] = $organizer;
$data['description'] = $description;
$data['switch'] = $switch;

// 实例化类库
$mysql = new mysql();



// 更新信息并记录日志
$row = $mysql -> find("setting","1=1");
if ($row) {
	$mysql -> update("setting",$data,"id={$row['id']}");
	$info['action'] = "修改网站设置信息";
}else{
	$info['action'] = "新建网站设置信息";
	$mysql -> insert("setting",$data);
}
$info['user'] = $_SESSION['super']['name'];
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['sql_cont'] = $mysql -> getLastSql();
$mysql -> insert("super_log",$info);

// 更新session
$_SESSION['setting'] = $data;

exit_msg("恭喜您，修改成功","success",0);
?>