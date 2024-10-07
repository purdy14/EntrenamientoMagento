<?php

namespace NttData\Technicians\Block\Adminhtml\Edit\Buttons;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;
use Magento\Framework\UrlInterface;

class GenericButton
{
    protected UrlInterface $urlBuilder;
    protected Registry $registry;
    protected Context $context;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Registry $registry
     */
    public function __construct(
        Context  $context,
        Registry $registry
    )
    {
        $this->context = $context;
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
    }

    /**
     * Return the synonyms group Id.
     *
     * @return int|null
     */
    public function getId()
    {
        $company = $this->registry->registry('current_nttdata_technicians_items');
        return $company ? $company->getId() : null;
    }

    public function getTechnician()
    {
        return $this->registry->registry('current_nttdata_technicians_items');
    }

    public function getEntry()
    {
        return $this->registry->registry('current_nttdata_technicians_entry');
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
