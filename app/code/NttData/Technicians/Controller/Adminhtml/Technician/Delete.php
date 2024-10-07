<?php

namespace NttData\Technicians\Controller\Adminhtml\Technician;


use NttData\Technicians\Controller\Adminhtml\Technician;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;

class Delete extends Technician
{
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('NttData_Technicians::index_delete');
    }

    /**
     * Delete action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->technicianModel;
                $this->technicianResource->load($model, $id);
                $this->technicianResource->delete($model);
                $this->messageManager->addSuccess(__('Technician deleted'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Technician does not exist'));
        return $resultRedirect->setPath('*/*/');
    }
}
