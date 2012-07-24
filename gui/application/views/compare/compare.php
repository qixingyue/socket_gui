<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>R7—DIP企业数据交互平台</title>
<meta content="R7—DIP,数据交互,平台" name="keywords" />
<?php load_cssjs();?>
<script type="text/javascript">
$(document).ready(function() {
    $(".compare tr:even").css("backgroundColor","#ebf1f8");
	$(".compare th:gt(0)").addClass("b_l_fff");
	$(".compare th:lt(2)").addClass("b_r_blue");
});
</script>
</head>

<body id="mainbody">
<?php Widget::render("header");?>
<div id="content">
<div id="navLeft">
<?php Widget::render("leftmenu",array("selmenu"=>"compare"))?>
</div> <!--end navLeft-->
<div id="rightFrame">    <div id="wrap"><div class="pageTitle">数据比对任务设置</div>
    <table class="border compare tb" cellspacing="0">
     <tr>
        <th>&nbsp;</th>
        <th>任务名称</th>
        <th>DB-1</th>
        <th>DB-2</th>
        <th>状态</th>
     </tr>
     	<?php  $i = 5;foreach ($tasks as $task):$i--;?>
		<tr>
		<td class="text_cent"><?php echo form_radio("seltask",$task->name)?></td>
		<td>
			<?php echo $task->name?>
			</td>
			<td><?php echo $task->db1?></td>
			<td><?php echo $task->db2?></td>
			<td><?php echo $task->status?></td>
			</tr>
		<?php endforeach;?>
        <?php echo str_repeat(<<<HTML
       <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td></td>
     </tr> 
HTML
,max(array(0,$i)));?>
            </table>
            <table style="padding:0px;" cellpadding="0" cellspacing="0" id="smallmenu">
            <tr>
            	<td colspan="4"><a href="<?php echo site_url("compare/checktask")?>"><img src="<?php echo base_url()?>images/compareList.jpg" />查看比对结果</a></td>
           	</tr>
            <tr>
                <td colspan="4"><a href="<?php echo site_url("compare/ljbd")?>"><img src="<?php echo base_url()?>images/compareList.jpg" />立即比对</a></td>
            </tr>
            <tr>
                 <td colspan="4"><a href="<?php echo site_url("compare/setting")?>"><img src="<?php echo base_url()?>images/compareList.jpg" />设置比对任务</a></td>
            </tr>
            <tr> 
                <td colspan="4"><a href="<?php echo site_url("compare/create")?>"><img src="<?php echo base_url()?>images/compareList.jpg" />创建新的比对任务</a></td>
            </tr>
                <tr><td colspan="4"><a href="<?php echo site_url("compare/delete")?>"><img src="<?php echo base_url()?>images/compareList.jpg" />删除比对任务</a></td>
            </tr>
        </table>


    </div>
</div><!--end rightFrame -->  
</div>
<!--end content -->
<?php Widget::render("footer");?>
<script type="text/javascript">
$(function(){
	
	$("#smallmenu").find("a").click(function(){
		var s = $("input[name='seltask']:checked").val();
		var x = $(this).attr("href");

		if(x == "<?php echo site_url("compare/create")?>"){
			jumpto(x);
			return false;	
		}
		if(s == undefined){
			alert("请选择任务！");
		} else {
			jumpto(x+"/" +s);
		}

		return false;
	});
	
});
</script>
	<?php alert_error_message();?>
</body>
</html>