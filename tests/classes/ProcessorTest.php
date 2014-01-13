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
class ProcessorTest extends PHPUnit_Framework_TestCase {

	/**
	 * @test
	 */
	function extract() {
		$conf = array('fields' => array('xxx' => array('type' => 'text')));
		$proc = pixcore::instance('PixcoreProcessor', $conf);
		$this->assertEquals(array('xxx' => array('type' => 'text')), $proc->fields()->metadata_array());

		$conf = array('fields' => array('xxx' => array('type' => 'text', 'test' => array('type' => 'text'))));
		$extr = array('xxx' => array('type' => 'text',  'test' => array('type' => 'text')), 'test' => array('type' => 'text'));
		$proc = pixcore::instance('PixcoreProcessor', $conf);
		$this->assertEquals($extr, $proc->fields()->metadata_array());

		$conf = array
			(
				'fields' => array
					(
						'xxx' => array
							(
								'type' => 'text',
								'test' => array('type' => 'text'),
								'gallery' => array
									(
										array('name' => 'test1', 'type' => 'image'),
										array('name' => 'test2', 'type' => 'image'),
										array('name' => 'test3', 'type' => 'image'),
									)
							)
					)
			);
		$extr = array
			(
				'xxx' => array
					(
						'type' => 'text',
						'test' => array('type' => 'text'),
						'gallery' => array
							(
								array('name' => 'test1', 'type' => 'image'),
								array('name' => 'test2', 'type' => 'image'),
								array('name' => 'test3', 'type' => 'image'),
							)
					),
				'test' => array('type' => 'text'),
				'test1' => array('name' => 'test1', 'type' => 'image'),
				'test2' => array('name' => 'test2', 'type' => 'image'),
				'test3' => array('name' => 'test3', 'type' => 'image'),

			);
		$proc = pixcore::instance('PixcoreProcessor', $conf);
		$this->assertEquals($extr, $proc->fields()->metadata_array());
	}

	/**
	 * @test
	 */
	function run_method() {
		// faulty configuration (missing settings-key)
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$conf = array
			(
				'fields' => array
					(
						'testfield' => array('type' => 'text')
					)
			);
		$proc = pixcore::instance('PixcoreProcessor', $conf);
		$status = array
			(
				'state' => 'error',
				'errors' => array(),
				'dataupdate' => false,
				'message' => 'Missing option_key in plugin configuration.'
			);
		$this->assertEquals($status, $proc->status());

		// correct configuration
		$conf['settings-key'] = 'plugin-settings';
		$proc = pixcore::instance('PixcoreProcessor', $conf);
		$status = array
			(
				'state' => 'nominal',
				'errors' => array(),
				'dataupdate' => true,
			);
		$this->assertEquals($status, $proc->status());

		// re-run test
		$proc->run();
		$this->assertEquals($status, $proc->status());

		// failed validation
		$_POST = array('testfield' => '');
		$conf['fields']['testfield']['type'] = 'counter';
		$proc = pixcore::instance('PixcoreProcessor', $conf);

		$errors = array
			(
				'testfield' => array
					(
						'is_numeric' => 'Numberic value required.',
						'not_empty' => 'Field is required.'
					),
			);

		$this->assertEquals($errors, $proc->errors());

		// passed validation
		$_POST = array('testfield' => '');
		$conf['fields']['testfield']['type'] = 'text';
		$proc = pixcore::instance('PixcoreProcessor', $conf);

		$this->assertEquals(array(), $proc->errors());
	}

} # class
