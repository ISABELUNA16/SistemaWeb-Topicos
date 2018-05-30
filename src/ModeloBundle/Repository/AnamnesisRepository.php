<?php

namespace ModeloBundle\Repository;

class AnamnesisRepository extends \Doctrine\ORM\EntityRepository {
 
    public function listadoAnamnesis() {
        $sql = "SELECT  * FROM anamnesis WHERE anam_estado = 1";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        return $datos;
    }
}
