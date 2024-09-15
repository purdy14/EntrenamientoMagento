<?php
namespace Ntt\Questions\Block;

use Magento\Framework\View\Element\Template;
use Ntt\Questions\Model\ResourceModel\Question\CollectionFactory;

class QuestionList extends Template
{
    protected $collectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getQuestions()
    {
        $collection = $this->collectionFactory->create();
        return $collection->getItems();
    }
}
