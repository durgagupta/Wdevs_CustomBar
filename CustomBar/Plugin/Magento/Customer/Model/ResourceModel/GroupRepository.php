<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Wdevs\CustomBar\Plugin\Magento\Customer\Model\ResourceModel;
use Magento\Framework\App\RequestInterface;
use Wdevs\CustomBar\Helper\Data as customBarHelper;

class GroupRepository
{
    protected $groupRegistry;

    protected $groupExtensionInterfaceFactory;

    protected $request;

    protected $customBarHelper;

    public function __construct(
        \Magento\Customer\Model\GroupRegistry $groupRegistry,
        \Magento\Customer\Api\Data\GroupExtensionInterfaceFactory $groupExtensionInterfaceFactory,
        RequestInterface $request,
        CustomBarHelper $customBarHelper) {

        $this->groupRegistry = $groupRegistry;
        $this->groupExtensionInterfaceFactory = $groupExtensionInterfaceFactory;
        $this->request = $request;
        $this->customBarHelper = $customBarHelper;
    }

    public function afterGetById(
        \Magento\Customer\Model\ResourceModel\GroupRepository $subject,
        $result,
        $id
    ) {
        if ($this->customBarHelper->isEnabled()) { 

            $groupModel = $this->groupRegistry->retrieve($id);
            $customerGroupExtensionAttributes = $this->groupExtensionInterfaceFactory->create();
            $customerGroupExtensionAttributes->setCustomBarContent($groupModel->getData('custom_bar_content'));
            $result->setExtensionAttributes($customerGroupExtensionAttributes);
        }
        return $result;
    }


    /**
     * Undocumented function
     *
     * @param \Magento\Customer\Model\ResourceModel\GroupRepository $subject
     * @param [type] $group
     * @return void
     */
    public function beforeSave(
        \Magento\Customer\Model\ResourceModel\GroupRepository $subject,
        $group
    ) {

        if ($this->customBarHelper->isEnabled()) {
            $customBarContent = $this->request->getParam('custom_bar_content');                
            if ($customBarContent) {
                if ($group->getExtensionAttributes()) {
                    $customerGroupExtensionAttributes = $group->getExtensionAttributes();    
                } else {
                    $customerGroupExtensionAttributes = $this->groupExtensionInterfaceFactory->create();
                }
                $customerGroupExtensionAttributes->setCustomBarContent($customBarContent);
                $group->setExtensionAttributes($customerGroupExtensionAttributes);
            }
        }    
        return [$group];
    }
}