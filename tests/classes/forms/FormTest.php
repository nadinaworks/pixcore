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
class FormTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	function instance() {
		$form = pixcore::instance('PixcoreForm', null);
		$this->assertEquals(true, $form instanceof PixcoreForm);
	}

	/**
	 * @test
	 */
	function addtemplatepath() {
		$form = pixcore::instance('PixcoreForm', null);
		$this->assertEquals(array(), $form->getmeta('template-paths'));
		$form->addtemplatepath('test');
		$this->assertEquals(array('test'), $form->getmeta('template-paths'));
	}

	/**
	 * @test
	 */
	function autocomplete() {
		$form = pixcore::instance('PixcoreForm', null);
		$form->addtemplatepath(pixcore::corepath().'tests/assets/form-partials/');

		// no autocomplete
		$field = $form->field('test1', array('type' => 'text'));
		$expt = '<input name="test1" id="test1" type="text"/>';
		$this->assertEquals($expt, trim($field->render()));

		// request of same field
		$field = $form->field('test1', array('type' => 'text'));
		$expt = '<input name="test1" id="test1" type="text"/>';
		$this->assertEquals($expt, trim($field->render()));

		// with autocomplete
		$ac = pixcore::instance('PixcoreMeta', array('test2' => '112233'));
		$form->autocomplete($ac);
		$field = $form->field('test2', array('type' => 'text'));
		$expt = '<input name="test2" id="test2" type="text" value="112233"/>';
		$this->assertEquals($expt, trim($field->render()));
	}

	/**
	 * @test
	 */
	function toString_method() {
		$form = pixcore::instance('PixcoreForm', null);
		$this->assertEquals('<form action method="POST">', $form.'');
	}

	/**
	 * @test
	 */
	function endform() {
		$form = pixcore::instance('PixcoreForm', null);
		$this->assertEquals('</form>', $form->endform());
	}

} # class
