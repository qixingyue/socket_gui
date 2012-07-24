<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>R7—DIP企业数据交互平台</title>
<meta content="R7—DIP,数据交互,平台" name="keywords" />
<?php load_cssjs();?>

<style>
	.timeInput {
		width:35px;
	}
	.taskName {
		width:100px;
	}
</style>

</head>
<body id="mainbody">
<?php Widget::render("header");?>
<div id="content">
<div id="navLeft">
<?php Widget::render("leftmenu",array("selmenu"=>"compare"));?>
</div> <!--end navLeft-->
<div id="rightFrame">  
<div id="wrap">
<div class="pageTitle">创建新的比对任务</div>
  <?php echo form_open();?>
    <table class="border setCompareTable">
      <tr>
        <td width="57" align="right"></td>
        <td width="197" ></td>
        <td width="75" ></td>
        <td width="281" align="right"></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td>任务名称</td>
        <td><input class="taskName" type="text" name="taskName"  /></td>
      </tr>
      <tr>
          <td align="right">源数据库</td>
          <td ><input type="text"  name="sourcedb[tns]"/></td>
          <td align="right">目标数据库</td>
          <td ><input type="text" name="targetdb[tns]"  /></td>
        </tr>
        <tr>
          <td align="right">用户名</td>
          <td ><input  type="text"  name="sourcedb[user]"/></td>
          <td align="right">用户名</td>
          <td ><input  type="text"  name="targetdb[user]"/></td>
        </tr>
        <tr>
          <td align="right">密码</td>
          <td ><input type="password" name="sourcedb[password]" /></td>
          <td align="right">密码</td>
          <td ><input  type="password"  name="targetdb[password]"/></td>
        </tr>
      <tr>
        <td colspan="2">比对内容条件</td>
      </tr>
      <tr style="color:red;">
        <td colspan="4">格式： 源端用户名.表名:目标端用户名.表名:条件
              <pre>      R7.ENTRUST:R7_REP.ENTRUST:WHERE INIT_DATE&gt;10</pre>
        </td>
      </tr>
      <tr>
        <td colspan="4" ><textarea cols="59" rows="5" name="sql_condition"></textarea></td>
      </tr>
    </table>
    <table   id="setTimeTable">
      <tr>
        <td>分：
          <input type="text"  class="timeInput" name="minute"/></td>
        <td>时：
          <input type="text"   class="timeInput" name="hour"/></td>
        <td >日：
          <input type="text"  class="timeInput" name="day"/></td>
        <td >周：
          <input type="text" class="timeInput"  name="week"/></td>
        <td >月：
          <input type="text"  class="timeInput" name="month"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td >&nbsp;</td>
        <td >&nbsp;</td>
        <td >&nbsp;</td>
      </tr>
      <tr>
        <td></td>
        <td ><a href="<?php q_do_nothing()?>" onclick="sendBack('time')"><?php echo "保存为定时任务>>";?></a></td>
        <td><a href="<?php q_do_nothing()?>"  onclick="sendBack('ljbd')"><?php echo "立即比对>>"?></a></td>
        <td><a href="<?php echo site_url("compare")?>"><?php echo "返回>>";?></a></td>
      </tr>
    </table>
    <?php echo form_hidden("mode")?>
<?php echo form_close();?>
</div>
</div><!--end rightFrame -->  
</div>
<!--end content -->
<?php Widget::render("footer");?>
<?php alert_error_message();?>
<script type="text/javascript">
	function sendBack(i) {
		_n("mode").val(i);
		$("form").submit();
	}
</script>
</body>
</html>
