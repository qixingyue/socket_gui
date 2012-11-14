<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class MY_Loader extends CI_Loader {
		
		/**
		 *  修改loader的路径
		 */
		public function __construct(){
			parent::__construct();
			$this->_ci_helper_paths = array_merge($this->_ci_helper_paths,array('tianmen/'));
			$this->_ci_library_paths = array_merge($this->_ci_library_paths,array('tianmen/'));
		}
		
		
		/**
		 * 自动按照控制器的名字去识别视图的位置，同时将大写转化为小写 
		 * @var string
		 */
		private  $controllerName;
		
		private $controller;
		
		public function setController($controller) {
			$this->controllerName = strtolower( get_class($controller));
			$this->controller = $controller;
		}
		
		public function getController() {
			return $this->controller;
		}
		
		public function getControllerName() {
			return $this->controllerName;
		}
		
		public function view($view, $vars = array(), $return = FALSE) {
			$view = $this->controllerName . '/' . $view;
			$vars["cself"] = $this->controller;
			return parent::view($view, $vars , $return);
		}
		
		public function widgetview($view, $vars = array(), $return = FALSE) {
			$view =  'widgets/' . $view;
			$vars['wd'] = _G("WD");
			return parent::view($view, $vars , $return);
		}
		
		
		public function loadxml($xmlname,$vars = array()){
			$view = 'xml/' . $xmlname;
			return parent::view($view,$vars,TRUE);	
		}
	}
	