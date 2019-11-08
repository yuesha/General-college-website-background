<?php
	$xtcs = "active open";
	$administrator = "active";
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
						<li class="active">管理员管理</li>
					</ul><!-- .breadcrumb -->

				</div>

				<div class="page-content">
					<div class="page-header">
						<h1>
							管理员管理
							<small>
								<i class="icon-double-angle-right"></i>
								管理员添加
							</small>
						</h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<div class="tabbable">
								<ul class="nav nav-tabs" id="myTab">
									<li class="">
										<a href="administrator.php">
											<i class="green icon-home bigger-110"></i>
											管理员列表
										</a>
									</li>

									<li class="active">
										<a href="administrator-add.php">
											管理员添加
										</a>
									</li>

									<li class="hidden" id="edit_manage">
										<a href="javascript:;" id="edit_title">
											编辑管理员
										</a>
									</li>

									<?php
										$del_num = $mysql -> getRowsNum("SELECT * FROM manage WHERE del_tag=1");
									?>
									<li>
										<a href="administrator-dtr.php">
											删除恢复
											<?php echo $del_num==0?'':'<span class="badge badge-warning">'.$del_num.'</span>';?>
										</a>
									</li>
								</ul>

								<div class="tab-content">

									<div id="edit" class="tab-pane active">
										<div id="alert"></div>
										<form class="form-horizontal" id="sample-form">
											<div class="form-group">
												<label for="name" class="col-xs-12 col-sm-3 control-label no-padding-right">用户名</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<input type="text" name="name" id="name" class="width-100">
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(必填)
												</div>
											</div>
											<div class="form-group">
												<label for="real_name" class="col-xs-12 col-sm-3 control-label no-padding-right">真实姓名</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<input type="text" name="real_name" id="real_name" class="width-100">
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline">
													(可选填)
												</div>
											</div>
											<div class="form-group">
												<label for="password" class="col-xs-12 col-sm-3 control-label no-padding-right">用户口令</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<input type="password" name="password" id="password" class="width-100" placeholder="如果不填写，默认为123456">
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline">
													(可选填)
												</div>
											</div>
											<div class="form-group">
												<label for="remark" class="col-xs-12 col-sm-3 control-label no-padding-right">备注信息</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<input type="text" name="remark" id="remark" class="width-100">
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline">
													(可选填)
												</div>
											</div>
											<div class="form-group">
												<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">添加人</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<label>
															admin
														</label>
													</span>
												</div>
											</div>
											<div class="form-group">
												<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">添加时间</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<label>
															系统自动获取
														</label>
													</span>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-12 col-sm-5 col-sm-offset-4 inline help-block">
													<button class="btn btn-success" onclick="return save();">提交修改</button>&nbsp;&nbsp;&nbsp;
													<button class="btn btn-warning" type="reset">重置</button>
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
			$.post('/ajax/administrator-add.php',$('form').serialize(),function(res){
				if (res.tag > 0) {
					$('#loading').modal('hide');
					$('#alert').html(res.html);
					return false;
				}else{
					$('#alert').html(res.html);
					setTimeout(function(){
						$('#loading').modal('hide');
						$('#login').text('成功');
						window.location.href="/super/administrator-add.php";
					},1000);
				}
			},'json');
			return false;
		}
	</script>
	</body>
	</html>

