<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Compare extends MY_Controller {
		
		public function __construct() {
			parent::__construct($this);
			$this->load->model('comparem');
		}
		
		public function index() {
			$tasks = $this->comparem->query_compare_task();
			
			$this->load->view('compare',array('tasks'=>$tasks));
		}
		
		public function ljbd($name) {
			$this->comparem->start_compare_task($name);
			return $this->index();
		}
		
		public function delete($name) {
			$this->comparem->delete_compare_task($name);
			return $this->index();
		}

		
		public function create() {
			if($this->ispostback()) {
				$targetdb = $this->input->post("targetdb");
				$sourcedb = $this->input->post("sourcedb");
				$name = $this->input->post("taskName");
				$mode = $this->input->post("mode");
				$sql_condition = $this->input->post("sql_condition");
				$sql_condition = preg_split("/\n/", $sql_condition);
				//month|week|day
				$plan_type = $this->input->post("month") . "|" . $this->input->post("week") . "|" . $this->input->post("day");
				$start_time = $this->input->post("hour") . ":" . $this->input->post("minute");
				if($this->comparem->create_compare_task($name,$sourcedb,$targetdb,$sql_condition,$plan_type,$start_time,$mode)){
					$this->jump("compare");
				}
			}	
			$this->load->view('create');
		}
		
		public function checktask($name,$t = ""){
						
			$date = $this->comparem->query_compare_result_date($name);
			
			$res =	$this->comparem->query_compare_result($name,$t);
			
			$this->load->view("check",array("res"=>$res,'date'=>$date,"seldate"=>$t));
		}
		
		public function setting($name) {
			$current = $this->comparem->query_compare_task_detail($name);
			$this->load->view("setting",array("current"=>$current,array("name"=>$name)));
		}
		
		public function checkdetail($record_no,$task_name,$sel_date=""){
			$res = $this->comparem->query_compare_result_detail(0,$task_name,$sel_date);
			$this->load->view("detail",array("taskName"=>$task_name,"res"=>$res,"json"=>array("recored_no"=>$record_no,"task_name"=>$task_name,"date"=>$sel_date)));
		}
		
	}