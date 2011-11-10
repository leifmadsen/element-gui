<?php

class Cards extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}

	function index()
	{
		$data['main_content'] = 'cardview';
		$this->load->view('includes/template', $data);
	}

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if (!isset($is_logged_in) || $is_logged_in != true)
		{
			$data['main_content'] = 'nopermsview';
			$this->load->view('includes/template', $data);
		}
	}

	function opencard()
	{
		$which_card = $this->input->post('which_card');
		if (isset($which_card))
		{
			redirect($which_card);
		} else {
			echo "No data received.";
		}
	}
}

?>
