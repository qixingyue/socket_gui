<?php

	class Test extends MY_Controller {
		
		public function __construct() {
			parent::__construct($this);
		}
		
		public function index() {
			$this->load->view("welcome");
		}
		
		public function show() {
			echo $this->get("Hello");
		} 
	}