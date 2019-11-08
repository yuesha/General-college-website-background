<?php
// 引入函数库、类库文件
include "../inc/myfunction.inc";
include "../inc/mysql.class.php";

// 获取变量
$time = date("Y-m-d H:i:s",time());
$show_tag = (int)@$_POST['show_tag'];

// 验证基础变量
if($_FILES["pic"]["error"]){
	echo $_FILES["pic"]["error"];
}else{
	// 大小不可过10M
	if(($_FILES["pic"]["type"]=="image/png" || $_FILES["pic"]["type"]=="image/jpeg" || $_FILES["pic"]["type"]=="image/jpg" || $_FILES["pic"]["type"]=="image/gif")&&$_FILES["pic"]["size"]<10000000)
	{
        //防止文件名重复
        $arr = pathinfo($_FILES['pic']['name']);
		$filename ="../upload/image/".time().rand(0,9).rand(0,9).rand(0,9).".".$arr['extension'];
        //转码，把utf-8转成gb2312,返回转换后的字符串， 或者在失败时返回 FALSE。
		// $filename =iconv("UTF-8","gb2312",$filename);
         //检查文件或目录是否存在
		if(file_exists($filename)) {
			// echo"该文件已存在";
			exit_msg("请重新上传");
		} else {
            //保存文件,   move_uploaded_file 将上传的文件移动到新位置
            $rst = move_uploaded_file($_FILES["pic"]["tmp_name"],$filename);//将临时地址移动到指定地址
            if (!$rst) {
            	exit_msg("文件移动失败，请检查权限");
            }else{
                // exit_msg(basename($filename));
                $data['src'] = "/upload/image/".basename($filename);
            }
        }
    } else {
    	// echo"文件类型不对";
    	exit_msg("上传图片类型错误");
    }
}
// 实例化类库
$mysql = new mysql();
// 新增轮播图片并记录日志
$data['type'] = 1;// 轮播图片
$data['show_tag'] = $show_tag;
$data['created_at'] = $time;
$data['add_user'] = $_SESSION['super']['name'];

$mysql -> insert2("pics",$data);

$info = [];
$info['user'] = $_SESSION['super']['name'];
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "新增轮播图片:".@basename($filename)."成功";
$info['sql_cont'] = str_replace('"', "'", $mysql -> getLastSql());
$mysql -> insert("super_log",$info);

exit_msg("新增轮播图片:".@basename($filename)."成功","success",0);
?>