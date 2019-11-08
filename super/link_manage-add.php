<?php
$link_manage = "active";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<!-- head 内容 -->
	<?php include "../inc/super/head.php";?>
	<title><?php echo @$_SESSION['setting']['name'];?>-网站后台</title>
	<style type="text/css">
		.radio{padding-top: 0!important;}
	</style>
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
						<li class="">链接管理</li>
						<li class="active">链接添加</li>
					</ul><!-- .breadcrumb -->

				</div>

				<div class="page-content">
					<div class="page-header">
						<h1>
							链接管理
							<small>
								<i class="icon-double-angle-right"></i>
								链接添加
							</small>
						</h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<div class="tabbable">
								<ul class="nav nav-tabs" id="myTab">
									<li class="">
										<a href="link_manage.php">
											<i class="green icon-home bigger-110"></i>
											链接列表
										</a>
									</li>

									<li class="active">
										<a href="javascript:;">
											链接添加
										</a>
									</li>

									<li class="hidden" id="edit_manage">
										<a href="link_manage-edit.php" id="edit_title">
											编辑链接
										</a>
									</li>

									<?php
									$del_num = $mysql -> getRowsNum("SELECT * FROM links WHERE del_tag=1");
									?>
									<li>
										<a href="link_manage-dtr.php">
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
												<label for="show_order" class="col-xs-12 col-sm-3 control-label no-padding-right">显示序号</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<input type="number" name="show_order" id="show_order" class="width-100">
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(必填)
												</div>
											</div>
											<div class="form-group">
												<label for="type" class="col-xs-12 col-sm-3 control-label no-padding-right">链接类型</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<select name="type" id="type" class="width-100">
															<option value="0">校内链接</option>
															<option value="1">校外链接</option>
														</select>
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(必选)
												</div>
											</div>
											<div class="form-group">
												<label for="name" class="col-xs-12 col-sm-3 control-label no-padding-right">链接标题</label>

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
												<label for="src" class="col-xs-12 col-sm-3 control-label no-padding-right">链接地址</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<input type="text" name="src" id="src" class="width-100">
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(必填)
												</div>
											</div>
											<div class="form-group">
												<label for="show_tag" class="col-xs-12 col-sm-3 control-label no-padding-right">是否隐藏</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<div class="radio inline">
															<label>
																<input type="radio" name="show_tag" value="1" title="是" class="ace">
																<span class="lbl"> 是 </span>
															</label>
														</div>
														<div class="radio inline">
															<label>
																<input type="radio" name="show_tag" id="show_tag" value="0" title="否" checked="true" class="ace">
																<span class="lbl"> 否 </span>
															</label>
														</div>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(必选)
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
			$.post('/ajax/link_manage-add.php',$('form').serialize(),function(res){
				if (res.tag > 0) {
					$('#loading').modal('hide');
					$('#alert').html(res.html);
					return false;
				}else{
					$('#alert').html(res.html);
					setTimeout(function(){
						$('#loading').modal('hide');
						$('#login').text('成功');
						window.location.href="/super/link_manage-add.php";
					},1000);
				}
			},'json');
			return false;
		}
	</script>
</body>
</html>

