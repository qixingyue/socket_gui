<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends  MY_Controller {

	public function __construct() {
		parent::__construct($this);
	}

	public function index() {
		$this->jump("status");
	}

	public function login() {
		if($this->ispostback()) {
			extract($this->mpost(array('username','password')));
			$n = $this->input->post('code');
			$this->load->model('user');
			if(check_code($n) && $this->user->checkUser($username,$password)) {
				$this->load->library('session');
				$this->session->set_userdata('current_socket_user',json_encode(array('username'=>$username,'password'=>$password)));
				return $this->jump('main/index');
			}
		}
		$this->load->view('login');
	}

	public function logout(){
		$this->load->library('session');
		$this->session->set_userdata('current_socket_user',json_encode(''));
		$this->login();
	}



	public function mainv() {
		$this->load->view('mainv');
	}

	public function chart($group,$name,$type) {
		$this->load->model("statusm");
		if($type == "capture" ) {
			$status = $this->statusm->query_capture_status($group,$name);
		}elseif ($type == "loader") {
			$status = $this->statusm->query_loader_status($group,$name);
		}else {
			$status = $this->statusm->query_simulator_status($group,$name);
		}
		$i=$u=$d=$dl=array();
		$s = isset($status->history_op->op_node) ? $status->history_op->op_node : array();
		foreach ($s as $j) {
			$i[]= (int) $j->op_insert ;
			$u[]=(int)$j->op_update;
			$d[]=(int)$j->op_delete;
			$dl[] = (int)$j->op_ddl;
		}
		drawChart($i,$u,$d,$dl);
	}

}