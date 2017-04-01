<?php

namespace Coinfide\Entity;

class Tax extends Base
{
    protected $validationRules = array(
        'name' => array('type' => 'string', 'max_length' => 255, 'required' => true),
        'rate' => array('type' => 'decimal', 'digits' => 3, 'precision' => 3, 'required' => true)
    );

    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $rate;

    /**
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

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
}
