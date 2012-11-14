<html>
<head>
<?php 
load_cssjs();?>
</head>
<body>
	<div class="left">
	<?php Widget::render('leftmenu',array('selmenu'=>'status'));?>
	</div>
	<div class="main">
		<?php echo form_label("$name:状态信息")?>
		
		
	</div>
	<?php alert_error_message(); ?>

</body>
</html>

