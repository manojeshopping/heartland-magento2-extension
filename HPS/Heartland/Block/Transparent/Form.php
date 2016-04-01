<?php


namespace HPS\Heartland\Block\Transparent;

/**
 * Created by PhpStorm.
 * User: charles.simmons
 * Date: 3/1/2016
 * Time: 11:35 AM
 */

class Form extends \Magento\Payment\Block\Form\Cc
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Payment\Model\Config $paymentConfig
     * @param array $data
     */
    public function __construct(\Magento\Framework\View\Element\Template\Context $context,
                                \Magento\Payment\Model\Config $paymentConfig,
                                array $data) {
        parent::__construct($context,$paymentConfig,$data);
        }
    /**
     * Retrieve availables credit card types
     *
     * @return array
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function getCcAvailableTypes()
        {
     return parent::getCcAvailableTypes(); // TODO: Change the autogenerated stub
    }
    /**
         * Retrieve credit card expire months
         *
         * @return array
         */
    public function getCcMonths()
        {
     return parent::getCcMonths(); // TODO: Change the autogenerated stub
    }
    /**
         * Retrieve credit card expire years
         *
         * @return array
         */
    public function getCcYears()
        {
     return parent::getCcYears(); // TODO: Change the autogenerated stub
    }
    /**
         * Retrieve has verification configuration
         *
         * @return bool
         */
    public function hasVerification()
        {
     return parent::hasVerification(); // TODO: Change the autogenerated stub
    }
    /**
         * Whether switch/solo card type available
         *
         * @return bool
         */
    public function hasSsCardType()
        {
     return parent::hasSsCardType(); // TODO: Change the autogenerated stub
    }
    /**
         * Solo/switch card start year
         *
         * @return array
         */
    public function getSsStartYears()
        {
     return parent::getSsStartYears(); // TODO: Change the autogenerated stub
    }
    /**
         * Render block HTML
         *
         * @return string
         */
    protected function _toHtml()
        {
     return parent::_toHtml(); // TODO: Change the autogenerated stub
    }
    /**
     * @return string
     */
    public function getTemplate ()
    {
        return $this->_template;
    }

    /**
     * @param string $template
     */
    public function setTemplate ($template)
    {
        $this->_template = $template;
    }

    /**
     * @return \Magento\Payment\Model\Config
     */
    public function getPaymentConfig ()
    {
        return $this->_paymentConfig;
    }

    /**
     * @param \Magento\Payment\Model\Config $paymentConfig
     */
    public function setPaymentConfig ($paymentConfig)
    {
        $this->_paymentConfig = $paymentConfig;
    }

}