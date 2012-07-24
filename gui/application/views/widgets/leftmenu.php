<?php 
	/**
	 * $selmenu 选中的菜单name
	 */
?>
<div id="navLeft">
    <ul>
      <li id="setting"><a href="<?php echo site_url("setting")?>" >配置管理</a></li>
      <li id="datainit"><a href="<?php echo site_url("datainit")?>" >数据初始化</a></li>
      <li id="status"><a href="<?php echo site_url("status")?>" >运行状态</a></li>
      <li id="bakeup"><a href="<?php echo site_url("bakeup")?>" >持续备份数据信息</a></li>
      <li id="compare"><a href="<?php echo site_url("compare")?>" >数据比对</a></li>
      <li id="repair"><a href="<?php echo site_url("repair")?>" >数据修复</a></li>
    </ul>
</div>
<script type="text/javascript">

//左边导航效果
$(document).ready(function(e) {
  $("#navLeft li").click(function(e) {
		$("#navLeft li").removeClass("navLiCurrent");
      $(this).addClass("navLiCurrent");
  });
	$("#navLeft").height($("#rightFrame").height());

});

$(function(){
	$("#<?php echo $selmenu?>").attr("class","navLiCurrent");
});
</script>