<?php
// 获取分类id，如果无id，则跳出本页
$id = (int)@$_GET['id'];
if (!$id) {
	header("location:./");
}
$up_id = (int)@$_GET['up_id'];
// 打开大的内容管理菜单
$nrgl = "active open";
// 将两级目录（如果有）打开
$str = "content".$id;
$$str = "active";
if ($up_id) {
	$str1 = "content1".$up_id;
	$$str1 = "active";
}

// 本条记录id
$cont_id = (int)@$_GET['cont_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<!-- head 内容 -->
	<?php include "../inc/super/head.php";?>
	<title><?php echo @$_SESSION['setting']['name'];?>-网站后台</title>
	<!-- 百度编辑器  -->

	<!-- 配置文件 -->
	<script type="text/javascript" src="/UEditor/ueditor.config.js"></script>
	<!-- 编辑器源码文件 -->
	<script type="text/javascript" src="/UEditor/ueditor.all.js"></script>
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
					<?php
					$type_row = $mysql -> find("cont_type","id={$id}");
					$cont_row = $mysql -> find("conts","id = {$cont_id}");
					?>
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="./">首页</a>
						</li>
						<li>内容管理</li>
						<?php
						if ($up_id) {
							// 输出父级分类的名称
							$row_1 = $mysql -> find("cont_type","id = {$up_id}");
							echo '<li>'.$row_1['name'].'</li>';
						}
						?>
						<li class="active"><?php echo $type_row['name'];?></li>
					</ul><!-- .breadcrumb -->

				</div>

				<div class="page-content">
					<div class="page-header">
						<h1>
							内容管理
							<small>
								<i class="icon-double-angle-right"></i>
								内容列表
							</small>
						</h1>
					</div><!-- /.page-header -->
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<div class="tabbable">
								<ul class="nav nav-tabs" id="myTab">

									<li class="">
										<a href="list.php?id=<?php echo $id;?>&up_id=<?php echo $up_id;?>">
											内容列表
										</a>
									</li>

									<li class="active">
										<a href="javascript:;">
											内容编辑
										</a>
									</li>

									<li class="">
										<a href="list-add.php?id=<?php echo $id;?>&up_id=<?php echo $up_id;?>">
											内容添加
										</a>
									</li>

								</ul>
								<div class="tab-content">
									<div id="lists" class="tab-pane in active">
										<div id="alert"></div>
										<form class="form-horizontal" id="sample-form">
											<input type="hidden" name="type" value="<?php echo $type_row['type'];?>">
											<input type="hidden" name="id" value="<?php echo $id;?>">
											<input type="hidden" name="up_id" value="<?php echo $up_id;?>">
											<input type="hidden" name="cont_id" value="<?php echo $cont_id;?>">
												<div class="form-group">
													<label for="show_order" class="col-xs-12 col-sm-2 control-label no-padding-right">显示序号</label>

													<div class="col-xs-12 col-sm-8 inline help-block">
														<span class="block input-icon input-icon-right">
															<input type="number" name="show_order" id="show_order" class="width-100" value="<?php echo @$cont_row['show_order'];?>">
															<i class="icon-leaf"></i>
														</span>
													</div>
													<div class="help-block col-xs-12 col-sm-reset inline red">
														*(必填)
													</div>
												</div>
												<div class="form-group">
													<label for="name" class="col-xs-12 col-sm-2 control-label no-padding-right">信息标题</label>

													<div class="col-xs-12 col-sm-8 inline help-block">
														<span class="block input-icon input-icon-right">
															<input type="text" name="name" id="name" class="width-100" value="<?php echo @$cont_row['name'];?>">
															<i class="icon-leaf"></i>
														</span>
													</div>
													<div class="help-block col-xs-12 col-sm-reset inline red">
														*(必填)
													</div>
												</div>
												<?php
												if ($type_row['type']==2) {
													$pic = $mysql -> find("pics","content_id={$cont_id}");
													?>
													<div class="form-group">
														<label for="name" class="col-xs-12 col-sm-2 control-label no-padding-right">图片</label>

														<div class="col-xs-12 col-sm-8 inline help-block">
															<input type="file" id="pic_addr" />
															<input type="hidden" name="pic_addr" id="pic_addr1" />
															<input type="hidden" name="pic_size" id="pic_size" />
															<img src="<?php echo $pic['src'];?>" style="width: 100px;margin-top: 5px;">
														</div>
														<div class="help-block col-xs-12 col-sm-reset inline red">
															*(必须上传)
														</div>
													</div>
												<?php }?>
												<div class="form-group">
													<label for="name" class="col-xs-12 col-sm-2 control-label no-padding-right">内容</label>

													<div class="col-xs-12 col-sm-8 inline help-block">
														<span class="block input-icon input-icon-right">
															<!-- 加载编辑器的容器 -->
															<script id="container" name="cont" type="text/plain"><?php echo @$cont_row['cont'];?></script>
															<!-- 实例化编辑器 -->
															<script type="text/javascript">
																var ue = UE.getEditor('container',{
																	// toolbars: [
																	// ['fullscreen', 'source', 'undo', 'redo', 'bold']
																	// ],
																	autoHeightEnabled: true,
																	autoFloatEnabled: true
																});
															</script>
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
																	<input type="radio" name="show_tag" value="1" title="是" class="ace" <?php echo @$cont_row['show_tag'] == 1?'checked':'';?>>
																	<span class="lbl"> 是 </span>
																</label>
															</div>
															<div class="radio inline">
																<label>
																	<input type="radio" name="show_tag" id="show_tag" value="0" title="否" class="ace" <?php echo @$cont_row['show_tag'] == 0?'checked':'';?>>
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
				// console.log(file);
				$('#pic_addr1').val($('#pic_addr').val());
				$('#pic_size').val(file.size);
			})
			function save() {
				$('#loading').modal('show');
				var formData = new FormData($('form')[0]);
				if ($('#pic_addr')[0] != undefined) {
		            formData.append("pic",$('#pic_addr')[0].files[0]);
				}
	            $.ajax({
	                type: "POST",
	                url: "/ajax/list-edit.php",
	                data: formData,
	                async: true,
	                processData: false, //processData 默认为false，当设置为true的时候,jquery ajax 提交的时候不会序列化 data，而是直接使用data
	                contentType: false,
	                success: function(res){
	                	var res = $.parseJSON(res);
	                	// console.log(res);return false;
	                	if (res.tag > 0) {
	                		$('#loading').modal('hide');
	                		$('#alert').html(res.html);
	                		return false;
	                	}else{
	                		$('#alert').html(res.html);
	                		setTimeout(function(){
	                			$('#loading').modal('hide');
	                			$('#login').text('成功');
	                			window.location.href="/super/list-edit.php?id=<?php echo $id;?>&up_id=<?php echo $up_id;?>&cont_id=<?php echo $cont_id;?>";
	                		},1000);
	                	}
	                }
	            });
				return false;
			}
		</script>
	</body>
	</html>

