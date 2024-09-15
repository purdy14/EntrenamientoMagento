<?php
namespace Vendor\Questions\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Sales\Api\OrderRepositoryInterface;

class SaveOrderData implements ObserverInterface
{
    protected $customOrderDataFactory;
    protected $logger;
    protected $orderRepository;

    public function __construct(
        \Vendor\Questions\Model\CustomOrderDataFactory $customOrderDataFactory,
        LoggerInterface $logger,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->customOrderDataFactory = $customOrderDataFactory;
        $this->logger = $logger;
        $this->orderRepository = $orderRepository;
    }

    public function execute(Observer $observer)
    {
        try {
            $this->logger->info('Observer ejecutado: Iniciando proceso para guardar datos personalizados.');

            // Obtener el objeto del evento
            $order = $observer->getEvent()->getOrder();
            $this->logger->info('Order obtenido desde el evento: ' . ($order ? 'Sí' : 'No'));

            // Verificar si el objeto del pedido está disponible y tiene un Increment ID válido
            if ($order && $order->getIncrementId()) {
                $incrementId = $order->getIncrementId();
                $this->logger->info('Increment ID encontrado: ' . $incrementId);

                // Obtener el ID del pedido para operaciones internas
                $orderId = $order->getId();
                $this->logger->info('Pedido encontrado con ID: ' . $orderId);

                // Obtener los productos del pedido
                $items = $order->getAllItems();
                $this->logger->info('Productos obtenidos del pedido: ' . count($items));

                // Recorrer los productos y guardar SKU y order_id en la tabla personalizada
                foreach ($items as $item) {
                    $sku = $item->getSku(); // Obtener el SKU del producto
                    $this->logger->info('Procesando SKU: ' . $sku);

                    // Guardar los datos en la tabla personalizada
                    $this->saveCustomOrderData($sku, $incrementId);
                }
            } else {
                $this->logger->error('El pedido no está disponible o no tiene un Increment ID válido.');
            }

        } catch (\Exception $e) {
            // Registrar cualquier error con más detalles
            $this->logger->error('Error al guardar los datos personalizados: ' . $e->getMessage());
            $this->logger->error('Traza del error: ' . $e->getTraceAsString());
        }
    }

    protected function saveCustomOrderData($sku, $incrementId)
    {
        try {
            // Crear una instancia del modelo CustomOrderData
            $customOrderData = $this->customOrderDataFactory->create();

            // Asignar los datos del SKU y el Increment ID
            $customOrderData->setData('sku', $sku);
            $customOrderData->setData('increment_id', $incrementId);

            // Guardar los datos en la tabla personalizada
            $customOrderData->save();

            // Registrar que los datos se guardaron correctamente
            $this->logger->info('Datos guardados exitosamente para Increment ID: ' . $incrementId . ' SKU: ' . $sku);

        } catch (\Exception $e) {
            // Registrar cualquier error durante el guardado de datos
            $this->logger->error('Error al guardar los datos personalizados: ' . $e->getMessage());
            $this->logger->error('Traza del error (saveCustomOrderData): ' . $e->getTraceAsString());
        }
    }
}
