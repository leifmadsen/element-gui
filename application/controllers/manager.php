<?php
class Manager extends CI_Controller {

	function index()
	{
		$this->load->view('loginview');
	}

	function cards()
	{
		$this->load->view('cardview');
	}

}

?>
