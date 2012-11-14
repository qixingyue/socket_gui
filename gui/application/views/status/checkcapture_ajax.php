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
						<td><?php echo $status->work_scn;?></td>
						<td>日志分析时间</td>
						<td><?php echo $status->work_scn_time;?></td>
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
				<div align="center" class="progressPic mt20">
					<img src="<?php echo site_url("main/chart/$group/$name/capture") . "?rand=" . rand(0, 65535)?>" width="630" height="202"
						class="mt20" />
						<?php // 630*202?>
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
	<script type="text/javascript">
	 $(".errorLogsTable tr:even").css("backgroundColor","#ebf1f8");
		$(".progressMagTable tr:lt(4) td:odd").addClass("text_blue");
		$("table th:gt(0)").addClass("b_l_fff");
		$("table th:lt(2)").addClass("b_r_blue");	
</script>	
	