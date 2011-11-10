<?php

class People extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if (!isset($is_logged_in) || $is_logged_in != true)
		{
			$data['main_content'] = 'nopermsview';          // no permissions view
			$this->load->view('includes/template', $data);
		} else {
			return;
		}
	}

	function index()
	{
		$data['main_content'] = 'cards/peopleview.php';

		$this->load->model('People_model');
		$data['passthru'] = $this->People_model->get_people();
		$data['available_extensions'] = $this->People_model->get_available_extensions();
		$data['available_devices'] = $this->People_model->get_available_devices();

		$this->load->view('includes/header.php');
		$this->load->view('cards/peopleview.php',$data);
		$this->load->view('includes/footer.php');

	}

	function add_people()
	{

		// TODO: add form validation

		$this->load->model('People_model');
		$this->People_model->add_people();
		redirect('people');
	}

	function remove($id)
	{
		$this->load->model('People_model');
		$this->People_model->delete_person($id);
		redirect('people');
	}

	function update_people()
	{
		$this->load->model('People_model');
		$this->People_model->update_people($this->input->post('updateExtension_id'),$this->input->post('updateDevice_id'));
		redirect('people');
	}

}

?>
