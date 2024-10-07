<?php

/**
 * NttData_Technicians Module
 *
 * @category    NttData
 * @package     NttData_Technicians
 */

namespace NttData\Technicians\Model;

use NttData\Technicians\Api\Data\TechnicianInterface;
use Magento\Framework\Model\AbstractModel;

class Technician extends AbstractModel implements TechnicianInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'nttdata_technicians';

    /**
     * @var string
     */
    protected $_cacheTag = 'nttdata_technicians';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'nttdata_technicians';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('NttData\Technicians\Model\ResourceModel\Technician');
    }

    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    public function getSku()
    {
        return $this->getData(self::SKU);
    }

    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    public function getNombreTecnico()
    {
        return $this->getData(self::NOMBRE_TECNICO);
    }

    public function setNombreTecnico($nombreTecnico)
    {
        return $this->setData(self::NOMBRE_TECNICO, $nombreTecnico);
    }

    public function getCelularTecnico()
    {
        return $this->getData(self::CELULAR_TECNICO);
    }

    public function setCelularTecnico($celularTecnico)
    {
        return $this->setData(self::CELULAR_TECNICO, $celularTecnico);
    }

    public function getCorreoTecnico()
    {
        return $this->getData(self::CORREO_TECNICO);
    }

    public function setCorreoTecnico($correoTecnico)
    {
        return $this->setData(self::CORREO_TECNICO, $correoTecnico);
    }

    public function getCodigoTecnico()
    {
        return $this->getData(self::CODIGO_TECNICO);
    }

    public function setCodigoTecnico($codigoTecnico)
    {
        return $this->setData(self::CODIGO_TECNICO, $codigoTecnico);
    }

    public function getDiaSemana()
    {
        return $this->getData(self::DIA_SEMANA);
    }

    public function setDiaSemana($diaSemana)
    {
        return $this->setData(self::DIA_SEMANA, $diaSemana);
    }

    public function getRegional()
    {
        return $this->getData(self::REGIONAL);
    }

    public function setRegional($regional)
    {
        return $this->setData(self::REGIONAL, $regional);
    }

    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
