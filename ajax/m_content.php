<?php
// 引入函数库、类库文件
include "../inc/myfunction.inc";
include "../inc/mysql.class.php";
// 获取变量
$time = date("Y-m-d H:i:s",time());
$name = trim_blank(@$_POST['name']);
$cont = @$_POST['cont'];
$link_addr = @$_POST['link_addr'];
$id = (int)@$_POST['id'];
$show_order = (int)@$_POST['show_order'];
$up_id = (int)@$_POST['up_id'];
$show_tag = (int)@$_POST['show_tag'];
$type = (int)@$_POST['type'];

// 验证基础变量
if ($name == '') {
	exit_msg("请输入信息标题");
}

// 实例化类库
$mysql = new mysql();

// 设置信息记录并记录日志
$data = [];
$data['type_id'] = $id;
$data['show_order'] = $show_order;
$data['name'] = $name;
$data['link_addr'] = @$link_addr;
$data['cont'] = str_replace("'",'"',$cont);
$data['show_tag'] = $show_tag;
$data['created_at'] = $time;
$data['add_user'] = $_SESSION['manage']['name'];
// 查询是否已经存在此记录
$row = $mysql -> find("conts","type_id='{$id}'");
if (!$row) {
	$res = $mysql -> insert2("conts",$data);
}else{
	$mysql -> update("conts",$data,"type_id={$id}");
}

$info = [];
$info['user'] = $_SESSION['manage']['name'];
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "设置信息记录:".$name."成功";
$info['sql_cont'] = str_replace('"', "'", $mysql -> getLastSql());
$mysql -> insert("manage_log",$info);

exit_msg("设置信息记录:".$name."成功","success",0);
?>