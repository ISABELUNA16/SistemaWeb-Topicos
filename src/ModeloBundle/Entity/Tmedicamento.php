<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tmedicamento
 *
 * @ORM\Table(name="Tmedicamento")
 * @ORM\Entity
 */
class Tmedicamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_tmedicamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codTmedicamento;

    /**
     * @var string
     *
     * @ORM\Column(name="tmed_descripcion", type="string", length=255, nullable=true)
     */
    private $tmedDescripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tmed_estado", type="integer", nullable=true)
     */
    private $tmedEstado;


    /**
     * Get codTmedicamento
     *
     * @return integer
     */
    public function getCodTmedicamento()
    {
        return $this->codTmedicamento;
    }

    /**
     * Set tmedDescripcion
     *
     * @param string $tmedDescripcion
     *
     * @return Tmedicamento
     */
    public function setTmedDescripcion($tmedDescripcion)
    {
        $this->tmedDescripcion = $tmedDescripcion;

        return $this;
    }

    /**
     * Get tmedDescripcion
     *
     * @return string
     */
    public function getTmedDescripcion()
    {
        return $this->tmedDescripcion;
    }

    /**
     * Set tmedEstado
     *
     * @param integer $tmedEstado
     *
     * @return Tmedicamento
     */
    public function setTmedEstado($tmedEstado)
    {
        $this->tmedEstado = $tmedEstado;

        return $this;
    }

    /**
     * Get tmedEstado
     *
     * @return integer
     */
    public function getTmedEstado()
    {
        return $this->tmedEstado;
    }
}
