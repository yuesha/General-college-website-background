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

// 查询内容信息
$row = $mysql -> find("conts","id='{$id}'");
$name = $row['name'];
// 删除内容并记录日志
$mysql -> delete("conts","id={$id}");

$info = [];
$info['user'] = $_SESSION['manage']['name'];
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "删除内容: ".$name." 成功";
$info['sql_cont'] = str_replace('"', "'", $mysql -> getLastSql());
$mysql -> insert("manage_log",$info);

exit_msg("删除内容: ".$name." 成功","success",0);
?>