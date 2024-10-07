<?php

namespace NttData\Technicians\Console\Command;

use Magento\Framework\App\State;
use Magento\Framework\App\ResourceConnection;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as OrderCollectionFactory;
use Magento\Sales\Model\ResourceModel\Order\Item\CollectionFactory as OrderItemCollectionFactory;
use NttData\Technicians\Model\ResourceModel\Technician\CollectionFactory as TechnicianCollectionFactory;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Mail\Attachment; // Asegúrate de tener esta línea
use Magento\Framework\Mail\Message; // Asegúrate de tener esta línea

class SendTechnicianEmail extends Command
{
    protected $resource;
    protected $orderCollectionFactory;
    protected $orderItemCollectionFactory;
    protected $technicianCollectionFactory;
    protected $transportBuilder;
    protected $inlineTranslation;
    protected $state;

    public function __construct(
        State $state,
        ResourceConnection $resource,
        OrderCollectionFactory $orderCollectionFactory,
        OrderItemCollectionFactory $orderItemCollectionFactory,
        TechnicianCollectionFactory $technicianCollectionFactory,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation
    ) {
        $this->state = $state;
        $this->resource = $resource;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->orderItemCollectionFactory = $orderItemCollectionFactory;
        $this->technicianCollectionFactory = $technicianCollectionFactory;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('nttdata:send-email');
        $this->setDescription('Enviar correos de información del técnico a los clientes');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Aumentar límite de memoria si es necesario
        ini_set('memory_limit', '4G');
        $this->state->setAreaCode('frontend');
        $output->writeln('<info>Comenzando a procesar pedidos no procesados...</info>');

        // Obtener pedidos en estado 0 (no procesado)
        $orderCollection = $this->orderCollectionFactory->create()
            ->addFieldToFilter('processed', '0');

        $output->writeln('<info>Se han encontrado ' . $orderCollection->getSize() . ' pedidos no procesados.</info>');

        foreach ($orderCollection as $order) {
            $output->writeln('<info>Procesando pedido ID: ' . $order->getId() . '</info>');

            // Obtener items del pedido
            $orderItems = $this->orderItemCollectionFactory->create()
                ->addFieldToFilter('order_id', $order->getId());

            foreach ($orderItems as $item) {
                $sku = $item->getSku();
                $currentDay = date('l'); // Día actual
                $regional = $order->getData('regional');
                $output->writeln('<info>Producto SKU: ' . $sku . '</info>');

                // Obtener el primer técnico
                $technician = $this->getFirstTechnician();

                if ($technician) {
                    $output->writeln('<info>Primer técnico encontrado: ' . $technician->getData('nombre') . '</info>');
                    $codigoTecnico = $technician->getData('codigo');
                    $pdfFileName = 'tecnico_' . $codigoTecnico . '.pdf';
                    $pdfFilePath = BP . '/pub/' . $pdfFileName; // Archivo PDF en carpeta pública

                    if (file_exists($pdfFilePath)) {
                        $output->writeln('<info>El archivo PDF ' . $pdfFileName . ' existe. Enviando correo...</info>');

                        // Enviar el correo al cliente
                        $this->sendEmail(
                            $order->getCustomerEmail(),
                            $sku,
                            $currentDay,
                            $regional,
                            $pdfFilePath,
                            $technician,
                            $order
                        );

                        $output->writeln('<info>Correo enviado a ' . $order->getCustomerEmail() . '</info>');

                        // Marcar el pedido como procesado
                        $this->markOrderAsProcessed($order);
                        $output->writeln('<info>Pedido ID ' . $order->getId() . ' marcado como procesado.</info>');
                    } else {
                        $output->writeln('<error>El archivo PDF ' . $pdfFileName . ' no existe. No se enviará el correo.</error>');
                    }
                } else {
                    $output->writeln('<error>No se encontró un técnico disponible.</error>');
                }
            }
        }

        $output->writeln('<info>Correos enviados y pedidos procesados.</info>');
        return 0;
    }

    protected function getFirstTechnician()
    {
        $technicianCollection = $this->technicianCollectionFactory->create();
        return $technicianCollection->getFirstItem();
    }

    protected function sendEmail($customerEmail, $sku, $currentDay, $regional, $pdfFilePath, $technician, $order)
    {
        $this->inlineTranslation->suspend();

        // Crear el transporte para el correo
        $transport = $this->transportBuilder
            ->setTemplateIdentifier('technician_installation') // Identificador de la plantilla
            ->setTemplateOptions([
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND, // Define el área (frontend o adminhtml)
                'store' => $order->getStoreId() // Define la tienda desde el pedido
            ])
            ->setTemplateVars([
                'sku' => $sku,
                'day' => $currentDay,
                'regional' => $regional,
                'message' => 'Su producto será instalado entre las 8:00 am y 10:00 am.',
                'technician_name' => $technician->getData('nombre'),
                'technician_cell' => $technician->getData('celular'),
                'technician_email' => $technician->getData('correo')
            ])
            ->setFromByScope('general')
            ->addTo($customerEmail)
            // ->addAttachment(
            //     open($pdfFilePath, 'r'),
            //     'application/pdf',
            //     basename($pdfFilePath),
            //     \Zend_Mime::DISPOSITION_ATTACHMENT,
            //     \Zend_Mime::ENCODING_BASE64
            // )
            ->getTransport();

        // // Crear el adjunto
        // if (file_exists($pdfFilePath)) {
        //     $attachment = new Attachment();
        //     $attachment->setFileName(basename($pdfFilePath))
        //         ->setType('application/pdf')
        //         ->setDisposition('attachment')
        //         ->setContent(fopen($pdfFilePath, 'r'));

        //     // Agregar el adjunto al transporte
        //     $transport->addAttachment($attachment);
        // }

        // Enviar el correo
        try {
            $transport->sendMessage();
            $output->writeln('<info>Correo enviado correctamente a ' . $customerEmail . '</info>');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        $this->inlineTranslation->resume();
    }

    protected function markOrderAsProcessed($order)
    {
        $connection = $this->resource->getConnection();
        $connection->update(
            $this->resource->getTableName('sales_order'),
            ['processed' => 1],
            ['entity_id = ?' => $order->getId()]
        );
    }
}
