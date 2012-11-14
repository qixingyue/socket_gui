<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User extends  MY_Model {
		
		public function checkUser($username,$pwd) {
			extract(config_item('adminuser'));
			if(!($username == $username && $pwd == $password)){
				write_flash_message('error_message', "用户名或密码错误！");
				return FALSE;
			}
			return TRUE;
		}
		
	}

	