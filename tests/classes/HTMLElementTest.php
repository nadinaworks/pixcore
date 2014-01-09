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
class HTMLElementTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	function instance() {
		$el = pixcore::instance('PixcoreHTMLElement', array('attrs' => array('x' => 'success')));
		$this->assertEquals('success', $el->get('x'));
	}

	/**
	 * @test
	 */
	function hasmeta() {
		$el = pixcore::instance('PixcoreHTMLElement', array('test1' => 'success', 'attrs' => array()));
		$this->assertEquals(true, $el->hasmeta('test1'));
		$this->assertEquals(false, $el->hasmeta('test2'));
		$this->assertEquals(false, $el->hasmeta('attrs'));
	}

	/**
	 * @test
	 */
	function getmeta() {
		$el = pixcore::instance('PixcoreHTMLElement', array('test1' => 'success', 'attrs' => array()));
		$this->assertEquals('success', $el->getmeta('test1', 'fail'));
		$this->assertEquals('fail', $el->getmeta('test2', 'fail'));
		$this->assertEquals(null, $el->getmeta('test2', null));
		$this->assertEquals('fail', $el->getmeta('attrs', 'fail'));
	}

	/**
	 * @test
	 */
	function setmeta() {
		$el = pixcore::instance('PixcoreHTMLElement', array('test1' => 'success', 'attrs' => array()));
		$this->assertEquals('fail', $el->getmeta('test2', 'fail'));
		$el->setmeta('test2', 'success');
		$this->assertEquals('success', $el->getmeta('test2', 'fail'));
	}

	/**
	 * @test
	 */
	function ensuremeta() {
		$el = pixcore::instance('PixcoreHTMLElement', array('test1' => 'success', 'attrs' => array()));
		$this->assertEquals('success', $el->getmeta('test1', 'fail'));
		$this->assertEquals('fail', $el->getmeta('test2', 'fail'));
		$el->ensuremeta('test1', '1');
		$el->ensuremeta('test2', '2');
		$this->assertEquals('success', $el->getmeta('test1', 'fail'));
		$this->assertEquals('2', $el->getmeta('test2', 'fail'));
	}

	/**
	 * @test
	 */
	function addmeta() {
		$el = pixcore::instance('PixcoreHTMLElement', array('test1' => 'success', 'attrs' => array()));
		$el->addmeta('test1', '1');
		$this->assertEquals(array('success', '1'), $el->getmeta('test1', 'fail'));
	}

	/**
	 * @test
	 */
	function meta() {
		$el = pixcore::instance('PixcoreHTMLElement', array('test1' => 'success', 'test2' => 'success', 'attrs' => array()));
		$this->assertEquals(true, $el->meta() instanceof PixcoreMeta);
		$this->assertEquals(array('test1' => 'success', 'test2' => 'success'), $el->meta()->metadata_array());
	}

} # class
