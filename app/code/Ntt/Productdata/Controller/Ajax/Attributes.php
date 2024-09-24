<?php
namespace Ntt\Productdata\Controller\Ajax;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class Attributes extends Action
{
    protected $productRepository;
    protected $jsonFactory;

    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository,
        JsonFactory $jsonFactory
    ) {
        $this->productRepository = $productRepository;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->jsonFactory->create();
        $productId = $this->getRequest()->getParam('product_id');

        try {
            $product = $this->productRepository->getById($productId);
            $attributes = [
                'sample_attribute' => $product->getCustomAttribute('sample_attribute') ?
                    $product->getCustomAttribute('sample_attribute')->getValue() : null,
                'another_attribute' => $product->getCustomAttribute('another_attribute') ?
                    $product->getCustomAttribute('another_attribute')->getValue() : null
            ];
            return $result->setData(['success' => true, 'attributes' => $attributes]);
        } catch (\Exception $e) {
            return $result->setData(['success' => false, 'error_message' => $e->getMessage()]);
        }
    }
}
