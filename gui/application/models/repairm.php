<?php

	class Repairm extends  MY_Model {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function repair_search($sourcedb,$targetdb,$condition) {
			$cmd = $this->makeSimpleCommand('repair_search',get_defined_vars());
			setxmlName("repair_search_success");
			$res = $this->sendCommand($cmd);
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				return false;
			} 
			return $this->getData($res);
		}
		
		public function manual_fix_data($sourcedb,$targetdb,$referenceby,$fix_command) {
			$cmd = $this->makeCommand('manual_fix_data',get_defined_vars());
			setxmlName("manual_fix_data_success");
			$res = $this->sendCommand($cmd);
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				return false;
			} 
			return true;
		}
		
		public function fix_one_data($db,$referenceby,$record_id,$result_name = "") {
			$cmd = $this->makeCommand('fix_one_data',get_defined_vars());
			setxmlName("fix_one_data_success");
			$res = $this->sendCommand($cmd);
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				return false;
			} 
			return true;
		}
		
		public function repair_query_result_detail($result_name,$result_no){
			$cmd = $this->makeCommand("repair_query_result_detail",array("name"=>$result_name,"result_no"=>$result_no));
			setxmlName("repair_query_result_detail_success");
			$res = $this->sendCommand($cmd);
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				return false;
			} else {
				return $this->getData($res);	
			}
			
		}
		
	}