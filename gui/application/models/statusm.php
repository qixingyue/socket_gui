<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statusm extends MY_Model {

	public function queryStatus(){
		$cmd = $this->makeSimpleCommand('query_group_status');
		setxmlName('status_query_success');
		$res = $this->sendCommand($cmd);
		if($this->isSuccess($res)) {
			return $this->getData($res);
		} else {
			write_flash_message('error_message', $this->getErrorMessage($res));
			return FALSE;
		}
	}

	public function startService($group,$name) {
		$vars = get_defined_vars();
		$cmd = $this->makeCommand('start_service',$vars);
		setxmlName('start_service_failed');
		$res = $this->sendCommand($cmd);
		$flag = TRUE;
		if(!$this->isSuccess($res)) {
			write_flash_message('error_message', $this->getErrorMessage($res));
			$flag = FALSE;
		}
		return $flag;
	}

	public function stopService($group,$name) {
		$vars = get_defined_vars();
		$cmd = $this->makeCommand('stop_service',$vars);
		setxmlName('stop_service_failed');
		$res = $this->sendCommand($cmd);
		$flag = TRUE;
		if(!$this->isSuccess($res)) {
			write_flash_message('error_message', $this->getErrorMessage($res));
			$flag = FALSE;
		}
		return $flag;
	}

	public function startscn($name,$group,$lowscn,$startscn) {
		$vars = get_defined_vars();
		$cmd = $this->makeCommand('startscn',$vars);
		setxmlName('startscn_failed');
		$res = $this->sendCommand($cmd);
		$flag = TRUE;
		if(!$this->isSuccess($res)) {
			write_flash_message('error_message', $this->getErrorMessage($res));
			$flag = FALSE;
		}
		return $flag;
	}

	public function query_capture_status($group,$thread) {
		$vars = get_defined_vars();
		$cmd = $this->makeCommand('query_capture_status',$vars);
		setxmlName('query_capture_status_success');
		$res = $this->sendCommand($cmd);
		if(!$this->isSuccess($res)) {
			write_flash_message('error_message', $this->getErrorMessage($res));
			return FALSE;
		} else {
			return $this->getData($res);
		}
	}

	public function query_loader_status($group,$name) {
		$vars = get_defined_vars();
		$cmd = $this->makeCommand('query_loader_status',$vars);
		setxmlName('query_loader_status_success');
		$res = $this->sendCommand($cmd);
		if(!$this->isSuccess($res)) {
			write_flash_message('error_message', $this->getErrorMessage($res));
			return FALSE;
		} else {
			return $this->getData($res);
		}
	}

	public function query_simulator_status($group,$name) {
		$vars = get_defined_vars();
		$cmd = $this->makeCommand('query_simulator_status',$vars);
		setxmlName('query_simulator_status_success');
		$res = $this->sendCommand($cmd);
		if(!$this->isSuccess($res)) {
			write_flash_message('error_message', $this->getErrorMessage($res));
			return FALSE;
		} else {
			return $this->getData($res);
		}
	}
	
	public function query_error_detail($group,$name,$error_id) {
		$vars = get_defined_vars();
		$cmd = $this->makeCommand('query_error_detail',$vars);
		setxmlName('query_error_detail_success');
		$res = $this->sendCommand($cmd);
		if(!$this->isSuccess($res)) {
			write_flash_message('error_message', $this->getErrorMessage($res));
			return FALSE;
		} else {
			return $this->getData($res);
		}
	}


	public function skip_error($group,$name,$skip) {
		$vars = get_defined_vars();
		$cmd = $this->makeCommand('skip_error',$vars);
		setxmlName('skip_error_success');
		$res = $this->sendCommand($cmd);
		if(!$this->isSuccess($res)) {
			write_flash_message('error_message', $this->getErrorMessage($res));
			return FALSE;
		} else {
			return $this->getData($res);
		}
	}


	public function force_update($group,$name) {
		$vars = get_defined_vars();
		$cmd = $this->makeCommand('force_update',$vars);
		setxmlName('force_update_success');
		$res = $this->sendCommand($cmd);
		$flag = TRUE;
		if(!$this->isSuccess($res)) {
			write_flash_message('error_message', $this->getErrorMessage($res));
			$flag = FALSE;
		}
		return $flag;
	}
	
	public function fix_record($group,$name) {
		$vars = get_defined_vars();
		$cmd = $this->makeCommand('fix_record',$vars);
		setxmlName('fix_record_failed');
		$res = $this->sendCommand($cmd);
		$flag = TRUE;
		if(!$this->isSuccess($res)) {
			write_flash_message('error_message', $this->getErrorMessage($res));
			$flag = FALSE;
		}
		return $flag;
	}
	


}

