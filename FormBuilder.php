<?php
abstract class FormBuilder extends FormField
{
    public function __construct($name)
    {
        parent::__construct($name, FormType::MAIN);
        $this->configureForm($this);
    }

    abstract public function configureForm(FormField $form);

    public function configureFromArray(array $elements)
    {
        foreach ($elements as $element) {
            if (!isset($element['name'], $element['type'])) {
                continue;
            }
            $formElement = new FormField($element['name'], $element['type']);
            if (isset($element['attributes']) && is_array($element['attributes'])) {
                $formElement->setAttributes($element['attributes']);
            }
        }
    }
}