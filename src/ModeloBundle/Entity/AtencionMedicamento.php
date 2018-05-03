<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AtencionMedicamento
 *
 * @ORM\Table(name="Atencion_medicamento")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\AtencionMedicamentoRepository")
 */
class AtencionMedicamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_amedicamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codAmedicamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_atencion", type="integer", nullable=true)
     */
    private $codAtencion;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_medicamento", type="integer", nullable=true)
     */
    private $codMedicamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="amed_concentracion", type="integer", nullable=true)
     */
    private $amedConcentracion;

    /**
     * @var integer
     *
     * @ORM\Column(name="amed_unidad", type="integer", nullable=true)
     */
    private $amedUnidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="amed_dosis", type="integer", nullable=true)
     */
    private $amedDosis;

    /**
     * @var integer
     *
     * @ORM\Column(name="amed_tdosis", type="integer", nullable=true)
     */
    private $amedTdosis;

    /**
     * @var integer
     *
     * @ORM\Column(name="amed_duracion", type="integer", nullable=true)
     */
    private $amedDuracion;

    /**
     * @var integer
     *
     * @ORM\Column(name="amed_tduracion", type="integer", nullable=true)
     */
    private $amedTduracion;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_user", type="integer", nullable=true)
     */
    private $codUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="amed_feg_reg", type="datetime", nullable=true)
     */
    private $amedFegReg;

    /**
     * @var integer
     *
     * @ORM\Column(name="amed_estado", type="integer", nullable=true)
     */
    private $amedEstado;



    /**
     * Get codAmedicamento
     *
     * @return integer
     */
    public function getCodAmedicamento()
    {
        return $this->codAmedicamento;
    }

    /**
     * Set codAtencion
     *
     * @param integer $codAtencion
     *
     * @return AtencionMedicamento
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
     * Set codMedicamento
     *
     * @param integer $codMedicamento
     *
     * @return AtencionMedicamento
     */
    public function setCodMedicamento($codMedicamento)
    {
        $this->codMedicamento = $codMedicamento;

        return $this;
    }

    /**
     * Get codMedicamento
     *
     * @return integer
     */
    public function getCodMedicamento()
    {
        return $this->codMedicamento;
    }

    /**
     * Set amedConcentracion
     *
     * @param integer $amedConcentracion
     *
     * @return AtencionMedicamento
     */
    public function setAmedConcentracion($amedConcentracion)
    {
        $this->amedConcentracion = $amedConcentracion;

        return $this;
    }

    /**
     * Get amedConcentracion
     *
     * @return integer
     */
    public function getAmedConcentracion()
    {
        return $this->amedConcentracion;
    }

    /**
     * Set amedUnidad
     *
     * @param integer $amedUnidad
     *
     * @return AtencionMedicamento
     */
    public function setAmedUnidad($amedUnidad)
    {
        $this->amedUnidad = $amedUnidad;

        return $this;
    }

    /**
     * Get amedUnidad
     *
     * @return integer
     */
    public function getAmedUnidad()
    {
        return $this->amedUnidad;
    }

    /**
     * Set amedDosis
     *
     * @param integer $amedDosis
     *
     * @return AtencionMedicamento
     */
    public function setAmedDosis($amedDosis)
    {
        $this->amedDosis = $amedDosis;

        return $this;
    }

    /**
     * Get amedDosis
     *
     * @return integer
     */
    public function getAmedDosis()
    {
        return $this->amedDosis;
    }

    /**
     * Set amedTdosis
     *
     * @param integer $amedTdosis
     *
     * @return AtencionMedicamento
     */
    public function setAmedTdosis($amedTdosis)
    {
        $this->amedTdosis = $amedTdosis;

        return $this;
    }

    /**
     * Get amedTdosis
     *
     * @return integer
     */
    public function getAmedTdosis()
    {
        return $this->amedTdosis;
    }

    /**
     * Set amedDuracion
     *
     * @param integer $amedDuracion
     *
     * @return AtencionMedicamento
     */
    public function setAmedDuracion($amedDuracion)
    {
        $this->amedDuracion = $amedDuracion;

        return $this;
    }

    /**
     * Get amedDuracion
     *
     * @return integer
     */
    public function getAmedDuracion()
    {
        return $this->amedDuracion;
    }

    /**
     * Set amedTduracion
     *
     * @param integer $amedTduracion
     *
     * @return AtencionMedicamento
     */
    public function setAmedTduracion($amedTduracion)
    {
        $this->amedTduracion = $amedTduracion;

        return $this;
    }

    /**
     * Get amedTduracion
     *
     * @return integer
     */
    public function getAmedTduracion()
    {
        return $this->amedTduracion;
    }

    /**
     * Set codUser
     *
     * @param integer $codUser
     *
     * @return AtencionMedicamento
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
     * Set amedFegReg
     *
     * @param \DateTime $amedFegReg
     *
     * @return AtencionMedicamento
     */
    public function setAmedFegReg($amedFegReg)
    {
        $this->amedFegReg = $amedFegReg;

        return $this;
    }

    /**
     * Get amedFegReg
     *
     * @return \DateTime
     */
    public function getAmedFegReg()
    {
        return $this->amedFegReg;
    }

    /**
     * Set amedEstado
     *
     * @param integer $amedEstado
     *
     * @return AtencionMedicamento
     */
    public function setAmedEstado($amedEstado)
    {
        $this->amedEstado = $amedEstado;

        return $this;
    }

    /**
     * Get amedEstado
     *
     * @return integer
     */
    public function getAmedEstado()
    {
        return $this->amedEstado;
    }
}
