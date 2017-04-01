<?php

namespace Coinfide\Entity;

class Token extends Base
{
    protected $validationRules = array(
        'accessToken' => array('type' => 'string', 'required' => true),
        'expiresIn' => array('type' => 'integer', 'required' => true),
        'refreshToken' => array('type' => 'string', 'required' => true),
    );

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var string
     */
    protected $expiresIn;

    /**
     * @var string
     */
    protected $refreshToken;

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return integer
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * @param string $expiresIn
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }
    
    
}
