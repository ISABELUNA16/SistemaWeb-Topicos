<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estado
 *
 * @ORM\Table(name="Estado")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\EstadoRepository")
 */
class Estado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_estado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codEstado;

    /**
     * @var string
     *
     * @ORM\Column(name="est_decripcion", type="string", length=20, nullable=true)
     */
    private $estDecripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="est_estado", type="integer", nullable=true)
     */
    private $estEstado;



    /**
     * Get codEstado
     *
     * @return integer
     */
    public function getCodEstado()
    {
        return $this->codEstado;
    }

    /**
     * Set estDecripcion
     *
     * @param string $estDecripcion
     *
     * @return Estado
     */
    public function setEstDecripcion($estDecripcion)
    {
        $this->estDecripcion = $estDecripcion;

        return $this;
    }

    /**
     * Get estDecripcion
     *
     * @return string
     */
    public function getEstDecripcion()
    {
        return $this->estDecripcion;
    }

    /**
     * Set estEstado
     *
     * @param integer $estEstado
     *
     * @return Estado
     */
    public function setEstEstado($estEstado)
    {
        $this->estEstado = $estEstado;

        return $this;
    }

    /**
     * Get estEstado
     *
     * @return integer
     */
    public function getEstEstado()
    {
        return $this->estEstado;
    }
}
