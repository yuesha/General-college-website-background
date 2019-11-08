<?php
// 引入函数库、类库文件
include "../inc/myfunction.inc";
include "../inc/mysql.class.php";

// 获取变量
$time = date("Y-m-d H:i:s",time());
$name = trim_blank(@$_POST['name']);
$cont = @$_POST['cont'];
$id = (int)@$_POST['id'];
$show_order = (int)@$_POST['show_order'];
$up_id = (int)@$_POST['up_id'];
$show_tag = (int)@$_POST['show_tag'];
$type = (int)@$_POST['type'];

// 验证基础变量
if ($name == '') {
	exit_msg("请输入信息标题");
}elseif (isset($_FILES['pic'])) {	// 如果上传了文件，则为图文列表上传的图片
	if($_FILES["pic"]["error"])
	{
		echo $_FILES["pic"]["error"];
	} else {
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
                    $data2 = [];
                    $data2['type'] = 0;
                    $data2['src'] = "/upload/image/".basename($filename);
                }
            }
        } else {
        	// echo"文件类型不对";
        	exit_msg("上传图片类型错误");
        }
    }
}
// 实例化类库
$mysql = new mysql();
// 新增信息记录并记录日志
$data = [];
$data['type_id'] = $id;
$data['show_order'] = $show_order;
$data['name'] = $name;
$data['link_addr'] = @$link_addr;
$data['cont'] = str_replace("'",'"',$cont);
$data['show_tag'] = $show_tag;
$data['created_at'] = $time;
$data['add_user'] = $_SESSION['manage']['name'];

$ins_id = $mysql -> insert2("conts",$data);

// 上传图片（如果有）
if (isset($data2)) {
    $data2['content_id'] = $ins_id;
    $data2['created_at'] = $time;
    $data2['add_user'] = $_SESSION['manage']['name'];

    $mysql -> insert2("pics",$data2);
}

$info = [];
$info['user'] = $_SESSION['manage']['name'];
$info['created_at'] = $time;
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['action'] = "新增信息记录:".$name."成功";
$info['sql_cont'] = str_replace('"', "'", $mysql -> getLastSql());
$mysql -> insert("manage_log",$info);

exit_msg("新增信息记录:".$name."成功","success",0);
?>