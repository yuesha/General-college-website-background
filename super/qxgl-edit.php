<?php
$xtcs = "active open";
$qxgl = "active";
$id = (int)@$_GET['id'];
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
						<li class="">
							<a href="qxgl.php">权限管理</a>
						</li>
						<li class="active">
							权限设置
						</li>
					</ul><!-- .breadcrumb -->

				</div>

				<div class="page-content">
					<div class="page-header">
						<h1>
							权限管理
							<small>
								<i class="icon-double-angle-right"></i>
								权限设置
							</small>
						</h1>
					</div><!-- /.page-header -->
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<div class="tabbable">
								<ul class="nav nav-tabs" id="myTab">
									<li class="">
										<a href="qxgl.php">
											<i class="green icon-home bigger-110"></i>
											管理员列表
										</a>
									</li>
									<li class="active">
										<a href="javascript:;">
											权限设置
										</a>
									</li>

								</ul>

								<div class="tab-content">
									<div id="lists" class="tab-pane in active">
										<div id="alert"></div>
										<form class="form-horizontal" id="sample-form">
											<input type="hidden" name="id" value="<?php echo $id;?>">
											<?php
											$row_auth = $mysql -> find("authority","manage_id={$id}");
											$auth = json_decode($row_auth['auth']);
											// dump($auth);
											$rows = $mysql -> findAll("cont_type","show_tag=0 && del_tag=0 ORDER BY up_id asc");
											$rows = sort_in_array($rows);
											foreach ($rows as $row) {
												?>
												<span style="font-size: 20px;"><?php echo $row['name'];?>:</span>
												<?php
												if (isset($row['down'])) {
													foreach ($row['down'] as $row_down) {
														?>

														<div class="checkbox inline form-group">
															<label>
																<input type="checkbox" name="qx[]" value="<?php echo $row_down['id'];?>" title="<?php echo $row_down['name'];?>" class="ace" <?php echo @in_array($row_down['id'],$auth)?'checked':'';?>>
																<span class="lbl"> <?php echo $row_down['name'];?> </span>
															</label>
														</div>
													<?php }}else{ ?>
														<div class="checkbox inline form-group">
															<label>
																<input type="checkbox" name="qx[]" value="<?php echo $row['id'];?>" title="<?php echo $row['name'];?>" class="ace" <?php echo @in_array($row['id'],$auth)?'checked':'';?>>
																<span class="lbl"> 本信息分类 </span>
															</label>
														</div>
													<?php }?>
													<hr>
												<?php }?>

												<div class="form-group">
													<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">添加人</label>

													<div class="col-xs-12 col-sm-5 inline help-block">
														<span class="block input-icon input-icon-right">
															<label>
																<?php echo $_SESSION['super']['name'];?>
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
				$.post('/ajax/qxgl.php',$('form').serialize(),function(res){
					if (res.tag > 0) {
						$('#loading').modal('hide');
						$('#alert').html(res.html);
						return false;
					}else{
						$('#alert').html(res.html);
						setTimeout(function(){
							$('#loading').modal('hide');
							$('#login').text('成功');
							window.location.reload();
						},1000);
					}
				},'json');
				return false;
			}
		</script>
	</body>
	</html>

