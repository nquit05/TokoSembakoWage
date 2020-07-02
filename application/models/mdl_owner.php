<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_owner extends CI_Model {
	
	function __construct()
	{
		$this->load->database();
	}

	function get_owner(){
		$table ="OWNER";
		return $table;
	}

}

?>