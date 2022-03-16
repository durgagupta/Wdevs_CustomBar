<?php
namespace Wdevs\CustomBar\Plugin\Backend\Magento\Customer\Block\Adminhtml\Group\Edit;

use Magento\Customer\Controller\RegistryConstants;
use Magento\Customer\Api\GroupRepositoryInterface;
use Wdevs\CustomBar\Helper\Data as CustomBarHelper;

class Form 
{

    protected $registry;
    protected $groupRepository;

    protected $customBarHelper;

    public function __construct(\Magento\Framework\Registry $registry,
        GroupRepositoryInterface $groupRepository,
        CustomBarHelper $customBarHelper ) {

        $this->registry = $registry;
        $this->groupRepository = $groupRepository;
        $this->customBarHelper = $customBarHelper;
    }

    /**
     * Undocumented function
     *
     * @param \Magento\Customer\Block\Adminhtml\Group\Edit\Form $subject
     * @param [type] $form
     * @return void
     */
    public function beforeSetForm(
        \Magento\Customer\Block\Adminhtml\Group\Edit\Form $subject,
        $form
    ) {

        if ($this->customBarHelper->isEnabled()) {
            
            $groupId = $this->registry->registry(RegistryConstants::CURRENT_GROUP_ID);
            if ($groupId === null) {
                $customBarContent = ""; 
            } else {
                $customerGroup = $this->groupRepository->getById($groupId);
                $customBarContent = $customerGroup->getExtensionAttributes()->getCustomBarContent();
            }
        
            $fieldset = $form->addFieldset('custom_bar', ['legend' => __('Custom Bar Information')]);
            $validateClass = sprintf('required-entry validate-length maximum-length-%d', 200);
            $fieldset->addField(
                'custom_bar_content',
                'textarea',
                [
                    'name' => 'custom_bar_content',
                    'label' => __('Custom Bar Content'),
                    'title' => __('Custom Bar Content'),
                    'note' => __('Maximum length must be less then %1 characters.',200),
                    'class' => $validateClass,
                    'required' => true
                ]
            );
            $form->addValues(["custom_bar_content" => $customBarContent]);
        }
        return [$form];
    }
}
