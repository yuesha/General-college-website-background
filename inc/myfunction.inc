<?php
/**
* 页面输出ace的提示框（可关闭）
*
* @access public
* @param String  	提示的信息
* @param int  		若为0(或者不输入)，则为info(蓝色);若为1，则为danger(红色);若为2，则为warning(黄色)
*/
function msg($msg,$code = 0){
	switch ($code) {
		case '0':
			$code = "info";
			break;
		case '1':
			$code = "warning";
			break;
		case '2':
			$code = "danger";
			break;
	}

	echo <<<EOF
		<div class="alert alert-block alert-$code">
			<button type="button" class="close" data-dismiss="alert">
				&times;
			</button>
			$msg
		</div>
EOF;
}

/**
* 去除所有的空格
*
* @access public
* @param String  传入字符串
* @return String 返回没有空格的字符串
*/
function trim_blank($str)
{
	return str_replace(' ','',$str);
}

// 返回错误信息
function exit_msg($msg='错误，数据不全',$code = 'danger',$tag = 1)
{
	$html = <<<EOF
		<div class="alert alert-block alert-$code">
			<button type="button" class="close" data-dismiss="alert">
				&times;
			</button>
			$msg
		</div>
EOF;
	exit(json_encode(array('tag' => $tag,'html' => $html)));
}

// 格式化打印变量
function dump($var){
	echo "<pre>";
	var_dump($var);
}

// 验证加密密码（用户名连上密码，两次md5加密）是否正确
function check_pw($name,$user_pw,$pw)
{
	$password = md5(md5($name.$user_pw));
	if ($pw != $password) {
		return false;
	}else{
		return true;
	}
}

// 加密密码(用户名连上密码，两次md5加密)
function pw_md5($name,$pw)
{
	return md5(md5($name.$pw));
}

// 信息分类类型id转换为中文（用以显示）
function change_type_name($id)
{
	switch ($id) {
		case '0':
			$name = "有下级分类";
			break;
		case '1':
			$name = "新闻列表";
			break;
		case '2':
			$name = "图文列表";
			break;
		case '3':
			$name = "直接内容";
			break;
		case '4':
			$name = "链接地址";
			break;
		default:
			$name = "未知错误";
			break;
	}
	return $name;
}

function sort_in_array($rows){
	foreach ($rows as $row) {
		if ($row['up_id'] == 0) {
			$rows_new[$row['id']] = $row;
		}else{
			$rows_new[$row['up_id']]['down'][] = $row;
		}
	}
	$show_order = array_column($rows_new,'show_order');
	array_multisort($show_order,SORT_ASC,$rows_new);
	// dump($rows_new); exit;
	return $rows_new;
}

?>