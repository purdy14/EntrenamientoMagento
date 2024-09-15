<?php
namespace Ntt\Questions\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Question extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('ntt_questions', 'question_id');
    }
}
