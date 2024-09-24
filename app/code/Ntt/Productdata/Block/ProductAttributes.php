<?php
namespace Ntt\Productdata\Block;

use Magento\Catalog\Model\Product;
use Magento\Framework\View\Element\Template;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Registry;

class ProductAttributes extends Template
{
    protected $productRepository;
    protected $registry;

    public function __construct(
        Template\Context $context,
        ProductRepositoryInterface $productRepository,
        Registry $registry,
        array $data = []
    ) {
        $this->productRepository = $productRepository;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    public function getProduct()
    {
        return $this->registry->registry('current_product');
    }

    public function getCustomAttributes()
    {
        $product = $this->getProduct();
        if ($product) {
            return [
                'sample_attribute' => $product->getCustomAttribute('sample_attribute') ?
                    $product->getCustomAttribute('sample_attribute')->getValue() : null,
                'another_attribute' => $product->getCustomAttribute('another_attribute') ?
                    $product->getCustomAttribute('another_attribute')->getValue() : null
            ];
        }
        return [];
    }
}
