<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class MY_Exceptions extends CI_Exceptions {
		
		public function __construct(){
			if(ENVIRONMENT != 'development') {
				$ci = & get_instance();
				if(!function_exists('base_url'))
					$ci->load->helper('url');
				header('location:'. base_url());
				exit();
			} else {
				parent::__construct();
			}
			
		}
		
		
		public function show_php_error($severity, $message, $filepath, $line) {
			return;
		}
	}