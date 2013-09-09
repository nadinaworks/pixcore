<?php
class FormOptionsManager implements FormManagerInterface
{

    private $options = array();

    function __construct($name)
    {
        $this->options = get_option($name);
    }


    /**
     * Set field value
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value)
    {
        $this->options[$key] = $value;
    }

    /**
     * Get field value
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return isset($this->options[$key]) ? $this->options[$key] : $default;
    }

    public function save(array $values)
    {
        foreach ($values as $key => $value) {
            if (isset($this->options[$key])) {
                $this->options[$key] = $value;
            }
        }
    }
}
