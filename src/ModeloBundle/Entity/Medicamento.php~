<?php

namespace ModeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medicamento
 *
 * @ORM\Table(name="Medicamento")
 * @ORM\Entity(repositoryClass="ModeloBundle\Repository\MedicamentoRepository")
 */
class Medicamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cod_medicamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codMedicamento;

    /**
     * @var string
     *
     * @ORM\Column(name="med_descripcion", type="string", length=100, nullable=true)
     */
    private $medDescripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="med_estado", type="integer", nullable=true)
     */
    private $medEstado;



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
     * Set medDescripcion
     *
     * @param string $medDescripcion
     *
     * @return Medicamento
     */
    public function setMedDescripcion($medDescripcion)
    {
        $this->medDescripcion = $medDescripcion;

        return $this;
    }

    /**
     * Get medDescripcion
     *
     * @return string
     */
    public function getMedDescripcion()
    {
        return $this->medDescripcion;
    }

    /**
     * Set medEstado
     *
     * @param integer $medEstado
     *
     * @return Medicamento
     */
    public function setMedEstado($medEstado)
    {
        $this->medEstado = $medEstado;

        return $this;
    }

    /**
     * Get medEstado
     *
     * @return integer
     */
    public function getMedEstado()
    {
        return $this->medEstado;
    }
}
