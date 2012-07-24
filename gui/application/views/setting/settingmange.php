<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>R7—DIP企业数据交互平台</title>
<meta content="R7—DIP,数据交互,平台" name="keywords" />
<?php load_cssjs();?>
</head>
<body id="mainbody">
<?php Widget::render("header")?>
<div id="content">
<div id="navLeft">
<?php Widget::render("leftmenu",array("selmenu"=>"setting"))?>
</div> <!--end navLeft-->
<div id="rightFrame"><div id="wrap">
<div class="pageTitle">配置管理</div>
  <div id="configMag">
    <div id="magHeader" class="font_deepblue"></div>
    <table cellspacing="0" cellpadding="0" class="tb table_t_none">
        <tr>
        <th class="b_r_blue">任务组</th>
        <th class="b_l_fff b_r_blue ">描述</th>
        <th class="b_l_fff">操作</th>
        </tr>
        <?php $groups = $groups->group; $i = 5; ?>
       <?php foreach ($groups as $g) : $i--;?>
      <tr>
        <td ><img src="<?php echo base_url()?>images/listPic.png" class="margin_5"><?php echo $g->name?></td>
        <td ><?php echo $g->description;?></td>
        <td ><?php echo anchor("setting/delgroup/".$g->name,"删除>>")?>      <?php echo anchor("setting/editgroup/{$g->name}","修改>>")?></td>
      </tr>
      <?php endforeach;?>
	 <?php echo str_repeat(<<<HTML
	<tr><td> &nbsp;</td><td ></td><td ></td></tr>
HTML
, max(array($i,0)))?>
    </table>
    <div id="addGroup"><a class="float_rt clear_rt" href="<?php echo site_url("setting/addgroup")?>"><?php echo "添加任务组>>"?></a></div>

  </div> 
</div>
<!--end wrap-->
</div><!--end rightFrame -->  
</div>
<!--end content -->
<?php Widget::render("footer");?>
<script type="text/javascript">
//左边导航效果
$(function(e) {
	
    $("#navLeft li").click(function(e) {
		$("#navLeft li").removeClass("navLiCurrent");
        $(this).addClass("navLiCurrent");
    });
	$("#navLeft").height($("#rightFrame").height());
	
    $("tr:even").css("backgroundColor","#ebf1f8");
});
</script>
<?php
	alert_error_message();alert_error_message('del_error');
?>
</body>
</html>
