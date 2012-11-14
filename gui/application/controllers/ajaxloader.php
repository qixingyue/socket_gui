<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Ajaxloader extends MY_Controller {
		
		
		public function __construct() {
			parent::__construct($this);
		}
		
		/**
		 * 获取数据库用户 
		 */
		public function dbusers(){
			
			extract($this->mpost(array('type','user','password','tns')));
			$this->load->model('settingm');
			$res = $this->settingm->query_db_users($type,$user,$password,$tns);
			if(!$res){
				$this->echoJson(FALSE,get_flash_message("error_message"));	
			}else {
				$this->echoJson(TRUE,$res);
			}
			
		}
		
		/**
		 * 检测capture数据库连通性
		 */
		public function check_capture_db(){
			extract($this->mpost(array('type','user','password','tns1','tns2','db_user','password2','tns3')));
			$this->load->model('settingm');
			$res = $this->settingm->test_capture_db($type,
							array('db_user'=>$user,'password'=>$password,'tns_1'=>$tns1,'tns_2'=>$tns2),
							array('tns'=>$tns3,'db_user'=>$db_user,'password'=>$password2)
			);
			$this->echoBoolJson($res);
		}
		
		
		/**
		 * 检查loader 数据库的连通习惯你
		 * Enter description here ...
		 */
		public function check_loader_db() {
			$this->load->model('settingm');
			extract($this->mpost(array("type","user","password","tns")));
			$res = $this->settingm->check_loader_connect($type,$user,$password,$tns);
			$this->echoBoolJson($res);
		}
		
		public function check_bakeup_sql() {
			$rowid = $this->input->post("rowid");
			$this->load->model("bakeupm");
			$d = $this->bakeupm->query_row_sql($rowid);
			if($d === FALSE) {
				$this->echoJson(FALSE,get_flash_message("error_message"));
			}else{
				$this->echoJson(TRUE,$d);
			}
		}
		
		
		public function manaual_repair(){
			$sql = $this->input->post("sql");
			$referenceby = $this->input->post("referenceby");
			$sourcedb = $this->input->post("sourcedb");
			$targetdb = $this->input->post("targetdb");
			$this->load->model('repairm');
			if(!$this->repairm->manual_fix_data($sourcedb,$targetdb,$referenceby,$sql)) {
				$this->echoJson(FALSE,get_flash_message("error_message"));
			} else {
				$this->echoJson(TRUE,"");
			}
			
		}
		
		public function compare_fix_one_data() {
			$name = $this->input->post("task_name");
			$record_no = $this->input->post("record_no");
			$refer = $this->input->post("refer");
			$this->load->model("comparem");
			$res = $this->comparem->fix_data($name,$refer,$record_no);
			$this->echoBoolJson($res);
		}
		
		public function compare_change() {
			$this->load->model("comparem");
			$task_name = $this->input->post("task_name");
			$sel_date = urldecode($this->input->post("date"));
			$record_no = $this->input->post("record_no");
			$res = $this->comparem->query_compare_result_detail($record_no,$task_name,$sel_date);
			if($res === FALSE) {
				$this->echoJson(FALSE,get_flash_message("error_message"));
			}else{
				$tmp = array();
				foreach ($res->results->column as $c) {
					$i['name'] = $c->name."";
					$i['source_data'] = $c->source_data."";
					$i['target_data'] = $c->target_data."";
					$tmp[] = $i;
				}
				
				$this->echoJson(TRUE,$tmp);
			}
		}
		
		public function query_error_detail() {
			$group = $this->input->post("group");
			$name = $this->input->post("name");
			$error_id = $this->input->post("error_id");
			$this->load->model("statusm");
			$r = $this->statusm->query_error_detail($group,$name,$error_id);
			$this->echoBoolJson($r);
		}
		
		public function repair_change() {
			$result_name = $this->input->post("result_name");
			$result_no= $this->input->post("record_no");
			$this->load->model("repairm");
			$res = $this->repairm->repair_query_result_detail($result_name,$result_no);
			if($res === FALSE) {
				$this->echoJson(FALSE,get_flash_message("error_message"));
			}else{
				$tmp = array();
				foreach ($res->results->column as $c) {
					$i['name'] = $c->name."";
					$i['source_data'] = $c->source_data."";
					$i['target_data'] = $c->target_data."";
					$tmp[] = $i;
				}
				$this->echoJson(TRUE,$tmp);
			}
		}
		
		public function repair_fixonedata(){
			$sourcedb = $this->input->post("sourcedb");
			$targetdb = $this->input->post("targetdb");
			$referenceby = $this->input->post("refer");
			$record_no = $this->input->post("record_no");
			$this->load->model("repairm");
			$d =  $referenceby == "source" ? $sourcedb : $targetdb;
			$res =	$this->repairm->fix_one_data($d,$referenceby,$record_no);
			$this->echoBoolJson($res);
		}
		
		public function startscn(){
			$this->load->model("statusm");
			extract($this->mpost(array("name","group","lowscn","startscn")));
			$res = $this->statusm->startscn($name,$group,$lowscn,$startscn);
			$this->echoBoolJson($res);
		}
		
		
		public function data_init_percent(){
			$this->load->model("datainitm");
			$status = $this->datainitm->queryinit();
			if($status == false) {
				$this->echoJson(false,get_flash_message("error_message"));
			}else {
				extract($status);
				$this->echoJson(TRUE,array("percent"=>isset($percent)?$percent."":0,"detail_info"=>isset($detail_info)?$detail_info."":""));
			}
		}
		
		public function new_node(){
			$group = $this->input->post("group");
			$name = $this->input->post("name");
			$type = $this->input->post("type");
			$this->load->model("statusm");
			if($type == "capture" ) {
				$status = $this->statusm->query_capture_status($group,$name);
			}elseif ($type == "loader") {
				$status = $this->statusm->query_loader_status($group,$name);
			}else {
				$status = $this->statusm->query_simulator_status($group,$name);
			}
			$m['insert']  = (int) $status->op_insert;
			$m['update']  = (int) $status->op_update;
			$m['delete']  = (int) $status->op_delete;
			$m['ddl']  = (int) $status->op_ddl;
			
			$this->echoJson(TRUE, $m);
			
		}
		
		private function echoJson($res,$data = array()){
			$d = array();
			$d['res'] = $res;
			$d['data'] = $data;
			echo json_encode($d);
		}
		
		
		
		private function  echoBoolJson($res) {
			if(!$res){
				$this->echoJson(FALSE,get_flash_message("error_message"));	
			}else {
				$this->echoJson(TRUE,$res);
			}
		}
	}
	
	
	
	
