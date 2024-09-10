<?php

namespace Vendor\Questions\Block;

use Magento\Framework\View\Element\Template;
use Vendor\Questions\Helper\Config as ConfigHelper;

class CustomConfig extends Template
{
    protected $configHelper;

    public function __construct(
        Template\Context $context,
        ConfigHelper $configHelper,
        array $data = []
    ) {
        $this->configHelper = $configHelper;
        parent::__construct($context, $data);
    }

    public function getCustomFieldValue()
    {
        return $this->configHelper->getCustomFieldValue();
    }
}
