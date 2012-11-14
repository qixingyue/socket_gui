<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>R7—DIP企业数据交互平台</title>
<meta content="R7—DIP,数据交互,平台" name="keywords" />
<?php load_cssjs();?>
</head>
<body id="mainbody">
<?php Widget::render("header");?>
<div id="content">
<div id="navLeft">
<?php Widget::render("leftmenu",array("selmenu"=>"bakeup"));?>
</div> <!--end navLeft-->
<div id="rightFrame">  
<div id="wrap">
<div class="pageTitle">回滚信息管理</div>
  
  <?php echo form_open();?>
    <table class="border">
      <tr>
        <td >备份数据库</td>
        <td colspan="2" align="left"><input name="bakeupdb" type="text" value="<?php echo objpro($vars, "bakeupdb");?>" /></td>
      </tr>
      <tr>
        <td >用户名</td>
        <td><input name="username" type="text" value="<?php echo objpro($vars, "username");?>"/></td>
        <td class="spacePre">密     码</td>
        <td><input name="password" type="password" value="<?php echo objpro($vars, "password");?>"/></td>
      </tr>
      <tr>
        <td >检索条件</td>
      </tr>
      <tr>
        <td >开始时间</td>
        <td><input name="starttime" type="text" value="<?php echo objpro($vars, "starttime");?>"/></td>
        <td>结束时间</td>
        <td><input name="endtime" type="text" value="<?php echo objpro($vars, "endtime");?>"/></td>
      </tr>
      <tr>
        <td >用户名</td>
        <td><input name="dbuser" type="text" value="<?php echo objpro($vars, "dbuser");?>" /></td>
        <td  class="spacePre">表      名</td>
        <td><input name="dbtable" type="text" value="<?php echo objpro($vars, "dbtable");?>"/></td>
      </tr>
      <tr>
        <td >操作类型</td>
        <td><input name="optype" type="text" value="<?php echo objpro($vars, "optype");?>"/></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><input name="check" type="submit"  value="检索" class="buttonSpan"/></td>
      </tr>
    </table>
 <?php echo form_close();?>
  <table cellpadding="0" cellspacing="0" class="ctltable mt20">
    <tr>
      <th width="71">Table</th>
      <th width="75">Owner</th>
      <th width="74">SCN</th>
      <th width="68">OP</th>
      <th width="139">Timestamp</th>
      <th width="152">Backup Table</th>
      <th width="49" >详细</th>
     </tr>
    <?php $i = 4; 
    	foreach ($data as $d) : $i--;
    ?>
    <tr  class="b_t_blue4">
      <td><?php echo $d->table;?></td>
      <td><?php echo $d->owner;?></td>
      <td><?php echo $d->scn;?></td>
      <td><?php echo $d->operation;?></td>
      <td><?php echo $d->timestamp;?></td>
      <td><?php echo $d->backup_table?></td>
      <td><a href="<?php q_do_nothing()?>"><img onclick="check_detail(<?php echo $d->row_id?>)" src="<?php echo base_url()?>images/magnifier.jpg" /></a></td>
    </tr>
    <?php endforeach;?>
    <?php echo str_repeat(<<<HTML
  <tr  class="b_t_blue4">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td></td>
      <td>&nbsp;</td>
    </tr>   
HTML
    , max(array(0,$i)))?>
  </table>
  <div class=" pagination"><?php echo $pages;?></div>
  
</div>
</div><!--end rightFrame -->  
</div>
<!--end content -->
<?php Widget::render("footer")?>
<script type="text/javascript">
$(document).ready(function() {
    $(".ctltable tr:even").css("backgroundColor","#ebf1f8");
	$(".ctltable th:gt(0)").addClass("b_l_fff");
	$(".ctltable th:lt(6)").addClass("b_r_blue");
});

function check_detail(rowid){
	loader.load("check_bakeup_sql",{rowid:rowid},function(res,data){
		alert(data);
	});
}

</script>
<?php alert_error_message();?>
</body>
</html>
