<?php
namespace NttData\Technicians\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Regional implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'north', 'label' => __('North')],
            ['value' => 'south', 'label' => __('South')],
            ['value' => 'east', 'label' => __('East')],
            ['value' => 'west', 'label' => __('West')],
        ];
    }
}
