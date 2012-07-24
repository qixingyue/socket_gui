<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加应用条目</title>
<?php load_cssjs();?>
</head>
<body>
	<div id="wrap">
		<div class="pageTitle">添加应用（Loader）条目（包含）</div>
		<table class="text_l addItemContainTable">
			<tr>
				<td width="300px">用 户 名</td>
				<td ><select name="user" id="users" style="width:200px"  >
				</select></td>
			</tr>
			<tr>
				<td >映射用户名</td>
				<td ><input name="ysuser" type="text" style="width:195px"  /></td>
			</tr>
			<tr>
				<td>对象类型</td>
				<td><?php echo form_dropdown("objtypes",object_types(),"",array("style"=>" width:200px"));?></td>
			</tr>
			<tr>
				<td>对象名称</td>
				<td><input name="objtype" type="radio" value="*" id="all" checked="checked" /><label for="all">所有对象</label> <span
					class="margin_30"> <input name="objtype" type="radio"
						value="some" id="some" /> <label for="some">指定对象</label></span></td>
			</tr>
			<tr>
				<td></td>

			</tr>
			<tr style="color: red;">
				<td class="float_rt">格式：</td>
				<td colspan="2"><p>
						源端表名 例如：t_cc_eorder 表示目标端表名与源端同名<br /> 源端表名：目标端表名
						例如：t_cc_eorder：TMP_ORDER 表示目标端表名与源端不同名
					</p></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"><textarea name="objlist" cols="60" rows="8"></textarea></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td class="float_rt"><input name="queding" value="保存" type="button"
					class="buttonSpan" onclick="closeMe()" /></td>
				<td width="254"><input name="fanhui" value="返回" type="button"
					class="buttonSpan" onclick="window.close()"  /></td>
			</tr>
		</table>
	</div>
	<?php alert_error_message();?>
	<script type="text/javascript">

	var mode = "edit";

	var current = {};

	var userArguments = {};
	
	$(function(){
		
		mode = window.dialogArguments.mode == null ? "add" : "edit";
		if(mode == "edit"){
			current = window.dialogArguments.current;
			userArguments = window.dialogArguments.userArguments;
		} else {
			userArguments = window.dialogArguments;
		}
		loadUsers();

		_n("objlist").keydown(function(){
			$("#some").attr("checked","checked");
		});
	});
	
	
	var loadUsers = function(){
		loader.load("dbusers",userArguments,function(res,data){
			if(res != ""){
				$(".dateCapRange tr:gt(0)").remove();
				$(data).each(function(i,obj){
					var option = "<option value='"+obj+"'>"+obj+"</option>";
					var x =$(option);	
					$("#users").append(x);		
				});
				if(mode == "edit"){
					bindCurrent();
				}
			}else {
				alert(data);
			}
			
		});
	};

	var bindCurrent = function(){
		$("#users").val(current.userName);
		 _n("ysuser").val(current.ysuserName);
		 _n("objtypes").val(current.objtype);
		 var f = current.fw;
		 if(f == "*") $("#all").attr("checked","checked"); else $("#some").attr("checked","checked");
		 if(f != "*"){
			 _n("objlist").val(current.objlist);
		 }
	};
	
	var closeMe = function(){
		var userName = $("#users").val();
		var ysuserName = _n("ysuser").val();
		var objtype = _n("objtypes").val();
		var f = $("input[name='objtype']:checked").val();
		var r = {};
		if(f == "*"){
			r = {"userName":userName,"objtype":objtype,"ysuserName":ysuserName,"fw":"*","objlist":"*"};
		}else{
			r = {"userName":userName,"objtype":objtype,"ysuserName":ysuserName,"fw":"some","objlist":_n("objlist").val()};
		}
		window.returnValue = r;
		window.close();
	}
	</script>
</body>
</html>
