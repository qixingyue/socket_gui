<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>R7—DIP企业数据交互平台</title>
<meta content="R7—DIP,数据交互,平台" name="keywords" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>style/style.css" />
</head>

<body id="mainbody">

<div id="header" >
  <div><img src="<?php echo base_url()?>images/header.jpg" /></div>
</div>
<div id="content">
<div id="navLeft">
	    <li></li>
		<li class="navLiCurrent"><a href="<?php echo site_url("setting")?>" target="mainRight">配置管理</a></li>
	    <li><a href="subPages/dateInitialize.html" target="mainRight">数据初始化</a></li>
	    <li><a href="subPages/runStatus.html" target="mainRight">运行状态</a></li>
	    <li><a href="subPages/continueBackups.html" target="mainRight">持续备份数据信息</a></li>
	    <li><a href="subPages/dateContrast.html" target="mainRight">数据比对</a></li>
	    <li><a href="subPages/dateRepair.html" target="mainRight">数据修复</a></li>
</div> <!--end navLeft-->
  <iframe src="<?php echo base_url()?>" name="mainRight" width="795px" frameborder="0" id="rightFrame" class="float_lt" scrolling="auto"></iframe>
</div>
<!--end content -->
<div id="footer">
  <div id="footer_1">
    <div><img src="images/bottomLine.jpg" /></div>
  </div>
  <div id="footer_2" align="center">
    <div id="copyRight" align="center">
    <font style="white-space:pre">翱旗创业（北京）科技有限公司     www.r7data.com</font>
    </div>
  </div>
</div><!--END FOOTER -->

<script type="text/javascript" src="<?php echo base_url()?>js/common.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/viewport.js"></script>

</body>
</html>