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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<!-- head 内容 -->
	<?php include "../inc/manage/head.php";?>
	<title><?php echo @$_SESSION['setting']['name'];?>-网站后台</title>
</head>

<body>
	<!-- 顶部内容 -->
	<?php include "../inc/manage/header.php";?>

	<div class="main-container" id="main-container">
		<script type="text/javascript">
			try{ace.settings.check('main-container' , 'fixed')}catch(e){}
		</script>

		<div class="main-container-inner">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<!-- 左侧菜单栏 -->
			<?php include "../inc/manage/navbar.php";?>

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<script type="text/javascript">
						try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
					</script>
					<?php
					$type_row = $mysql -> find("cont_type","id={$id}");
					$cont_row = $mysql -> find("conts","type_id = {$id}");
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

									<li class="active">
										<a href="javascript:;">
											内容列表
										</a>
									</li>

									<li class="hidden">
										<a href="list-edit.php?id=<?php echo $id;?>&up_id=<?php echo $up_id;?>">
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
										<div class="table-responsive">
											<table id="sample-table-1" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>序号</th>
														<th>标题</th>
														<?php
														if ($type_row['type']==2) {
														?>
														<th class="hidden-480">图片</th>
														<?php }?>
														<th class="hidden-480">显示状态</th>
														<th class="hidden-480">创建时间</th>
														<th class="hidden-480">添加人</th>
														<th>操作</th>
													</tr>
												</thead>

												<tbody>
													<?php
													$rows = $mysql -> findAll("conts","type_id = {$id} ORDER BY show_order asc");
													foreach ($rows as $k => $v) {
														?>
														<tr>
															<td class="center">
																<?php echo $k+1;?>
															</td>
															<td><?php echo $v['name'];?></td>
															<?php
															if ($type_row['type']==2) {
																$pic = $mysql -> find("pics","content_id={$v['id']} && show_tag=0 && del_tag=0 && type <> 1");
																?>
																<td class="hidden-480"><img src="<?php echo $pic['src'];?>" style="width: 100px;"></td>
															<?php }?>
															<td>
																<span class="label label-sm label-info">
																	<?php echo $v['show_tag']==1?'隐藏':'显示';?>
																</span>
															</td>
															<td class="hidden-480"><?php echo $v['created_at'];?></td>
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
	<?php include "../inc/manage/foot.php";?>
	<script type="text/javascript">
		function edit(id) {
			window.location.href="list-edit.php?id=<?php echo $id;?>&up_id=<?php echo $up_id;?>&cont_id=" + id;
		}

		function del(id) {
			var bool = confirm("是否要删除这条数据\n注意，删除后无法恢复!!");
			if (bool) {
				$('#loading').modal('show');
				$.post('/ajax/m_list-del.php',{'id':id},function(res){
					if (res.tag > 0) {
						$('#loading').modal('hide');
						$('#alert').html(res.html);
						return false;
					}else{
						$('#alert').html(res.html);
						setTimeout(function(){
							$('#loading').modal('hide');
							$('#login').text('成功');
							window.location.href="/manage/list.php?id=<?php echo $id;?>&up_id=<?php echo $up_id;?>";
						},1000);
					}
				},'json');
			}
			return false;
		}
	</script>
</body>
</html>

