<?php
	/* @var PixcoreFormField $field */
	/* @var PixcoreForm $form */
	/* @var string $name */
	/* @var string $label */
	/* @var string $desc */

	isset($type) or $type = 'text';
?>

<div>
	<p><?php echo $desc ?></p>
	<label id="<?php echo $name ?>">
		<?php echo $label ?> <?php echo $field->getmeta('special_sekrit_property', '?') ?>
		<input <?php echo $field->htmlattributes(array('type' => 'text')) ?>/>
	</label>
</div>
