<?php
// 引入函数库、类库文件
include "../inc/myfunction.inc";
include "../inc/mysql.class.php";

// 获取变量
$id = (int)$_POST['id'];
$time = date("Y-m-d H:i:s",time());
// 验证基础变量
if (!$id) {
	exit_msg("未知错误：参数错误");
}
// 实例化类库
$mysql = new mysql();

// 查询菜单信息
$row = $mysql -> find("menus","id='{$id}'");
$name = $row['name'];
// 删除菜单并记录日志
$data = [];
$data['del_tag'] = 1;
$mysql -> update("menus",$data,"id={$id} || up_id={$id}");

$info = [];
$info['user'] = $_SESSION['super']['name'];
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "删除菜单: ".$name." 成功";
$info['sql_cont'] = str_replace('"', "'", $mysql -> getLastSql());
$mysql -> insert("super_log",$info);

exit_msg("删除菜单: ".$name." 成功","success",0);
?>