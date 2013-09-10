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
class PixcoreMetaImpl implements PixcoreMeta {

	/** @var array metadat */
	protected $metadata = array();

	/**
	 * @param  array metadata
	 * @return PixcoreMeta
	 */
	static function instance($metadata) {
		$i = new self;
		$i->metadata = $metadata;
		return $i;
	}

	/**
	 * @param  string key
	 * @param  mixed  default
	 * @return mixed
	 */
	function get($key, $default = null) {
		return isset($this->metadata[$key]) ? $this->metadata[$key] : $default;
	}

	/**
	 * @param  string key
	 * @param  mixed  value
	 * @return static $this
	 */
	function set($key, $value) {
		$this->metadata[$key] = $value;
		return $this;
	}

	/**
	 * If the key is currently a non-array value it will be converted to an
	 * array maintaning the previous value (along with the new one).
	 *
	 * @param  string name
	 * @param  mixed  value
	 * @return static $this
	 */
	function add($name, $value) {

		// Cleanup
		// -------

		if ( ! isset($this->metadata[$name])) {
			$this->metadata[$name] = array();
		}
		else if ( ! is_array($this->metadata[$name]))
		{
			$this->metadata[$name] = array($this->metadata[$name]);
		}
		# else: array, no cleanup required

		// Register new value
		// ------------------

		$this->metadata[$name][] = $value;

		return $this;
	}

	/**
	 * @return array all metadata as array
	 */
	function metadata_array() {
		return $this->metadata;
	}

} # class
