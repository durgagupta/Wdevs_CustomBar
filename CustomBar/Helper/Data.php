<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Wdevs\CustomBar\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use \Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Customer\Api\GroupRepositoryInterface;


class Data extends AbstractHelper
{
    /**  */
    protected $scopeConfig;

    protected $storeManager;

    protected $groupRepository;

    protected $customerSession;

    protected $escaper;


    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        \Magento\Customer\Model\Session $customerSession,
        GroupRepositoryInterface $groupRepository,
        \Magento\Framework\Escaper $escaper
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->groupRepository = $groupRepository;
        $this->customerSession = $customerSession;
        $this->escaper = $escaper;
    }
    

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->scopeConfig->getValue("custom_bar/general/enable", 
            ScopeInterface::SCOPE_STORE,$this->storeManager->getStore()->getStoreId());
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function isCustomerLoggedIn() {
        return $this->customerSession->isLoggedIn();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function getCustomerGroupId() {

        if($this->isCustomerLoggedIn()) {
            return $customerGroup = $this->customerSession->getCustomer()->getGroupId();
        } 
        return \Magento\Customer\Api\Data\GroupInterface::NOT_LOGGED_IN_ID;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getCustomBarContent() {
        $customerGroup = $this->groupRepository->getById($this->getCustomerGroupId());
        return $customerGroup->getExtensionAttributes()->getCustomBarContent();
        
    }
    

}