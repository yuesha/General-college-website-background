<?php
	$menu_manage = "active";
	$up_id = (int)@$_GET['up_id'];
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
						<li class="active">菜单管理</li>
					</ul><!-- .breadcrumb -->

				</div>

				<div class="page-content">
					<div class="page-header">
						<h1>
							菜单管理
							<small>
								<i class="icon-double-angle-right"></i>
								菜单列表
							</small>
						</h1>
					</div><!-- /.page-header -->
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<div class="tabbable">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active">
										<a href="javascript:;">
											<i class="green icon-home bigger-110"></i>
											菜单列表
										</a>
									</li>

									<li class="">
										<a href="menu_manage-add.php">
											菜单添加
										</a>
									</li>

									<li class="hidden" id="edit_manage">
										<a href="menu_manage-edit.php" id="edit_title">
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
									<div id="lists" class="tab-pane in active">
										<div id="alert"></div>
										<?php
											// 查询父级菜单的记录
											$up_row = array();
											if ($up_id) {
												$up_row = $mysql -> find('menus',"id={$up_id}");
										?>
										<button class="btn btn-xs btn-info pull-right" onclick="jump(<?php echo $up_row['up_id'];?>)" style="margin-bottom: 10px;">
											返回上级菜单
										</button>
										<?php }?>
										<div class="table-responsive">
											<table id="sample-table-1" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>序号</th>
														<th>显示序号</th>
														<th>菜单名称</th>
														<th class="hidden-480">隶属菜单</th>
														<th class="hidden-480">菜单类型</th>
														<th>
															<i class="icon-time bigger-110 hidden-480"></i>
															最后修改时间
														</th>
														<th class="hidden-480">显示状态</th>
														<th class="hidden-480">添加人</th>
														<th> <span>操作</span> </th>
													</tr>
												</thead>

												<tbody>
													<?php
													$rows = $mysql -> findAll("menus","del_tag=0 && up_id={$up_id} ORDER BY show_order asc");
													foreach ($rows as $k => $v) {
													?>
													<tr>
														<td class="center">
															<?php echo $k+1;?>
														</td>
														<td><?php echo $v['show_order'];?></td>
														<td><?php echo $v['name'];?></td>
														<td class="hidden-480"><?php echo $up_row['name'];?></td>
														<td><?php echo $v['link_addr']==''?'关联信息分类':'链接地址';?></td>
														<td><?php echo $v['updated_at'];?></td>
														<td>
															<span class="label label-sm label-info">
																<?php echo $v['show_tag']==1?'隐藏':'显示';?>
															</span>
														</td>

														<td class="hidden-480">
															<span class="label label-sm label-warning"><?php echo $v['add_user'];?></span>
														</td>

														<td>
															<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
																<button class="btn btn-xs btn-info" onclick="edit(<?php echo $v['id'];?>)">
																	编辑
																	<i class="icon-edit bigger-120"></i>
																</button>
																<button class="btn btn-xs btn-danger" onclick="del(<?php echo $v['id'];?>)">
																	删除
																	<i class="icon-trash bigger-120"></i>
																</button>
																<button class="btn btn-xs btn-info" onclick="jump(<?php echo $v['id'];?>)">
																	下级菜单
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
		// 编辑菜单信息
		function edit(id) {
			window.location.href="menu_manage-edit.php?id=" + id;
		}

		// 查看下级菜单
		function jump(id) {
			window.location.href="menu_manage.php?up_id=" + id;
		}

		function del(id) {
			var bool = confirm("是否要删除这条数据");
			if (bool) {
				$('#loading').modal('show');
				$.post('/ajax/menu_manage-del.php',{'id':id},function(res){
					if (res.tag > 0) {
						$('#loading').modal('hide');
						$('#alert').html(res.html);
						return false;
					}else{
						$('#alert').html(res.html);
						setTimeout(function(){
							$('#loading').modal('hide');
							$('#login').text('成功');
							window.location.href="/super/menu_manage.php?up_id=<?php echo $up_id;?>";
						},1000);
					}
				},'json');
			}
			return false;
		}
	</script>
	</body>
	</html>

