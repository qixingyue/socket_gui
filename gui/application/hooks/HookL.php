<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * 自定义挂钩点
	 * @author istrone
	 */
	class HookL {
		
		private $exceptUrls = array();
		
		private $exceptControllers = array();
		
		private $uri = '';
		
		
		private function get_ci() {
			if(class_exists('CI_Controller')) {
				$ci = & get_instance();
				return $ci;
			}
		}
		
		public function __construct() {
			$this->exceptUrls = array('main/login','main/code');
			$this->exceptControllers = array("xmlreturn");
			if($this->get_ci()) {
				$this->uri = uri_string();
			}
		}
		
		public function pre_system() {
			
		}

		public function pre_controller() {
				
		}
		
		public function post_controller_constructor() {
			
			if( in_array($this->get_ci()->load->getControllerName(),$this->exceptControllers ) || in_array($this->uri, $this->exceptUrls)) {
				return ;
			}
			
			if(!user_logined()) {
				redirect(site_url('main/login'));
				return;
			} 
			
			_G('WD',load_class('Widgetdata','core'));
			_G('Saver',load_class('Saver','core'));
		}
		
		public function post_controller() {
				
		}
		public function display_override() {
			$this->get_ci()->output->_display();
		}
		
		public function cache_override() {
				
		}
		
		public function post_system() {
				
		} 
		
	}