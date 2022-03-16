<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Wdevs\CustomBar\Plugin\Magento\Customer\Model\ResourceModel;
use Wdevs\CustomBar\Helper\Data as CustomBarHelper;

class Group
{

    protected $customBarHelper;

    public function __construct(CustomBarHelper $customBarHelper )
    {
        $this->customBarHelper = $customBarHelper;
    }
    /**
     * Undocumented function
     *
     * @param \Magento\Customer\Model\ResourceModel\Group $subject
     * @param [type] $object
     * @return void
     */
    public function beforeSave(
        \Magento\Customer\Model\ResourceModel\Group $subject,
        $object
    ) {
        
        if ($this->customBarHelper->isEnabled()) { 
            $custom_bar_content = @$object->getData('extension_attributes')['custom_bar_content'];
            $object->setData('custom_bar_content',$custom_bar_content);
        }
        return [$object];
    }
}