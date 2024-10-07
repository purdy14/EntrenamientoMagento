<?php

namespace NttData\Technicians\Block\Adminhtml\Edit\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Psr\Log\LoggerInterface;
use Magento\Backend\Block\Widget\Context; // Asegúrate de importar el contexto correcto
use Magento\Framework\Registry;

/**
 * Class SaveButton
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * SaveButton constructor.
     * @param Context $context
     * @param Registry $registry
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        Registry $registry,
        LoggerInterface $logger
    ) {
        parent::__construct($context, $registry);
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        $technician = $this->getTechnician();
        
        // Logging technician data
        $this->logger->info('Technician data:', ['technician' => $technician]);

        $technicianId = null;
        if ($technician) {
            $technicianId = $technician->getId();
        }
        if (($technicianId && $technician->canBeEdited()) || !$this->getId()) {
            $data = [
                'label' => __('Save'),
                'class' => 'save primary',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'save']],
                    'form-role' => 'save',
                ],
                'sort_order' => 90,
            ];
        }
        return $data;
    }
}
