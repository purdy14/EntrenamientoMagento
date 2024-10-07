<?php

namespace NttData\Technicians\Api\Data;

interface TechnicianInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const ENTITY_ID = 'id';
    const SKU = 'sku';
    const NOMBRE_TECNICO = 'nombre_tecnico';
    const CELULAR_TECNICO = 'celular_tecnico';
    const CORREO_TECNICO = 'correo_tecnico';
    const CODIGO_TECNICO = 'codigo_tecnico';
    const DIA_SEMANA = 'dia_semana';
    const REGIONAL = 'regional';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getEntityId();

    public function setEntityId($entityId);

    public function getSku();

    public function setSku($sku);

    public function getNombreTecnico();

    public function setNombreTecnico($nombreTecnico);

    public function getCelularTecnico();

    public function setCelularTecnico($celularTecnico);

    public function getCorreoTecnico();

    public function setCorreoTecnico($correoTecnico);

    public function getCodigoTecnico();

    public function setCodigoTecnico($codigoTecnico);

    public function getDiaSemana();

    public function setDiaSemana($diaSemana);

    public function getRegional();

    public function setRegional($regional);

    public function getStatus();

    public function setStatus($status);

    public function getCreatedAt();

    public function setCreatedAt($createdAt);

    public function getUpdatedAt();

    public function setUpdatedAt($updatedAt);
}
