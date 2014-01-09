<?php defined('ABSPATH') or die;

/* This file is property of Pixel Grade Media. You may NOT copy, or redistribute
 * it. Please see the license that came with your copy for more information.
 */

/**
 * @package    pixcore
 * @category   core
 * @author     Pixel Grade Team
 * @copyright  (c) 2014, Pixel Grade Media
 */
class coreTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	function defaults() {
		$defaults = pixcore::defaults();
		$this->assertEquals('pixcore_validate_is_numeric', $defaults['callbacks']['is_numeric']);
	}

	/**
	 * @test
	 */
	function use_impl() {
		pixcore::use_impl('PixcoreMeta', 'FakePixcoreMetaImpl');
		$meta = pixcore::instance('PixcoreMeta', array());
		$this->assertEquals('test passed', $meta->get('anything'));
		pixcore::use_impl('PixcoreMeta', 'PixcoreMetaImpl');
	}

	/**
	 * @test
	 */
	function shorthands() {
		$processor = pixcore::processor(array());
		$this->assertEquals(true, $processor instanceof PixcoreProcessor);
		$form = pixcore::form(array(), $processor);
		$this->assertEquals(true, $form instanceof PixcoreForm);
	}

	/**
	 * @test
	 */
	function corepath() {
		$this->assertEquals(true, file_exists(pixcore::corepath().'tests/coreTest'.EXT));
	}

	/**
	 * @test
	 */
	function pluginpath() {
		$this->assertEquals(true, file_exists(pixcore::pluginpath().'pixcore/tests/coreTest'.EXT));
	}

	/**
	 * @test
	 */
	function setpluginpath() {
		$oldpath = pixcore::pluginpath();
		pixcore::setpluginpath(pixcore::corepath().'tests/assets');
		$this->assertEquals(true, file_exists(pixcore::pluginpath().'wordpress-functions'.EXT));
		pixcore::setpluginpath($oldpath);
	}

	/**
	 * @test
	 */
	function merge() {
		$this->assertEquals(
			array
				(
					'orange',
					'pink',
					'test' => array
						(
							'x' => 2,
							'y' => 1,
							'z' => 3,
						)
				),
			pixcore::merge
				(
					array('orange'),
					array('pink'),
					array('test' => 15),
					array('test' => array('x' => 1)),
					array('test' => array('x' => 2, 'y' => 3)),
					array('test' => array('y' => 1, 'z' => 3)),
					array('test' => array('x' => 2))
				)
		);
	}

	/**
	 * @test
	 */
	function callback_method() {
		$meta = pixcore::instance('PixcoreMeta', array());
		$callback = pixcore::callback('is_numeric', $meta);
		$this->assertEquals('pixcore_validate_is_numeric', $callback);
		$this->setExpectedException('Exception');
		pixcore::callback('non-existent-callback', $meta);
	}

	/**
	 * @test
	 */
	function textdomain() {
		$this->assertEquals('pixcore_txtd', pixcore::textdomain());
	}

	/**
	 * @test
	 */
	function settextdomain() {
		$oldtextdomain = pixcore::textdomain();
		pixcore::settextdomain('test_txtd');
		$this->assertEquals('test_txtd', pixcore::textdomain());
		pixcore::settextdomain(null);
		$this->assertEquals('pixcore_txtd', pixcore::textdomain());
		pixcore::settextdomain($oldtextdomain);
	}

	/**
	 * @test
	 */
	function find_files() {
		$this->assertEquals(7, count(pixcore::find_files(pixcore::corepath().'tests/assets/find_files')));
	}

	/**
	 * @test
	 */
	function require_all() {
		pixcore::require_all(pixcore::corepath().'tests/assets/require_all');
		$loaded = 0;
		foreach (array(1,2,3,4,5,6) as $i) {
			$loaded += function_exists("test_required_func$i") ? 1 : 0;
		}

		$this->assertEquals(6, $loaded);
	}

} # class

class FakePixcoreMetaImpl {
	static function instance($metadata) {
		$i = new self;
		return $i;
	}

	function get($key, $default = null) {
		return 'test passed';
	}
}