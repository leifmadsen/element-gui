<?php

class Extensions extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}

	function index()
	{
		$data['main_content'] = 'cards/extensionview';

		$this->load->model('Extension_model');
		$data['passthru'] = $this->Extension_model->get_extensions();

		$this->load->view('includes/template', $data);
	}

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if (!isset($is_logged_in) || $is_logged_in != true)
		{
			$data['main_content'] = 'nopermsview';		// no permissions view
			$this->load->view('includes/template', $data);
		} else {
			return;
		}
	}

	function add_extension()
	{
		$this->is_logged_in();
		$this->load->model('Extension_model');

		// TODO: validate input
		$this->load->library('form_validation');
		$this->form_validation->set_rules('extension_number','Extension number','required|is_numeric');
		$this->form_validation->set_rules('extension_number','Extension number','callback_extension_check');

		if ($this->form_validation->run() == FALSE)
		{
			$data['main_content'] = 'cards/extensionview';
			$data['passthru'] = $this->Extension_model->get_extensions();
			$this->load->view('includes/template',$data);
		} else {
			$this->Extension_model->add_extension();
			redirect('extensions');
		}
	}

	function extension_check($str)
	{
		$result = $this->Extension_model->check_for_dupe($str);
		if ($result > 0)
		{	$this->form_validation->set_message('extension_check','The field %s contains a duplicate value. Please use another value');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function remove($extension_id)
	{
		$this->is_logged_in();
		$this->load->model('Extension_model');
		$this->Extension_model->remove_extension($extension_id);
		redirect('extensions');
	}
}

?>
