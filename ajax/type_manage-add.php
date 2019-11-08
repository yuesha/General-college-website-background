<?php
// 引入函数库、类库文件
include "../inc/myfunction.inc";
include "../inc/mysql.class.php";
// 获取变量
$time = date("Y-m-d H:i:s",time());
$show_order = (int)@$_POST['show_order'];
$up_id = (int)@$_POST['up_id'];
$name = trim_blank(@$_POST['name']);
$type = (int)@$_POST['type'];
$show_tag = (int)@$_POST['show_tag'];

// 验证基础变量
if ($name == '') {
	exit_msg("请输入信息分类名称");
}
// 实例化类库
$mysql = new mysql();

// 查询信息分类信息是否正确
$row = $mysql -> find("cont_type","name='{$name}'");
if ($row) {
	exit_msg("此信息分类名称已存在，请重新添加");
}
// 新增信息分类并记录日志
$data = [];
$data['show_order'] = $show_order;
$data['up_id'] = $up_id;
$data['name'] = $name;
$data['type'] = $type;
$data['show_tag'] = $show_tag;
$data['created_at'] = $time;
$data['add_user'] = $_SESSION['super']['name'];
$mysql -> insert("cont_type",$data);

$info = [];
$info['user'] = $_SESSION['super']['name'];
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "新增信息分类: ".$name." 成功";
$info['sql_cont'] = str_replace('"', "'", $mysql -> getLastSql());
$mysql -> insert("super_log",$info);

exit_msg("新增信息分类: ".$name." 成功","success",0);
?>