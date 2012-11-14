<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Repair extends MY_Controller {
		
		public function __construct() {
			parent::__construct($this);
			$this->load->model('repairm');
		}
		
		public function index() {
			
			$record_no = -1;
			
			$s = array("user"=>$this->input->post("user1"),"password"=>$this->input->post("password1"),"tns"=>$this->input->post("tns1"),"table"=>$this->input->post("table1"));
			$t = array("user"=>$this->input->post("user2"),"password"=>$this->input->post("password2"),"tns"=>$this->input->post("tns2"),"table"=>$this->input->post("table2"));
			$c = $this->input->post("searchCondition");
			
			$res->results->column = array();
			
			$res_name = "";
			
			if($this->ispostback()) {
				
				$res1 =	$this->repairm->repair_search($s,$t,$c);
				
				$res_name = $res1->result_name."";
				
				$record_no = 0;
				
				$res = $this->repairm->repair_query_result_detail($res_name,0);
				
			}
			
			$this->load->view('repair',array("record_no"=>$record_no,"source"=>$s,"target"=>$t,"condtion"=>$c,'current'=>$res,"result_name"=>$res_name));
		}
		
		
	}