<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<?php load_cssjs();?>
<script type="text/javascript">
$(document).ready(function() {
    $(".errorLogsTable tr:even").css("backgroundColor","#ebf1f8");
	$(".progressMagTable tr:lt(4) td:odd").addClass("text_blue");
	$("table th:gt(0)").addClass("b_l_fff");
	$("table th:lt(2)").addClass("b_r_blue");	
});
</script>

</head>
<body id="mainbody">
	<div id="header">
	<?php Widget::render("header");?>
	</div>
	<div id="content">
		<div id="navLeft">
			<?php Widget::render("leftmenu",array("selmenu"=>"status"));?>
		</div>
		<!--end navLeft-->
		<div id="rightFrame">
			<div id="wrap">
				<div class="pageTitle">Capture 进程管理</div>
				<table class="text_l float_lt progressMagTable">
					<tr>
						<td width="114">名称</td>
						<td width="284"><?php echo $name;?></td>
						<td width="114">数据库</td>
						<td width="116"><?php echo $status->db_name;?></td>
					</tr>

					<tr>
						<td>启动时间</td>
						<td><?php echo $status->start_time;?></td>
						<td>状态</td>
						<?php function get_color($s){ $s.=""; $colors = array("running"=>"green","terminated"=>"red"); return isset($colors[$s]) ? $colors[$s] : "yellow"; }?>
						<td id="runStateTD"><img src="<?php echo base_url()?>images/<?php echo get_color($status->status);?>.png"
							id="runStatePic" /><?php echo $status->status;?></td>
					</tr>
					<tr>
						<td>数据库SCN</td>
						<td><?php echo $status->work_scn;?></td>
						<td>数据库时间</td>
						<td><?php echo $status->work_scn_time;?></td>
					</tr>
					<tr>
						<td>日志分析SCN</td>
						<td><?php echo $status->current_scn;?></td>
						<td>日志分析时间</td>
						<td><?php echo $status->current_time;?></td>
					</tr>
					<tr>
						<td>统计信息：</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>插入操作：<span class="text_blue"><?php echo $status->op_insert;?></span></td>
						<td>修改操作：<span class="text_blue"><?php echo $status->op_update;?></span></td>
						<td>删除操作：<span class="text_blue"><?php echo $status->op_delete;?></span></td>
						<td>DDL操作：<span class="text_blue"><?php echo $status->op_ddl;?></span></td>
					</tr>
				</table>
				<div align="center" class="progressPic mt20" id="chart">
						<?php //<img src="<?php echo site_url("main/chart/$group/$name/capture")" width="630" height="202" class="mt20" /> 630*202 ?>
				</div>
				<div>最近SQL</div>
				<div class="text_blue margin_30 mt15"><?php echo $status->last_sql;?></div>
				<div class="mt15">事件/告警/错误信息</div>

				<table border="0" bordercolor="#000000" cellspacing="0"
					class="border_t errorLogsTable">
				<tr>
					<th style="width:180.383px">时间</th>
					<th style="width: 372.2px">信息</th>
					<th >详细</th>
				</tr>
				<?php $a = isset($status->errors->error) ? $status->errors->error : array();  $i = 5; foreach ($a as $b): $i--;?>
					<tr>
						<td><?php echo $b->error_time;?></td>
						<td><?php echo $b->error_message;?></td>
						<td><a href="#"><img src="<?php echo base_url()?>/images/magnifier.jpg" /> </a></td>
					</tr>
					<?php endforeach;?>
					<?php echo str_repeat(<<<HTML
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>					
HTML
					, max($i,0));?>
				</table>


				<div>
					错误处理 <span class="margin_30"><a href="<?php q_do_nothing()?>">停止进程>></a> </span>
				</div>

				<div class="mt15 mb20" align="center">
					<input type="button" class="buttonSpan" value="返回" onclick="window.location.href='<?php echo site_url("status")?>'" />
				</div>


			</div>
		</div>
		<!--end rightFrame -->
	</div>
	<!--end content -->
	
<?php alert_error_message();?>

<?php function get_data($m,$status){
		$insert = $update = $delete = $ddl = array();
		$s = isset($status->history_op->op_node) ? $status->history_op->op_node : array();
		foreach ($s as $j) {
			$insert[]= (int) $j->op_insert ;
			$update[]=(int)$j->op_update;
			$delete[]=(int)$j->op_delete;
			$ddl[] = (int)$j->op_ddl;
		}
	
	return json_encode($$m);
}?>
<script type="text/javascript" src="<?php echo base_url()?>js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/themes/grid.js"></script>
<script type="text/javascript">
	  var chart;  
      $(document).ready(function () {  
          chart = new Highcharts.Chart({  
          	animation:true,
              chart: {  
                  renderTo: 'chart',  
                  defaultSeriesType: 'line',  
                  marginRight: 70,  
                  marginBottom: 25  
              },  
              title: {  
                  text: '',  
                  x: -0 //center  
              },   
              yAxis: {  
                  title: {  
                      text: ''  
                  },  
                  plotLines: [{  
                      value: 0,  
                      width: 1,  
                      color: '#808080'  
                  }]  
              },  
              legend: {  
                  layout: 'vertical',  
                  align: 'right',  
                  verticalAlign: 'top',  
                  x: -10,  
                  y: 100,  
                  borderWidth: 0 ,
                  width:50
              },  
              series: [{  
                  name: 'insert',  
                  data:<?php echo get_data('insert',$status);?>,
                  lineWidth:1  
              }, {  
                  name: 'update',  
                  data:<?php echo get_data('update',$status);?>,
                  lineWidth:1  
              }, {  
                  name: 'delete',  
                  data: <?php echo get_data('delete',$status);?>,
                  lineWidth:1   
              }, {  
                  name: 'ddl',  
                  data:<?php echo get_data('ddl',$status);?>,
                  lineWidth:1  
              }]  
          });  

      });  

  	var points = <?php echo get_data('insert',$status);?>  
  	var pointsCount = points.length;
  	window.curretx = pointsCount;
</script>
<script type="text/javascript">
	
	<?php $url = current_url(); js_refresh_seconds(<<<JS
			function(){
				loader.load("new_node",{group:'$group',name:'$name',type:'capture'},function(res,data){
					if(res){
					    var x = ++window.curretx;
						chart.series[0].addPoint([x,data.insert],true,true);
						chart.series[1].addPoint([x,data.update],true,true);
						chart.series[2].addPoint([x,data.delete],true,true);
						chart.series[3].addPoint([x,data.ddl],true,true);
					}
				});
			}
JS
); ?>
</script>

<?php Widget::render("footer");?>
</body>
</html>
