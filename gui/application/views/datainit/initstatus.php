<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>R7—DIP企业数据交互平台</title>
<meta content="R7—DIP,数据交互,平台" name="keywords" />
<?php load_cssjs();	 extract($status);?>
</head>
<body>
<body id="mainbody">
<?php Widget::render("header");?>
<div id="content">
<div id="navLeft">
<?php Widget::render("leftmenu",array("selmenu"=>"datainit"))?>
</div> <!--end navLeft-->
<div id="rightFrame"> 
<div id="wrap">
 <div class="pageTitle">数据初始化</div>
  <?php echo form_open(site_url("datainit"));?>
  <table  class=" dateInitialTable" >
    <tr>
      <td width="62">源数据库</td>
      <td width="137" ><input type="text" class="text" name="sourcedb" value="<?php echo isset($sourcedb)? objpro($sourcedb, "sourcedb"):"";?>"/></td>
      <td colspan="2"  >用户名
      <input type="text" name="sourceuser"  value="<?php echo isset($sourcedb)?objpro($sourcedb, "sourceuser"):"";?>"/></td>
      <td colspan="2">密码
      <input type="password" name="soucepwd"  value="<?php echo isset($sourcedb)?objpro($sourcedb, "sourcepwd"):"";?>"/></td>
    </tr>
    <tr>
      <td>目标库</td>
      <td><input type="text" class="text" name="targetdb"  value="<?php echo isset($targetdb)? objpro($targetdb, "targetdb"):"";?>"/></td>
      <td colspan="2">用户名
      <input type="text" name="targetuser" value="<?php echo isset($targetdb)?objpro($targetdb, "targetuser"):"";?>" /></td>
      <td colspan="2">密码
      <input type="password" name="targetpwd"  value="<?php echo isset($targetdb)? objpro($targetdb, "targetpwd"):"";?>" /></td>
    </tr>
    <tr>
      <td  >同步范围</td>
    </tr>
    <tr style="color:red;">
    <td class="float_rt">格式：</td>  
      <td colspan="5" >
        源端用户名   例如：cosco <br/>
        源端用户名:目标端用户名  
 例如：cosco:cosco_rep    <br/>
        源端用户名.表名     例如：cosco.t_cc_eorder <br/>     
     源端用户名.表名：目标端用户名.表名  例如 cosco.t_cc_eorder: cosco_rep.t_cc_eorder</td>
    </tr>
    <tr><td colspan="6"><textarea rows="7" style="width:100%" name="tbfw"><?php echo isset($fw)? $fw : "";?></textarea></td></tr>
    <tr>
      <td colspan="5">并发任务数
        <input  type="text"class="text" name="bftask"  value="<?php 	echo isset($bftask)? $bftask : "";?>"/>        
        <span  class="margin_30">单任务内并发度
            <input type="text" name="singletask" value="<?php echo isset($singletask)? $singletask : "";?>"/></span>
      </td>
      <td width="105"></td>
    </tr>
    <tr>
      <td class="float_rt"><?php echo form_checkbox('truncate_table','YES', isset($ttable) && $ttable == "YES","id='truncate_table'")?></td>
      <td >  <label for="truncate_table">Truncate Table</label></td>
      <td width="58">&nbsp;</td>
      <td width="119" class=" text_l"><?php echo form_checkbox('create_index','YES', isset($create_index) && $create_index == "YES","id = 'create_index'")?>
      <label for="create_index">Create  index</label></td>
      <td width="141">&nbsp;</td>
      <td></td>
    </tr>
    <tr>
      <td colspan="4">Flash Back SCN
      <input name="fbs" type="text" class="text" value="<?php echo isset($backscn)? $backscn : "";?>"/></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="44" colspan="2"><input name="begin" value="开始同步" type="submit" value="" class="buttonSpan"/></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td class="text_blue">进度</td>
      <td colspan="4" >
      <div id="progressBar" class="float_lt"><div id="progressBarMain"></div></div>
      <div class="margin_5 text_blue float_lt" id="progressText"></div><!--注意：进度的条（id=progressBarMain）的全长是300px，因此实际长度为百分比*3，如现在是70*3=210px-->
      </td>
      <td></td>
    </tr>
    <tr>
      <td class="text_blue">详细信息</td>
      <td colspan="5"><textarea name="textarea" rows="7"  class="float_lt width100" disabled="disabled" ><?php if(isset($detail_info)) echo $detail_info;?></textarea></td>
    </tr>
  </table>
  <?php echo form_close();?>
</div>
</div><!--end rightFrame -->  
</div>
<!--end content -->
<?php Widget::render("footer");?>
<script type="text/javascript">
$(function(){
	$("input[type=text]").width(100);
	$("input[type=password]").width(100);
	<?php if(isset($percent)):?>
		setPercent(<?php echo $percent?>);
	<?php else :?>
		setPercent(0);
	<?php endif;?>

	<?php js_refresh_seconds(<<<JS
function(){
	loader.load("data_init_percent",{},function(res,data){
		if(res == false){
			alert(data);
		}else{
			setPercent(data.percent);
			_n("textarea").val(data.detail_info);
		}
	});
}
JS
)?>
	
});

function setPercent(i){
	$("#progressBarMain").width(3*i);
	$("#progressText").html(i+"%");
}


</script>
<?php alert_error_message();?>
<?php //refresh_seconds(3, current_url());?>
</body>
</html>