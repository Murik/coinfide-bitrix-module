<?php

namespace Coinfide\Entity;

class AffiliateInfo extends Base
{
    protected $validationRules = array(
        'affiliateId' => array('type' => 'string', 'max_length' => 50, 'required' => true),
        'campaignId' => array('type' => 'string', 'max_length' => 50, 'required' => true),
        'bannerId' => array('type' => 'string', 'max_length' => 50, 'required' => true),
        'customParameters' => array('type' => 'string', 'max_length' => 255, 'required' => false)
    );

    /**
     * @var string
     */
    protected $affiliateId;

    /**
     * @var string
     */
    protected $campaignId;

    /**
     * @var string
     */
    protected $bannerId;

    /**
     * @var string
     */
    protected $customParameters;

    /**
     * @return string
     */
    public function getAffiliateId()
    {
        return $this->affiliateId;
    }

    /**
     * @param string $affiliateId
     */
    public function setAffiliateId($affiliateId)
    {
        $this->affiliateId = $affiliateId;
    }

    /**
     * @return string
     */
    public function getCampaignId()
    {
        return $this->campaignId;
    }

    /**
     * @param string $campaignId
     */
    public function setCampaignId($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    /**
     * @return string
     */
    public function getBannerId()
    {
        return $this->bannerId;
    }

    /**
     * @param string $bannerId
     */
    public function setBannerId($bannerId)
    {
        $this->bannerId = $bannerId;
    }

    /**
     * @return string
     */
    public function getCustomParameters()
    {
        return $this->customParameters;
    }

    /**
     * @param string $customParameters
     */
    public function setCustomParameters($customParameters)
    {
        $this->customParameters = $customParameters;
    }
    
}
