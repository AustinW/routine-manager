<?php

function alert_success($message, $title = 'Success!', $type = 'success', $class = 'alert-success') {
	set_alert($message, $title, $type, $class);
}

function alert_error($message, $title = 'Uh oh!', $type = 'error', $class = 'alert-danger') {
	set_alert($message, $title, $type, $class);
}

function alert_info($message, $title = '<i class="fa fa-info-circle"></i>', $type = 'info', $class = 'alert-info') {
	set_alert($message, $title, $type, $class);
}

function alert_warning($message, $title = '<i class="fa fa-info-circle"></i>', $type = 'warning', $class = 'alert-warning') {
	set_alert($message, $title, $type, $class);
}

function set_alert($message, $title, $type, $class) {
	Session::flash('alert', array(
		'type'    => $type,
		'title'   => $title,
		'message' => $message,
		'class'   => $class,
	));
}

function csv_to_array($csv) {
	return array_map(function($tag) {
		return trim($tag);
	}, str_getcsv($csv));
}

function csv_to_int_array($csv) {
	return array_map(function($tag) {
		return (int) trim($tag);
	}, str_getcsv($csv));
}