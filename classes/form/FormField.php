<?php defined('ABSPATH') or die;

/* This file is property of Pixel Grade Media. You may NOT copy, or redistribute
 * it. Please see the license that came with your copy for more information.
 */

/**
 * @package    pixcore
 * @category   core
 * @author     Pixel Grade Team
 * @copyright  (c) 2013, Pixel Grade Media
 */
class PixcoreFormFieldImpl extends PixcoreHTMLTagImpl implements PixcoreFormField {

	/** @var array configuration attributes */
	protected $meta = null;

	/**
	 * @param array config
	 */
	static function instance($config) {
		$i = new self;
		$i->configure($config);
		return $i;
	}

	/**
	 * Apply configuration.
	 */
	protected function configure($config) {
		if ($config == null) {
			$config = array('attrs' => array());
		}

		// invoke htmltag instance
		parent::configure($config['attrs']);

		// everything else is under the general meta
		unset($config['attrs']);
		$this->meta = pixcore::instance('PixcoreMeta', $config);
	}

	// Helpers
	// ------------------------------------------------------------------------

	/**
	 * @return mixed value or default
	 */
	function getmeta($key, $default = null) {
		return $this->meta->get($key, $default);
	}

	/**
	 * @return static $this
	 */
	function setmeta($key, $value) {
		$this->meta->set($key, $value);
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
	function addmeta($name, $value) {
		$this->meta->set($name, $value);
		return $this;
	}

	/**
	 * @return PixcoreMeta
	 */
	function meta() {
		return $this->meta;
	}

	// Rendering
	// ------------------------------------------------------------------------

	/**
	 * Emulates wordpress template behaviour. First searches for name, then
	 * searches field type and so on.
	 *
	 * @return string
	 */
	function render() {
		$form = $this->getmeta('form');

		// we reverse the order so that last added is first checked
		$template_paths = array_reverse($form->getmeta('template-paths', array()));

		if (empty($template_paths)) {
			throw new Exception('Missing template paths.');
		}

		// the following are the file patterns we look for
		$patterns = array
			(
				$this->getmeta('name'),
				$this->getmeta('type')
			);

		foreach ($patterns as $pattern) {
			foreach ($template_paths as $path) {
				$dirpath = rtrim($path, '\\/').DIRECTORY_SEPARATOR;
				if (file_exists($dirpath.$pattern.EXT)) {
					return $this->render_template_file($dirpath.$pattern.EXT);
				}
			}
		}

		throw new Exception('Failed to match any pattern for field ['.$this->getmeta('name').']');
	}

	/**
	 * @param  string template path
	 * @return string rendered field
	 */
	protected function render_template_file($_template_filepath) {
		// variables which we wish to expose to template
		$field = $this; # $this will also work
		$form = $this->getmeta('form');
		$name = $this->getmeta('name');
		$label = $this->getmeta('label');
		$desc = $this->getmeta('desc', '');

		ob_start();
		include $_template_filepath;
		return ob_get_clean();
	}

	/**
	 * @return string
	 */
	function __toString() {
		return $this->render();
	}

} # class
