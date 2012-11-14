<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Status extends MY_Controller {
		
		public function __construct() {
			parent::__construct($this);
			$this->load->model('statusm');
		}
		
		public function index(){
			if($this->isAjax()){
				$status = $this->statusm->queryStatus();
				if($status == NULL) write_flash_message('error_message', '状态读取错误！');
				$this->load->view('status_ajax',array('status'=>$status,'error'=>$status==FALSE));
				return;
			}
			$status = $this->statusm->queryStatus();
			if($status == NULL) write_flash_message('error_message', '状态读取错误！');
			$this->load->view('status',array('status'=>$status,'error'=>$status==FALSE));
			
		}
		
		public function checkloader($name,$group) {
			if($this->isAjax()) {
				$status = $this->statusm->query_loader_status($group,$name);
				$this->load->view('checkloader_ajax',array('name'=>$name,'status'=>$status));
				return ;
			}
			$status = $this->statusm->query_loader_status($group,$name);
			$this->load->view('checkloader',array('name'=>$name,'status'=>$status));
		}
		
		public function checkcapture($thread,$group,$name) {
			if($this->isAjax()) {
				$status = $this->statusm->query_capture_status($group,$thread);
				$this->load->view('checkcapture_ajax',array('name'=>$name,'status'=>$status,'group'=>$group));
				return ;
			}
			$status = $this->statusm->query_capture_status($group,$thread);
			$this->load->view('checkcapture',array('name'=>$name,'status'=>$status,'group'=>$group));
		}
		
		public function checksimulator($name,$group) {
			if($this->isAjax()) {
				$status = $this->statusm->query_simulator_status($group,$name);
				$this->load->view('checksimulator_ajax',array('name'=>$name,'status'=>$status,'group'=>$group));
				return;
			}
			$status = $this->statusm->query_simulator_status($group,$name);
			$this->load->view('checksimulator',array('name'=>$name,'status'=>$status,'group'=>$group));
		}
		
		public function start($name,$group) {
			$this->statusm->startService($group,$name);
			return	$this->index();
		}
		
		public function stop($name,$group) {
			$this->statusm->stopService($group,$name);
			return	$this->index();
		}
		
		public function startscn($type = 'server') {
			if($this->ispostback()) {
				extract($_POST);
				$this->statusm->startscn($name,$group,$lowscn,$startscn);
				return $this->index();
			}
			$this->load->view('startscn',array('type'=>$type));
		}
		
		public function break_error($n,$group,$name) {
			$this->statusm->skip_error($group,$name,$n);
			$this->jump("status/checkloader/$group/$name");
		}
		
		
		public function forceupdate($group,$name){
			$this->statusm->force_update($group,$name);
			$this->jump("status/checkloader/$group/$name");
		}
		
		public function repair($group,$name){
			$this->statusm->fix_record($group,$name);
			$this->jump("status/checkloader/$group/$name");
		}
		
		
		public function show_error(){
			$this->load->view("show_error");
		}
		
	}