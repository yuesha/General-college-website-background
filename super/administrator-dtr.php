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
								管理员恢复
							</small>
						</h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<div class="tabbable">
								<ul class="nav nav-tabs" id="myTab">
									<li>
										<a href="administrator.php">
											<i class="green icon-home bigger-110"></i>
											管理员列表
										</a>
									</li>

									<li class="">
										<a href="administrator-add.php">
											管理员添加
										</a>
									</li>

									<li class="hidden" id="edit_manage">
										<a href="administrator-edit.php" id="edit_title">
											编辑管理员
										</a>
									</li>

									<?php
									$del_num = $mysql -> getRowsNum("SELECT * FROM manage WHERE del_tag=1");
									?>
									<li class="active">
										<a href="administrator-dtr.php">
											删除恢复
											<?php echo $del_num==0?'':'<span class="badge badge-warning">'.$del_num.'</span>';?>
										</a>
									</li>
								</ul>

								<div class="tab-content">
									<div id="dtr" class="tab-pane active">
										<div id="alert"></div>
										<div class="table-responsive">
											<table id="sample-table-1" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>序号</th>
														<th>登录别名</th>
														<th class="hidden-480">真实姓名</th>
														<th>
															<i class="icon-time bigger-110 hidden-480"></i>
															最后修改时间
														</th>
														<th class="hidden-480">添加人</th>

														<th>操作</th>
													</tr>
												</thead>

												<tbody>
													<?php
													$rows = $mysql -> findAll("manage","del_tag=1 ORDER BY created_at desc");
													foreach ($rows as $k => $v) {
														?>
														<tr>
															<td class="center">
																<?php echo $k+1;?>
															</td>
															<td><?php echo $v['name'];?></td>
															<td class="hidden-480"><?php echo $v['real_name'];?></td>
															<td><?php echo $v['updated_at'];?></td>

															<td class="hidden-480">
																<span class="label label-sm label-warning"><?php echo $v['add_user'];?></span>
															</td>
															<td>
																<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
																	<button class="btn btn-xs btn-success" onclick="reset(<?php echo $v['id'];?>)">
																		恢复
																		<i class="icon-ok bigger-120"></i>
																	</button>
																</div>

																<div class="visible-xs visible-sm hidden-md hidden-lg">
																	<div class="inline position-relative">
																		<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown">
																			<i class="icon-cog icon-only bigger-110"></i>
																		</button>

																		<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																			<li>
																				<a href="#" class="tooltip-info" data-rel="tooltip" title="" data-original-title="View">
																					<span class="blue">
																						<i class="icon-zoom-in bigger-120"></i>
																					</span>
																				</a>
																			</li>

																			<li>
																				<a href="#" class="tooltip-success" data-rel="tooltip" title="" data-original-title="Edit">
																					<span class="green">
																						<i class="icon-edit bigger-120"></i>
																					</span>
																				</a>
																			</li>

																			<li>
																				<a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
																					<span class="red">
																						<i class="icon-trash bigger-120"></i>
																					</span>
																				</a>
																			</li>
																		</ul>
																	</div>
																</div>
															</td>
														</tr>
													<?php }?>
												</tbody>
											</table>
										</div>
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
		function reset(id) {
			var bool = confirm("是否要恢复这条数据");
			if (bool) {
				$('#loading').modal('show');
				$.post('/ajax/administrator-reset.php',{'id':id},function(res){
					if (res.tag > 0) {
						$('#loading').modal('hide');
						$('#alert').html(res.html);
						return false;
					}else{
						$('#alert').html(res.html);
						setTimeout(function(){
							$('#loading').modal('hide');
							$('#login').text('成功');
							window.location.href="/super/administrator-edit.php?id=<?php echo $id;?>";
						},1000);
					}
				},'json');
			}
			return false;
		}
	</script>
</body>
</html>

