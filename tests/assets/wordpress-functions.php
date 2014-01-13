<?php

	#
	# Mock wordpress functions used in tests.
	# We ignore them from the code coverage report.
	#

	// @codeCoverageIgnoreStart

	function __($text, $textdomain) { return $text; }

	function get_option($key) {
		switch ($key) {
			case 'plugin-settings':
				return array();
			default:
				throw new Exception('Missing key ['.$key.'] in database');
		}
	}

	function update_option($key, $value) {}

	// @codeCoverageIgnoreEnd