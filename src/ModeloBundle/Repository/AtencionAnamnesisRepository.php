<?php

namespace ModeloBundle\Repository;

class AtencionAnamnesisRepository extends \Doctrine\ORM\EntityRepository {

    public function Data_Lista_Aanamnesis($codAtencion) {
        
        $sql= "SELECT  At1.cod_aanamnesis AS codigo ,
                        At1.cod_atencion AS codatencion ,
                        At1.aanam_observacion AS observacion ,
                        At1.aanam_feg_reg AS fecha ,
                        per.cNombres AS nom ,
                        per.cApePat AS ap ,
                        per.cApeMat AS am
                FROM    Atencion_anamnesis AS At1
                        INNER JOIN Anamnesis AS A ON At1.cod_anamnesis = A.cod_anamnesis
                        INNER JOIN dbo.Usuario AS usu ON usu.cod_user = At1.cod_user
                        INNER JOIN presupuesto.dbo.Trabajador AS per ON per.nCodTra = usu.percodigo
                WHERE   At1.cod_atencion = '$codAtencion'
                        AND At1.anam_estado = 1";

        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        return $datos;
    }
}
