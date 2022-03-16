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
     * Constructor
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(\Psr\Log\LoggerInterface $logger,
                                CusomtBarHelper $customBarHelper) {

        $this->logger = $logger;
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

