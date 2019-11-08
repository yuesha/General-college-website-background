<?php
	// 如果未登录，予以跳转
	@session_start();
	if (!@$_SESSION['super']) {
		?>
		<script>window.location.href="../login_super.php"</script>
		<?php
		exit;
	}

	// 引入类库文件及函数库
	include "../inc/mysql.class.php";
	include "../inc/myfunction.inc";

	// 实例化对象
	$mysql = new mysql();

	// 获取网站基本信息
	if (!$_SESSION['setting']) {
		$setting = $mysql -> find("setting","1=1");
		$_SESSION['setting'] = $setting;
	}
?>
<meta name="keywords" content="学院网站,通用网站后台,ET工作室" />
<meta name="description" content="关于学院网站的简要介绍" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- basic styles -->
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />

<!--[if IE 7]>
<link rel="stylesheet" href="../assets/css/font-awesome-ie7.min.css" />
<![endif]-->

<!-- page specific plugin styles -->

<!-- fonts -->

<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

<!-- ace styles -->

<link rel="stylesheet" href="../assets/css/ace.min.css" />
<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />

<!--[if lte IE 8]>
<link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
<![endif]-->

<!-- inline styles related to this page -->

<!-- ace settings handler -->
<script src="../assets/js/jquery.min.js"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

<!--[if lt IE 9]>
<script src="../assets/js/html5shiv.js"></script>
<script src="../assets/js/respond.min.js"></script>
<![endif]-->
<?php
	error_reporting(E_ALL ^ E_NOTICE);
?>