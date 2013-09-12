<?php defined('ABSPATH') or die;

	function pixcore_validate_not_empty($fieldvalue, $processor) {
		return ! empty($fieldvalue);
	}
