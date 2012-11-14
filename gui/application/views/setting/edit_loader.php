<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>注册数据装载服务</title>
 <?php load_cssjs();?>
</head>
<body id="mainbody">
<?php Widget::render("header");?>
<div id="content">
<div id="navLeft">
<?php Widget::render("leftmenu",array("selmenu"=>"setting"));?>
</div> <!--end navLeft-->
<div id="rightFrame"> <div id="wrap">
   <?php echo form_open();?>
   <div class="pageTitle">注册数据应用（Loader）服务</div>
   <table >
     <tr>
       <td>名称</td>
       <td colspan="3"><input type="text"  value="" name="name" /></td>
       <td>数据库类型</td>
       <td><?php echo form_dropdown("dbtype",getdbtypes());?><script type="text/javascript">_n("dbtype").width(155);</script></td>
     </tr>
     <tr>
       <td>连接串</td>
       <td colspan="3"><input type="text"  value="" name="tns"/></td>
       <td>登陆用户名</td>
       <td><input type="text"  class="inputText" value="" name="user"/></td>
     </tr>
     <tr>
       <td>密码</td>
       <td colspan="3"><input type="password"  value="" name="password" /></td>
       <td></td>
       <td></td>
     </tr>
     <tr>
       <td><input name="lianjie" value="连接测试" type="button" onclick="cl()"  class="buttonSpan"/></td>
       <td colspan="3">&nbsp;</td>
       <td></td>
     </tr>
   </table>
   <div class="mt15"><span class="float_lt">
   		应用范围（包含）</span>
   		<input name="tiajia1" value="添加" type="button"  onclick="bh('<?php echo site_url("setting/addinclude");?>')" class="buttonSpan float_rt" style="display:block-inline"/>
   		<div class=" clear_rt"></div>
   </div>
   <table id="includeTable" width="508" class="loaderTable1 mt10 tb" cellspacing="0">
     <tr>
       <th style="width:80px">用户</th>
       <th  style="width:70px">对象类型</th>
       <th style="width:280px">对象列表</th>
       <th >操作</th>
      </tr>
      <?php echo str_repeat(<<<HTML
    <tr rowid="-1">
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>    
HTML
, 5);?>
   </table>
   
   <div class="mt15"><span class="float_lt">应用范围（排除）</span>
		<input name="tiajia1" value="添加" type="button"  onclick="pc('<?php echo site_url("setting/addreject");?>')" class="buttonSpan float_rt"/>
		<div class=" clear_rt"></div>
   </div>
   <table width="508" class="loaderTable2 mt10 tb" cellspacing="0" id="rejectTable">
       <tr>
       <th  style="width:80px">用户</th>
       <th class="b_l_fff" style="width:70px">对象类型</th>
       <th class="b_l_fff" style="width:280px">对象列表</th>
       <th class="b_l_fff">操作</th>
      </tr>
   <?php echo str_repeat(<<<HTML
    <tr rowid="-1">
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
HTML
   , 5);?>
   </table>
   
   <div id="hiddenChangeBox">
     <input type="checkbox"  id="hiddenCheckBox" name="skiptag" value="on"/>
     过滤Tag（在双向复制下必须选中该项目，否则将造成数据循环复制） </div>
   <table class="mt15" id="backUpTable">
     <tr>
       <td width="146">延迟告警阈值（秒）</td>
       <td width="472"><input  type="text" name="delay"/></td>
     </tr>
   </table>
   
   <table style="color:#0061c8" cellspacing="0">
     <tr  class="bgColor">
       <td width="133">错误处理规则</td>
       <td width="103"></td>
       <td width="106"></td>
       <td width="268"></td>
     </tr>
     <tr>
       <td><input type="radio" name="dealWay" id="repairit" checked="checked" value="auto_fix"/><label for="repairit">修复</label></td>
       <td><input type="radio" name="dealWay" id="jump" value="skip_record"/><label for="jump">跳过记录</label></td>
       <td><input type="radio" name="dealWay" id="jump_repair" value="skip_transaction"/><label for="jump_repair">跳过事务</label></td>
       <td><input type="radio" name="dealWay" id="retry" value="retry"/><label for="retry">重试</label></td>
     </tr>
   </table>
   <div style="padding-left:150px; padding-bottom:10px; clear:left"> 
     <span class="margin_30 mt10">
     <input name="save" value="保存" type="submit"  class="buttonSpan" value=""/>
     </span> 
     
     <span class="margin_30">
     <input name="cancel" value="取消" type="button" class="buttonSpan" onclick="window.location.href='<?php echo site_url("setting/editgroup/" . $group)?>';"/>
     </span> </div>
     
 </div>
 <?php echo form_hidden("js_field");?>
 <?php echo form_close();?>
</div><!--end rightFrame -->  
</div>
<!--end content -->
<?php Widget::render("footer");?>

 <script type="text/javascript">

var connected = false;
 
function cl(){
	
	var sendData = loadArguments();
	loader.load("check_loader_db",sendData,function(res,data){
		if(res != ""){
			alert("连接正常！");
			connected = true;
		} else {
			alert(data);
		}
	});
	
}

function _c(fn){
	var sendData = loadArguments();
	var m = false;
	loader.load("check_loader_db",sendData,function(res,data){
		if(res == true){
			fn();
		} else {
			alert(data);
		}
	});
}


//弹出页面函数
function loadFromUrl(dialogUrl,obj){
	var sUrl = dialogUrl;
	var w = $(window).width();
	var x = w/2 - 400;
	var sFeathers = "dialogHeight:650px;dialogWidth:800px;help:off;resizable:off;scroll:no;status:off;dialogLeft:"+x+"px;";
	var x = window.showModalDialog(sUrl,obj,sFeathers);
	return x;
}

function loadArguments(){
	var type = _n("dbtype").val();
	var user = _n("user").val();
	var password = _n("password").val();
	var tns = _n("tns").val();
	return {"type":type,"user":user,"password":password,"tns":tns};
}

var includeobjects = [];

function obj_str(r,type){
	if(type == "include"){
		return '{"userName":"'+r.userName+'","objtype":"'+r.objtype+'","ysuserName":"'+r.ysuserName+'","fw":"'+r.fw+'","objlist":"'+r.objlist+'"}';
	} else {
		return '{"userName":"'+r.userName+'","objtype":"'+r.objtype+'","fw":"'+r.fw+'","objlist":"'+r.objlist+'"}';
	}
}

function bh(url) {
	_c(function(){
		var r = loadFromUrl(url,loadArguments());
		if(r != undefined){
			bh_addrow(r,url);	
		}
	});
}


function bh_addrow(r,url){
	var i = getUniqueId();
	includeobjects[i]=r; 
	var row = '<tr rowid="'+i+'"><td>'+r.userName+'</td><td>'+r.objtype+'</td><td>'+r.objlist+'</td><td><a onclick="bh_edit('+i+',\''+url+'\')" href="<?php q_do_nothing()?>">修改>></a> <a href="<?php q_do_nothing()?>" onclick="bh_del('+i+')">删除>></a></td></tr>';
	var replaced = false;
	$("#includeTable tr").each(function(i,obj){
		if($(this).attr("rowid") == "-1") {
			replaced = true;
			$(this).replaceWith($(row));
			return false;		//提前跳出each循环
		}
	});
	if(!replaced){
		$("#includeTable").append(row);
	}
	$("#includeTable tr:even").css("backgroundColor","#ebf1f8");	
	$("#includeTable tr:odd").css("backgroundColor","");	
}
function bh_del(rowid) {
	var c ;
	$("#includeTable tr").each(function(i,obj){
		var r = $(this).attr("rowid");
		if(r == rowid + "") {
		   $(this).remove();
		} 
	});

	var i = $("#includeTable tr").size();
	if( i<=6){
		var str = str_repeat('<tr rowid="-1"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> ',6-i);
		$("#includeTable").append(str);
	}
	$("#includeTable tr:even").css("backgroundColor","#ebf1f8");
	$("#includeTable tr:odd").css("backgroundColor","");
	includeobjects[rowid]=null;
}


function bh_edit(rowid,url){
	_c(function(){
		var m =  includeobjects[rowid];
		var r =	 loadFromUrl(url,{"mode":"edit","current":m,"userArguments":loadArguments()});
		if(r!=null){
			var row = '<tr rowid="'+rowid+'"><td>'+r.userName+'</td><td>'+r.objtype+'</td><td>'+r.objlist+'</td><td><a href="<?php q_do_nothing()?>" onclick="bh_edit('+rowid+',\''+url+'\')">修改>></a> <a href="<?php q_do_nothing()?>" onclick="pc_del('+rowid+')">删除>><input type="hidden" name="include[]"/></a></td></tr>';
			var row = $(row);
			row.find("input[type='hidden']").val(obj_str(r,'include'));
			$("#includeTable tr[rowid="+rowid+"]").replaceWith(row);
			includeobjects[rowid]=r;
			$("#includeTable tr:even").css("backgroundColor","#ebf1f8");
			$("#includeTable tr:odd").css("backgroundColor","");
		}
	});
}


var rejectobjects = [];

function pc(url) {
	_c(function(){
		var r = loadFromUrl(url,loadArguments());
		if( r != undefined){
			pc_addrow(r,url);
		}
	});
}

function pc_addrow(r,url){
	var i = getUniqueId();
	rejectobjects[i] = r;
	var row = '<tr rowid="'+i+'"><td>'+r.userName+'</td><td>'+r.objtype+'</td><td>'+r.objlist+'</td><td><a href="<?php q_do_nothing()?>" onclick="pc_edit('+i+',\''+url+'\')">修改>></a> <a href="<?php q_do_nothing()?>" onclick="pc_del('+i+')">删除>></a></td></tr>';
	var replaced = false;
	$("#rejectTable tr").each(function(i,obj){
		if($(this).attr("rowid") == "-1") {
			replaced = true;
			$(this).replaceWith($(row));
			return false;		//提前跳出each循环
		}
	});
	if(!replaced){
		$("#rejectTable").append(row);
	}
	$("#rejectTable tr:even").css("backgroundColor","#ebf1f8");	
	$("#rejectTable tr:odd").css("backgroundColor","");	
}

function pc_del(rowid) {
	var c ;
	$("#rejectTable tr").each(function(i,obj){
		var r = $(this).attr("rowid");
		if(r == rowid + "") {
		   $(this).remove();
		} 
	});

	var i = $("#rejectTable tr").size();
	if( i<=6){
		var str = str_repeat('<tr rowid="-1"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> ',6-i);
		$("#rejectTable").append(str);
	}
	$("#rejectTable tr:even").css("backgroundColor","#ebf1f8");
	$("#rejectTable tr:odd").css("backgroundColor","");
	rejectobjects[i]=null;
}


function pc_edit(rowid,url){
	_c(function(){
		var m =  rejectobjects[rowid];
		var r =	 loadFromUrl(url,{"mode":"edit","current":m,"userArguments":loadArguments()});
		if(r!=null){
			var row = '<tr rowid="'+rowid+'"><td>'+r.userName+'</td><td>'+r.objtype+'</td><td>'+r.objlist+'</td><td><a href="<?php q_do_nothing()?>" onclick="pc_edit('+rowid+',\''+url+'\')">修改>></a> <a href="<?php q_do_nothing()?>" onclick="pc_del('+rowid+')">删除>><input type="hidden" name="reject[]" /></a></td></tr>';
			var row = $(row);
			row.find("input[type='hidden']").val(obj_str(r,'reject'));
			$("#rejectTable tr[rowid="+rowid+"]").replaceWith(row);
			rejectobjects[rowid]=r;
			$("#rejectTable tr:even").css("backgroundColor","#ebf1f8");	
			$("#rejectTable tr:odd").css("backgroundColor","");	
		}
	});
}



$(function(){
	$(".loaderTable1 tr:even,.loaderTable2 tr:even").css("backgroundColor","#ebf1f8");	
	
    $("input[type=text]").width(150);
    $("input[type=password]").width(150);
	
	$(".loaderTable1 th:gt(0)").addClass("b_l_fff");
	$(".loaderTable1 th:lt(3)").addClass("b_r_blue");//表格的边框样式，不能一起设置
	
    $(".loaderTable2 th:gt(0)").addClass("b_l_fff");
	$(".loaderTable2 th:lt(3)").addClass("b_r_blue");

	_n("name").val("<?php echo isset($app->server_name) ? $app->server_name : "" ?>");
	_n("dbtype").val("<?php echo isset($app->db_type) ? $app->db_type : "" ?>");
	_n("tns").val("<?php echo isset($app->tns)? $app->tns : ""?>");
	_n("user").val("<?php echo isset($app->db_user) ? $app->db_user : "" ;?>");
	_n("password").val("<?php echo isset($app->db_password) ? $app->db_password : "" ;?>");
	_n("server_type").val("<?php echo isset($app->server_type) ? $app->server_type : ""?>");

	<?php /*******************控制下边的错误选择****************************************/?>
	<?php if(isset($app->skip_taged) && ($app->skip_taged . "") == "YES"):?>
		_n("skiptag").attr("checked","checked");
	<?php endif; ?>
	_n("delay").val("<?php echo isset($app->delay_alert)? $app->delay_alert : ""?>");
	<?php if(isset($app->auto_fix) && ($app->auto_fix . "") == "YES"):?>
		_n("dealWay[name='auto_fix']").attr("checked","checked");
	<?php else: $m = isset($app->skip_error) ? $app->skip_error : ""; $c = "" ; if($m != ""): $c = "input[value='".$m."']";?>
				_n("dealWay").each(function(i,obj){
					var v = $(obj).val();
					if(v == "<?php echo $m?>" ){
						$(obj).attr("checked","checked");
					}
				});
		<?php endif;?>	
	<?php endif;?>
<?php $d = isset($app->filter) ? $app->filter : array(); ?>
	
	<?php foreach ($d as $filter):  ?>
		<?php if(isset($filter->filter_type) && ("" . $filter->filter_type) == "include"):?>
			<?php //加入包含的
				$schemas = isset($filter->schema) ? $filter->schema : array();
				foreach ($schemas as $c):
			?>
				
				<?php echo_obj($c,"include");?>
				bh_addrow(sub_r,"<?php echo site_url("setting/addinclude");?>");
				<?php endforeach;?>
		<?php elseif (isset($filter->filter_type) && ("" . $filter->filter_type) == "exclude"): ?>
			
			<?php //加入排除 
				$schemas = isset($filter->schema) ? $filter->schema : array();
				foreach ($schemas as $c):
			?>
				<?php echo_obj($c,"reject");?>
				pc_addrow(sub_r,"<?php echo site_url("setting/addreject");?>");
				<?php endforeach;?>
		<?php endif;?>
	<?php endforeach;?>
	
});	

<?php 
	function get_objlist($c){
		if(isset($c->object_type->object_name)){
			$tmp = "";
			foreach ($c->object_type->object_name as $name) {
				$tmp .= $name . '\n';
			}
			return trim($tmp,'\n');
		}else {
			return "*";
		}
	}

	function echo_obj($c,$mode) {
		if($mode == "include"){
			?>
			sub_r = {};
			sub_r.userName = "<?php echo isset($c->name) ? $c->name : ""?>";
			sub_r.objtype = "<?php echo isset($c->object_type->name) ? $c->object_type->name : ""?>";
			sub_r.ysuserName = "<?php echo isset($c->mapping_name)?$c->mapping_name:""?>";
			sub_r.objlist = "<?php echo get_objlist($c); ?>";
			sub_r.fw = sub_r.objlist == "*"?"*":"some";
			<?php 
		} elseif ($mode == "reject"){?>
			 sub_r = {};
			sub_r.userName = "<?php echo isset($c->name) ? $c->name : ""?>";
			sub_r.objtype = "<?php echo isset($c->object_type->name) ? $c->object_type->name : ""?>";
			sub_r.objlist = "<?php echo get_objlist($c); ?>";
			sub_r.fw = sub_r.objlist == "*"?"*":"some";
			<?php 
		}
	}
?>
	var sub_r={};


 </script>
</body>
</html>