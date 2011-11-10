<?php

class Device_model extends CI_Model {

	function get_devices()
	{
		$query = $this->db->get('sip_devices');
		return $query->result();
	}

	function add_device()
	{
		$this->name = $this->input->post('mac_address');
		$this->secret = $this->input->post('password_input');
		$this->template = $this->input->post('which_template');
		$this->device_description = $this->input->post('dev_description');
		$this->db->insert('sip_devices', $this);
		return;
	}

	function remove_device($device_id)
	{
		$this->db->where('id', $device_id);
		$this->db->delete('sip_devices');
		return;
	}

	function check_for_dupe($mac_address)
	{
		$this->db->where('name',$mac_address);
		$result = $this->db->get('sip_devices');
		return $result->num_rows();
	}
}

?>
