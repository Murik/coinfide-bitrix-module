<?php

namespace Coinfide\Entity;

class Transaction extends Base
{
    protected $validationRules = array(
        'uid' => array('type' => 'string', 'max_length' => 10, 'required' => true),
        'type' => array('type' => 'string', 'max_length' => 1, 'required' => true),
        'action' => array('type' => 'string', 'max_length' => 2, 'required' => true),
        'status' => array('type' => 'string', 'max_length' => 1, 'required' => true),
        'amount' => array('type' => 'decimal', 'digits' => 14, 'precision' => 2, 'required' => true),
        'paymentMethodCode' => array('type' => 'string', 'max_length' => 100, 'required' => false),
        'payer' => array('type' => 'object', 'class' => '\Coinfide\Entity\Account', 'required' => false),
        'parameters' => array('type' => 'list', 'prototype' => array('type' => 'object', 'class' => '\Coinfide\Entity\Parameter', 'required' => false), 'required' => false),
    );

    /**
     * @var string
     */
    protected $uid;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $paymentMethodCode;

    /**
     * @var Account
     */
    protected $payer;

    /**
     * @var Parameter[]
     */
    protected $parameters;

    /**
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param string $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
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
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getPaymentMethodCode()
    {
        return $this->paymentMethodCode;
    }

    /**
     * @param string $paymentMethodCode
     */
    public function setPaymentMethodCode($paymentMethodCode)
    {
        $this->paymentMethodCode = $paymentMethodCode;
    }

    /**
     * @return Account
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * @param Account $payer
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
    }

    /**
     * @return Parameter[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param Parameter[] $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }
    
}
