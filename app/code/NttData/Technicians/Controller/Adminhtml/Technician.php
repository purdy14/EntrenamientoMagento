<?php
/**
 * Comerline_Company Module
 *
 * @category    Comerline
 * @package     Comerline_Company
 * @author      Comerline
 *
 */
namespace NttData\Technicians\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use NttData\Technicians\Model\Technician as TechnicianModel;
use NttData\Technicians\Model\ResourceModel\Technician as TechnicianResource;

abstract class Technician extends Action
{
    protected TechnicianModel $technicianModel;
    protected TechnicianResource $technicianResource;

    public function __construct(
        Context         $context,
        TechnicianModel $technicianModel,
        TechnicianResource $technicianResource
    )
    {
        $this->technicianModel = $technicianModel;
        $this->technicianResource = $technicianResource;
        parent::__construct($context);
    }
}
