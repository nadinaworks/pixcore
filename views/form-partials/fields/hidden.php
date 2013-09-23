<?php defined('ABSPATH') or die;
	/* @var PixcoreFormField $field */
	/* @var PixcoreForm $form */
	/* @var mixed $default */
	/* @var string $name */
	/* @var string $idname */
	/* @var string $label */
	/* @var string $desc */
	/* @var string $rendering */

	isset($type) or $type = 'text';

	$attrs = array
		(
			'name' => $name,
			'id' => $idname,
			'type' => 'text',
			'value' => $form->autovalue($name)
		);
?>

<input <?php echo $field->htmlattributes($attrs) ?>/>
