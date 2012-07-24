<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Bakeup extends MY_Controller {
		
		public function __construct() {
			parent::__construct($this);
			$this->load->model('bakeupm');
		}
		
		public function index($offset = 0){
			
			$data = array();
			
			$vars = $this->get("curent_check_now");
			$pagesize = 4;
			
			$pages =  "";
			
			if( $vars != NULL) {
				
				extract($vars);
				$data = $this->bakeupm->check_bakeup($username,$password,$bakeupdb,$starttime,$endtime,$dbuser,$dbtable,$optype,$offset/$pagesize,$pagesize);
				
				$pages = $this->createPages($data->total_pages,$pagesize,"bakeup/index");
				$data = $data->row;
			}
			
			if($this->ispostback()) {
				
				$bakeupdb = $this->input->post("bakeupdb");
				$username = $this->input->post("username");
				$password = $this->input->post("password");
				$starttime = $this->input->post("starttime");
				$endtime = $this->input->post("endtime");
				$dbuser = $this->input->post("dbuser");
				$dbtable = $this->input->post("dbtable");
				$optype = $this->input->post("optype");
				
				$vars = $this->mpost(array("bakeupdb","username","password","starttime","endtime","dbuser","dbtable","optype"));
				
				$this->save("curent_check_now", $vars);
				
				$this->jump("bakeup/index");
			}
			
			
			$this->load->view('bakeup',array("data"=>$data,"pages"=>$pages,"vars"=>$vars));
		}
		
	}