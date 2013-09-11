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
class pixcore {

	// Simple Dependency Injection Container
	// ------------------------------------------------------------------------

	/** @var array interface -> implementation mapping */
	protected static $mapping = array();

	/**
	 * @return mixed instance of class registered for the given interface
	 */
	static function instance() {
		$args = func_get_args();
		$interface = array_shift($args);

		if (isset(self::$mapping[$interface])) {
			$class = self::$mapping[$interface];
		}
		else { // the interface isn't mapped to a class
			// we fallback to interface name + "Impl" suffix
			$class = $interface.'Impl';
		}

		return call_user_func_array(array($class, 'instance'), $args);
	}

	/**
	 * Registers a class for the given interface. If no class is registered for
	 * an interface the interface name with a Impl suffix is used.
	 */
	static function use_impl($interface, $class) {
		self::$mapping[$interface] = $class;
	}


	// Syntactic Sugar
	// ------------------------------------------------------------------------

	/**
	 * @return PixcoreForm
	 */
	static function form($config) {
		return self::instance('PixcoreForm', $config);
	}

	// Helpers
	// ------------------------------------------------------------------------

	/**
	 * @return string root path for core
	 */
	static function corepath() {
		return dirname(__FILE__).DIRECTORY_SEPARATOR;
	}

	/**
	 * Recursively finds all files in a directory.
	 *
	 * @param string directory to search
	 * @return array found files
	 */
	static function find_files($dir)
	{
		$found_files = array();
		$files = scandir($dir);

		foreach ($files as $value) {
			// skip special dot files
			if ($value === '.' || $value === '..') {
				continue;
			}

			// is it a file?
			if (is_file("$dir/$value")) {
				$found_files []= "$dir/$value";
				continue;
			}
			else { // it's a directory
				foreach (self::find_files("$dir/$value") as $value) {
					$found_files []= $value;
				}
			}
		}

		return $found_files;
	}

	/**
	 * Requires all PHP files in a directory.
	 * Use case: callback directory, removes the need to manage callbacks.
	 *
	 * Should be used on a small directory chunks with no sub directories to
	 * keep code clear.
	 *
	 * @param string path
	 */
	static function require_all($path)
	{
		$files = self::find_files(rtrim($path, '\\/'));

		sort($files, SORT_ASC);

		foreach ($files as $file) {
			if (strpos($file, EXT)) {
				require $file;
			}
		}
	}


} # class