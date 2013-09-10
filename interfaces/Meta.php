<?php

/* This file is property of Pixel Grade Media. You may NOT copy, or redistribute
 * it. Please see the license that came with your copy for more information.
 */

/**
 * @package    pixcore
 * @category   core
 * @author     Pixel Grade Team
 * @copyright  (c) 2013, Pixel Grade Media
 */
interface PixcoreMeta {

	/**
	 * @return mixed value or default
	 */
	function get($key, $default = null);

	/**
	 * @return static $this
	 */
	function set($key, $value);

	/**
	 * If the key is currently a non-array value it will be converted to an
	 * array maintaning the previous value (along with the new one).
	 *
	 * @param  string name
	 * @param  mixed  value
	 * @return static $this
	 */
	function add($name, $value);

	/**
	 * @return array all metadata as array
	 */
	function metadata_array();

} # interface
