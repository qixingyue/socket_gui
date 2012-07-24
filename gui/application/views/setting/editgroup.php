<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo "配置管理的修改";?></title>
<meta content="R7—DIP,数据交互,平台" name="keywords" />
<?php load_cssjs();?>
</head>
<body id="mainbody">
<?php Widget::render("header");?>
<div id="content">
<div id="navLeft">
<?php Widget::render("leftmenu",array("selmenu"=>"setting"))?>
</div> <!--end navLeft-->
<div id="rightFrame">
<div id="wrap">
  <div id="contup">
  	<?php echo form_open();?>
    <table  id="copyGroupTable">
      <tr>
        <td height="30" align="right">任务组名称</td>
        <td ><input type="text" name="group" value="<?php echo objpro($current_group, "group");?>" /></td>
        <td align="right" height="30">任务组描述</td>
        <td><input type="text" name="description" value="<?php echo objpro($current_group, "description");?>" /></td>
        <td><input type="submit"  class="buttonSpan" value="修改组"/></td>
      </tr>
    </table>
    <?php echo form_close();?>
  </div><!--end up-->
  <div class="alterList" align="center">
    <table cellspacing="0"  class="alterListTable tb">
    <tr>
        <th>类别</th>
        <th>名称</th>
        <th>操作</th>
    </tr>
    <?php if(!isset($current_group->component))	 $current_group->component = array();$i=5;?>
				<?php foreach ($current_group->component as $v):$i--;?>
				<tr>
					<td><?php echo $v->type;?></td>
					<td><?php echo $v->name;?></td>
					<td><span class="margin5"><?php echo anchor("setting/delserver/" .  objpro($current_group, 'group') . "/" . $v->type . "/".  $v->name,"删除>>");?></span><?php echo anchor("setting/editserver/" .  objpro($current_group, 'group') . "/" . $v->type . "/".  $v->name,"编辑>>");?></td>
				</tr>
				<?php endforeach;?>
    <?php echo str_repeat(<<<HTML
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
HTML
, max($i,0))?>
    </table>
  </div>
  <!--end list --> 
<div id="contdown">
  <table class=" text_l" id="otherServersTable">
    <tr>
      <td><a href="<?php echo site_url("setting/addcapture/" . objpro($current_group, 'group'))?>"><img src="<?php echo base_url()?>images/ItemPic.png" />数据捕获服务>></a></td>
    </tr>
    <tr>
      <td><a href="<?php echo site_url("setting/addloader/" . objpro($current_group, 'group')) ?>"><img src="<?php echo base_url()?>images/ItemPic.png" />数据装载服务>></a></td>
    </tr>
    <tr>
      <td><a href="<?php echo site_url("setting/addbakeup/". objpro($current_group, 'group')) ?>"><img src="<?php echo base_url()?>images/ItemPic.png" />数据装载和事务级数据恢复服务>></a></td>
    </tr>
    <tr>
      <td ><img src="<?php echo base_url()?>images/backArow.png" /><a href="<?php echo site_url("setting")?>">返回>></a></td>
    </tr>
  </table>
</div>
<!--end contdown -->

</div><!--end wrap -->
</div><!--end rightFrame -->  
</div>
<!--end content -->
<?php Widget::render("footer");?>
<?php alert_error_message();?>
<script type="text/javascript">
$(function() {
    $(".alterListTable tr:even").css("backgroundColor","#ebf1f8");
	$("input[type=text]").width(150);
    $("input[type=password]").width(150);
	$("table th:gt(0)").addClass("b_l_fff");
	$("table th:lt(2)").addClass("b_r_blue");			

	
});
</script>
</body>
</html>

