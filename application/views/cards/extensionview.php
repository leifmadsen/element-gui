<div class="container_12" style="margin-top: 125px;">
	<div class="grid_4 card">
		<a href="cards" style="color: #000; margin-left: 10px">&lt;&lt; Back To Cards</a>
		<a href="people" style="color: #000; margin-right: 10px; float: right">Add People &gt;&gt;</a>
	</div>
	<div style="clear: both;">&nbsp;</div>
	<div class="grid_4 card">
		<?php
			$fieldset_attributes = array( 'class' => 'create_device_fieldset');
			echo form_fieldset('Add New Extension', $fieldset_attributes);
		?>
		<?php echo form_open('extensions/add_extension'); ?>

		<?php
			$attributes = array(
						'class' => 'create_device_label',
						'onFocus' => "this.value=''",
						'style' => 'width: 12em'
			);
			echo form_label('Extension Number: ', 'extension_number', $attributes);

			$data = array(
					'name' => 'extension_number',
					'value' => '200',
					'maxlength' => '10',
					'size' => '4',
					'class' => 'create_device_input',
					'onFocus' => "this.value=''"
			);
			echo form_input($data);
		?>
		<br />
		<?php
			$data = array('name' => 'submit_new_extension', 'value' => 'Create');
			echo form_submit($data);
		?>
	</div>
	<div class="grid_6 card">
		<?php
			$fieldset_attributes = array('class' => 'list_device_fieldset');
			echo form_fieldset('Currently Provisioned Extensions', $fieldset_attributes);
		?>

		<table class="devices" cellspacing="0">
			<tr>
				<td class="hed">Extension</td>
				<td class="hed">Who</td>
				<td class="hed">Device Identifier</td>
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
				<td class="<?php echo $class; ?>"><?php echo $data->extension_number; ?></td>
				<td class="<?php echo $class; ?>"><?php echo $data->first_name; ?>&nbsp;<?php echo $data->last_name; ?></td>
				<td class="<?php echo $class; ?>"><?php echo $data->name; ?></td>
				<td class="<?php echo $class; ?>" style="text-align: center"><a href="extensions/remove/<?php echo $data->id; ?>" style="color: red; font-size: 1.5em; font-style: bold">x</a></td>
			</tr>
		<?php
			endforeach;
		?>
		</table>
	</div>
<div style="margin-left: 10px; position: absolute; top: 270px; width: 300px;"><?php echo validation_errors(); ?></div>
</div>
