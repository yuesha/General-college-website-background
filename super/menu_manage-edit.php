<?php
	$id = (int)$_GET['id'];
	if (!$id) {
		header("location: ./menu_manage.php");
		exit;
	}
	$menu_manage = "active";
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
						<li class="active">菜单管理</li>
					</ul><!-- .breadcrumb -->

				</div>

				<div class="page-content">
					<div class="page-header">
						<h1>
							菜单管理
							<small>
								<i class="icon-double-angle-right"></i>
								菜单编辑
							</small>
						</h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<div class="tabbable">
								<ul class="nav nav-tabs" id="myTab">
									<li class="">
										<a href="menu_manage.php">
											<i class="green icon-home bigger-110"></i>
											菜单列表
										</a>
									</li>

									<li class="">
										<a href="menu_manage-add.php">
											菜单添加
										</a>
									</li>

									<li class="active" id="edit_manage">
										<a href="javascript:;" id="edit_title">
											编辑菜单
										</a>
									</li>

									<?php
										$del_num = $mysql -> getRowsNum("SELECT * FROM menus WHERE del_tag=1");
									?>
									<li>
										<a href="menu_manage-dtr.php">
											删除恢复
											<?php echo $del_num==0?'':'<span class="badge badge-warning">'.$del_num.'</span>';?>
										</a>
									</li>
								</ul>

								<div class="tab-content">
									<?php
										$row = $mysql -> find("menus","id={$id}");
									?>
									<div id="edit" class="tab-pane active">
										<div id="alert"></div>
										<form class="form-horizontal" id="sample-form">
											<input type="hidden" name="id" value="<?php echo $row['id'];?>">
											<div class="form-group">
												<label for="show_order" class="col-xs-12 col-sm-3 control-label no-padding-right">显示序号</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<input type="number" name="show_order" id="show_order" class="width-100" value="<?php echo $row['show_order'];?>">
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(必填)
												</div>
											</div>
											<div class="form-group">
												<label for="up_id" class="col-xs-12 col-sm-3 control-label no-padding-right">隶属菜单</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<select name="up_id" id="up_id" class="width-100">
															<option>无隶属菜单</option>
															<?php
																$menus = $mysql -> findAll("menus","del_tag = 0 && show_tag = 0 && id <> $id");
																foreach ($menus as $k => $v) {
															?>
															<option value="<?php echo $v['id'];?>" <?php echo $row['up_id']==$v['id']?'selected':'';?>><?php echo $v['name'];?></option>
															<?php }?>
														</select>
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(必选)
												</div>
											</div>
											<div class="form-group">
												<label for="name" class="col-xs-12 col-sm-3 control-label no-padding-right">菜单名称</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<input type="text" name="name" id="name" class="width-100" value="<?php echo $row['name'];?>">
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(必填)
												</div>
											</div>
											<div class="form-group">
												<label for="type_id" class="col-xs-12 col-sm-3 control-label no-padding-right">关联分类</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<select name="type_id" id="type_id" class="width-100">
															<option>无关联分类</option>
															<?php
																$cont_type_rows = $mysql -> findAll("cont_type","del_tag = 0 && show_tag = 0");
																foreach ($cont_type_rows as $k => $v) {
															?>
															<option value="<?php echo $v['id'];?>" <?php echo $row['type_id']==$v['id']?'selected':'';?>><?php echo $v['name'];?></option>
															<?php }?>
														</select>
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(关联分类与链接地址必须填写一个)
												</div>
											</div>
											<div class="form-group">
												<label for="link_addr" class="col-xs-12 col-sm-3 control-label no-padding-right">链接地址</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<input type="text" name="link_addr" id="link_addr" class="width-100" value="<?php echo $row['link_addr'];?>">
														<i class="icon-leaf"></i>
													</span>
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(关联分类与链接地址必须填写一个)
												</div>
											</div>
											<div class="form-group">
												<label for="show_tag" class="col-xs-12 col-sm-3 control-label no-padding-right">是否隐藏</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<div class="radio inline">
															<label>
																<input type="radio" name="show_tag" value="1" title="是" class="ace" <?php echo $row['show_tag'] == 1?'checked':'';?>>
																<span class="lbl"> 是 </span>
															</label>
														</div>
														<div class="radio inline">
															<label>
																<input type="radio" name="show_tag" id="show_tag" value="0" title="否" class="ace" <?php echo $row['show_tag'] == 0?'checked':'';?>>
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
			$.post('/ajax/menu_manage-edit.php',$('form').serialize(),function(res){
				if (res.tag > 0) {
					$('#loading').modal('hide');
					$('#alert').html(res.html);
					return false;
				}else{
					$('#alert').html(res.html);
					setTimeout(function(){
						$('#loading').modal('hide');
						$('#login').text('成功');
						window.location.href="/super/menu_manage-edit.php?id=<?php echo $row['id'];?>";
					},1000);
				}
			},'json');
			return false;
		}
	</script>
	</body>
	</html>

