<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Condicion
 *
 * @ORM\Table(name="Condicion")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\CondicionRepository")
 */
class Condicion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_condicion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codCondicion;

    /**
     * @var string
     *
     * @ORM\Column(name="cond_descripcion", type="string", length=20, nullable=true)
     */
    private $condDescripcion;



    /**
     * Get codCondicion
     *
     * @return integer
     */
    public function getCodCondicion()
    {
        return $this->codCondicion;
    }

    /**
     * Set condDescripcion
     *
     * @param string $condDescripcion
     *
     * @return Condicion
     */
    public function setCondDescripcion($condDescripcion)
    {
        $this->condDescripcion = $condDescripcion;

        return $this;
    }

    /**
     * Get condDescripcion
     *
     * @return string
     */
    public function getCondDescripcion()
    {
        return $this->condDescripcion;
    }
}
