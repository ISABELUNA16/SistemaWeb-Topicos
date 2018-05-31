<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AtencionAnamnesisPaciente
 *
 * @ORM\Table(name="Atencion_anamnesis_paciente")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\AtencionAnamnesisPacienteRepository")
 */
class AtencionAnamnesisPaciente
{
   
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_aanamnesispac", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codAanamnesisPac;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_atencion", type="integer", nullable=true)
     */
    private $codAtencion;

     /**
     * @var string
     *
     * @ORM\Column(name="aanamnesispac_te", type="string", length=250, nullable=true)
     */
    private $aanamnpacTe;

    /**
     * @var string
     *
     * @ORM\Column(name="aanamnesispac_inicio", type="string", length=250, nullable=true)
     */
    private $aanamnpacInicio;

    /**
     * @var string
     *
     * @ORM\Column(name="aanamnesispac_curso", type="string", length=400, nullable=true)
     */
    private $aanampacCurso;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_user", type="integer", nullable=true)
     */
    private $codUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="aanamnesispac_feg_reg", type="datetime", nullable=true)
     */
    private $aanampacFegReg;

    /**
     * @var integer
     *
     * @ORM\Column(name="aanamnesispac_estado", type="integer", nullable=true)
     */
    private $aanampacEstado;


    /**
     * Get codAanamnesisPac
     *
     * @return integer
     */
    public function getCodAanamnesisPac()
    {
        return $this->codAanamnesisPac;
    }

    /**
     * Set codAtencion
     *
     * @param integer $codAtencion
     *
     * @return AtencionAnamnesisPaciente
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
     * Set aanamnpacTe
     *
     * @param string $aanamnpacTe
     *
     * @return AtencionAnamnesisPaciente
     */
    public function setAanamnpacTe($aanamnpacTe)
    {
        $this->aanamnpacTe = $aanamnpacTe;

        return $this;
    }

    /**
     * Get aanamnpacTe
     *
     * @return string
     */
    public function getAanamnpacTe()
    {
        return $this->aanamnpacTe;
    }

    /**
     * Set aanamnpacInicio
     *
     * @param string $aanamnpacInicio
     *
     * @return AtencionAnamnesisPaciente
     */
    public function setAanamnpacInicio($aanamnpacInicio)
    {
        $this->aanamnpacInicio = $aanamnpacInicio;

        return $this;
    }

    /**
     * Get aanamnpacInicio
     *
     * @return string
     */
    public function getAanamnpacInicio()
    {
        return $this->aanamnpacInicio;
    }

    /**
     * Set aanampacCurso
     *
     * @param string $aanampacCurso
     *
     * @return AtencionAnamnesisPaciente
     */
    public function setAanampacCurso($aanampacCurso)
    {
        $this->aanampacCurso = $aanampacCurso;

        return $this;
    }

    /**
     * Get aanampacCurso
     *
     * @return string
     */
    public function getAanampacCurso()
    {
        return $this->aanampacCurso;
    }

    /**
     * Set codUser
     *
     * @param integer $codUser
     *
     * @return AtencionAnamnesisPaciente
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
     * Set aanampacFegReg
     *
     * @param \DateTime $aanampacFegReg
     *
     * @return AtencionAnamnesisPaciente
     */
    public function setAanampacFegReg($aanampacFegReg)
    {
        $this->aanampacFegReg = $aanampacFegReg;

        return $this;
    }

    /**
     * Get aanampacFegReg
     *
     * @return \DateTime
     */
    public function getAanampacFegReg()
    {
        return $this->aanampacFegReg;
    }

    /**
     * Set aanampacEstado
     *
     * @param integer $aanampacEstado
     *
     * @return AtencionAnamnesisPaciente
     */
    public function setAanampacEstado($aanampacEstado)
    {
        $this->aanampacEstado = $aanampacEstado;

        return $this;
    }

    /**
     * Get aanampacEstado
     *
     * @return integer
     */
    public function getAanampacEstado()
    {
        return $this->aanampacEstado;
    }
}
