<div class="container_12" style="margin-top: 125px;">
	<div class="grid_4 card">
		<a href="cards" style="color: #000; margin-left: 10px">&lt;&lt; Back To Cards</a>
	</div>
	<div style="clear: both;">&nbsp;</div>
	<div class="grid_4 card">
		<?php
			$fieldset_attributes = array( 'class' => 'create_device_fieldset');
			echo form_fieldset('Add New Person', $fieldset_attributes);
		?>
		<?php echo form_open('people/add_people'); ?>

		<?php
			$attributes = array(
						'class' => 'create_device_label',
						'onFocus' => "this.value=''",
			);
			echo form_label('First Name: ', 'first_name', $attributes);

			$data = array(
					'name' => 'first_name',
					'value' => 'Elle',
					'maxlength' => '32',
					'size' => '25',
					'class' => 'create_device_input',
					'onFocus' => "this.value=''"
			);
			echo form_input($data);
		?>
		<br />
		<?php
			$attributes = array(
						'class' => 'create_device_label',
						'onFocus' => "this.value=''"
			);
			echo form_label('Last Name: ', 'last_name', $attributes);

			$data = array(
					'name' => 'last_name',
					'value' => 'Mint',
					'maxlength' => '32',
					'size' => '25',
					'class' => 'create_device_input',
					'onFocus' => "this.value=''"
			);
			echo form_input($data);
		?>
		<br />
		<?php
			$attributes = array(
						'class' => 'create_device_label',
						'onFocus' => "this.value=''"
			);
			echo form_label('Email: ', 'email_addr', $attributes);

			$data = array(
					'name' => 'email_addr',
					'value' => 'elle.mint@domain.tld',
					'maxlength' => '64',
					'size' => '25',
					'class' => 'create_device_input',
					'onFocus' => "this.value=''"
			);
			echo form_input($data);
		?>
		<br />
		<?php

			$attributes = array(
						'class' => 'create_device_label',
						'onFocus' => "this.value=''"
			);
			echo form_label('Extension: ', 'extension_number', $attributes);

			if (!empty($available_extensions)) {

				foreach($available_extensions as $extension):
					$extensions[$extension->extensions_id] = $extension->extension_number;
				endforeach;
				$extensions['not_set'] = '';
				echo form_dropdown('thisExtensionNumber', $extensions);
				echo "<br />";

			} else {
				$extensions['not_set'] = '';
				echo '<p style="text-align: left; border: 0px; margin: 0px 0px 0px 0px; width: 150px; height: 20px; padding: 0px 0px 0px 0px;">No Extensions Available</p>';
			}
		?>
		<?php

			$attributes = array(
						'class' => 'create_device_label',
						'onFocus' => "this.value=''"
			);
			echo form_label('Device: ', 'device', $attributes);

			if (!empty($available_devices)) {
				foreach($available_devices as $device):
					$devices[$device->sip_device_id] = $device->device_description;
				endforeach;
				$devices['not_set'] = '';
				echo form_dropdown('thisDevice', $devices);
			} else {
				$devices['not_set'] = '';
				echo '<p style="text-align: left; border: 0px; margin: 0px 0px 0px 0px; width: 150px; height: 20px; padding: 0px 0px 0px 0px;">No Devices Available</p>';
			}

		?>
		<br />
		<?php
			$data = array('name' => 'submit_new_person', 'value' => 'Create');
			echo form_submit($data);
			echo form_close();
		?>
	</div>
	<div class="grid_8 card">
		<?php
			echo form_open('people/update_people');
			$fieldset_attributes = array('class' => 'list_device_fieldset');
			echo form_fieldset('List of People', $fieldset_attributes);
		?>

		<table class="devices" cellspacing="0">
			<tr>
				<td class="hed">Name</td>
				<td class="hed">Email</td>
				<td class="hed">Extension</td>
				<td class="hed">Device</td>
				<td class="hed">&nbsp;</td>
			</tr>
		<?php
			$flip="0";
			foreach($passthru as $data):
				if ($flip == 0) {
					$class = "lite";
					$flip++;
				} else {
					$class = "";
					$flip--;
				}
		?>
			<tr>
				<td class="<?php echo $class; ?>"><?php echo $data->first_name; ?>&nbsp;<?php echo $data->last_name; ?></td>
				<td class="<?php echo $class; ?>"><?php echo $data->email; ?></td>
				<td class="<?php echo $class; ?>"><?php 
									$thisExtenList = array();
									$thisExtenList = array_combine(array_keys($extensions), $extensions);

									if (isset($data->extension_number)) {
										$thisExtenList[$data->extensions_id] = $data->extension_number;
									}

									$thisExtenList['not_set'] = '';

									if (isset($data->extension_number)) {
										echo form_dropdown('updateExtension_id['.$data->people_id.']',$thisExtenList,$data->extensions_id);
									} else {
										echo form_dropdown('updateExtension_id['.$data->people_id.']',$thisExtenList,'not_set');
									}
								?></td>
				<td class="<?php echo $class; ?>"><?php 
									// Create an array based on the data returned from the database
									$thisDevList = array();
									$thisDevList = array_combine(array_keys($devices), $devices);

									// If $data->name is set, which contains the devices MAC address value, then add it to the list.
									// We want to make sure they have the option of setting it to the existing value.
									if (isset($data->device_description)) {
										
										$thisDevList[$data->device_id] = $data->device_description;
									}

									// Add a blank 'not_set' value for unassigning devices
									$thisDevList['not_set'] = '';

									// If we have an existing value, select it, otherwise select the 'not_set' value by default
									if (isset($data->device_description)) {
										echo form_dropdown('updateDevice_id['.$data->people_id.']',$thisDevList,$data->device_id);
									} else {
										echo form_dropdown('updateDevice_id['.$data->people_id.']',$thisDevList,'not_set');
									}
								?></td>
				<td class="<?php echo $class; ?>" style="text-align: center"><a href="people/remove/<?php echo $data->people_id; ?>" style="color: red; font-size: 1.5em; font-style: bold">x</a></td>
			</tr>
		<?php
			endforeach;
		?>
		</table>
		<?php 
			$data = array('name' => 'submit_update_people', 'value' => 'Update');
			echo form_submit($data);
			echo form_close();
		?>
	</div>
<div style="margin-left: 10px; position: absolute; top: 270px; width: 300px;"><?php echo validation_errors(); ?></div>
</div>
