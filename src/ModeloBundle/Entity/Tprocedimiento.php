<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tprocedimiento
 *
 * @ORM\Table(name="Tprocedimiento")
 * @ORM\Entity
 */
class Tprocedimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_tprocedimiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codTprocedimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="tproc_descripcion", type="string", length=255, nullable=true)
     */
    private $tprocDescripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tproc_estado", type="integer", nullable=true)
     */
    private $tprocEstado;

  

    /**
     * Get codTprocedimiento
     *
     * @return integer
     */
    public function getCodTprocedimiento()
    {
        return $this->codTprocedimiento;
    }

    /**
     * Set tprocDescripcion
     *
     * @param string $tprocDescripcion
     *
     * @return Tprocedimiento
     */
    public function setTprocDescripcion($tprocDescripcion)
    {
        $this->tprocDescripcion = $tprocDescripcion;

        return $this;
    }

    /**
     * Get tprocDescripcion
     *
     * @return string
     */
    public function getTprocDescripcion()
    {
        return $this->tprocDescripcion;
    }

    /**
     * Set tprocEstado
     *
     * @param integer $tprocEstado
     *
     * @return Tprocedimiento
     */
    public function setTprocEstado($tprocEstado)
    {
        $this->tprocEstado = $tprocEstado;

        return $this;
    }

    /**
     * Get tprocEstado
     *
     * @return integer
     */
    public function getTprocEstado()
    {
        return $this->tprocEstado;
    }
}
