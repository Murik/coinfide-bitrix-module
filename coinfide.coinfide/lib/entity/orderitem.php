<?php

namespace Coinfide\Entity;

use Coinfide\CoinfideException;
use Coinfide\Entity\Tax;

class OrderItem extends Base
{
    protected $validationRules = array(
        'type' => array('type' => 'string', 'required' => true),
        'name' => array('type' => 'string', 'max_length' => 255, 'required' => true),
        'description' => array('type' => 'string', 'max_length' => 255, 'required' => false),
        'priceUnit' => array('type' => 'decimal', 'digits' => 14, 'precision' => 2, 'required' => true),
        'quantity' => array('type' => 'decimal', 'digits' => 14, 'precision' => 2, 'required' => true),
        'discountAmount' => array('type' => 'decimal', 'digits' => 14, 'precision' => 2, 'required' => false),
        'discountPercent' => array('type' => 'decimal', 'decimal' => 14, 'precision' => 2, 'required' => false),
        'tax' => array('type' => 'object', 'class' => '\Coinfide\Entity\Tax', 'required' => false)
    );

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var float
     */
    protected $priceUnit;

    /**
     * @var float
     */
    protected $quantity;

    /**
     * @var float
     */
    protected $discountAmount;

    /**
     * @var float
     */
    protected $discountPercent;

    /**
     * @var Tax
     */
    protected $tax;

    public function validate()
    {
        if (!in_array($this->type, ['I', 'S'])) {
            throw new CoinfideException('Type of OrderItem must be one of "I" (item), "S" (shipping)');
        }

        parent::validate();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPriceUnit()
    {
        return $this->priceUnit;
    }

    /**
     * @param float $priceUnit
     */
    public function setPriceUnit($priceUnit)
    {
        $this->priceUnit = $priceUnit;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    /**
     * @param float $discountAmount
     */
    public function setDiscountAmount($discountAmount)
    {
        $this->discountAmount = $discountAmount;
    }

    /**
     * @return float
     */
    public function getDiscountPercent()
    {
        return $this->discountPercent;
    }

    /**
     * @param float $discountPercent
     */
    public function setDiscountPercent($discountPercent)
    {
        $this->discountPercent = $discountPercent;
    }

    /**
     * @return \Coinfide\Entity\Tax
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param \Coinfide\Entity\Tax $tax
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
    }
}
