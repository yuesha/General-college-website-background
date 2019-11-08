
<!-- basic scripts -->

<!--[if !IE]> -->

<!-- <script src="../assets/js/jquery.min.js"></script> -->

<!-- <![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

<!--[if !IE]> -->

<!-- 		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery-2.0.3.min.js'>"+"<"+"script>");
			</script> -->

			<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery-1.10.2.min.js'>"+"<"+"script>");
</script>
<![endif]-->
<script src="../assets/js/ace-extra.min.js"></script>

<script type="text/javascript">
	if("ontouchend" in document) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"script>");
</script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/typeahead-bs2.min.js"></script>

<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="../assets/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/jquery.slimscroll.min.js"></script>
		<script src="../assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="../assets/js/jquery.sparkline.min.js"></script>

		<!-- ace scripts -->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->


		<!-- JQuery js文件 -->
		<script src="../assets/js/jquery-ui-1.10.3.full.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script type="text/javascript">
			// 退出登录
			function loginout() {
				$.get('../ajax/loginout.php',function(res){
					if (res.tag > 0) {
						// layer.msg(res.msg,{'icon':2});
						alert(res.msg);
						return false;
					}else{
						setTimeout(function(){
							window.location.href="../login_super.php";
						},1000);
					}
				},'json');
			}
		</script>
		<!-- loading -->
		<div class="modal fade" id="loading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static'>
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">提示</h4>
					</div>
					<div class="modal-body">
						请稍候，正在处理<span id="result"></span>
					</div>
				</div>
			</div>
		</div>