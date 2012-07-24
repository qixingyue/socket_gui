<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Bakeupm extends MY_Model {

		public function __construct() {
			parent::__construct();
		}
		

		public function check_bakeup($db_user,$db_password,$tns,$start_time,$end_time,$username,$table,$option,$page,$page_count) {
			$vars = get_defined_vars();
			$cmd = $this->makeCommand('check_bakeup',$vars);
			setxmlName('check_bakeup_success');
			$res = $this->sendCommand($cmd);
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				return FALSE;
			} else {
				return $this->getData($res);
			}
		}
		
		public function query_row_sql($rowid) {
			$cmd = $this->makeCommand("query_row_sql",array("rowid"=>$rowid));
			setxmlName("query_row_sql_failed");
			$res = $this->sendCommand($cmd);
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				return FALSE;
			} else {
				$obj =  $this->getData($res);
				return $obj->sql;
			}
		}
		
		
	}
	
	
	