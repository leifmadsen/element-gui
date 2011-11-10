<?php

class Devices extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}

	function index()
	{
		$data['main_content'] = 'cards/deviceview';

		$this->load->model('Device_model');
		$data['passthru'] = $this->Device_model->get_devices();

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

	function add_device()
	{
		$this->is_logged_in();
		$this->load->model('Device_model');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('mac_address','MAC Address','required|min_length[12]|max_length[12]');
		$this->form_validation->set_rules('password_input','password','required|min_length[8]');
		$this->form_validation->set_rules('mac_address','MAC Address','callback_check_for_dupe');
		$this->form_validation->set_rules('password_input','Password','callback_check_password');
		$this->form_validation->set_rules('dev_description','Description','max_length[64]');
		if ($this->form_validation->run() == FALSE)
		{
			$data['main_content'] = 'cards/deviceview';
			$data['passthru'] = $this->Device_model->get_devices();
			$this->load->view('includes/template',$data);
		} else {
			$this->Device_model->add_device();
			redirect('devices');
		}
	}

	function check_for_dupe($str)
	{
		$result = $this->Device_model->check_for_dupe($str);
		if ($result > 0)
		{
			$this->form_validation->set_message('check_for_dupe','The field %s contains a duplicate value. Please use another value.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function check_password($str)
	{
		$password = $this->input->post('password_input');
		$pass_confirm = $this->input->post('password_verify');

		if ($password != $pass_confirm)
		{
			$this->form_validation->set_message('check_password','The passwords do not match.');
			return FALSE;
		} else {
			return TRUE;
		}
	}


	function remove($device_id)
	{
		$this->is_logged_in();

		if (!isset($device_id)) {
			echo "No device id found to remove.";
		} else {
			$this->load->model('Device_model');
			$this->Device_model->remove_device($device_id);

			redirect('devices');
		}
		
	}
}

?>
