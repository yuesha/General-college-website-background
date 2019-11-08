<?php
	$aqsz = "active open";
	$manage_log = "active";
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

					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="./">首页</a>
						</li>
						<li>
							<a href="#">安全设置</a>
						</li>
						<li class="active">日志管理</li>
					</ul><!-- .breadcrumb -->

				</div>

				<div class="page-content">
					<div class="page-header">
						<h1>
							系统初始
							<small>
								<i class="icon-double-angle-right"></i>
								网站设置
							</small>
						</h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<div class="tabbable">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active">
										<a data-toggle="tab" href="#lists">
											<i class="green icon-home bigger-110"></i>
											日志列表(仅显示前50条记录)
										</a>
									</li>
								</ul>

								<div class="tab-content">
									<div id="lists" class="tab-pane in active">
										<div class="table-responsive">
											<table id="sample-table-1" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">序号</th>
														<th>用户名</th>
														<th>动作</th>
														<th>执行的SQL语句</th>
														<th>操作ip</th>
														<th> 操作时间 </th>
														<th>备注</th>
													</tr>
												</thead>

												<tbody>
													<?php
														$rows = $mysql -> findAll("manage_log","1=1 order by created_at desc limit 50");
														foreach ($rows as $k => $v) {
													?>
													<tr>
														<td class="center"><?php echo $k+1?></td>
														<td><?php echo $v['user'];?></td>
														<td><?php echo $v['action'];?></td>
														<td><?php echo $v['sql_cont']==''?'无':$v['sql_cont'];?></td>
														<td><?php echo $v['ip'];?></td>
														<td><?php echo $v['created_at'];?></td>
														<td><?php echo $v['remark'];?></td>
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
		jQuery(function($) {

				//jquery tabs
				$( "#tabs" ).tabs();
			});
		</script>
	</body>
	</html>

