<div class="sidebar" id="sidebar">
	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
	</script>

	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<button class="btn btn-success">
				<!-- <i class="icon-signal"></i> -->
				学
			</button>

			<button class="btn btn-info">
				<!-- <i class="icon-pencil"></i> -->
				院
			</button>

			<button class="btn btn-warning">
				<!-- <i class="icon-group"></i> -->
				网
			</button>

			<button class="btn btn-danger">
				<!-- <i class="icon-cogs"></i> -->
				站
			</button>
		</div>

		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span>

			<span class="btn btn-info"></span>

			<span class="btn btn-warning"></span>

			<span class="btn btn-danger"></span>
		</div>
	</div><!-- #sidebar-shortcuts -->

	<ul class="nav nav-list">
		<li class="<?php echo $hysy;?>">
			<a href="./">
				<i class="icon-leaf"></i>
				<span class="menu-text"> 欢迎使用 </span>
			</a>
		</li>

		<li class="<?php echo $xtcs;?>">
			<a href="#" class="dropdown-toggle">
				<i class="icon-dashboard"></i>
				<span class="menu-text"> 系统初始 </span>

				<b class="arrow icon-angle-down"></b>
			</a>

			<ul class="submenu">
				<li class="<?php echo $wzsz;?>">
					<a href="websetting.php">
						<i class="icon-double-angle-right"></i>
						<span class="menu-text">网站设置</span>
					</a>
				</li>
				<li class="<?php echo $administrator;?>">
					<a href="administrator.php">
						<i class="icon-double-angle-right"></i>
						<span class="menu-text">管理员管理</span>
					</a>
				</li>
				<li class="<?php echo $qxgl;?>">
					<a href="qxgl.php">
						<i class="icon-double-angle-right"></i>
						<span class="menu-text">权限管理</span>
					</a>
				</li>
			</ul>
		</li>

		<li class="<?php echo $menu_manage;?>">
			<a href="menu_manage.php">
				<i class="icon-edit"></i>
				<span class="menu-text"> 菜单管理 </span>
			</a>
		</li>

		<li class="<?php echo $type_manage;?>">
			<a href="type_manage.php">
				<i class="icon-edit"></i>
				<span class="menu-text"> 内容分类管理 </span>
			</a>
		</li>

		<li class="<?php echo $nrgl;?>">
			<a href="#" class="dropdown-toggle">
				<i class="icon-edit"></i>
				<span class="menu-text"> 内容管理 </span>

				<b class="arrow icon-angle-down"></b>
			</a>

			<ul class="submenu">
				<?php
				$rows = $mysql -> findAll("cont_type","del_tag=0 && show_tag=0 && up_id=0 ORDER BY show_order");
				foreach ($rows as $row){
					// 循环输出所有一级菜单，如果存在二级，那么输出下拉框
					if (in_array($row['type'], [3,4])) {
						$str = "content".$row['id'];
						?>
						<li class="<?php echo $$str;?>">
							<a href="content.php?id=<?php echo $row['id'];?>">
								<i class="icon-double-angle-right"></i>
								<?php echo $row['name'];?>
							</a>
						</li>

						<?php
					}else if(in_array($row['type'],[1,2])){
						$str = "content".$row['id'];
						?>
						<li class="<?php echo $$str;?>">
							<a href="list.php?id=<?php echo $row['id'];?>">
								<i class="icon-double-angle-right"></i>
								<?php echo $row['name'];?>
							</a>
						</li>

						<?php
					}else{
						// 二级菜单输出
						$str1 = "content1".$row['id'];
						?>
						<li class="<?php echo $$str1;?>">
							<a href="javascript:;" class="dropdown-toggle">
								<i class="icon-double-angle-right"></i>
								<?php echo $row['name'];?>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<?php
								$rows_two = $mysql -> findAll("cont_type","up_id = {$row['id']}");
								foreach ($rows_two as $row_two){
									$str = "content".$row_two['id'];
									?>
									<li class="<?php echo $$str;?>">
										<a href="<?php echo $row_two['type']==4||$row_two['type']==3?'content.php?id='.$row_two['id'].'&up_id='.$row_two['up_id']:'list.php?id='.$row_two['id'].'&up_id='.$row_two['up_id'];?>" style="text-decoration: none;">
											<?php echo $row_two['name'];?>
										</a>
									</li>
									<?php
								}
								?>
							</ul>
						</li>
						<?php
					}
				}
				?>
			</ul>
		</li>

		<li class="<?php echo $pic_manage;?>">
			<a href="javascript:;" class="dropdown-toggle">
				<i class="icon-camera"></i>
				<span class="menu-text"> 图片管理 </span>
				<b class="arrow icon-angle-down"></b>
			</a>
			<ul class="submenu">
				<li class="<?php echo $banner;?>">
					<a href="banner.php">
						横幅图片管理
					</a>
				</li>
				<li class="<?php echo $slideshow;?>">
					<a href="slideshow.php">
						轮播图管理
					</a>
				</li>
			</ul>
		</li>

		<li class="<?php echo $link_manage;?>">
			<a href="link_manage.php">
				<i class="icon-link"></i>
				<span class="menu-text"> 链接管理 </span>
			</a>
		</li>

		<li class="<?php echo $aqsz;?>">
			<a href="#" class="dropdown-toggle">
				<i class="icon-briefcase"></i>
				<span class="menu-text"> 安全设置 </span>

				<b class="arrow icon-angle-down"></b>
			</a>

			<ul class="submenu">
				<li class="<?php echo $pw_manage;?>">
					<a href="pw_manage.php">
						<i class="icon-double-angle-right"></i>
						密码管理
					</a>
				</li>
				<li class="<?php echo $super_log;?>">
					<a href="super_log.php">
						<i class="icon-double-angle-right"></i>
						日志管理
					</a>
				</li>
				<li>
					<a href="javascript:;" onclick="loginout()">
						<i class="icon-double-angle-right"></i>
						安全退出
					</a>
				</li>
			</ul>
		</li>
	</ul><!-- /.nav-list -->

	<div class="sidebar-collapse" id="sidebar-collapse">
		<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
	</div>

	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
	</script>
</div>