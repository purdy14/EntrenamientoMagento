<?php
namespace NttData\Technicians\Controller\Adminhtml\Technician;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use NttData\Technicians\Model\ResourceModel\Technician\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;

class MassDelete extends \Magento\Backend\App\Action
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
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $deletedItems = 0;
        
        foreach ($collection as $item) {
            $item->delete();
            $deletedItems++;
        }

        $this->messageManager->addSuccessMessage(__('Deleted %1 items.', $deletedItems));

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
}
