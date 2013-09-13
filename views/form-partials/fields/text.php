<?php defined('ABSPATH') or die;
	/* @var PixcoreFormField $field */
	/* @var PixcoreForm $form */
	/* @var mixed $default */
	/* @var string $name */
	/* @var string $idname */
	/* @var string $label */
	/* @var string $desc */

	isset($type) or $type = 'text';

	$attrs = array
		(
			'name' => $name,
			'id' => $idname,
			'type' => 'text',
			'value' => $form->autovalue($name)
		);
?>

<?php if ($rendering == 'inline'): ?>
	<input <?php echo $field->htmlattributes($attrs) ?>/>
<?php else: # ?>
	<div>
		<p><?php echo $desc ?></p>
		<label id="<?php echo $name ?>">
			<?php echo $label ?>
			<input <?php echo $field->htmlattributes($attrs) ?>/>
		</label>
	</div>
<?php endif; ?>
