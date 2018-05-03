<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seguro
 *
 * @ORM\Table(name="Seguro")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\SeguroRepository")
 */
class Seguro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_seguro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codSeguro;

    /**
     * @var string
     *
     * @ORM\Column(name="seg_descripcion", type="string", length=20, nullable=true)
     */
    private $segDescripcion;



    /**
     * Get codSeguro
     *
     * @return integer
     */
    public function getCodSeguro()
    {
        return $this->codSeguro;
    }

    /**
     * Set segDescripcion
     *
     * @param string $segDescripcion
     *
     * @return Seguro
     */
    public function setSegDescripcion($segDescripcion)
    {
        $this->segDescripcion = $segDescripcion;

        return $this;
    }

    /**
     * Get segDescripcion
     *
     * @return string
     */
    public function getSegDescripcion()
    {
        return $this->segDescripcion;
    }
}
