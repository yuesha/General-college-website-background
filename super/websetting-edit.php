<?php
$xtcs = "active open";
$wzsz = "active";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<!-- head 内容 -->
	<?php include "../inc/super/head.php";?>
	<title><?php echo @$_SESSION['setting']['name'];?>-网站后台</title>
</head>

<body>
	<!-- 顶部内容 -->
	<?php include "../inc/super/header.php";?>

	<div class="main-container" id="main-container">
		<script type="text/javascript">
			try{ace.settings.check('main-container' , 'fixed')}catch(e){}
		</script>

		<div class="main-container-inner">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<!-- 左侧菜单栏 -->
			<?php include "../inc/super/navbar.php";?>

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<script type="text/javascript">
						try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
					</script>

					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="./">首页</a>
						</li>
						<li>
							<a href="javascript:;">系统初始</a>
						</li>
						<li class="active">网站设置</li>
					</ul><!-- .breadcrumb -->
				</div>

				<div class="page-content">
					<div class="page-header">
						<h1>
							网站设置
							<small>
								<i class="icon-double-angle-right"></i>
								信息编辑
							</small>
						</h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<div class="tabbable">
								<ul class="nav nav-tabs" id="myTab">
									<li class="">
										<a href="websetting.php">
											<i class="green icon-home bigger-110"></i>
											网站信息查看
										</a>
									</li>
									<li class="active">
										<a href="javascript:;">
											网站信息编辑
										</a>
									</li>
								</ul>

								<div class="tab-content">
									<!-- 编辑页面 -->
									<div id="edit" class="tab-pane active">
										<div id="alert">

										</div>
										<form class="form-horizontal" id="sample-form">
											<div class="form-group">
												<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">学院名称</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<input type="text" name="name" class="width-100" value="<?php echo $_SESSION['setting']['name'];?>">
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(必填)
												</div>
											</div>
											<div class="form-group">
												<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">网站副标题</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<input type="text" name="subhead" class="width-100" value="<?php echo $_SESSION['setting']['subhead'];?>">
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(必填)
												</div>
											</div>
											<div class="form-group">
												<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">承办单位</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<input type="text" name="organizer" class="width-100" value="<?php echo $_SESSION['setting']['organizer'];?>">
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(必填)
												</div>
											</div>
											<div class="form-group">
												<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">网站说明信息</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<input type="text" name="description" class="width-100" value="<?php echo $_SESSION['setting']['description'];?>">
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(必填)
												</div>
											</div>
											<div class="form-group">
												<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">网站运行状态</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<label>
															<small class="red">
																<b>OFF 为调试状态</b>
															</small>

															<input name="switch" class="ace ace-switch ace-switch-7" type="checkbox" value="1" <?php echo @$_SESSION['setting']['switch']==1?'checked':'';?>>
															<span class="lbl"></span>
														</label>
													</span>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-12 col-sm-5 col-sm-offset-4 inline help-block">
													<button class="btn btn-success" id="btn-action" data-loading-text="正在加载" onclick="return save()">提交修改</button>&nbsp;&nbsp;&nbsp;
													<input type="reset" class="btn btn-warning" value="重置">
												</div>
											</div>
										</form>
									</div>

								</div>
							</div>

							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div><!-- /.main-content -->

			<?php include "../inc/ace-setting.php";?>
		</div><!-- /.main-container-inner -->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>
	</div><!-- /.main-container -->

	<!-- 底部支持文件 + 声明文件 -->
	<?php include "../inc/super/foot.php";?>
	<script type="text/javascript">
		function save() {
			$('#loading').modal('show');
			$.post('/ajax/websetting.php',$('form').serialize(),function(res){
				if (res.tag > 0) {
					$('#loading').modal('hide');
					$('#alert').html(res.html);
					return false;
				}else{
					$('#alert').html(res.html);
					// layer.msg(res.msg,{'icon':1});
					setTimeout(function(){
						$('#loading').modal('hide');
						$('#login').text('修改成功');
						window.location.href="/super/websetting.php";
					},1000);
				}
			},'json');
			return false;
		}
	</script>
</body>
</html>

