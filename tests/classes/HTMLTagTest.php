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
class HTMLTagTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	function get() {
		$tag = pixcore::instance('PixcoreHTMLTag', array('id' => 'test'));
		$this->assertEquals('test', $tag->get('id'));
		$this->assertEquals(array(), $tag->get('class', array()));
	}

	/**
	 * @test
	 */
	function set() {
		$tag = pixcore::instance('PixcoreHTMLTag', array('id' => 'test'));
		$tag->set('id', 'success');
		$this->assertEquals('success', $tag->get('id'));
	}

	/**
	 * @test
	 */
	function htmlattributes() {
		$tag = pixcore::instance('PixcoreHTMLTag', array('id' => 'test', 'x' => 'y', 'z' => '', 'class' => array('x', 'y', 'z')));
		$this->assertEquals('id="test" x="y" z class="x y z"', $tag->htmlattributes());
	}

} # config
