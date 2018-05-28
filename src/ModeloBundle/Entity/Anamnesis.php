<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anamnesis
 *
 * @ORM\Table(name="Anamnesis")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\AnamnesisRepository")
 */
class Anamnesis
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_anamnesis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codAnamnesis;

    /**
     * @var string
     *
     * @ORM\Column(name="anam_descripcion", type="string", length=100, nullable=true)
     */
    private $anamDescripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="anam_estado", type="integer", nullable=true)
     */
    private $anamEstado;


    /**
     * Get codAnamnesis
     *
     * @return integer
     */
    public function getCodAnamnesis()
    {
        return $this->codAnamnesis;
    }

    /**
     * Set anamDescripcion
     *
     * @param string $anamDescripcion
     *
     * @return Anamnesis
     */
    public function setAnamDescripcion($anamDescripcion)
    {
        $this->anamDescripcion = $anamDescripcion;

        return $this;
    }

    /**
     * Get anamDescripcion
     *
     * @return string
     */
    public function getAnamDescripcion()
    {
        return $this->anamDescripcion;
    }

    /**
     * Set anamEstado
     *
     * @param integer $anamEstado
     *
     * @return Anamnesis
     */
    public function setAnamEstado($anamEstado)
    {
        $this->anamEstado = $anamEstado;

        return $this;
    }

    /**
     * Get anamEstado
     *
     * @return integer
     */
    public function getAnamEstado()
    {
        return $this->anamEstado;
    }
}
