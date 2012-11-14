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
<?php Widget::render("leftmenu",array("selmenu"=>"repair"))?>
</div> <!--end navLeft-->
<div id="rightFrame">
<div id="wrap">
  <div class="pageTitle">数据修复</div>
  <?php echo form_open();?>
    <table class="border" >
      <tr>
        <td width="124" ></td>
        <td width="233" align="left"></td>
        <td width="76" align="left"></td>
        <td width="177" ></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td >数据库1</td>
        <td align="left"><input type="text" name="tns1" /></td>
        <td >数据库2</td>
        <td align="left"><input type="text" name="tns2" /></td>
      </tr>
      <tr>
        <td >用户名</td>
        <td align="left"><input type="text" name="user1" /></td>
        <td >用户名</td>
        <td align="left"><input type="text" name="user2"/></td>
      </tr>
      <tr>
        <td >密码</td>
        <td align="left"><input type="password" name="password1" /></td>
        <td >密码</td>
        <td align="left"><input type="password" name="password2"/></td>
      </tr>
      <tr>
        <td >源端用户名.表名</td>
        <td align="left"><input type="text" name="table1"/></td>
      </tr>
      <tr>
        <td >目标端用户名.表名</td>
        <td align="left"><input type="text" name="table2"/></td>
      </tr>
      <tr>
        <td >检索条件</td>
        <td colspan="3"><input type="text" name="searchCondition"/><a href="<?php q_do_nothing()?>" onclick="submitForm()" class="margin_5"><?php echo "检索>>";?></a></td>
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
       <?php $i = 5; foreach ($current->results->column as $c): $i--;?>
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
 <?php echo form_open();?>
    <table class="border">
      <tr>
        <td  width="92">手工修复命令</td>
        <td width="526"><textarea   class="width100" rows="5" name="fixsql"></textarea></td>
      </tr>
      <tr>
      <td></td>
        <td id="command" colspan="2"><a href="<?php q_do_nothing()?>" refer="source"><?php echo "源端执行>>";?></a>
        <a href="<?php q_do_nothing()?>" class=" margin_30" refer="target"><?php echo "目标端执行>>"?></a></td>
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
   $("input[name=searchCondition]").width(430);
   $("#dateRepairTable tr:even").css("backgroundColor","#ebf1f8");
   $("#dateRepairTable th:gt(0)").addClass("b_l_fff");
   $("#dateRepairTable th:lt(3)").addClass("b_r_blue");
   $("#dateRepairTable").addClass("tb");   
   
   $("#updown a").click(function(){

		var m = $(this).attr("opt");
		if( m == "up" ) {
			record_no--;
			if(record_no<0) { alert("这是第一条！没有上一条！"); record_no++; return;} 
		} else {
			record_no++;
		}
		var sendData = {};
		sendData.result_name = result_name;
		sendData.record_no = record_no;
		loader.load("repair_change",sendData,function(res,data){
			if( res == false) {
				record_no--;
				alert("已经没有更多的数据了！");
			}else{
				show(data);
			}
		});
  });

   function show(s){
		$("#dateRepairTable tr:gt(0)").remove();
		var j = 5;
		$(s).each(function(i,obj){
			alert(obj);
			var row = '<tr ><td>'+obj.name+'</td><td>'+obj.source_data+'</td><td>'+obj.target_data+'</td></tr>'; 
			$("#dateRepairTable").append(row);
			j--;
		});
		$("#dateRepairTable").append(str_repeat('<tr ><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>',j));
		$("#dateRepairTable tr:gt(0):odd").css('background-color','rgb(235, 241, 248)');
		$("#dateRepairTable").compare();
	}

  $("#fixonedata a").click(function(){
	  var refer = $(this).attr("refer");
	  loader.load("repair_fixonedata",{sourcedb:getSourcedb(),targetdb:getTargetdb(),refer:refer,record_no:record_no},function(res,data){
		   var message  = res ? "修复完成！" : data;
		   alert(message);
	  });
  });

  $("#command a").click(function(){
	  var sql = _n("fixsql").val();
	  var refer = $(this).attr("refer");
	  loader.load("manaual_repair",{sql:sql,referenceby:refer,sourcedb:getSourcedb(),targetdb:getTargetdb()},function(res,data){
		   var message  = res ? "修复完成！" : data;
		   alert(message);
      });
  });
  
});

function submitForm() {
	$("form:eq(0)").submit();
};

function getSourcedb(){
	return {"user":_n("user1").val(),"tns":_n("tns1").val(),"password":_n("password1").val()};
};
function getTargetdb(){
	return {"user":_n("user2").val(),"tns":_n("tns2").val(),"password":_n("password2").val()};
};

var record_no = <?php echo $record_no;?>; 

var result_name = '<?php echo $result_name?>';

$(function(){
	var s = <?php echo json_encode($source);?> ; 
	var t = <?php echo json_encode($target);?> ;
	_n("user1").val(s.user == false ? "" : s.user);
	_n("user2").val(t.user == false ? "" : t.user);
	_n("tns1").val(s.tns == false ? "" : s.tns);
	_n("tns2").val(t.tns == false ? "" : t.tn);
	_n("password1").val(s.password == false ? "" : s.password);
	_n("password2").val(t.password == false ? "" : t.password);
	_n("table1").val(s.table  == false ? "" : s.table);
	_n("table2").val(t.table == false ? "" : t.table);
	_n("searchCondition").val("<?php echo $condtion?>");
	$("#dateRepairTable").compare();
});

</script>
<?php alert_error_message();?>
</body>
</html>
