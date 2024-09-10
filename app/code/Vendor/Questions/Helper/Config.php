<?php

namespace Vendor\Questions\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    public function getCustomFieldValue()
    {
        return $this->scopeConfig->getValue('custom_section/custom_group/custom_field', ScopeInterface::SCOPE_STORE);
    }
}