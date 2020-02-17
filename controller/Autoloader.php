<?php 

namespace Projet5\Model;

/** 

* Class Autoloader

* Used to load class automatically
 
**/

class Autoloader {

	static function register() {
		spl_autoload_register([__CLASS__, 'autoload']);
	}


	static function autoload($class) {
		if (strpos($class, __NAMESPACE__ . '\\') == 0) {

			$class = str_replace(__NAMESPACE__ . '\\', '', $class);
			
			require 'model/' . $class . '.php';
		}
	}
}

