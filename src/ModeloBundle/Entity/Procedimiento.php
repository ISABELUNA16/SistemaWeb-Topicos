<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Procedimiento
 *
 * @ORM\Table(name="Procedimiento")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\ProcedimientoRepository")
 */
class Procedimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_procedimiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codProcedimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="proc_descripcion", type="string", length=100, nullable=true)
     */
    private $procDescripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="proc_estado", type="integer", nullable=true)
     */
    private $procEstado;

     /**
     * @var integer
     *
     * @ORM\Column(name="cod_tprocedimiento", type="integer", nullable=true)
     */
    private $codTprocedimiento;


    /**
     * Get codProcedimiento
     *
     * @return integer
     */
    public function getCodProcedimiento()
    {
        return $this->codProcedimiento;
    }

    /**
     * Set procDescripcion
     *
     * @param string $procDescripcion
     *
     * @return Procedimiento
     */
    public function setProcDescripcion($procDescripcion)
    {
        $this->procDescripcion = $procDescripcion;

        return $this;
    }

    /**
     * Get procDescripcion
     *
     * @return string
     */
    public function getProcDescripcion()
    {
        return $this->procDescripcion;
    }

    /**
     * Set procEstado
     *
     * @param integer $procEstado
     *
     * @return Procedimiento
     */
    public function setProcEstado($procEstado)
    {
        $this->procEstado = $procEstado;

        return $this;
    }

    /**
     * Get procEstado
     *
     * @return integer
     */
    public function getProcEstado()
    {
        return $this->procEstado;
    }

    /**
     * Set codTprocedimiento
     *
     * @param integer $codTprocedimiento
     *
     * @return Procedimiento
     */
    public function setCodTprocedimiento($codTprocedimiento)
    {
        $this->codTprocedimiento = $codTprocedimiento;

        return $this;
    }

    /**
     * Get codTprocedimiento
     *
     * @return integer
     */
    public function getCodTprocedimiento()
    {
        return $this->codTprocedimiento;
    }
}
