<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Xmlreturn extends MY_Controller {

	public function __construct() {
		parent::__construct($this);
	}

	public function getxml($xmlName="") {
		$this->load->view($xmlName);
	}

}