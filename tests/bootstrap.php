<?php

	define('ABSPATH', 'abspath');

	// ensure EXT is defined
	if ( ! defined('EXT')) {
		define('EXT', '.php');
	}

	error_reporting(-1);

	$basepath = realpath(__DIR__).'/../';
	require $basepath.'bootstrap'.EXT;
