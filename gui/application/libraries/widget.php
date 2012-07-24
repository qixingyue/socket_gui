<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * widget类，小工具，分块渲染视图文件
	 * 
	 * @author istrone
	 *
	 */
	class Widget  {
		
		private static $widgetsParams;
		
		public static function register($name,$params=array()) {
			self::$widgetsParams[$name] = $params;
		}
		
		public static function render($name,$vparams=array()) {
			if(isset(self::$widgetsParams[$name])) {
				extract(self::$widgetsParams[$name]);
				if(isset($params)){
				 	$params = array_merge($vparams,$params);	
				}else {
					 $params = $vparams;
				}
				$ci = & get_instance();
				echo $ci->load->widgetview($name,$params,TRUE);
			}
		}
		
	}
