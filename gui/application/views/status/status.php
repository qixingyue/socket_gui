<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>运行状态</title>
<?php load_cssjs();?>
<link href="<?php echo base_url()?>style/thickbox.css" rel="stylesheet"
	type="text/css" />
</head>
<body id="mainbody">
<?php Widget::render("header");?>
	<div id="fade" class="black_overlay"> </div>


				<!--隐藏的对话框1，cap and sim 里面的指定SCN启动，现在两个GroupTable都是公用的一个相同的dialog -->
				<div id="hideDialog11" class="white_content">
					<div class="dialogDIV">
						<span class="closeSpan" onclick="CloseDiv('hideDialog11','fade',false)">关闭</span>
					</div>
					<table class="mt15" id="dialogTable1">
						<tr>
							<td>日志分析起始SCN</td>
							<td><input type="text" name="lowscn1" /></td>
						</tr>
						<tr>
							<td>发送起始SCN</td>
							<td><input type="text" name="startscn1" /></td>
						</tr>
						<tr>
							<td></td>
							<td><input type=button value="确定"
								onclick="CloseDiv('hideDialog11','fade',true)" /></td>
						</tr>
					</table>
				</div>
				
				<!--隐藏的对话框2 Loader里面的指定SCN启动，现在两个GroupTable都是公用的一个相同的dialog -->
				<div id="hideDialog12" class="white_content">
					<div class="dialogDIV">
						<span class="closeSpan" onclick="CloseDiv('hideDialog12','fade',false)">关闭</span>
					</div>
					<table class="mt20" id="dialogTable2">
						<tr>
							<td>开始装载SCN</td>
							<td><input type="text" name="lowscn2" /><?php echo form_hidden("startscn2","")?></td>
						</tr>
						<tr>
							<td></td>
							<td><input type=button value="确定"
								onclick="CloseDiv('hideDialog12','fade',true)" /></td>
						</tr>
					</table>
				</div>
				
	<div id="content">
	<?php Widget::render("leftmenu",array("selmenu"=>"status"));?>
		<!--end navLeft-->
		
		<div id="rightFrame">
			<div id="wrap" style="width: 780px;">
				<div class="pageTitle" style="width: 780px;">运行状态</div>
				<?php foreach ($status->group as $group) : $groupName = $group->name;
			    	 if(!isset($group->captures->capture)) $group->captures->capture = array();
			    	 if(!isset($group->captures->simulator)) $group->captures->simulator = array();
			    	 if(!isset($group->servers->server)) $group->servers->server = array();
			    		$first = NULL;
			    	$count  = count( $group->captures->capture) + count($group->captures->simulator);
			    ?>
				<!--第一组 -->
				<div class="group">
					<div class="groupTitle font_deepblue">
						Group Name:
						<?php echo $groupName;?>
					</div>
					<table border="0" cellspacing="0" class="runStateTable">
						<tr>
							<th>进程</th>
							<th>TH/DB</th>
							<th>状态</th>
							<th>启动日期</th>
							<th>SCN</th>
							<th>TimeStamp</th>
							<th>&nbsp;</th>
							<th>操作</th>
						</tr>
						
					<?php foreach ($group->captures->capture as $c) :?>
						<tr>
							<td><?php echo $c->name;?></td>
							<td><?php echo $c->thread?>/<?php echo $c->db_name?></td>
							<td><?php echo get_status_img($c->status)?></td>
							<td><?php echo $c->start_time ?></td>
							<td><?php echo $c->work_scn ?></td>
							<td><?php echo $c->work_scn_time ?></td>
							<td class="border_l border_r"><a href="<?php echo site_url("status/checkcapture/" . $c->thread . "/$groupName/$c->name")?>">查看</a>
							</td>
							<?php if($first == NULL): $first = 1;?>
							<td class="text_cent" rowspan="<?php echo $count?>">
								<ul class="operateList">
									<li><a href="<?php echo site_url("status/start/{$c->name}/$groupName")?>">启动</a></li>
									<li><a href="<?php echo site_url("status/stop/{$c->name}/$groupName")?>">停止</a></li>
									<li><a href="#"onclick="startScn('<?php echo $c->name?>' , '<?php echo $groupName?>' , 'capture')">指定SCN启动</a></li>
								</ul>
							</td>
							<?php endif;?>
						</tr>
					<?php endforeach;?>
					
					<?php foreach ($group->captures->simulator as $s) :?>
						<tr>
							<td><?php echo $s->name?></td>
							<td><?php echo $s->thread?>/<?php echo $s->db_name?></td>
							<td><?php echo get_status_img($s->status)?></td>
							<td><?php echo $s->start_time ?></td>
							<td><?php echo $s->work_scn ?></td>
							<td><?php echo $s->work_scn_time ?></td>
							<td class="border_l border_r"><a href="<?php echo site_url("status/checksimulator/" . $s->name . "/$groupName")?>">查看</a>
							</td>
						</tr>
					<?php endforeach;?>
						<?php foreach ($group->servers->server as $s):?>
						<tr>
							<td><?php echo $s->name?></td>
							<td><?php echo $s->thread?>/<?php echo $s->db_name?></td>
							<td><?php echo get_status_img($s->status)?></td>
							<td><?php echo $s->start_time ?></td>
							<td><?php echo $s->work_scn ?></td>
							<td><?php echo $s->work_scn_time ?></td>
							<td class="border_l border_r"><a href="<?php echo site_url("status/checkloader/" . $s->name . "/$groupName")?>">查看</a>
							</td>
							<td class="text_cent" id="scn2"><a href="<?php echo site_url("status/start/{$s->name}/{$group->name}")?>">启动</a> <a href="<?php echo site_url("status/stop/{$s->name}/{$group->name}")?>">停止</a>
								<a href="#" onclick="startScn('<?php echo $s->name?>' , '<?php echo $group->name?>' , 'server')">指定SCN启动</a>
							</td>
						</tr>
						<?php endforeach;?>
					</table>
				</div>
				<!-- end group -->
				<?php endforeach;?>
			</div>
			<!--wrap -->
			<div id="hf" style="display: none" >
 <?php echo form_open("status/startscn",array('id'=>'hform'));?>
 <?php echo form_hidden("lowscn").form_hidden("startscn").form_hidden("start_name").form_hidden("start_group").form_submit('save');?>
 <?php echo form_close();?>
</div>

<script type="text/javascript">

var mode = "server";
var name = "";
var group = "";

//弹出隐藏层，第一个参数为对话框ID
function ShowDiv(show_div,bg_div){
	document.getElementById(show_div).style.display='block';
	document.getElementById(bg_div).style.display='block' ;
	var bgdiv = document.getElementById(bg_div);
	$("#"+show_div).find("input[type='text']").val("");
	bgdiv.style.width = document.body.scrollWidth;
	 bgdiv.style.height = $(document).height();
	$("#"+bg_div).height($(document).height());
};
//关闭弹出层
//添加一个参数，submit是否需要提交
function CloseDiv(show_div,bg_div,submit)
{
	document.getElementById(show_div).style.display='none';
	document.getElementById(bg_div).style.display='none';
	if(submit){
		if(mode == "server"){
			sendUp(name,group,_n("startscn2").val(),_n("lowscn2").val());
		} else {
			sendUp(name,group,_n("startscn1").val(),_n("lowscn1").val());
		}
	}
};

function startScn(name,group,type){
	window.operate = true;
	mode = type;
	window.name = name;
	window.group = group;
	
	if(type=="server"){
		ShowDiv('hideDialog12','fade');
	}else{
		ShowDiv('hideDialog11','fade');
	}
}

function sendUp(name,group,startscn,lowscn){
	loader.load("startscn",{"name":window.name,"group":window.group,"startscn":startscn,"lowscn":lowscn},function(res,data){
		var message = res?"启动成功":data;
		window.operate = false;
		alert(message);
	});
}

$(document).ready(function() {
	$(".runStateTable tr:nth-child(odd)").css("backgroundColor","#ebf1f8");
    $(".runStateTable th:nth-child(n+2)").addClass("b_l_fff");
    $(".runStateTable th:nth-child(-n+7)").addClass("b_r_blue");
    $("table.runStateTable").each(function(i,obj){
		$(this).a_width(['70px','15px','30px','120px','60px','120px','30px']);
    });
});
</script>

		</div>
		<!--end rightFrame -->
	</div>
	<!--end content -->

<?php Widget::render("footer")?>
<?php alert_error_message(); ?>

<script type="text/javascript">
<?php $url = current_url(); js_refresh_seconds(<<<JS
			function(){
				if(window.operate != true) {
					$("#rightFrame").load('$url');
				}
			}
JS
); ?>
</script>

</body>
</html>
