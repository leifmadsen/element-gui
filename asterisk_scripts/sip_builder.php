<?php
	$db_user = 'root';
	$db_pass = 'DFer0107';
	$db_name = 'element';
	$db = mysql_connect('localhost',$db_user,$db_pass);
	if(!$db) {
		die();
	}

	$db_selected = mysql_select_db($db_name, $db);
	if (!$db_selected) {
		die();
	}

	$query = 'SELECT name, secret, template, device_description FROM sip_devices';
	$results = mysql_query($query);

	if (!$results) {
		die();
	}

	while ($row = mysql_fetch_assoc($results)) {
		echo "[".$row['name']."]"."(".$row['template'].")"."\n";
		echo "secret=".$row['secret']."\n";
		echo "description=".$row['device_description']."\n\n";
	}

	mysql_free_result($results);
	
?>
