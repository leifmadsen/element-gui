	<div id="login_form" class="container_12">
		<div class="grid_4" style="margin-top: 125px;"></div>
		<div class="grid_4 loginform" style="margin-top: 125px;">
			<?php echo form_open('login/validate_credentials'); ?>
			<label>
				Username
				<br />
				<?php
					$form_input_attributes = array(
									'class' => 'input',
									'name' => 'username',
									'value' => 'Username',
									'onFocus' => "this.value=''"
								);
					echo form_input($form_input_attributes); 
				?>
			</label>
			<label>
				Password
				<br />
				<?php
					$form_password_attributes = array(
									'class' => 'input',
									'name' => 'password',
									'value' => 'Password',
									'onFocus' => "this.value=''"
								);
					echo form_password($form_password_attributes);
				?>
			</label>
			<br />
			<p class="submit">
				<?php echo form_submit('submit', 'Login'); ?>
			</p>
		</div>
		<?php echo form_close(); ?>
		<?php if (isset($passthru)) { ?>
		<div style="clear: both;">&nbsp;</div>
		<div class="grid_4">&nbsp;</div>
		<div class="grid_4 loginform"><p style="border: 0px; text-align: center; font-size: 1.2em"><?php echo $passthru; ?></p></div>
		<?php } ?>
	</div>
<!-- end .container_12 -->
