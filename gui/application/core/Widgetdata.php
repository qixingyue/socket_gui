<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * 设置成一个model的代理，
	 * @author istrone
	 *
	 */
	class CI_Widgetdata {

		private $ci;
		
		private $model;
		
		public function __construct() {
			$this->ci = & get_instance();
		}

		public function __call($method,$arguments){
			return call_user_func_array(array($this->model,$method),$arguments);
		}
	
		public function setModel($name) {
			$this->ci->load->model($name);
			$this->model = $this->ci->$name;
		}
		
		
	}