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
class PixcoreFormImpl extends PixcoreHTMLTagImpl implements PixcoreForm {

	/** @var array configuration attributes */
	protected $meta = null;

	/** @var array templates */
	protected $fields = null;

	/**
	 * @param array config
	 */
	static function instance($config = null) {
		$i = new self;
		$i->configure($config);
		return $i;
	}

	/**
	 * Apply configuration.
	 */
	protected function configure($config = null) {
		if ($config === null) {
			$config = array('template-paths' => array(), 'fields' => array());
		}

		// invoke htmltag instance
		parent::configure(array());
		$this->fields = pixcore::instance('PixcoreMeta', $config['fields']);
		$this->meta = pixcore::instance('PixcoreMeta', array());

		$this->setmeta('template-paths', $config['template-paths']);

		// @todo CLEANUP the empty action should redirect to the same page but
		// it's probably wiser to explicitly provide the right page url
		$this->set('action', '');
		$this->set('method', 'POST');
	}

	/**
	 * Shorthand.
	 *
	 * @return static $this
	 */
	function addtemplatepath($path) {
		return $this->addmeta('template-paths', $path);
	}

	/**
	 * @return string
	 */
	function field($fieldname) {
		$fieldconfig = $this->fields->get($fieldname);
		return pixcore::instance('PixcoreFormField', $fieldconfig)
			->setmeta('form', $this)
			->setmeta('name', $fieldname);
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
		$this->meta->add($name, $value);
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
	 * @return string
	 */
	function __toString() {
		return $this->startform();;
	}

	/**
	 * @return string
	 */
	function startform() {
		return "<form {$this->htmlattributes()}>";
	}

	/**
	 * @return string
	 */
	function endform() {
		return '</form>';
	}

	/**
	 * @param string template path
	 * @param array  configuration
	 * @return string
	 */
	function fieldtemplate($templatepath, $conf = array()) {
		$config = pixcore::instance('PixcoreMeta', $conf);
		return $this->fieldtemplate_render($templatepath, $config);
	}

	/**
	 * @param string template path
	 * @param PixcoreMeta configuration
	 * @return string
	 */
	protected function fieldtemplate_render($_template_path, PixcoreMeta $conf) {
		// variables which we wish to expose to template
		$form = $this; # $this will also work

		ob_start();
		include $_template_path;
		return ob_get_clean();
	}

} # class
