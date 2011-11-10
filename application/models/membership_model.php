<?php

class Membership_model extends CI_Model {

	function validate()
	{
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		$this->db->select('first_name')->where('username', $this->input->post('username'));
		$query = $this->db->get('membership');

		if ($query->num_rows == 1)
		{
			$data['have_user'] = true;
			$row = $query->row_array();
			$data['first_name'] = $row['first_name'];
			return $data;
		} else {
			$data['have_user'] = false;
			return $data;
		}
	}
}
?>
