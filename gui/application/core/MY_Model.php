<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	/**
	 * 向socket发送数据
	 * @param string $command 消息信息
	 * @return string 返回从socket端接收到的消息
	 */
	public function sendCommand($cmd) {
		$ip = config_item('ip');
		$point = config_item('point');
		$socket = socket_create ( AF_INET, SOCK_STREAM, SOL_TCP ) or die ( 'could not create socket' );
		$connect = socket_connect ( $socket, $ip, $point );
		//向服务端发送数据
		$this->fiterSpaceCmd($cmd);
		if(function_exists('ifDebug')){
			ifDebug($cmd);
		}
		socket_write ( $socket, $cmd );
		//接受服务端返回数据
		$response = "";
		do {
			$msg =	socket_read ( $socket, 1024 );
			$response .= $msg;
		} while ($msg!="") ;

		//关闭
		socket_close($socket);
		return $response;
	}

	public function fiterSpaceCmd(&$cmd) {
		$lines = explode("\n", $cmd);
		$cmd = "";
		foreach ($lines as $line) {
			$cmd .=  trim($line);
		}
		$cmd .= "\n";
		return $cmd;
	}
	
	protected function getData($res) {
		$xml = simplexml_load_string($res);
		if(property_exists($xml, 'return_data'))
			return $xml->return_data;
		else 
			return NULL;
	}
	
	protected function isSuccess($res) {
		$xml = simplexml_load_string($res);
		$success = 	"" . $xml->command_return == "SUCCESS";
		return $success;
	}
	
	
	protected function getErrorMessage($res) {
		$xml = simplexml_load_string($res);
		return $xml->return_data->error_message . "";
	}
	
	protected function makeSimpleCommand($command) {
		return $this->makeCommand('simple_command',array('command'=>$command));
	}
	
	protected function makeCommand($command,$params = array()){
		return $this->load->loadxml($command,$params);
	}
	

}
