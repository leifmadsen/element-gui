	<div id="card_form" class="container_12">
		<div class="grid_4 card" style="margin-top: 125px;">
			<?php
				echo form_open('cards/opencard');
				echo form_hidden('which_card','devices');

				$form_device_attributes = array(
								'type' => 'image',
								'name' => 'devices',
								'src' => base_url().'img/devices.png',
								'border' => '0'
							);
				echo '<p class="img_center">';
				echo form_input($form_device_attributes);
				echo '</p>';
				echo form_close();
			?>
			<div id="device_desc" class="card_description_box">
				<p class="card_description_title">Devices</p>
				<p class="card_description">The device configuration screen is used to provide configuration for your phones, and to control their ability to place and receive calls in the system.</p>
			</div>
			<p class="open_description"><a onclick="switchMenu('device_desc', this, '...less');" title="Switch" class="switchMenu_link">...more</a></p>
		</div>
		
		<div class="grid_4 card" style="margin-top: 125px;">
			<?php
				echo form_open('cards/opencard');
				echo form_hidden('which_card','extensions');

				$form_device_attributes = array(
								'type' => 'image',
								'name' => 'extensions',
								'src' => base_url().'img/extensions.png',
								'border' => '0'
							);
				echo '<p class="img_center">';
				echo form_input($form_device_attributes);
				echo '</p>';
				echo form_close();
			?>
			<div id="extension_desc" class="card_description_box">
				<p class="card_description_title">Extensions</p>
				<p class="card_description">The extension configuration screen is used to provide an interface for the creation and assignment of extension numbers.</p>
			</div>
			<p class="open_description"><a onclick="switchMenu('extension_desc', this, '...less');" title="Switch" class="switchMenu_link">...more</a></p>
		</div>

		<div class="grid_4 card" style="margin-top: 125px;">
			<?php
				echo form_open('cards/opencard');
				echo form_hidden('which_card','people');

				$form_device_attributes = array(
								'type' => 'image',
								'name' => 'people',
								'src' => base_url().'img/people.png',
								'border' => '0'
							);
				echo '<p class="img_center">';
				echo form_input($form_device_attributes);
				echo '</p>';
				echo form_close();
			?>
			<div id="people_desc" class="card_description_box">
				<p class="card_description_title">People</p>
				<p class="card_description">The people configuration screen allows you to tell the system about the various people in your organization.</p>
			</div>
			<p class="open_description"><a onclick="switchMenu('people_desc', this, '...less');" title="Switch" class="switchMenu_link">...more</a></p>
		</div>
	</div>
<!-- end .container_12 -->
