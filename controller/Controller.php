<?php  

use Projet5\Model\Autoloader;

require_once('Autoloader.php');

class Controller {

	public function __construct() {
		Autoloader::register();
	}

	public function valid_data($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        
        return $data;
    }

}
