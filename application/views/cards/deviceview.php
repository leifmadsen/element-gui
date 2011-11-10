<div class="container_12" style="margin-top: 125px">
	<div class="grid_4 card">
		<!-- TODO: Need to fix these to not just be subdirs, but rather the right full path -->
		<a href="cards" style="color: #000; margin-left: 10px;">&lt;&lt; Return To Cards</a>
		<a href="extensions" style="color: #000; margin-right: 10px; float: right">Create Extensions &gt;&gt;</a>
	</div>
	<div style="clear: both;">&nbsp;</div>
	<div class="grid_4 card">
			<?php 
				$fieldset_attributes = array( 'class' => 'create_device_fieldset');
				echo form_fieldset('Add New Device', $fieldset_attributes);
			?>
			<?php echo form_open('devices/add_device'); ?>

			<?php 
				$attributes = array(
						'class' => 'create_device_label',
						'onFocus' => "this.value=''"
				);
				echo form_label('MAC Address: ', 'mac_address', $attributes);
			?>
			
			<?php 
				$data = array(
						'name' => 'mac_address',
						'value' => set_value('mac_address','0004F2040001'),
						'maxlength' => '12',
						'size' => '12',
						'class' => 'create_device_input',
						'onFocus' => "this.value=''"
				);
				echo form_input($data);
			?>
			<br />
			<?php
				echo form_label('Password: ', 'password_input', $attributes);
				$data = array(
						'name' => 'password_input',
						'value' => 'welcome',
						'maxlength' => '128',
						'size' => '16',
						'class' => 'create_device_input',
						'onFocus' => "this.value=''"
				);
				echo form_password($data);
			?>
			<br />
			<?php
				echo form_label('Confirm: ', 'password_verify', $attributes);
				$data = array(
						'name' => 'password_verify',
						'value' => 'welcome',
						'maxlength' => '128',
						'size' => '16',
						'class' => 'create_device_input',
						'onFocus' => "this.value=''"
				);

				echo form_password($data);
			?>
			<br />
			<?php 
				$attributes = array(
						'class' => 'create_device_label',
						'onFocus' => "this.value=''"
				);
				echo form_label('Description: ', 'dev_description', $attributes);
			?>
			<?php 
				$data = array(
						'name' => 'dev_description',
						'value' => set_value('dev_description','Device at reception'),
						'maxlength' => '64',
						'size' => '24',
						'class' => 'create_device_input',
						'onFocus' => "this.value=''"
				);
				echo form_input($data);
			?>
			<br />
			<?php
				echo form_label('Template: ', 'device_template', $attributes);

				$options = array(
						'standard' => 'Standard (default)',
						'polycom_static_ip' => 'Polycom Static IP'
				);

				echo form_dropdown('which_template', $options, 'standard');
			?>
			<br /><br />
			<?php
				$data = array('name' => 'submit_new_device', 'value' => 'Create');
				echo form_submit($data);
			?>
			<?php echo form_close(); ?>
			<?php echo form_fieldset_close(); ?>
	</div>

	<div class="grid_6 card">
		<?php
			$fieldset_attributes = array( 'class' => 'list_device_fieldset');
			echo form_fieldset('Currently Provisioned Devices', $fieldset_attributes);
		?>
		<table class="devices" cellspacing="0">
			<tr><td class="hed">Device Name</td><td class="hed">Template</td><td class="hed">IP Address</td><td class="hed">Description</td><td class="hed">&nbsp;</td></tr>	
		<?php
			$flip = 0;
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
						<td class="<?php echo $class; ?>"><?php echo $data->name; ?></td>
						<td class="<?php echo $class; ?>"><?php echo $data->template; ?></td>
						<td class="<?php echo $class; ?>"><?php echo $data->ipaddr; ?></td>
						<td class="<?php echo $class; ?>"><?php echo $data->device_description; ?></td>
						<td class="<?php echo $class; ?>" style="text-align: center"><a href="devices/remove/<?php echo $data->id; ?>" style="font-size: 1.5em; font-style: bold; color: red;">x</a></td>
					</tr>
		<?php
			endforeach;
		?>
		</table>
	</div>
<div style="margin-left: 10px; position: absolute; top: 380px; width: 300px;"><?php echo validation_errors(); ?></div>
</div>

