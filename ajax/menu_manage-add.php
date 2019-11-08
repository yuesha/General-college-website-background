<?php
// 引入函数库、类库文件
include "../inc/myfunction.inc";
include "../inc/mysql.class.php";

// 获取变量
$time = date("Y-m-d H:i:s",time());
$show_order = (int)@$_POST['show_order'];
$up_id = (int)@$_POST['up_id'];
$name = trim_blank(@$_POST['name']);
$type_id = (int)@$_POST['type_id'];
$link_addr = trim_blank(@$_POST['link_addr']);
$show_tag = (int)@$_POST['show_tag'];

// 验证基础变量
if ($name == '') {
	exit_msg("请输入菜单名称");
}elseif ($type_id == 0 && $link_addr == '') {
	exit_msg("请选择关联分类或填写链接地址");
}
// 实例化类库
$mysql = new mysql();

// 查询菜单信息是否正确
$row = $mysql -> find("menus","name='{$name}'");
if ($row) {
	exit_msg("此菜单名称已存在，请重新添加");
}

// 新增菜单并记录日志
$data = [];
$data['show_order'] = $show_order;
$data['up_id'] = $up_id;
$data['name'] = $name;
$data['type_id'] = $type_id;
$data['link_addr'] = $link_addr;
$data['show_tag'] = $show_tag;
$data['created_at'] = $time;
$data['add_user'] = $_SESSION['super']['name'];
$mysql -> insert("menus",$data);

$info = [];
$info['user'] = $_SESSION['super']['name'];
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "新增菜单: ".$name." 成功";
$info['sql_cont'] = str_replace('"', "'", $mysql -> getLastSql());
$mysql -> insert("super_log",$info);

exit_msg("新增菜单: ".$name." 成功","success",0);
?>