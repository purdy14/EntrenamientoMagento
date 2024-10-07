<?php
/**
 * Comerline_Company Module
 *
 * @category    Comerline
 * @package     Comerline_Company
 * @author      Comerline
 *
 */

namespace NttData\Technicians\Model\Technician;

use NttData\Technicians\Model\ResourceModel\Technician\CollectionFactory;
use Magento\Framework\Filesystem;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{

    /**
     * @var Filesystem|null
     */
    protected $filesystem = null;

    /**
     * @var StoreManagerInterface|null
     */
    protected $storageManagerInterface = null;

    /**
     * @var array|null
     */
    protected $loadedData = null;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param Filesystem $filesystem
     * @param StoreManagerInterface $storageManagerInterface
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        Filesystem $filesystem,
        StoreManagerInterface $storageManagerInterface,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $collectionFactory->create();
        $this->storageManagerInterface = $storageManagerInterface;
        $this->filesystem = $filesystem;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = [];
        foreach ($items as $i) {
            $data = $i->getData();
            $this->loadedData[$i->getId()]['technician'] = $data;
        }

        return $this->loadedData;
    }
}
