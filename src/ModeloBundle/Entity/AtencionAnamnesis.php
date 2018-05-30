<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AtencionAnamnesis
 *
 * @ORM\Table(name="Atencion_anamnesis")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\AtencionAnamnesisRepository")
 */
class AtencionAnamnesis
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_aanamnesis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codAanamnesis;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_atencion", type="integer", nullable=true)
     */
    private $codAtencion;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_anamnesis", type="integer", nullable=true)
     */
    private $codAnamnesis;

    /**
     * @var string
     *
     * @ORM\Column(name="aanam_observacion", type="string", length=400, nullable=true)
     */
    private $aanamObservacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_user", type="integer", nullable=true)
     */
    private $codUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="aanam_feg_reg", type="datetime", nullable=true)
     */
    private $aanamFegReg;

    /**
     * @var integer
     *
     * @ORM\Column(name="anam_estado", type="integer", nullable=true)
     */
    private $aanamEstado;




    /**
     * Get codAanamnesis
     *
     * @return integer
     */
    public function getCodAanamnesis()
    {
        return $this->codAanamnesis;
    }

    /**
     * Set codAtencion
     *
     * @param integer $codAtencion
     *
     * @return AtencionAnamnesis
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
     * Set codAnamnesis
     *
     * @param integer $codAnamnesis
     *
     * @return AtencionAnamnesis
     */
    public function setCodAnamnesis($codAnamnesis)
    {
        $this->codAnamnesis = $codAnamnesis;

        return $this;
    }

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
     * Set aanamObservacion
     *
     * @param string $aanamObservacion
     *
     * @return AtencionAnamnesis
     */
    public function setAanamObservacion($aanamObservacion)
    {
        $this->aanamObservacion = $aanamObservacion;

        return $this;
    }

    /**
     * Get aanamObservacion
     *
     * @return string
     */
    public function getAanamObservacion()
    {
        return $this->aanamObservacion;
    }

    /**
     * Set codUser
     *
     * @param integer $codUser
     *
     * @return AtencionAnamnesis
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
     * Set aanamFegReg
     *
     * @param \DateTime $aanamFegReg
     *
     * @return AtencionAnamnesis
     */
    public function setAanamFegReg($aanamFegReg)
    {
        $this->aanamFegReg = $aanamFegReg;

        return $this;
    }

    /**
     * Get aanamFegReg
     *
     * @return \DateTime
     */
    public function getAanamFegReg()
    {
        return $this->aanamFegReg;
    }

    /**
     * Set aanamEstado
     *
     * @param integer $aanamEstado
     *
     * @return AtencionAnamnesis
     */
    public function setAanamEstado($aanamEstado)
    {
        $this->aanamEstado = $aanamEstado;

        return $this;
    }

    /**
     * Get aanamEstado
     *
     * @return integer
     */
    public function getAanamEstado()
    {
        return $this->aanamEstado;
    }
}
