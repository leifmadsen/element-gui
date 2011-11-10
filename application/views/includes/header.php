<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Element Asterisk Management System</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/reset.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/text.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/960.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/custom.css" />

<script type="text/javascript">
<!--

oldTextAry = new Array();

function switchMenu(obj, fieldObj, newTextStr) {
	if (newTextStr == fieldObj.innerHTML) {
		fieldObj.innerHTML = oldTextAry[fieldObj.id];
	} else {
		oldTextAry[fieldObj.id] = fieldObj.innerHTML;
		fieldObj.innerHTML = newTextStr;
	}

	var el = document.getElementById(obj);
	if ( el.style.display != 'none' ) {
		el.style.display = 'none';
	} else {
		el.style.display = '';
	}
}

function collapseAll(objs) {
	var i;
	for (i=0;i<objs.length;i++ ) {
		objs[i].style.display = 'none';
	}
}

function addEvent( obj, type, fn ) {
	if (obj.addEventListener) {
		obj.addEventListener( type, fn, false );
		EventCache.add(obj, type, fn);
	}
	else if (obj.attachEvent) {
		obj["e"+type+fn] = fn;
		obj[type+fn] = function() { obj["e"+type+fn]( window.event ); }
		obj.attachEvent( "on"+type, obj[type+fn] );
		EventCache.add(obj, type, fn);
	}
	else {
		obj["on"+type] = obj["e"+type+fn];
	}
}

var EventCache = function(){
	var listEvents = [];
	return {
		listEvents : listEvents,
		add : function(node, sEventName, fHandler){
			listEvents.push(arguments);
		},
		flush : function(){
			var i, item;
			for(i = listEvents.length - 1; i >= 0; i = i - 1){
				item = listEvents[i];
				if(item[0].removeEventListener){
					item[0].removeEventListener(item[1], item[2], item[3]);
				};
				if(item[1].substring(0, 2) != "on"){
					item[1] = "on" + item[1];
				};
				if(item[0].detachEvent){
					item[0].detachEvent(item[1], item[2]);
				};
				item[0][item[1]] = null;
			};
		}
	};
}();

function $() {
	var elements = new Array();
	for (var i = 0; i < arguments.length; i++) {
		var element = arguments[i];
		if (typeof element == 'string')
			element = document.getElementById(element);
		if (arguments.length == 1)
			return element;
		elements.push(element);
	}
	return elements;
}

function pageLoad() {
	collapseAll($('device_desc','extension_desc','people_desc'));
}



addEvent(window,'load',pageLoad);
//-->
</script>

</head>
<body>
	<div class="header">
		<?php
			$is_logged_in = $this->session->userdata('is_logged_in');

			if ($is_logged_in == true)
			{
				echo '<p class="hello_header">Welcome, '.$this->session->userdata('first_name');
				echo '<br />';
				echo '<a style="position: absolute; right: 0px;" href="'.base_url().'/index.php/logout">Logout</a>';
			}
		?>
		<p class="system_header">Element Asterisk Management System.</p>
	</div>
	<div style="clear: both;"></div>

