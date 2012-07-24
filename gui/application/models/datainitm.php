<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Datainitm extends MY_Model {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function createinit($sourcedb,$targetdb,$fw,$bftask,$singletask,$ttable,$create_index,$backscn) {
			$cmd = $this->makeCommand('datainit',array('sourcedb'=>$sourcedb,'targetdb'=>$targetdb,'fw'=>$fw,'bftask'=>$bftask,
				'singletask'=>$singletask,'ttable'=>$ttable,'create_index'=>$create_index,'backscn'=>$backscn
			));
			setxmlName('datainit_success');
			$res = $this->sendCommand($cmd);
			$flag = $this->isSuccess($res);
			if(!$flag) 
				write_flash_message('error_message', $this->getErrorMessage($res));
			return $flag;
		}
		
		
		public function queryinit() {
			$cmd = $this->makeSimpleCommand('query_init_data_status');
			setxmlName('query_init_success');
			$xml = $this->sendCommand($cmd);
			if($this->isSuccess($xml)) {
				$data = $this->getData($xml);
				return array('percent'=>$data->process_percent,'detail_info'=>$data->detail_info,"status"=>$data->status);
			} else {
				write_flash_message('error_message', $this->getErrorMessage($xml));
				return false;
			}
		}
	}