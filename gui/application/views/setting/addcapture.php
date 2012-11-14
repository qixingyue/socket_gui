<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>复制任务管理</title>
	<?php load_cssjs();?>
	</head>
<body id="mainbody">
<?php Widget::render("header");?>
<div id="content">
<div id="navLeft">
<?php Widget::render("leftmenu",array("selmenu"=>"setting"));?>
</div> <!--end navLeft-->
<div id="rightFrame">    
<div id="wrap" >
      <form id="CaptureServerForm" name="CaptureServerForm" method="post">
        <div class="pageTitle">注册数据捕获（Capture）服务</div>
        <table width="625" class="captureTable">
          <tr>
            <td width="116" class=" spacePre">名        称</td>
            <td><input type="text" name="name" /></td>
            <td width="116" >数据库类型</td>
            <td><?php echo form_dropdown("dbtype",getdbtypes(),"",array("class"=>"float_lt"))?></td>
          </tr>
          <tr>
            <td>节点 1 连接串</td>
            <td width="202"><input type="text" name="tns1"  value="" /></td>
            <td> 日志文件可选路径</td>
            <td width="176"><input type="text" value="" name="log1" /></td>
          </tr>
          <tr>
            <td >节点 2 连接串</td>
            <td><input type="text"  value="" name="tns2"/></td>
            <td >日志文件可选路径</td>
            <td><input type="text"  value="" name="log2"/></td>
          </tr>
          <tr>
            <td >登 陆 用 户 名</td>
            <td><input type="text" name="user"  value="" /></td>
            <td >登陆密码</td>
            <td><input type="password" name="loginpassword"  value="" /></td>
          </tr>
          <tr>
            <td width="116" class="  float_rt"><span >离线分析</span>
              <input name="offline" type="checkbox" value="离线分析" /></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr class="canbe_remove_line">
            <td >分析数据库连接串</td>
            <td width="202"><input type="text" value="" name="tns3" /></td>
          </tr>
          <tr class="canbe_remove_line">
            <td >分析库登陆用户名</td>
            <td><input type="text"  value="" name="db_user"/></td>
          </tr>
          <tr class="canbe_remove_line">
            <td >分 析 登 录 密 码 </td>
            <td><input type="password" value="" name="password2"/></td>
          </tr>
          <tr>
            <td><input name="contrac" value="连接" type="button" class="buttonSpan"/></td>
            <td></td>
          </tr>
        </table>
        <table class="dateCapRange tb mt15" cellspacing="0">
         <tr id="userspoint">
            <th width="56" class="b_r_blue">&nbsp;</th>
            <th width="532" class=" b_l_fff">用户名</th>
          </tr>
          <tr>
            <td><label for="checkbox1">&nbsp;</label>
              </td>
            <td></td>
          </tr>
          <tr>
            <td><label for="checkbox2">&nbsp;</label>
             </td>
            <td></td>
          </tr>
           <tr>
            <td><label for="checkbox3">&nbsp;</label>
             </td>
            <td></td>
          </tr>
           <tr>
            <td><label for="checkbox4">&nbsp;</label>
              </td>
            <td></td>
          </tr>
           <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <div class="text_cent mt10">
          <input name="save" type="submit" value="保存" class="buttonSpan"/>
          <input name="cancle" type="button" value="取消" class="buttonSpan" onclick="window.location.href='<?php echo site_url("setting/editgroup/" . $group);?>';"/>
        </div>
      </form>
    </div>
</div><!--end rightFrame -->  
</div>
<!--end content -->
<?php Widget::render("footer");?>
<script type="text/javascript">
$(function(){
	
	<?php //获得数据库用户 ?>

    var dbusers = [] ;
	var bindUser = function(){
		for(var i=0;i<dbusers.length;i++){
			var m = dbusers[i];
			m.remove();
		}
		var type = _n("dbtype").val();
		var user = _n("user").val();
		var password = $(this).val();			
		var tns = _n("tns1").val();
		loader.load("dbusers",{type:type,user:user,password:password,tns:tns},function(res,data){
			if(res != ""){
				$(".dateCapRange tr:gt(0)").remove();
				$(data).each(function(i,obj){
					var row = '<tr><td><label for="checkbox4"></label><input type="checkbox" name="fwusers[]" value="'+obj+'" id="checkbo5" /></td><td>'+obj+'</td></tr>';
					var x =$(row);	
					dbusers[dbusers.length] = x;
					$("#userspoint").after(x);	
				});
				$(".dateCapRange tr:even").css("backgroundColor","#ebf1f8");	
			}else {
				alert(data);
			}
		});
	};
			

	_n("contrac").click(function(){
		
		var type = _n("dbtype").val();
		var user = _n("user").val();
		var password = _n("loginpassword").val();
		var tns1 = _n("tns1").val();
		var tns2 = _n("tns2").val();
		var tns3 = _n("tns3").val();
		var db_user = _n("db_user").val();
		var password2 = _n("password2").val();
		
		var sendData = {type:type,user:user,password:password,tns1:tns1,tns2:tns2,tns3:tns3,db_user:db_user,password2:password2};
		
		loader.load("check_capture_db",sendData,function(res,data){
			if(res != ""){
				bindUser();
			} else {
				alert(data);
			}
		});
	});

	_n("offline").change(function(){
		if($(this).attr("checked")) {
			$(".canbe_remove_line").show();
		} else {
			$(".canbe_remove_line").hide();
		}
	}).change();
	
	$(".dateCapRange tr:even").css("backgroundColor","#ebf1f8");	
	$("input[type=text]").width(150);
	$("input[type=password]").width(150);
	$("select").width(152);
	$("#navLeft").height($("#rightFrame").height());
	
});

</script>
<?php alert_error_message();?>
</body>
</html>
