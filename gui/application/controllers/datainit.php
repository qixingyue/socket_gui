<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Datainit extends MY_Controller {
		
		public function __construct() {
							
			parent::__construct($this);
			$this->load->model('datainitm');
		}
		
		public function index() {
			
			$status;
			if(($status = $this->datainitm->queryinit())!=FALSE){
				
				$s = $status['status'] . "";
				if($s == "init") {
					$this->jump("datainit/status");
				}
				
			}
			
			
			/**
			 * 
			 * 缺少一个命令，当数据初始化过程中，只显示状态
			 * 
			 */
			if($this->ispostback()) {

				$fw = $this->input->post('tbfw');
				$fw = explode("\n", $fw);
				$sourcedb = $this->mpost(array('sourcedb','sourceuser','sourcepwd'));
				$targetdb = $this->mpost(array('targetdb','targetuser','targetpwd'));
				$bftask = $this->input->post('bftask');
				$singletask = $this->input->post('singletask');
				$ttable = $this->input->post('truncate_table');
				$create_index = $this->input->post('create_index');
				$backscn = $this->input->post('fbs');
				if($this->datainitm->createinit($sourcedb,$targetdb,$fw,$bftask,$singletask,$ttable,$create_index,$backscn)){
					$this->save("current_init",array("sourcedb"=>$sourcedb,"targetdb"=>$targetdb,"fw"=>implode("\n", $fw),"bftask"=>$bftask,"singletask"=>$singletask,
						"ttable"=>$ttable,"create_index"=>$create_index,"backscn"=>$backscn
					));
					$this->refresh(site_url('datainit/status'));
					return;
				}
			}
			$this->load->view('initconfig');
		}
		
		/**
		 * 状态查询
		 */
		public function status() {
			$vars = $this->get("current_init");
			$this->load->model("datainitm");
			$tmp = array();
			foreach ($vars as $k=>$v) {
				$tmp[$k] = $v;
			}
			$this->load->view('initstatus',$tmp);
		}
		
	}

	