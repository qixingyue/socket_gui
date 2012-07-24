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
<?php Widget::render("leftmenu",array("selmenu"=>"compare"))?>
</div> <!--end navLeft-->
<div id="rightFrame">
<div id="wrap">
  <div class="pageTitle">数据比对详细</div>
  <?php echo form_open();?>
    <table class="border" >
      <tr>
        <td width="124" >比对任务</td>
        <td width="233" align="left"><?php echo $taskName;?></td>
        <td width="76" align="left"></td>
        <td width="177" ></td>
      </tr>      <tr>
        <td >数据库1</td>
        <td align="left"><input type="text" name="tns1" value="<?php echo $res->source_db?>" /></td>
        <td >数据库2</td>
        <td align="left"><input type="text" name="tns2" value="<?php echo $res->target_db;?>" /></td>
      </tr>
    </table>
  <?php echo form_close();?>
  <?php echo form_open();?>
    <table id="dateRepairTable" cellspacing="0">
      <tr>
        <th>字段名</th>
        <th>源端值</th>
        <th>目标端值</th>
       </tr>
      <?php $i = 5;foreach ($res->results->column as $c): $i--;?>
      <tr>
        <td><?php echo $c->name;?></td>
        <td><?php echo $c->source_data;?></td>
        <td><?php echo $c->target_data;?></td>
       </tr>
      <?php endforeach;?>
     <?php echo str_repeat(<<<HTML
      <tr >
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr> 
HTML
,max($i,0));?>
    </table>
    <div id="updown"  class="text_r mt15"> 
   		 <span class="margin_5"><a href="<?php q_do_nothing()?>" opt="up">上一条</a></span><span class="margin_5"><a href="<?php q_do_nothing()?>" opt="down">下一条</a></span>
    </div>
    <div class="tb_b text_cent mt15 pb10 mb10" id="fixonedata">
   	 <span><a href="<?php q_do_nothing()?>"  class="margin_30" refer="source"><?php echo "以源端为准修复>>"?></a></span><span><a href="<?php q_do_nothing()?>" refer="target"><?php echo "以目标端为准修复>>"?></a></span>
    </div>
 <?php echo form_close();?>
</div>
</div><!--end rightFrame -->  
</div>
<!--end content -->
<?php Widget::render("footer");?>
<script type="text/javascript">

var sendData = <?php echo json_encode($json);?>; 

var record_no = 0 ;

$(function(){
	
   $("input[type=text]").width(100);
   $("input[type=password]").width(100);
   $("input[name=searchCondition]").width(430);
   $("#dateRepairTable tr:even").css("backgroundColor","#ebf1f8");
   $("#dateRepairTable th:gt(0)").addClass("b_l_fff");
   $("#dateRepairTable th:lt(3)").addClass("b_r_blue");
   $("#dateRepairTable").addClass("tb").compare();   
   
  $("#fixonedata a").click(function(){
	  var refer = $(this).attr("refer");
	  sendData.refer = refer;
	  sendData.record_no = record_no;
	  loader.load("compare_fix_one_data",sendData,function(res,data){
		   var message  = res ? "修复完成！" : data;
		   alert(message);
	  });
  });

  $("#updown a").click(function(){

	  
		var m = $(this).attr("opt");
		if( m == "up" ) {
			record_no--;
			if(record_no<0) { alert("这是第一条！没有上一条！"); record_no++; return;} 
		} else {
			record_no++;
		}
		sendData.record_no = record_no;
		loader.load("compare_change",sendData,function(res,data){
			
			if( res == false) {
				record_no--;
				alert("已经没有更多的数据了！");
			}else{
				show(data);
				 $("#dateRepairTable").addClass("tb").compare();   
			}
		});
});
  
});

function show(s){
	$("#dateRepairTable tr:gt(0)").remove();
	var j = 5;
	$(s).each(function(i,obj){
		var row = '<tr ><td>'+obj.name+'</td><td>'+obj.source_data+'</td><td>'+obj.target_data+'</td></tr>'; 
		$("#dateRepairTable").append(row);
		j--;
	});
	$("#dateRepairTable").append(str_repeat('<tr ><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>',j));
	$("#dateRepairTable tr:gt(0):odd").css('background-color','rgb(235, 241, 248)');
}



</script>
<?php alert_error_message();?>
</body>
</html>
