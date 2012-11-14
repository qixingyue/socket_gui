<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Setting extends MY_Controller {
		
		public function __construct() {
			parent::__construct($this);
			$this->load->model('settingm');
		}
		
		public function index(){
			$groups = $this->settingm->queryGroup();
			$this->load->view('settingmange',array('groups'=>$groups,'error'=>$groups === FALSE));
		}
		
		public function delgroup($groupName) {
			$this->settingm->delGroup($groupName);
		    $this->index();
		}
		
		public function addgroup() {
			$current_group = array('group'=>'','description'=>'');
			
			if($this->ispostback()) {
				$current_group = $this->mpost(array('group','description'));
				extract($current_group);
				if($this->settingm->saveGroup($group,$description)){
					redirect("setting/addcapture/$group");
				}
			}
			$this->load->view('addgroup',array('current_group'=>$current_group));
		}
		
		public function editgroup($name){
			$current_group = $this->settingm->queryGroupServers($name);
			if($this->ispostback()) {
				$cu = $this->mpost(array('group','description'));
				extract($cu);
				if($this->settingm->saveGroup($group,$description))
					return redirect('setting/editgroup/'. $group);	
				$current_group->group = $group;
				$current_group->description = $description;
			}
			$this->load->view('editgroup',array('current_group'=>$current_group));
		}
		
		
		public function delserver($group,$type,$servername) {
			 $this->settingm->delete_group_server($group,$type,$servername);
			 return $this->editgroup($group);
		}
		
		public function editserver($group,$type,$servername) {
			if($type == "capture") {
				$this->jump("setting/edit_capture/$group/$servername");
			}elseif ($type == "loader") {
				$this->jump("setting/edit_loader/$group/$servername");
			}elseif ($type == "loader+TCDP") {
				$this->jump("setting/edit_bakeup/$group/$servername");
			}else {
				show_404("Not found!");
			}
		}
		
		public function edit_capture($group,$name) {
			if($this->ispostback()) {
				return	$this->addcapture($group);
			}
			$capture = $this->settingm->query_capture($group,$name);
			
			$this->load->view("edit_capture",array("capture"=>$capture,));
		}
		
		public function edit_loader($group,$name){
			if($this->ispostback()) {
				return $this->addloader($group);
			}
		    $app = $this->settingm->query_apply_config($group,$name);
			$this->load->view("edit_loader",array("app"=>$app));
		}
		
		public function edit_bakeup($group,$name) {
			if($this->ispostback()) {
				return $this->addbakeup($group);
			}
			$app = $this->settingm->query_apply_config($group,$name);
			$this->load->view("edit_bakeup",array("app"=>$app));
		}
		
		
		public function addcapture($group=""){
			
			if($this->ispostback()) {

				$name = $this->input->post("name");
				$type = $this->input->post("dbtype");
				
				$fwuser = $this->input->post('fwusers');
				$fwuser = $fwuser ==  "" ? array(): $fwuser;
				
				$offline = $this->input->post("offline");
				$offline = $offline ? true : false;
				
				$sourcedb = array("user"=>$this->input->post("user"),"password"=>$this->input->post("loginpassword"),"tns1"=>$this->input->post("tns1"),"tns2"=>$this->input->post("tns2"));
				$downstreamdb = array("user"=>$this->input->post("db_user"),"password"=>$this->input->post("password2"),"tns"=>$this->input->post("tns3"));
				
				$node1diaray_path = $this->input->post("log1");
				$node2diaray_path = $this->input->post("log2");
				
				$users = $fwuser;
			
				if($this->settingm->add_capture($group,$name,$type,$sourcedb,$downstreamdb,$node1diaray_path,$node2diaray_path,$users)){
					redirect(site_url("setting/editgroup/".$group));
				}
				
			}
			$this->load->view('addcapture',array('group'=>$group));
		}
		
		public function addloader($group){
			if($this->ispostback()) {
				
				extract($this->_get_include_reject());
				
				$server = array("name"=>$this->input->post("name"),
							"db_type"=>$this->input->post("dbtype"),"db_user"=>$this->input->post("user"),
							"password"=>$this->input->post("password"),"tns"=>$this->input->post("tns"),
				);
				$delay_alter = $this->input->post("delay");
				$skip_taged = $this->input->post("skiptag") == "on";
				$skip_error = $this->input->post("dealWay");
				$auto_fix = $skip_error == "auto_fix";
				
				if($this->settingm->save_loader($group,$server,$skip_taged,$auto_fix,$skip_error,$delay_alter,$include,$reject)){
					$this->jump("setting/editgroup/".$group);
				}
				
			}
			$this->load->view('addloader',array("group"=>$group));
		}
		
		
		private function _get_include_reject(){
				$include = $reject = array();
				$obj = $this->input->post("include") == "" ? array() : $this->input->post("include");
				foreach ($obj as $i) {
					$m = explode("\n", $i);
					$i = implode(REPLACEENTER, $m);
					$include[] = json_decode($i);
				}
				$obj = $this->input->post("reject") == "" ? array() : $this->input->post("reject");
				foreach ($obj as $i) {
					$m = explode("\n", $i);
					$i = implode(REPLACEENTER, $m);
					$reject[] = json_decode($i);
				}
				return array("include"=>$include,"reject"=>$reject);
		}
		
		public function addbakeup($group){
			if($this->ispostback()) {
				extract($this->_get_include_reject());
				$server = array("name"=>$this->input->post("name"),"type"=>$this->input->post("server_type"),
							"db_type"=>$this->input->post("dbtype"),"db_user"=>$this->input->post("user"),
							"password"=>$this->input->post("password"),"tns"=>$this->input->post("tns"),
				);
				$delay_alter = $this->input->post("delay");
				$skip_taged = $this->input->post("skiptag") == "on";
				$skip_error = $this->input->post("dealWay");
				$auto_fix = $skip_error == "auto_fix";
				$savedays = $this->input->post("savedays");
				
				if($this->settingm->save_bakeup($group,$server,$skip_taged,$auto_fix,$skip_error,$delay_alter,$include,$reject,$savedays)){
					$this->jump("setting/editgroup/".$group);
				}
			}
			$this->load->view('addbakeup',array("group"=>$group));
		}
		
		public function addinclude() {
			$this->load->view("addinclude");
		}
		
		public function addreject() {
			$this->load->view("addreject");
		}
	}