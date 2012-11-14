<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class CI_Saver {
		
		static $opend = FALSE;
		
		public function __construct(){
			if( self::$opend == FALSE ) {
				session_start();
				self::$opend = TRUE;
			}
		}
		
		public function set($k,$v){
			$_SESSION[$k] = serialize($v);
		}
		
		
		public function get($k) {
			return isset($_SESSION[$k]) ? unserialize($_SESSION[$k]) : NULL;
		}
		
		
		/**
		 * 清除单条记录
		 * @param string $n 名称
		 */
		public function remove($n) {
			if(isset($_SESSION[$n])) {
				unset($_SESSION[$n]);
			}
		}
		
		public function clear($n) {
			if(is_array($n)) {
				foreach ($array_expression as $value) {
					$this->remove($n);
				}
			}
		}
		
	}