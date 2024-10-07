<?php

namespace NttData\Technicians\Controller\Adminhtml\Technician;

use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use NttData\Technicians\Controller\Adminhtml\Technician as TechnicianAction;

class Edit extends TechnicianAction
{
    /**
     * Edit/Add A Company Page
     *
     * @return Page|Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
        $technicianDatas = $this->getRequest()->getParam('technician');
        if (is_array($technicianDatas)) {
            $technicianModel = $this->technicianModel;
            $technicianModel->setData($technicianDatas);
            $this->technicianResource->save($technicianModel);
            $this->messageManager->addSuccess(__('Technician saved successfully'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
