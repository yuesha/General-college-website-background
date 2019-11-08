<?php
	$code = (int)@$_GET['code'];
	include "/inc/myfunction.inc";
	include "/inc/mysql.class.php";
	$mysql = new mysql();
	if (!@$_SESSION['setting']) {
		$setting = $mysql -> find("setting","1=1");
		$_SESSION['setting'] = $setting;
	}
?>
<html lang="en"><head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta charset="utf-8">
	<title>学院网站后台-登录入口</title>

	<meta name="description" content="User login page">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<!-- bootstrap & fontawesome -->
	<!-- <link rel="shortcut icon" href="../images/fac.png"> -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css">

	<!-- text fonts -->
	<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css">

	<!-- ace styles -->
	<link rel="stylesheet" href="assets/css/ace.min.css">

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css">

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->

	<style type="text/css">
		/*设置图标右对齐问题*/
		.input-icon>.ace-icon{
			padding: 0 3px;
			z-index: 2;
			position: absolute;
			top: 1px;
			bottom: 1px;
			left: 3px;
			line-height: 30px;
			display: inline-block;
			color: #909090;
			font-size: 16px;
			left: auto;
			right: 3px;
		}

		/*设置主题表单框样式，阴影*/
		#login-box{
			background: 0;-webkit-box-shadow: 0 0 2px 1px rgba(0,0,0,.12); padding: 0;box-shadow: 0 0 2px 1px rgba(0,0,0,.12);
		}
	</style>
</head>

<body class="login-layout light-login" style="background: #DFE0E2" onkeyup="if(event.keyCode == 13){login();};">
	<div class="main-container">
		<div class="main-content">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="login-container">
						<div class="center">
							<h1>
								<i class="ace-icon fa fa-leaf green"></i>
								<span class="red"><?php echo $_SESSION['setting']['name'];?></span>
								<span class="block white" id="id-text2">普通管理员登录</span>
							</h1>
							<h4 class="blue" id="id-company-text">©日照职业技术学院</h4>
						</div>

						<div class="space-6"></div>

						<div class="position-relative">
							<div id="login-box" class="login-box visible widget-box no-border" style="">
								<div class="widget-body">
									<div class="widget-main">
										<h4 class="header blue lighter bigger">
											<i class="ace-icon fa fa-coffee green"></i>
											请输入您的账户信息
										</h4>
										<div class="space-6"></div>
										<!-- 提示框 -->
										<div id="alert" style="margin-bottom: 20px;"></div>

										<form action="doAction.php?a=log" method="post">
											<input type="hidden" name="_token" value="">
											<fieldset>
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="text" autofocus="" name="name" class="form-control" placeholder="请输入帐号" />
														<i class="ace-icon fa fa-user"></i>
													</span>
												</label>

												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="password" name="password" class="form-control" placeholder="请输入密码" />
														<i class="ace-icon fa fa-lock"></i>
													</span>
												</label>

												<label class="block clearfix">
													<div class="row">
														<div class="col-xs-7">
															<span class="block input-icon input-icon-right">
																<input name="captcha" type="text" class="form-control" placeholder="请输入四位验证码">
															</span>
														</div>
														<div class="col-xs-5">
															<img class="captcha pull-right" src="inc/captcha.func.php" onclick="this.src='inc/captcha.func.php?id='+Math.random()" style="height: 30px;" />
														</div>
													</div>
												</label>

												<div class="space"></div>


												<div class="space-4"></div>
											</fieldset>
										</form>
										<div class="clearfix">
											<button class="width-35 pull-right btn btn-sm btn-primary" onclick="return login();" id="login" data-loading-text="正在加载">
												<i class="ace-icon fa fa-key"></i>
												<span class="bigger-110">登录</span>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		function login() {
			$('#login').button('loading');
			$.post('/ajax/login-manage.php',$('form').serialize(),function(res){
				if (res.tag > 0) {
					$('#login').button('reset');
					$('#alert').html(res.html);
					return false;
				}else{
					$('#alert').html(res.html);
					// layer.msg(res.msg,{'icon':1});
					setTimeout(function(){
						$('#login').button('reset');
						$('#login').text('登录成功');
						window.location.href="/manage/index.php";
					},1000);
				}
			},'json');
			return false;
		}
	</script>
</body>
</html>