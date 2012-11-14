<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('user_logined')) {

	function user_logined() {
		$u = current_socket_user();
		return $u!=NULL && $u!="";
	}

}

if(!function_exists('current_socket_user')) {

	function current_socket_user() {
		$ci = & get_instance();
		$ci->load->library('session');
		return json_decode($ci->session->userdata('current_socket_user'));
	}

}

if(!function_exists('open_session')) {

	function open_session() {
		static $opend = false;
		if(!$opend) {
			session_start();
			$opend = true;
		}
			
	}

}




if(!function_exists('load_cssjs')) {

	function load_cssjs() {
		?>
<link
	rel="stylesheet" href="<?php echo base_url()?>style/style.css" />
<script type="text/javascript"> var AJAXURL = "<?php echo base_url() ?>index.php/ajaxloader/";</script>
<script
	type="text/javascript" src="<?php echo base_url()?>js/jquery.js"></script>
<script
	type="text/javascript" src="<?php echo base_url()?>js/jquery.utils.js"></script>

		<?php
	}

}


if(!function_exists('write_flash_message')) {

	function write_flash_message($name,$message) {
		if(get_flash_message($name) == "") {
			global $messages;
			if($message == "") $message = "未知错误，可能是由于socket服务器未打开！";
			if($messages == NULL)	$messages = array();
			$messages[$name] = $message;
		}
	}

}



if(!function_exists('echo_flash_message')) {

	function echo_flash_message($name) {
		global $messages;
		if(isset($messages[$name]))
		echo $messages[$name];
	}

}

if(!function_exists('get_flash_message')) {

	function get_flash_message($name) {
		global $messages;
		if(isset($messages[$name]))
		return  $messages[$name];
	}

}

if(!function_exists('alert_message')) {

	function alert_message($msg) {
		?>
<script type="text/javascript">alert("<?php echo $msg?>");</script>
		<?php
	}

}

if(!function_exists('alert_error_message')) {

	function alert_error_message($name = 'error_message') {
		$msg = get_flash_message($name);
		if($msg != NULL && $msg != "") {
			?>
<script type="text/javascript">
		$(function(){alert("<?php echo $msg?>");	});</script>
			<?php
		}
	}

}


if(!function_exists('refresh_seconds')) {

	function refresh_seconds($s,$url) { ?>
<script type="text/javascript">
	(function(){
		var i = <?php echo $s?>;
		window.setInterval(function(){
			i--;
			if(i==0){
				window.location.href="<?php echo $url?>";
			}
		},1000);
	})();
</script>
	<?php }

}



if(!function_exists('getdbtypes')) {

	function getdbtypes(){
		return array(
				'ORACLE'=>'ORACLE', 'MS SQL SERVER'=>'MS SQL SERVER', 'DB2'=>'DB2'
				);
	}

}


if(!function_exists('object_types')) {

	function object_types() {
		$str = 'ALL,TABLE,INDEX,VIEW,SYNONYM,SEQUENCE,PROCEDURE,FUNCTION,PACKAGE,PACKAGE BODY,TRIGGER,TYPE,TYPE BODY,TABLE PARTITION';
		$tmp = explode(',', $str);
		$res = array();
		foreach ($tmp as $a) {
			$k = $a == 'ALL' ? '*' : $a;
			$res[$k] = $a;
		}
		return $res;
	}

}

if(!function_exists('get_status_img')) {

	function get_status_img($n) {
		if($n == "running") {
			return	img(base_url() . "images/green.png" );
		} else {
			return	img(base_url() . "images/red.png" );
		}
	}

}


if(!function_exists('dbtype_name')) {

	function dbtype_name($i) {
		static $types ;
		$types = getdbtypes();
		if(isset($types[$i])){
			return $types[$i];
		}
	}

}


if(!function_exists('check_code')) {

	function check_code($n) {

		@session_start();
		$c = $_SESSION['code'];
		if($n!=$c) write_flash_message('error_message', "验证码错误！");
		return $n == $c;

	}

}


if(!function_exists('rand_create')) {


	//验证码图片生成
	function rand_create()
	{
		//通知浏览器将要输出PNG图片
		header("Content-type: image/PNG");
		//准备好随机数发生器种子
		srand((double)microtime()*1000000);
		//准备图片的相关参数
		$im = imagecreate(62,20);
		$black = ImageColorAllocate($im, 0,0,0);  //RGB黑色标识符
		$white = ImageColorAllocate($im, 255,255,255); //RGB白色标识符
		$gray = ImageColorAllocate($im, 200,200,200); //RGB灰色标识符
		//开始作图
		imagefill($im,0,0,$gray);
		$randval=rand(1000, 9999);
		session_start();
		$_SESSION["code"] = $randval;
		//将四位整数验证码绘入图片
		imagestring($im, 5, 10, 3, $randval, $black);
		//加入干扰象素
		for($i=0;$i<200;$i++){
			$randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
			imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
		}
		//输出验证图片
		ImagePNG($im);
		//销毁图像标识符
		ImageDestroy($im);
	}


}


if(!function_exists('progressbar')) {
	function progressbar($percent){
		?>
<script
	type="text/javascript"
	src="<?php echo base_url();?>js/jquery.progressbar.min.js"></script>
<script>
$(document).ready(function() {
	$("#spaceused1").progressBar({ barImage: '<?php echo base_url();?>images/progressbg_green.gif'} );
});
</script>
<span class="progressBar" id="spaceused1"><?php echo $percent?>%</span>
		<?php
	}
}


if(!function_exists('objpro')) {

	function objpro($obj,$pro,$default = "") {
		if(!is_object($obj) && ! is_array($obj)) $obj = new stdClass();
		if(is_array($obj)){
			return isset($obj[$pro]) ? $obj[$pro] : "sss";
		}
		return  property_exists($obj, $pro) ?  $obj->$pro : $default;
	}

}


/**
 * 全局变量的封存
 */
if(!function_exists('_G')) {

	function _G($name,$value = NULL){

		if(!isset($GLOBALS['SOCKET_G'])) {
			$GLOBALS['SOCKET_G'] = array();
		}

		static 	$G ;
		$G = $GLOBALS['SOCKET_G'];

		if ($value == NULL) {
			return isset($G[$name]) ? $G[$name] : NULL;
		} else {
			$G[$name] = $value;
			$GLOBALS['SOCKET_G'] = $G;
		}
	}

}

if(!function_exists('q_make_array')) {

	function q_make_array(& $i) {

		if(!is_array($i)) $i = array();

	}

}

if(!function_exists('q_array_fill_count')) {

	function q_array_fill_count(&$a,$count,$default) {
		$i = count($a);
		if($i<$count) {
			for (;$i<$count;$i++) {
				$a[] = $default;
			}
		}
	}

}


if(!function_exists('q_do_nothing')) {

	function q_do_nothing() {
		echo 'javascript:void(0);';
	}

}

if(!function_exists('drawChart')) {

	function drawChart($i,$u,$d,$dl){
		// Standard inclusions
		include("pChart/pData.class.php");
		include("pChart/pChart.class.php");

		// Dataset definition
		$DataSet = new pData;
		//图表数据
		$DataSet->AddPoint($i,"Serie1");
		$DataSet->AddPoint($d,"Serie2");
		$DataSet->AddPoint($u,"Serie3");
		$DataSet->AddPoint($dl,"Serie4");
		$DataSet->AddAllSeries();
		$DataSet->SetAbsciseLabelSerie();
		//数据图例
		$DataSet->SetSerieName("Insert","Serie1");
		$DataSet->SetSerieName("Delete","Serie2");
		$DataSet->SetSerieName("Update","Serie3");
		$DataSet->SetSerieName("DDL","Serie4");

		// Initialise the graph
		$Test = new pChart(700,230);
		//设置图表尺寸、样式
		$Test->setFontProperties("Fonts/tahoma.ttf",8);
		$Test->setGraphArea(50,30,680,200);		//图标区域，两个点，需要空出图例的位置
		$Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
		$Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);		//边界的圆角举行
		$Test->drawGraphArea(255,255,255,TRUE);
		$Test->setLineStyle(1);												//设置线性
		$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE);	//R，G，B为坐标线的颜色
		$Test->drawGrid(4,TRUE,230,230,230,100);		//方格线

		// Draw the 0 line
		$Test->setFontProperties("Fonts/MankSans.ttf",6);
		$Test->drawTreshold(0,143,55,72,TRUE,TRUE);

		//折线图
		$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE,80);


		// Finish the graph
		//制作图例、标题、字体等属性
		$Test->setFontProperties("Fonts/MankSans.ttf",8);
		$Test->drawLegend(620,0,$DataSet->GetDataDescription(),255,255,255);
		$Test->setFontProperties("Fonts/MankSans.ttf",10);
		$Test->drawTitle(50,22,"",50,50,50,585);
		//生成图表
		$Test->Stroke();
		header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
		header('Expires: Mon, 26 Jul 2010 05:00:00 GMT');
		header('Pragma: no-cache');
	}

}










if(!function_exists('js_comment_var_dump')) {

	function js_comment_var_dump() {
		echo "/*";
		foreach (func_get_args() as $a) {
			var_dump($a);
		}
		echo "*/";
	}

}

if(!function_exists('js_refresh_seconds')) {

	function js_refresh_seconds($js_fun_body ){
		if($js_fun_body == "") $js_fun_body = "function(){}";
		$refresh_seconds = config_item('refresh_times');
		echo <<<JS
		setInterval($js_fun_body,$refresh_seconds);
JS
		;
	}

}
























if(!function_exists('ifDebug')) {

	function ifDebug(&$cmd){
		if(ENVIRONMENT == "development") {
			global $xml_name;
			$cmd = $xml_name . "\n" . $cmd;
		}
	}

}


if(!function_exists('setxmlName')) {

	function setxmlName($xmlname = "test") {
		if(ENVIRONMENT == "development") {
			global $xml_name;
			$xml_name = $xmlname;
		}
	}

}