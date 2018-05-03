<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AtencionProcedimiento
 *
 * @ORM\Table(name="Atencion_procedimiento")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\AtencionProcedimientoRepository")
 */
class AtencionProcedimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_aprocedimiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codAprocedimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_atencion", type="integer", nullable=true)
     */
    private $codAtencion;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_procedimiento", type="integer", nullable=true)
     */
    private $codProcedimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_user", type="integer", nullable=true)
     */
    private $codUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="aproc_feg_reg", type="datetime", nullable=true)
     */
    private $aprocFegReg;

    /**
     * @var integer
     *
     * @ORM\Column(name="aproc_estado", type="integer", nullable=true)
     */
    private $aprocEstado;



    /**
     * Get codAprocedimiento
     *
     * @return integer
     */
    public function getCodAprocedimiento()
    {
        return $this->codAprocedimiento;
    }

    /**
     * Set codAtencion
     *
     * @param integer $codAtencion
     *
     * @return AtencionProcedimiento
     */
    public function setCodAtencion($codAtencion)
    {
        $this->codAtencion = $codAtencion;

        return $this;
    }

    /**
     * Get codAtencion
     *
     * @return integer
     */
    public function getCodAtencion()
    {
        return $this->codAtencion;
    }

    /**
     * Set codProcedimiento
     *
     * @param integer $codProcedimiento
     *
     * @return AtencionProcedimiento
     */
    public function setCodProcedimiento($codProcedimiento)
    {
        $this->codProcedimiento = $codProcedimiento;

        return $this;
    }

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
     * Set codUser
     *
     * @param integer $codUser
     *
     * @return AtencionProcedimiento
     */
    public function setCodUser($codUser)
    {
        $this->codUser = $codUser;

        return $this;
    }

    /**
     * Get codUser
     *
     * @return integer
     */
    public function getCodUser()
    {
        return $this->codUser;
    }

    /**
     * Set aprocFegReg
     *
     * @param \DateTime $aprocFegReg
     *
     * @return AtencionProcedimiento
     */
    public function setAprocFegReg($aprocFegReg)
    {
        $this->aprocFegReg = $aprocFegReg;

        return $this;
    }

    /**
     * Get aprocFegReg
     *
     * @return \DateTime
     */
    public function getAprocFegReg()
    {
        return $this->aprocFegReg;
    }

    /**
     * Set aprocEstado
     *
     * @param integer $aprocEstado
     *
     * @return AtencionProcedimiento
     */
    public function setAprocEstado($aprocEstado)
    {
        $this->aprocEstado = $aprocEstado;

        return $this;
    }

    /**
     * Get aprocEstado
     *
     * @return integer
     */
    public function getAprocEstado()
    {
        return $this->aprocEstado;
    }
}
