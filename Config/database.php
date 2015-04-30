<?php
class DATABASE_CONFIG {


	
		/*
	 * Read updates from private config file
	 * app/Config/private.php
	 */
        public function __construct() {
	        $this->test = Configure::read('database.test');
	        $this->default = Configure::read('database.default');
	}
	
}
