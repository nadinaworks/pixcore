<?php

	define('ABSPATH', 'abspath');

	// ensure EXT is defined
	if ( ! defined('EXT')) {
		define('EXT', '.php');
	}

	error_reporting(-1);

	$testspath = realpath(dirname(__FILE__)).'/';
	require $testspath.'assets/wordpress-functions'.EXT;
	require $testspath.'../bootstrap'.EXT;
