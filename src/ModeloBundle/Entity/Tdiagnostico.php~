<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tdiagnostico
 *
 * @ORM\Table(name="Tdiagnostico")
 * @ORM\Entity
 */
class Tdiagnostico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_tdiagnostico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codTdiagnostico;

    /**
     * @var string
     *
     * @ORM\Column(name="tdiag_descripcion", type="string", length=255, nullable=true)
     */
    private $tdiagDescripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tdiag_estado", type="integer", nullable=true)
     */
    private $tdiagEstado;



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
     * Set tdiagDescripcion
     *
     * @param string $tdiagDescripcion
     *
     * @return Tdiagnostico
     */
    public function setTdiagDescripcion($tdiagDescripcion)
    {
        $this->tdiagDescripcion = $tdiagDescripcion;

        return $this;
    }

    /**
     * Get tdiagDescripcion
     *
     * @return string
     */
    public function getTdiagDescripcion()
    {
        return $this->tdiagDescripcion;
    }

    /**
     * Set tdiagEstado
     *
     * @param integer $tdiagEstado
     *
     * @return Tdiagnostico
     */
    public function setTdiagEstado($tdiagEstado)
    {
        $this->tdiagEstado = $tdiagEstado;

        return $this;
    }

    /**
     * Get tdiagEstado
     *
     * @return integer
     */
    public function getTdiagEstado()
    {
        return $this->tdiagEstado;
    }
}
