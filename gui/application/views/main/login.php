<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>R7—DIP企业数据交互平台</title>
<meta content="R7—DIP,数据交互,平台" name="keywords" />
<?php load_cssjs();?>
</head>
<body id="mainbody" >
        <div id="header" >
           <div><img src="<?php echo base_url()?>images/header.jpg" /></div>
        </div>
        
 <div id="content">       
        <div id="loginForm">
          <div id="loginFormLeft"></div>
          
          <div id="loginFormMid">
          <div id="loginHeader">R7-DIP企业数据交互平台</div>
          <div id="loginFormBody">
          <?php echo form_open();?>
            <table id="loginTable">
              <tr>
                <td >用户名：</td>
                <td ><input type="text" class="inputText" name="username"/></td>
              </tr>
              <tr>
                <td  style="text-align:justify;">密&nbsp;&nbsp;码：</td>
                <td><input type="password" class="inputText" name="password"/></td>
              </tr>
              <tr>
                <td>验证码：</td>
                <td><input type="text" class="inputText" name="code"/></td>
              </tr>
              <tr>
                <td></td>
                <td><img src="<?php echo base_url() . 'code.php'?>" id="img" /><span class="font12"><a href="javascript:void(0)" id="changelink">看不清楚，换一张？</a></span></td>
              </tr>
              <tr>
                <td></td>
                <td><input type="submit"  id="submit"  value=""/></td>
              </tr>
            </table>
          <?php echo form_close();?>
          </div>
          </div>
          <div id="loginFormRight"></div>
        </div>
</div>
         
         <div id="footer">
         <div id="footer_1">
            <div><img src="<?php echo base_url()?>images/bottomLine.jpg" /></div>
        </div>  
        <div id="footer_2"align="center">
           		 <div id="copyRight" align="center">
                 <font style="white-space:pre">翱旗创业（北京）科技有限公司     www.r7data.com</font></div>
        </div>
        </div>  
<script type="text/javascript">
//设置输入框为100像素长度
$(document).ready(function(){
	$("input[type=text]").width(200);
	$("input[type=password]").width(200);
	
	//动态设置content的高度以适应浏览器
	var indexH=$(window).height()-142;
	var pdt=indexH-279;
	$("#content").css("padding-top",pdt/2);
	$("#content").css("padding-bottom",pdt/2);
});

function changePic(){
	document.getElementById('img').src = '<?php echo base_url()?>code.php?' + Math.random(); //fristphp.php为图片生成代码
}

$("#img").click(changePic);
$("#changelink").click(changePic);
</script>
<?php alert_error_message();?>
    </body>
</html>
