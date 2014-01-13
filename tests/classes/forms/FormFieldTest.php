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
class FormFieldTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	function has_errors() {
		$form = pixcore::instance('PixcoreForm', null);
		$form->errors(array('test1' => array('mock_error')));
		$field1 = $form->field('test1', array('type' => 'text'));
		$field2 = $form->field('test2', array('type' => 'text'));
		$this->assertEquals(true, $field1->has_errors());
		$this->assertEquals(false, $field2->has_errors());
	}

	/**
	 * @test
	 */
	function one_error() {
		$form = pixcore::instance('PixcoreForm', null);
		$form->errors(array('test1' => array('error1' => 'test1', 'error2' => 'test2')));
		$field1 = $form->field('test1', array('type' => 'text'));
		$this->assertEquals('test1', $field1->one_error());
	}

	/**
	 * @test
	 */
	function render() {
		$form = pixcore::instance('PixcoreForm', null);
		try {
			$form->field('test1', array('type' => 'text'))->render();
			throw new Exception('Failed asserting template paths exception.');
		}
		catch (Exception $e) {
			$this->assertEquals('Missing template paths.', $e->getMessage());
		}

		$form->addtemplatepath(pixcore::corepath().'tests/assets/form-partials/');
		try {
			// testing rendering via __toString too...
			$test = '' . $form->field('test2', array('type' => 'no-such-type'));
			throw new Exception('Failed asserting pattern exception.');
		}
		catch (Exception $e) {
			$expt = 'Failed to match any pattern for field [test2] of type no-such-type';
			$this->assertEquals($expt, $e->getMessage());
		}
	}

} # class
