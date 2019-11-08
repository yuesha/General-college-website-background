<?php
$pic_manage = "active open";
$banner = "active";
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
						<li class="active">横幅图片管理</li>
					</ul><!-- .breadcrumb -->

				</div>

				<div class="page-content">
					<div class="page-header">
						<h1>
							横幅图片管理
							<small>
								<i class="icon-double-angle-right"></i>
								横幅图片编辑
							</small>
						</h1>
					</div><!-- /.page-header -->
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<div class="tabbable">
								<ul class="nav nav-tabs" id="myTab">
									<li class="">
										<a href="banner.php">
											横幅图片列表
										</a>
									</li>

									<li class="">
										<a href="banner-add.php">
											横幅图片添加
										</a>
									</li>

									<li class="active" id="edit_pics">
										<a href="javascript:;" id="edit_title">
											编辑横幅图片
										</a>
									</li>

									<?php
									$del_num = $mysql -> getRowsNum("SELECT * FROM pics WHERE del_tag=1 && type=2");
									?>
									<li>
										<a href="banner-dtr.php">
											删除恢复
											<?php echo $del_num==0?'':'<span class="badge badge-warning">'.$del_num.'</span>';?>
										</a>
									</li>


								</ul>

								<div class="tab-content">
									<div id="lists" class="tab-pane in active">
										<?php
											$row = $mysql -> find("pics","id={$id}");
										?>
										<div id="alert"></div>
										<form class="form-horizontal" id="sample-form">
											<input type="hidden" name="id" value="<?php echo $id;?>">
											<div class="form-group">
												<label for="name" class="col-xs-12 col-sm-3 control-label no-padding-right">原图片</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<img src="<?php echo $row['src'];?>" style="width: 200px;">
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(必须上传)
												</div>
											</div>
											<div class="form-group">
												<label for="name" class="col-xs-12 col-sm-3 control-label no-padding-right">图片</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<input type="file" id="pic_addr" />
												</div>
												<div class="help-block col-xs-12 col-sm-reset inline red">
													*(必须上传)
												</div>
											</div>
											<div class="form-group">
												<label for="show_tag" class="col-xs-12 col-sm-3 control-label no-padding-right">是否隐藏</label>

												<div class="col-xs-12 col-sm-5 inline help-block">
													<span class="block input-icon input-icon-right">
														<div class="radio inline">
															<label>
																<input type="radio" name="show_tag" value="1" title="是" class="ace" <?php echo $row['show_tag']==1?'checked':'';?>>
																<span class="lbl"> 是 </span>
															</label>
														</div>
														<div class="radio inline">
															<label>
																<input type="radio" name="show_tag" id="show_tag" value="0" title="否"  class="ace" <?php echo $row['show_tag']==0?'checked':'';?>>
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
		$('#pic_addr').on('change',function(){
			var file=this.files[0]; //获取file对象
			var arr = ['jpg','jpeg','png','bmp'];
			var type = file.type.split("/"); //检查文件类型
			if(type[0] != "image"){
				alert("请选择图片");
				return false;
			}else if (arr.indexOf(type[1])==-1) {
				alert("格式错误");
			}
		});
		function save() {
			$('#loading').modal('show');
			var formData = new FormData($('form')[0]);
			if ($('#pic_addr')[0] != undefined) {
				formData.append("pic",$('#pic_addr')[0].files[0]);
			}
			$.ajax({
				type: "POST",
				url: "/ajax/banner-edit.php",
				data: formData,
				async: true,
                processData: false, //processData 默认为false，当设置为true的时候,jquery ajax 提交的时候不会序列化 data，而是直接使用data
                contentType: false,
                success: function(res){
                	var res = $.parseJSON(res);
                	if (res.tag > 0) {
                		$('#loading').modal('hide');
                		$('#alert').html(res.html);
                		return false;
                	}else{
                		$('#alert').html(res.html);
                		setTimeout(function(){
                			$('#loading').modal('hide');
                			$('#login').text('成功');
                			window.location.href="/super/banner-edit.php?id=<?php echo $id;?>";
                		},1000);
                	}
                }
            });
			return false;
		}
	</script>
</body>
</html>