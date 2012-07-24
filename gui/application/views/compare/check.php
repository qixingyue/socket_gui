<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>R7—DIP企业数据交互平台</title>
<meta content="R7—DIP,数据交互,平台" name="keywords" />
<?php load_cssjs();?>

<script type="text/javascript">
$(document).ready(function() {
    $("#checkComPRes tr:even").css("backgroundColor","#ebf1f8");
	$("#checkComPRes th:gt(0)").addClass("b_l_fff");
	$("#checkComPRes th:lt(2)").addClass("b_r_blue");
		
});
</script>
</head>
<body id="mainbody">
<?php Widget::render("header");?>
<div id="content">
<div id="navLeft">
<?php Widget::render("leftmenu",array("selmenu"=>"compare"))?>
</div> <!--end navLeft-->
<div id="rightFrame"><div id="wrap">
<?php if(!isset($res->results)) $res->results = array() ; ?>
<div class="pageTitle">查看比对结果</div>
  <table>
    <tr>
      <td width="78" >任务名称：</td>
      <td width="118" class="text_l"><?php echo $res->task_name;?></td>
      <td width="57" >数据库1：</td>
      <td width="154"><?php echo $res->source_db;?></td>
      <td width="66">数据库2：</td>
      <td width="129"><?php echo $res->target_db;?></td>
     </tr>
    <tr>
      <td colspan="2">选择需要查看的比对结果集</td><td colspan="2"><select name="select">
       <?php foreach ($date as $d):?>
        <option><?php echo $d?></option>
        <?php endforeach;?>
      </select></td>
      <td><a href="<?php q_do_nothing()?>" onclick="sendBack()"><?php echo "查看>>";?></a></td>
      <td>&nbsp;</td>
    </tr>
  </table>
    <table cellspacing="0" cellpadding="0" class="border_t ctltable" id="checkComPRes">
     <tr>
	     <th>ONWER</th>
	     <th>TABLE</th>
	     <th>OK Cnt.</th>
	     <th>DISMATCH Cnt.</th>
	     <th>&nbsp;</th>
     </tr>
     <?php $i =  5;  foreach ($res->results as $r) : $i--;?>
     <tr>
       <td><?php echo $r->owner?></td>
       <td><?php echo $r->table?></td>
       <td><?php echo $r->ok_count?></td>
       <td><?php echo $r->dismatch_count?></td>
       <td><img src="<?php echo base_url()?>images/magnifier.jpg"   onclick="check(this)"/></td>
     </tr>
     <?php endforeach;?>
     <?php echo str_repeat(<<<HTML
 <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
HTML
, max(0,$i));?>
</table> 
    
</div>
</div><!--end rightFrame -->  
</div>
<!--end content -->
<?php Widget::render("footer");?>
<script type="text/javascript">
$(function(){
	_n("select").val("<?php echo $seldate?>");
});
function sendBack(){
		var url = "<?php echo site_url("compare/checktask/");?>/";
		url += "<?php echo $res->task_name;?>/";
		url += _n("select").val();
		jumpto(url);
};
function check(obj) {
	var me = $(obj);
	var url = "<?php echo site_url("compare/checkdetail/");?>/"+ 0 + "/" ;
	url += "<?php echo $res->task_name;?>/" + <?php echo $seldate == "" ? '""' : " _n(\"select\").val()" ;?>;
	jumpto(url);
}
</script>
</body>
</html>

