<?php

class People_model extends CI_Model {

	function get_people()
	{
		// select people.first_name, people.last_name, extensions.extension_number, sip_devices.name 
		// from people 
		// left join extensions on extensions.people_id = people.id left 
		// left join sip_devices on people.sip_device_id = sip_devices.id;

		$this->db->select('people.id as people_id, people.first_name, people.last_name, people.email, extensions.extension_number, extensions.id as extensions_id, sip_devices.name, sip_devices.device_description, sip_devices.id as device_id')->from('people')->join('extensions','extensions.people_id = people.id','left')->join('sip_devices','people.sip_device_id = sip_devices.id','left')->order_by('extensions.extension_number','asc');
		$query = $this->db->get();
		return $query->result();
	}

	function get_available_extensions()
	{
		$query = $this->db->query('select extensions.id as extensions_id, extensions.extension_number, people.id as people_id from extensions left join people on extensions.people_id = people.id where extensions.people_id IS NULL order by extensions.extension_number ASC');
		return $query->result();
	}

	function get_available_devices()
	{
		$query = $this->db->query('select sip_devices.id as sip_device_id, sip_devices.name, sip_devices.device_description, people.id as people_id from sip_devices left join people on sip_devices.id = people.sip_device_id where people.sip_device_id IS NULL order by sip_devices.name ASC');
		return $query->result();
	}

	function add_people()
	{
		$dataForPeople = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'email' => $this->input->post('email_addr'),
					'sip_device_id' => $this->input->post('thisDevice')
		);

		$this->db->insert('people',$dataForPeople);
		$people_id = $this->db->insert_id();


		$dataForExtensions = array(
						'people_id' => $people_id
		);
		$extension_id = $this->input->post('thisExtensionNumber');
		$this->db->where('id',$extension_id);
		$this->db->update('extensions',$dataForExtensions);
		return;
	}

	function delete_person($people_id)
	{
		$this->db->trans_start();
		$this->db->query("UPDATE extensions SET people_id = NULL WHERE people_id = '$people_id'");
		$this->db->query("DELETE FROM people WHERE id = '$people_id'");
		$this->db->trans_complete();
	}

	function update_people($extensions,$devices) {
		$this->db->trans_start();

		foreach($extensions as $people_id => $extension_id):
			if ($extension_id == 'not_set') {
				$this->db->query("UPDATE extensions SET people_id = NULL WHERE people_id = '$people_id'");
			} else {
				$this->db->query("UPDATE extensions SET people_id = NULL WHERE people_id = '$people_id'");
				$this->db->query("UPDATE extensions SET people_id = '$people_id' WHERE id = '$extension_id'");
			}
		endforeach;

		foreach($devices as $people_id => $device_id):
			if ($device_id == 'not_set') {
				$this->db->query("UPDATE people SET sip_device_id = NULL where id = '$people_id'");
			} else {
				$this->db->query("UPDATE people SET sip_device_id = NULL where id = '$people_id'");
				$this->db->query("UPDATE people SET sip_device_id = '$device_id' WHERE id = '$people_id'");
			}
		endforeach;

		$this->db->trans_complete();
	}
}

?>
