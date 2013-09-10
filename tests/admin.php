<?php
	include 'bootstrap.php';
	$basepath = dirname(__FILE__).DIRECTORY_SEPARATOR;
	$templatepath = $basepath.'sample-templates'.DIRECTORY_SEPARATOR;
	$config = include 'sample-config'.EXT;

	// invoke processor
//	$processor = pixcore::processor();
//	$status = $processor->post_check();

	$status = array('show_form' => true); // @debug hardcoded test value
?>

<?php if ($status['show_form']): ?>

	<?php
		$f = pixcore::form($config);
//		$f->register_errors($processor->errors());
		$f->addtemplatepath($templatepath.'fields');
	?>

	<?php echo $f->startform() ?>

		<?php
			$conf = array('fields' => array_keys($config['fields']));
		?>

		<?php echo $f->fieldtemplate($templatepath.'example'.EXT, $conf) ?>

		<button type="submit">
			Save
		</button>

	<?php echo $f->endform() ?>

<?php endif; ?>
