<?php defined('ABSPATH') or die;

	// ensure EXT is defined
	if ( ! defined('EXT')) {
		define('EXT', '.php');
	}

	$basepath = dirname(__FILE__).DIRECTORY_SEPARATOR;
	require $basepath.'pixcore'.EXT;

	// load classes

	$interfacepath = $basepath.'interfaces'.DIRECTORY_SEPARATOR;
	pixcore::require_all($interfacepath);

	$classpath = $basepath.'classes'.DIRECTORY_SEPARATOR;
	pixcore::require_all($classpath);
