	<div id="wrap" style="width: 780px;">
				<div class="pageTitle" style="width: 780px;">运行状态</div>
				<div id="fade" class="black_overlay"> </div>
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
$(document).ready(function() {
	$(".runStateTable tr:nth-child(odd)").css("backgroundColor","#ebf1f8");
    $(".runStateTable th:nth-child(n+2)").addClass("b_l_fff");
    $(".runStateTable th:nth-child(-n+7)").addClass("b_r_blue");
});
</script>