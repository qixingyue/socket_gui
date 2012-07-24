<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Settingm extends  MY_Model {
		
		public function queryGroup() {
			$cmd = $this->makeSimpleCommand('query_group');
			setxmlName("group_res_success");
			$res = $this->sendCommand($cmd);
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				return false;
			} 
			return $this->getData($res);
		}
		
		public function delGroup($name) {
			$cmd = $this->makeCommand('deltete_group',array('group'=>$name));
			setxmlName('delete_group_success');
			$res = $this->sendCommand($cmd);
			$flag = true;
			if(!$this->isSuccess($res)){
				write_flash_message('del_error', $this->getErrorMessage($res));
				$flag = false;
			}
			return $flag;
		}
		
		public function saveGroup($name,$description){
			$vars  = get_defined_vars();
			$cmd = $this->makeCommand('save_group',$vars);
			setxmlName('save_group_success');
			$res = $this->sendCommand($cmd);
			$flag = true ;
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				$flag = false;
			}
			return $flag;
		}
		
		public function queryGroupServers($name) {
			$cmd = $this->makeCommand('query_group_servers',array('name'=>$name));
			setxmlName('query_group_servers_success');
			$res = $this->sendCommand($cmd);
			$flag = true;
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				$flag = false;
			} else {
				$flag = $this->getData($res);
			}
			return $flag;
		}
		
		public function delete_group_server($group,$type,$name) {
			$cmd = $this->makeCommand('delete_group_server',array('group'=>$group,'type'=>$type,'name'=>$name));
			setxmlName('delete_group_server_success');
			$res = $this->sendCommand($cmd);
			$flag = true;
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				$flag = false;
			}
			return $flag;
		}
		
		public function checkConnect($sourcedb,$downstreamdb,$type) {
			$cmd =	$this->makeCommand('test_capture_db',array('sourcedb'=>$sourcedb,'downstreamdb'=>$downstreamdb,'type'=>$type));
			setxmlName('test_capture_db_success');
			$res = $this->sendCommand($cmd);
			$flag = true;
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				$flag = FALSE;
			}
			return $flag;
		}
		
		
		public function query_db_users($type,$user,$password,$tns){
			
			$cmd = $this->makeCommand('query_db_user',get_defined_vars());
			setxmlName('query_db_user_success');
			$res = $this->sendCommand($cmd);
			$users = array();
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
			} else {
				$users = $this->getData($res);
				$tmp = array();
				foreach ($users->schema as $user) {
					$tmp[] = $user . "";
				}
				$users = $tmp;
			}
			return $users;
		}
		
		public function add_capture($group,$name,$type,$sourcedb,$downstreamdb,$node1diaray_path,$node2diaray_path,$users) {
			$cmd = $this->makeCommand('add_capture',get_defined_vars());
			setxmlName('add_capture_success');
			$res = $this->sendCommand($cmd);
			$flag = $this->isSuccess($res);
			if($flag == FALSE) {
				write_flash_message('error_message', $this->getErrorMessage($res));
			}
			return $flag;
		}
		
		public function check_loader_connect($type,$user,$password,$tns) {
			$cmd = $this->makeCommand('check_loader_connect',get_defined_vars());
			setxmlName('lodaer_connect_success');
			$res = $this->sendCommand($cmd);
			$flag = $this->isSuccess($res);
			if($flag == FALSE) {
				write_flash_message('error_message', $this->getErrorMessage($res));
			}
			return $flag;
		}
		
		public function save_loader($group,$server,$skip_taged,$auto_fix,$skip_error,$delay_alter,$include_schemas,$excludeschemas){
			$cmd = $this->makeCommand('save_loader',get_defined_vars());
			setxmlName('save_loader_success');
			$res = $this->sendCommand($cmd);
			$flag = $this->isSuccess($res);
			if($flag == FALSE) {
				write_flash_message('error_message', $this->getErrorMessage($res));
			}
			return $flag;
		}

		public function save_bakeup($group,$server,$skip_taged,$auto_fix,$skip_error,$delay_alter,$include_schemas,$excludeschemas,$savedays) {
			$cmd = $this->makeCommand('save_bakeup',get_defined_vars());
			setxmlName('save_bakeup_success');
			$res = $this->sendCommand($cmd);
			$flag = $this->isSuccess($res);
			if($flag == FALSE) {
				write_flash_message('error_message', $this->getErrorMessage($res));
			}
			return $flag;
		}
		
		public function test_capture_db($type,$sourcedb,$downstreamdb) {
			$cmd = $this->makeCommand('test_capture_db',get_defined_vars());
			setxmlName('test_capture_db_success');
			$res = $this->sendCommand($cmd);
			$flag = $this->isSuccess($res);
			if($flag == FALSE) {
				write_flash_message('error_message', $this->getErrorMessage($res));
				//write_flash_message('error_message', $sourcedb['password']);
			}
			return $flag;
		}
		
		
		public function query_capture($group,$name) {
			$cmd = $this->makeCommand('query_capture',array("group"=>$group,"name"=>$name));
			setxmlName('query_capture_success');
			$res = $this->sendCommand($cmd);
			$users = array();
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
			} else {
				$capture = $this->getData($res);
			}
			return $capture;
		}
		
		public function query_apply_config($group,$name) {
			$cmd = $this->makeCommand('query_apply_config',array("group"=>$group,"name"=>$name));
			setxmlName('query_apply_config_success');
			$res = $this->sendCommand($cmd);
			$app = array();
			if(!$this->isSuccess($res)) {
				write_flash_message('error_message', $this->getErrorMessage($res));
			} else {
				$app = $this->getData($res);
			}
			return $app;
		}
	}
	
	
	
	