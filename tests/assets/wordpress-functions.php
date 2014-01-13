<?php

	#
	# Mock wordpress functions used in tests.
	# We ignore them from the code coverage report.
	#

	// @codeCoverageIgnoreStart

	function __() {}

	function get_option($key) {
		switch ($key) {
			case 'plugin-settings':
				return array();
			default:
				return array();
		}
	}

	function update_option($key, $value) {}

	// @codeCoverageIgnoreEnd