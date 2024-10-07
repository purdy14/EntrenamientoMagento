<?php
namespace NttData\Technicians\Controller\Adminhtml\Technician;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use NttData\Technicians\Model\ResourceModel\Technician\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;

class MassStatus extends \Magento\Backend\App\Action
{
    protected $filter;
    protected $collectionFactory;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
    }

    public function execute()
    {
        $status = (int) $this->getRequest()->getParam('status');
        $statusField = $this->getRequest()->getParam('status_field');

        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $updatedItems = 0;

        foreach ($collection as $item) {
            $item->setData($statusField, $status)->save();
            $updatedItems++;
        }

        $this->messageManager->addSuccessMessage(__('Updated %1 items.', $updatedItems));

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
}
