<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Wdevs\CustomBar\Block;

use Wdevs\CustomBar\Helper\Data as CusomtBarHelper;
use Magento\Framework\View\Element\Template\Context;

class CustomBar extends \Magento\Framework\View\Element\Template
{

    /**
     * Undocumented variable
     *
     * @var CusomtBarHelper
     */
    protected $cusomtBarHelperHelper;

   /**
    * Undocumented function
    *
    * @param Context $context
    * @param CusomtBarHelper $cusomtBarHelper
    * @param array $data
    */
    public function __construct(
        Context $context,
        CusomtBarHelper $cusomtBarHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->cusomtBarHelperHelper = $cusomtBarHelper;
    }

    /**
     * @return CusomtBarHelper
     */
    public function getCustomBarHerlper()
    {
        return $this->cusomtBarHelperHelper;
    }
}