<?php

class Login extends CI_Controller {

	function index()
	{
		$data['main_content'] = 'loginview';
		$this->load->view('includes/template', $data);
	}

	function validate_credentials()
	{
		$this->load->model('membership_model');
		$query = $this->membership_model->validate();

		if ($query['have_user'])	// if the user's credentials validated...
		{
			$data = array(
				'username' => $this->input->post('username'),
				'first_name' => $query['first_name'],
				'is_logged_in' => true
			);

			$this->session->set_userdata($data);
			redirect('cards');
		}
		else
		{
			$data['main_content'] = 'loginview';
			$data['passthru'] = 'No data returned or invalid login credentials.';
			$this->load->view('includes/template',$data);
		}
	}
}

?>
