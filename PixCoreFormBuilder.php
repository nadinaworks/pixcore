<?php
abstract class PixCoreFormBuilder extends PixCoreFormField
{
    public function __construct($name)
    {
        parent::__construct($name, 'main');
        $this->configureForm($this);
    }

    abstract public function configureForm(PixCoreFormField $form);

    public function configureFromArray(array $elements)
    {
        foreach ($elements as $element) {
            if (!isset($element['name'], $element['type'])) {
                continue;
            }
            $formElement = new PixCoreFormField($element['name'], $element['type']);
            if (isset($element['attributes']) && is_array($element['attributes'])) {
                $formElement->setAttributes($element['attributes']);
            }
        }
    }
}