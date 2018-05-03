<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Atencion
 *
 * @ORM\Table(name="Atencion")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\AtencionRepository")
 */
class Atencion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_atencion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codAtencion;

    /**
     * @var integer
     *
     * @ORM\Column(name="percodigo", type="integer", nullable=true)
     */
    private $percodigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ate_tipo_per", type="integer", nullable=true)
     */
    private $ateTipoPer;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_user", type="integer", nullable=true)
     */
    private $codUser;

    /**
     * @var string
     *
     * @ORM\Column(name="ate_peso", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $atePeso;

    /**
     * @var string
     *
     * @ORM\Column(name="ate_talla", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $ateTalla;

    /**
     * @var string
     *
     * @ORM\Column(name="ate_indice_masa", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $ateIndiceMasa;

    /**
     * @var string
     *
     * @ORM\Column(name="ate_per_abdominal", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $atePerAbdominal;

    /**
     * @var string
     *
     * @ORM\Column(name="ate_est_nutricional", type="text", length=-1, nullable=true)
     */
    private $ateEstNutricional;

    /**
     * @var integer
     *
     * @ORM\Column(name="ate_val_atropometria", type="integer", nullable=true)
     */
    private $ateValAtropometria;

    /**
     * @var string
     *
     * @ORM\Column(name="ate_fre_cardiaca", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $ateFreCardiaca;

    /**
     * @var string
     *
     * @ORM\Column(name="ate_fre_respiratoria", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $ateFreRespiratoria;

    /**
     * @var string
     *
     * @ORM\Column(name="ate_fre_arterial", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $ateFreArterial;

    /**
     * @var string
     *
     * @ORM\Column(name="ate_temperatura", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $ateTemperatura;

    /**
     * @var integer
     *
     * @ORM\Column(name="ate_val_signos", type="integer", nullable=true)
     */
    private $ateValSignos;

    /**
     * @var string
     *
     * @ORM\Column(name="aten_anamenis", type="text", length=-1, nullable=true)
     */
    private $atenAnamenis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ate_fec_reg", type="datetime", nullable=true)
     */
    private $ateFecReg;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_estado", type="integer", nullable=true)
     */
    private $codEstado;



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
     * Set percodigo
     *
     * @param integer $percodigo
     *
     * @return Atencion
     */
    public function setPercodigo($percodigo)
    {
        $this->percodigo = $percodigo;

        return $this;
    }

    /**
     * Get percodigo
     *
     * @return integer
     */
    public function getPercodigo()
    {
        return $this->percodigo;
    }

    /**
     * Set ateTipoPer
     *
     * @param integer $ateTipoPer
     *
     * @return Atencion
     */
    public function setAteTipoPer($ateTipoPer)
    {
        $this->ateTipoPer = $ateTipoPer;

        return $this;
    }

    /**
     * Get ateTipoPer
     *
     * @return integer
     */
    public function getAteTipoPer()
    {
        return $this->ateTipoPer;
    }

    /**
     * Set codUser
     *
     * @param integer $codUser
     *
     * @return Atencion
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
     * Set atePeso
     *
     * @param string $atePeso
     *
     * @return Atencion
     */
    public function setAtePeso($atePeso)
    {
        $this->atePeso = $atePeso;

        return $this;
    }

    /**
     * Get atePeso
     *
     * @return string
     */
    public function getAtePeso()
    {
        return $this->atePeso;
    }

    /**
     * Set ateTalla
     *
     * @param string $ateTalla
     *
     * @return Atencion
     */
    public function setAteTalla($ateTalla)
    {
        $this->ateTalla = $ateTalla;

        return $this;
    }

    /**
     * Get ateTalla
     *
     * @return string
     */
    public function getAteTalla()
    {
        return $this->ateTalla;
    }

    /**
     * Set ateIndiceMasa
     *
     * @param string $ateIndiceMasa
     *
     * @return Atencion
     */
    public function setAteIndiceMasa($ateIndiceMasa)
    {
        $this->ateIndiceMasa = $ateIndiceMasa;

        return $this;
    }

    /**
     * Get ateIndiceMasa
     *
     * @return string
     */
    public function getAteIndiceMasa()
    {
        return $this->ateIndiceMasa;
    }

    /**
     * Set atePerAbdominal
     *
     * @param string $atePerAbdominal
     *
     * @return Atencion
     */
    public function setAtePerAbdominal($atePerAbdominal)
    {
        $this->atePerAbdominal = $atePerAbdominal;

        return $this;
    }

    /**
     * Get atePerAbdominal
     *
     * @return string
     */
    public function getAtePerAbdominal()
    {
        return $this->atePerAbdominal;
    }

    /**
     * Set ateEstNutricional
     *
     * @param string $ateEstNutricional
     *
     * @return Atencion
     */
    public function setAteEstNutricional($ateEstNutricional)
    {
        $this->ateEstNutricional = $ateEstNutricional;

        return $this;
    }

    /**
     * Get ateEstNutricional
     *
     * @return string
     */
    public function getAteEstNutricional()
    {
        return $this->ateEstNutricional;
    }

    /**
     * Set ateValAtropometria
     *
     * @param integer $ateValAtropometria
     *
     * @return Atencion
     */
    public function setAteValAtropometria($ateValAtropometria)
    {
        $this->ateValAtropometria = $ateValAtropometria;

        return $this;
    }

    /**
     * Get ateValAtropometria
     *
     * @return integer
     */
    public function getAteValAtropometria()
    {
        return $this->ateValAtropometria;
    }

    /**
     * Set ateFreCardiaca
     *
     * @param string $ateFreCardiaca
     *
     * @return Atencion
     */
    public function setAteFreCardiaca($ateFreCardiaca)
    {
        $this->ateFreCardiaca = $ateFreCardiaca;

        return $this;
    }

    /**
     * Get ateFreCardiaca
     *
     * @return string
     */
    public function getAteFreCardiaca()
    {
        return $this->ateFreCardiaca;
    }

    /**
     * Set ateFreRespiratoria
     *
     * @param string $ateFreRespiratoria
     *
     * @return Atencion
     */
    public function setAteFreRespiratoria($ateFreRespiratoria)
    {
        $this->ateFreRespiratoria = $ateFreRespiratoria;

        return $this;
    }

    /**
     * Get ateFreRespiratoria
     *
     * @return string
     */
    public function getAteFreRespiratoria()
    {
        return $this->ateFreRespiratoria;
    }

    /**
     * Set ateFreArterial
     *
     * @param string $ateFreArterial
     *
     * @return Atencion
     */
    public function setAteFreArterial($ateFreArterial)
    {
        $this->ateFreArterial = $ateFreArterial;

        return $this;
    }

    /**
     * Get ateFreArterial
     *
     * @return string
     */
    public function getAteFreArterial()
    {
        return $this->ateFreArterial;
    }

    /**
     * Set ateTemperatura
     *
     * @param string $ateTemperatura
     *
     * @return Atencion
     */
    public function setAteTemperatura($ateTemperatura)
    {
        $this->ateTemperatura = $ateTemperatura;

        return $this;
    }

    /**
     * Get ateTemperatura
     *
     * @return string
     */
    public function getAteTemperatura()
    {
        return $this->ateTemperatura;
    }

    /**
     * Set ateValSignos
     *
     * @param integer $ateValSignos
     *
     * @return Atencion
     */
    public function setAteValSignos($ateValSignos)
    {
        $this->ateValSignos = $ateValSignos;

        return $this;
    }

    /**
     * Get ateValSignos
     *
     * @return integer
     */
    public function getAteValSignos()
    {
        return $this->ateValSignos;
    }

    /**
     * Set atenAnamenis
     *
     * @param string $atenAnamenis
     *
     * @return Atencion
     */
    public function setAtenAnamenis($atenAnamenis)
    {
        $this->atenAnamenis = $atenAnamenis;

        return $this;
    }

    /**
     * Get atenAnamenis
     *
     * @return string
     */
    public function getAtenAnamenis()
    {
        return $this->atenAnamenis;
    }

    /**
     * Set ateFecReg
     *
     * @param \DateTime $ateFecReg
     *
     * @return Atencion
     */
    public function setAteFecReg($ateFecReg)
    {
        $this->ateFecReg = $ateFecReg;

        return $this;
    }

    /**
     * Get ateFecReg
     *
     * @return \DateTime
     */
    public function getAteFecReg()
    {
        return $this->ateFecReg;
    }

    /**
     * Set codEstado
     *
     * @param integer $codEstado
     *
     * @return Atencion
     */
    public function setCodEstado($codEstado)
    {
        $this->codEstado = $codEstado;

        return $this;
    }

    /**
     * Get codEstado
     *
     * @return integer
     */
    public function getCodEstado()
    {
        return $this->codEstado;
    }
}
