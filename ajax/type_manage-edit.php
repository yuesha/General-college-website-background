<?php
// 引入函数库、类库文件
include "../inc/myfunction.inc";
include "../inc/mysql.class.php";

// 获取变量
$time = date("Y-m-d H:i:s",time());
$id = (int)@$_POST['id'];
$show_order = (int)@$_POST['show_order'];
$up_id = (int)@$_POST['up_id'];
$name = trim_blank(@$_POST['name']);
$type = (int)@$_POST['type'];
$show_tag = (int)@$_POST['show_tag'];

// 验证基础变量
if ($name == '') {
	exit_msg("请输入信息分类名称");
}else if ($id == 0) {
	exit_msg("未知错误：参数错误");
}
// 实例化类库
$mysql = new mysql();

// 查询信息分类信息是否正确
$row = $mysql -> find("cont_type","name='{$name}' && id <> {$id}");
if ($row) {
	exit_msg("此信息分类名称已存在，请重新添加");
}
// 修改信息分类并记录日志
$data = [];
$data['up_id'] = $up_id;
$data['show_order'] = $show_order;
$data['type'] = $type;
$data['name'] = $name;
$data['show_tag'] = $show_tag;
$data['add_user'] = $_SESSION['super']['name'];
$data['updated_at'] = $time;
$mysql -> update("cont_type",$data,"id={$id}");

$info = [];
$info['user'] = $_SESSION['super']['name'];
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "修改信息分类: ".$name." 成功";
$info['sql_cont'] = str_replace('"', "'", $mysql -> getLastSql());
$mysql -> insert("super_log",$info);

exit_msg("修改信息分类: ".$name." 成功","success",0);
?>