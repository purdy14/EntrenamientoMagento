<?php
namespace Ntt\Questions\Cron;

use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Application;
use Magento\Framework\Console\CommandListInterface;
use Psr\Log\LoggerInterface;

class CustomCommand
{
    /**
     * @var Application
     */
    protected $application;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Constructor
     * 
     * @param Application $application
     * @param LoggerInterface $logger
     */
    public function __construct(Application $application, LoggerInterface $logger)
    {
        $this->application = $application;
        $this->logger = $logger;
    }

    /**
     * Método que se ejecuta a través del cron
     */
    public function execute()
    {
        $date = (new \DateTime())->format('Y-m-d H:i:s'); // Obtiene la fecha y hora actual en formato 'YYYY-MM-DD HH:MM:SS'

        try {
            // Buscar y ejecutar el comando directamente desde la aplicación de consola de Magento
            $command = $this->application->find('   '); // Cambia por el nombre de tu comando

            $input = new ArrayInput([]);
            $output = new NullOutput();

            $result = $command->run($input, $output);

            // Registra el resultado con la fecha
            $this->logger->info("[$date] Custom command executed successfully with result: " . $result);
        } catch (\Exception $e) {
            // Registra cualquier excepción que ocurra con la fecha
            $this->logger->error("[$date] Custom command failed with error: " . $e->getMessage());
        }
    }
}
