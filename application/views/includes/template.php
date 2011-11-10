<?php $this->load->view('includes/header'); ?>

<?php 
	if (isset($passthru))
		$this->load->view($main_content, $passthru);
	else
		$this->load->view($main_content);

?>

<?php $this->load->view('includes/footer'); ?>
