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
class ValidatorTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	function can_validate_input() {
		// empty case
		$config = array();
		$fields = array();
		$input = array();
		$validator = pixcore::instance('PixcoreValidator', $config, $fields);
		$errors = $validator->validate($input);
		$this->assertEmpty($errors);
		// valid case empty case
		$input = array('test1' => 5, 'test2' => 'a-string');
		$errors = $validator->validate($input);
		$this->assertEmpty($errors);
		// valid case
		$fields = array
			(
				'test1' => array
					(
						'type' => 'counter',
					),
				'test2' => array
					(
						'type' => 'text',
					),
			);
		$config = pixcore::instance('PixcoreMeta', array('checks' => array('counter' => array('is_numeric', 'not_empty'))));
		$fields = pixcore::instance('PixcoreMeta', $fields);
		$validator = pixcore::instance('PixcoreValidator', $config, $fields);
		$errors = $validator->validate($input);
		$this->assertEmpty($errors);
		// valid case: partial fields
		$input = array('test1' => 5);
		$errors = $validator->validate($input);
		$this->assertEmpty($errors);
		// invalid case: invalid field
		$input = array('test1' => 'a-string', 'test2' => 'a-string');
		$errors = $validator->validate($input);
		$this->assertEquals(false, empty($errors));
	}

} # class
