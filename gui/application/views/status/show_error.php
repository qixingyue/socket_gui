<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加应用条目</title>
<?php load_cssjs();?>
</head>
<body style="background-color: #EEE">
<table style="margin: 0 auto;">
  <tr >
    <td>错误sql语句</td>
    <td><textarea id="error_sql" rows="5" cols="40" disabled="disabled" ></textarea></td>
  </tr>
  <tr >
    <td>错误详细信息</td>
    <td><textarea id="error_detail" rows="5" cols="40" disabled="disabled"></textarea></td>
  </tr>
</table>
<script type="text/javascript">
$(function(){
    var data = window.dialogArguments;
    $("#error_sql").val(data.error_sql);
    $("#error_detail").val(data.error_detail);
});
</script>
</body>
</html>