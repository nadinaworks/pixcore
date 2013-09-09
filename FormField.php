<?php

/**
 * Class FormType
 */
class FormField
{
    /**
     * @var
     */
    protected $name;
    /**
     * @var string
     */
    protected $type;
    /**
     * @var array
     */
    protected $attributes = array();
    /**
     * @var FormField[]
     */
    protected $children = array();

    function __construct($name = "", $type = "")
    {
        $this->setName($name);
        $this->setType($type);
    }


    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

	/**
	 * @param string $key
	 * @return mixed value
	 */

	public function getAttribute($key)
	{
		return $this->attributes[$key];
	}

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param \FormField[] $children
     */
    public function setChildren(array $children)
    {
        $this->children = $children;
    }

    /**
     * @param FormField $children
     */
    public function addChildren(FormField $children)
    {
        $this->children[] = $children;
    }

    /**
     * @return \FormField[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    public function fromArray(array $elements)
    {
        foreach ($elements as $element) {
            if (!isset($element['name'], $element['type'])) {
                continue;
            }
            $formElement = new FormField($element['name'], $element['type']);
            if (isset($element['attributes']) && is_array($element['attributes'])) {
                $formElement->setAttributes($element['attributes']);
            }
            if (isset($element['children'])) {
                $formElement->fromArray($element['children']);
            }
            $this->addChildren($formElement);
        }
    }
}