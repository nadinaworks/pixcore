<?php
	/* @var PixcoreForm $form */
	/* @var PixcoreMeta $conf */

	$f = &$form;
?>

<?php foreach ($conf->get('fields', array()) as $fieldname): ?>

	<?php echo $f->field($fieldname)
		->addmeta('special_sekrit_property', '!!') ?>

<?php endforeach; ?>
