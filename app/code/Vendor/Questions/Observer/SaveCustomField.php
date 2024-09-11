<?php
namespace Vendor\Questions\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\OrderRepository;
use Psr\Log\LoggerInterface;

class SaveCustomField implements ObserverInterface
{
    protected $orderRepository;
    protected $logger;

    public function __construct(
        OrderRepository $orderRepository,
        LoggerInterface $logger
    ) {
        $this->orderRepository = $orderRepository;
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        // Obtén el objeto del pedido del evento
        $order = $observer->getEvent()->getOrder();
        
        // Acceder a la dirección de envío del pedido
        $this->logger->info('shippingAddres: ' . 'entrooo');
        $shippingAddress = $order->getShippingAddress();

        if ($shippingAddress) {
            // Obtener el valor de un campo personalizado (custom_field) desde custom attributes
            $customAttributes = $shippingAddress->getCustomAttributes();

            // Verificar si el campo personalizado está presente
            if (isset($customAttributes['custom_field'])) {
                $this->logger->info('shippingAddres: ' . 'entrooo');
                $customFieldValue = $customAttributes['custom_field']->getValue();

                // Registro para verificar el valor del campo personalizado
                $this->logger->info('Custom Field Value: ' . $customFieldValue);

                // Asignar el valor del campo personalizado al pedido
                $order->setCustomField($customFieldValue);
                $this->orderRepository->save($order);
            }
        }
    }
}
