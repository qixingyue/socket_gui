<html>
	<head>
		<?php load_cssjs();?>
	</head>
	<body>
	<?php if($type == "server") {?>
	开始装载SCN:
	<input type="text" name="lowscn" value="" id="lowscn"/>
	<input type="hidden" name="startscn" value="" id="startscn"/>
	<input type="button" value="启动" id="save"/>
<?php } else { ?>
	日志分析起始SCN:
	<input type="text" name="lowscn" value="" id="lowscn"/>
	发送起始SCN:
	<input type="text" name="startscn" value="" id="startscn"/>
	<input type="button" value="启动" id="save"/>
<?php }?>
<script type="text/javascript">
	$(function(){
		$("#save").click(function(){
			var lowscn = $("#lowscn").val();
			var startscn = $("#startscn").val();
			var obj = {};
			obj.startscn = startscn;
		    obj.lowscn = lowscn;
		    window.returnValue = obj;
			window.close();
			return;
		});
	});
</script>
	</body>
</html>

