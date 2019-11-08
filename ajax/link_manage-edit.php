<?php
// 引入函数库、类库文件
include "../inc/myfunction.inc";
include "../inc/mysql.class.php";

// 获取变量
$time = date("Y-m-d H:i:s",time());
$id = (int)@$_POST['id'];
$show_order = (int)@$_POST['show_order'];
$type = (int)@$_POST['type'];
$name = trim_blank(@$_POST['name']);
$src = @$_POST['src'];
$show_tag = (int)@$_POST['show_tag'];

// 验证基础变量
if ($name == '') {
	exit_msg("请输入链接标题");
}elseif ($src == '') {
	exit_msg("请输入链接地址");
}elseif ($id == 0) {
	exit_msg("未知错误：参数错误");
}
// 实例化类库
$mysql = new mysql();

// 查询链接信息是否正确
$row = $mysql -> find("links","id <> {$id} && name='{$name}'");
if ($row) {
	exit_msg("此链接标题已存在，请重新添加");
}

// 修改链接并记录日志
$data = [];
$data['show_order'] = $show_order;
$data['tag'] = $type;
$data['title'] = $name;
$data['src'] = $src;
$data['show_tag'] = $show_tag;
$data['add_user'] = $_SESSION['super']['name'];
$data['created_at'] = $time;
$mysql -> update("links",$data,"id={$id}");

$info = [];
$info['user'] = $_SESSION['super']['name'];
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "修改链接: ".$name." 成功";
$info['sql_cont'] = str_replace('"', "'", $mysql -> getLastSql());
$mysql -> insert("super_log",$info);

exit_msg("修改链接: ".$name." 成功","success",0);
?>