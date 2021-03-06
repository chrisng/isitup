<?php

	$setting["version"]		= "2.05.3";

	############# Configuration #############

	// Set to false to bring the site offline.
	$setting["live"]		= true;

	// Set to true to see PHP errors, warnings and notices.
	$setting["errors"]		= false;

	// Server time zone, for database records. (use: http://www.php.net/manual/en/timezones.php)
	$setting["time_zone"]	= "Europe/London";

	// The default input value.
	$setting["input"]		= "example.com";

	// The max time to check if a site is working for.
	$setting["timeout"]		= 3;

	// Static content override. No trailing slash.
	$setting["static"]		= "/static";
	// Folder of script, no trailing slash.
	$setting["folder"]		= "";

	$setting["banned_ips"]		= array();

	$setting["banned_ua"]		= array();

# Don't edit, this processes the settings

// ?admin will always work
if ($_COOKIE["admin"] == true) { $setting["live"] = true; }

// sets the error level
if ($setting["errors"] == true) {
	error_reporting(E_ALL); }
else {
	error_reporting(0); }

// sets the time zone
date_default_timezone_set($setting["time_zone"]);

// sets the timeout
ini_set("default_socket_timeout", $setting["timeout"]);

// check server load and set $setting["record"] accordingly
$load = explode(" ", file_get_contents("/proc/loadavg"));

if ($load[0] > 2.0) { $setting["record"] = false; };

// sets the host domain
$setting["host"] = $_SERVER["SERVER_NAME"];

if ($setting["folder"] != "") {
	$setting["host"] = $setting["host"] . $setting["folder"]; }

if ($setting["static"] == "") {
	$setting["static"] = 'http://' . $setting["host"] . '/static'; }

