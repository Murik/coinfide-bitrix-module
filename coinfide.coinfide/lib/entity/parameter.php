<?php

namespace Coinfide\Entity;

class Parameter extends Base
{
    protected $validationRules = array(
        'name' => array('type' => 'string', 'required' => true),
        'value' => array('type' => 'string', 'required' => true)
    );

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $value;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}
