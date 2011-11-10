<?php

class Extension_model extends CI_Model {

	function get_extensions()
	{
		// select extensions.extension_number, people.first_name, people.last_name, sip_devices.name from extensions left join people on extensions.people_id = people.id left join sip_devices on people.sip_device_id = sip_devices.id;
		$this->db->select('extensions.id,extensions.extension_number,people.first_name,people.last_name,sip_devices.name')->from('extensions')->join('people','extensions.people_id = people.id','left')->join('sip_devices','people.sip_device_id = sip_devices.id','left')->order_by('extensions.extension_number','asc');
		$query = $this->db->get();
		return $query->result();
	}

	function add_extension()
	{
		$this->extension_number = $this->input->post('extension_number');
		$this->db->insert('extensions', $this);
		return;
	}

	function remove_extension($extension_id)
	{
		// TODO: Perhaps do some sort of validate here. Return useful data. No duplicate extensions allowed.

		// Delete this extension
		$this->db->where('id', $extension_id);
		$this->db->delete('extensions');
	}

	function check_for_dupe($extension_number)
	{
		$this->db->where('extension_number',$extension_number);
		$result = $this->db->get('extensions');
		return $result->num_rows();
	}

}

?>
