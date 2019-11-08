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
// 查询信息分类信息
$row = $mysql -> find("cont_type","id='{$id}'");
// 获取将恢复信息分类的父级信息分类，若父级信息分类被删除，则不可恢复
if ($row['up_id']) {
	$num_row = $mysql -> getRowsNum("SELECT * FROM cont_type WHERE id = {$row['up_id']} && del_tag=1");
	if ($num_row) {
		exit_msg("错误:隶属信息分类未恢复");
	}
}
$name = $row['name'];
// 恢复信息分类并记录日志
$data = [];
$data['del_tag'] = 0;
$mysql -> update("cont_type",$data,"id=".$id);

$info = [];
$info['user'] = $_SESSION['super']['name'];
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "恢复信息分类:".$name." 成功";
$info['sql_cont'] = str_replace('"', "'", $mysql -> getLastSql());
$mysql -> insert("super_log",$info);

exit_msg("恢复信息分类:".$name." 成功","success",0);
?>