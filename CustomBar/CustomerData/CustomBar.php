<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Wdevs\CustomBar\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Wdevs\CustomBar\Helper\Data as CusomtBarHelper;


class CustomBar implements SectionSourceInterface
{

    protected $logger;

    protected $customBarHelper;

    
    /**
     * Undocumented function
     *
     * @param CusomtBarHelper $customBarHelper
     */
    public function __construct(CusomtBarHelper $customBarHelper) {
        $this->customBarHelper = $customBarHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getSectionData()
    {
        if ($this->customBarHelper->isEnabled()) {
            return [
                'group_data' => $this->customBarHelper->getCustomBarContent()
            ];
        }  
        return [];    
    }

}

