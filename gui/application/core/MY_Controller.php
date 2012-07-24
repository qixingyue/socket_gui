<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class MY_Controller extends CI_Controller {
		
		
		protected  $model;
		
		public function __construct($controller) {
			parent::__construct();
			$this->load->setController($controller);
			$this->initWidgets();
		}
		
		public function initWidgets() {
			$widgets = config_item('widgets');
			foreach ($widgets as $widget) {
				Widget::register($widget);
			}
		}
		
		/**
		 *  表单是否提交 
		 */
		public function ispostback() {
			return  !(empty($_GET) && empty($_POST));
		}
		
		
		public  function createPages($total,$limit,$router,$segment=3) {
			$this->load->library('pagination');
			$config['base_url'] = site_url($router);
			$config['total_rows'] = $total;
			$config['per_page'] = $limit;
			$config['uri_segment'] = $segment;
			$config['first_link'] = '首页';
			$config['last_link'] = '末页';
			$config['next_link'] = '下一页';
			$config['prev_link'] = '上一页';
			$this->pagination->initialize($config);
			return  $this->pagination->create_links();
		}
		
			
		protected function refresh($url) {
			$url = $url != "" ? $url : current_url();
			echo "<script>window.location.href='".$url."'</script>";
		}
		
		protected function jump($uri){
			ob_start();
			header("location:" . site_url($uri));
			ob_flush();
		}
		
		public function mpost($array){
			$d = array();
			foreach ($array as $a) {
				$d[$a] = $this->input->post($a);
			}
			return $d;
		}
		
		
		public function save($k,$v){
			@session_start();
			$_SESSION[$k] = json_encode($v);
		}
		
		public function get($k) {
			@session_start();
			return isset($_SESSION[$k]) ? json_decode($_SESSION[$k]) : NULL;
		}
		
		public function remove($k) {
			@session_start();
			if(isset($_SESSION[$k])){
				$_SESSION[$k] = NULL;
			} 
		}
		
		public function isAjax(){
			return $this->input->is_ajax_request();
		}
		
		
		
	}
