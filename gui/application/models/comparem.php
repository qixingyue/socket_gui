<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	
	class Comparem extends MY_Model {  
		
		public function __construct() {
			parent::__construct();
		}
		
		public function query_compare_task(){
			$cmd = $this->makeSimpleCommand('query_compare_task');
			setxmlName('query_compare_task_success');
			$res = $this->sendCommand($cmd);
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				return FALSE;
			} else {
				$res =  $this->getData($res);
				return $res->task;
			}
		}
		
		public function start_compare_task($taskname) {
			$cmd = $this->makeCommand('start_compare_task',array('taskname'=>$taskname));
			setxmlName('start_compare_task_success');
			$res = $this->sendCommand($cmd);
			$flag = TRUE;
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				$flag = FALSE;
			}
			return $flag;
		} 
		
		public function delete_compare_task($taskname) {
			$cmd = $this->makeCommand('delete_compare_task',array('taskname'=>$taskname));
			setxmlName('delete_compare_task_failed');
			$res = $this->sendCommand($cmd);
			$flag = TRUE;
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				$flag = FALSE;
			}
			return $flag;
		}
		
		public function create_compare_task($task_name,$source_db,$targetdb,$sql_condition,$plan_type,$start_time,$mode) {
			$cmd = $this->makeCommand('create_compare_task',get_defined_vars());
			setxmlName('create_compare_task_success');
			$res = $this->sendCommand($cmd);
			$flag = TRUE;
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				$flag = FALSE;
			}
			return $flag;
		}
		
		public function query_compare_result($name,$result_type){
			$cmd = $this->makeCommand("query_compare_result",array("name"=>$name,"result_type"=>$result_type));
			setxmlName('query_compare_result_success');
			$res = $this->sendCommand($cmd);
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				return FALSE;
			} else {
				return $this->getData($res);
			}
		}
		
		public function query_compare_result_date($name) {
			$cmd = $this->makeCommand("query_compare_result_date",array("name"=>$name));
			setxmlName('query_compare_result_date_success');
			$res = $this->sendCommand($cmd);
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				return FALSE;
			} else {
				$d = $this->getData($res);
				return isset($d->result_date) ? $d->result_date : array() ;
			}
		}
		
		public function query_compare_result_detail($record_no,$task_name,$sel_date=""){
			$cmd = $this->makeCommand("query_compare_result_detail",array("name"=>$task_name,"date"=>$sel_date,"record_no"=>$record_no));
			setxmlName("query_compare_result_detail_success");
			$res = $this->sendCommand($cmd);
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				return FALSE;
			} else {
				$d = $this->getData($res);
				return $d;
			}
		}
	
		public function fix_data($name,$refer,$record_no) {
			$cmd = $this->makeCommand("compare_fix_data",array("name"=>$name,"refer"=>$refer,"record_no"=>$record_no));
			setxmlName("compare_fix_data_success");
			$res = $this->sendCommand($cmd);
			if(!$this->isSuccess($res)) {
				write_flash_message("error_message", $this->getErrorMessage($res));
				return FALSE;
			}
			return TRUE;
		}
		
		public function query_compare_task_detail($name){
			$cmd = $this->makeCommand("query_compare_task_detail",array("name"=>$name));
			setxmlName("query_compare_task_detail_success");
			$res = $this->sendCommand($cmd);
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				return FALSE;
			} else {
				$d = $this->getData($res);
				return $d;
			}
		}
		
	}