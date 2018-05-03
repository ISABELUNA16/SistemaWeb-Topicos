<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Antecedente
 *
 * @ORM\Table(name="Antecedente")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\AntecedenteRepository")
 */
class Antecedente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_antecedente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codAntecedente;

    /**
     * @var integer
     *
     * @ORM\Column(name="codper", type="integer", nullable=true)
     */
    private $codper;

    /**
     * @var string
     *
     * @ORM\Column(name="ant_descripcion", type="text", length=-1, nullable=true)
     */
    private $antDescripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_tantecedente", type="integer", nullable=true)
     */
    private $codTantecedente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ant_fecha_reg", type="datetime", nullable=true)
     */
    private $antFechaReg;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_user", type="integer", nullable=true)
     */
    private $codUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="ant_estado", type="integer", nullable=true)
     */
    private $antEstado;



    /**
     * Get codAntecedente
     *
     * @return integer
     */
    public function getCodAntecedente()
    {
        return $this->codAntecedente;
    }

    /**
     * Set codper
     *
     * @param integer $codper
     *
     * @return Antecedente
     */
    public function setCodper($codper)
    {
        $this->codper = $codper;

        return $this;
    }

    /**
     * Get codper
     *
     * @return integer
     */
    public function getCodper()
    {
        return $this->codper;
    }

    /**
     * Set antDescripcion
     *
     * @param string $antDescripcion
     *
     * @return Antecedente
     */
    public function setAntDescripcion($antDescripcion)
    {
        $this->antDescripcion = $antDescripcion;

        return $this;
    }

    /**
     * Get antDescripcion
     *
     * @return string
     */
    public function getAntDescripcion()
    {
        return $this->antDescripcion;
    }

    /**
     * Set codTantecedente
     *
     * @param integer $codTantecedente
     *
     * @return Antecedente
     */
    public function setCodTantecedente($codTantecedente)
    {
        $this->codTantecedente = $codTantecedente;

        return $this;
    }

    /**
     * Get codTantecedente
     *
     * @return integer
     */
    public function getCodTantecedente()
    {
        return $this->codTantecedente;
    }

    /**
     * Set antFechaReg
     *
     * @param \DateTime $antFechaReg
     *
     * @return Antecedente
     */
    public function setAntFechaReg($antFechaReg)
    {
        $this->antFechaReg = $antFechaReg;

        return $this;
    }

    /**
     * Get antFechaReg
     *
     * @return \DateTime
     */
    public function getAntFechaReg()
    {
        return $this->antFechaReg;
    }

    /**
     * Set codUser
     *
     * @param integer $codUser
     *
     * @return Antecedente
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
     * Set antEstado
     *
     * @param integer $antEstado
     *
     * @return Antecedente
     */
    public function setAntEstado($antEstado)
    {
        $this->antEstado = $antEstado;

        return $this;
    }

    /**
     * Get antEstado
     *
     * @return integer
     */
    public function getAntEstado()
    {
        return $this->antEstado;
    }
}
