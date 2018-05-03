<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diagnostico
 *
 * @ORM\Table(name="Diagnostico")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\DiagnosticoRepository")
 */
class Diagnostico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_diagnostico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codDiagnostico;

    /**
     * @var string
     *
     * @ORM\Column(name="diag_descripcion", type="string", length=255, nullable=true)
     */
    private $diagDescripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_tdiagnostico", type="integer", nullable=true)
     */
    private $codTdiagnostico;

    /**
     * @var string
     *
     * @ORM\Column(name="diag_codigo", type="string", length=30, nullable=true)
     */
    private $diagCodigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="diag_estado", type="integer", nullable=true)
     */
    private $diagEstado;



    /**
     * Get codDiagnostico
     *
     * @return integer
     */
    public function getCodDiagnostico()
    {
        return $this->codDiagnostico;
    }

    /**
     * Set diagDescripcion
     *
     * @param string $diagDescripcion
     *
     * @return Diagnostico
     */
    public function setDiagDescripcion($diagDescripcion)
    {
        $this->diagDescripcion = $diagDescripcion;

        return $this;
    }

    /**
     * Get diagDescripcion
     *
     * @return string
     */
    public function getDiagDescripcion()
    {
        return $this->diagDescripcion;
    }

    /**
     * Set codTdiagnostico
     *
     * @param integer $codTdiagnostico
     *
     * @return Diagnostico
     */
    public function setCodTdiagnostico($codTdiagnostico)
    {
        $this->codTdiagnostico = $codTdiagnostico;

        return $this;
    }

    /**
     * Get codTdiagnostico
     *
     * @return integer
     */
    public function getCodTdiagnostico()
    {
        return $this->codTdiagnostico;
    }

    /**
     * Set diagCodigo
     *
     * @param string $diagCodigo
     *
     * @return Diagnostico
     */
    public function setDiagCodigo($diagCodigo)
    {
        $this->diagCodigo = $diagCodigo;

        return $this;
    }

    /**
     * Get diagCodigo
     *
     * @return string
     */
    public function getDiagCodigo()
    {
        return $this->diagCodigo;
    }

    /**
     * Set diagEstado
     *
     * @param integer $diagEstado
     *
     * @return Diagnostico
     */
    public function setDiagEstado($diagEstado)
    {
        $this->diagEstado = $diagEstado;

        return $this;
    }

    /**
     * Get diagEstado
     *
     * @return integer
     */
    public function getDiagEstado()
    {
        return $this->diagEstado;
    }
}
