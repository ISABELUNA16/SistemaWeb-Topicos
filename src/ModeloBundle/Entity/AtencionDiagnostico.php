<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AtencionDiagnostico
 *
 * @ORM\Table(name="Atencion_diagnostico")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\AtencionDiagnosticoRepository")
 */
class AtencionDiagnostico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_adiagnostico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codAdiagnostico;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_atencion", type="integer", nullable=true)
     */
    private $codAtencion;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_diagnostico", type="integer", nullable=true)
     */
    private $codDiagnostico;

    /**
     * @var integer
     *
     * @ORM\Column(name="adiag_tipo", type="integer", nullable=true)
     */
    private $adiagTipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_user", type="integer", nullable=true)
     */
    private $codUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="adiag_feg_reg", type="datetime", nullable=true)
     */
    private $adiagFegReg;

    /**
     * @var integer
     *
     * @ORM\Column(name="adiag_estado", type="integer", nullable=true)
     */
    private $adiagEstado;



    /**
     * Get codAdiagnostico
     *
     * @return integer
     */
    public function getCodAdiagnostico()
    {
        return $this->codAdiagnostico;
    }

    /**
     * Set codAtencion
     *
     * @param integer $codAtencion
     *
     * @return AtencionDiagnostico
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
     * Set codDiagnostico
     *
     * @param integer $codDiagnostico
     *
     * @return AtencionDiagnostico
     */
    public function setCodDiagnostico($codDiagnostico)
    {
        $this->codDiagnostico = $codDiagnostico;

        return $this;
    }

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
     * Set adiagTipo
     *
     * @param integer $adiagTipo
     *
     * @return AtencionDiagnostico
     */
    public function setAdiagTipo($adiagTipo)
    {
        $this->adiagTipo = $adiagTipo;

        return $this;
    }

    /**
     * Get adiagTipo
     *
     * @return integer
     */
    public function getAdiagTipo()
    {
        return $this->adiagTipo;
    }

    /**
     * Set codUser
     *
     * @param integer $codUser
     *
     * @return AtencionDiagnostico
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
     * Set adiagFegReg
     *
     * @param \DateTime $adiagFegReg
     *
     * @return AtencionDiagnostico
     */
    public function setAdiagFegReg($adiagFegReg)
    {
        $this->adiagFegReg = $adiagFegReg;

        return $this;
    }

    /**
     * Get adiagFegReg
     *
     * @return \DateTime
     */
    public function getAdiagFegReg()
    {
        return $this->adiagFegReg;
    }

    /**
     * Set adiagEstado
     *
     * @param integer $adiagEstado
     *
     * @return AtencionDiagnostico
     */
    public function setAdiagEstado($adiagEstado)
    {
        $this->adiagEstado = $adiagEstado;

        return $this;
    }

    /**
     * Get adiagEstado
     *
     * @return integer
     */
    public function getAdiagEstado()
    {
        return $this->adiagEstado;
    }
}
