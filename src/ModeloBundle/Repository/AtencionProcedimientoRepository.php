<?php

namespace ModeloBundle\Repository;

class AtencionProcedimientoRepository extends \Doctrine\ORM\EntityRepository {
//  FUNCION PARA LA LISTA ANTECEDENTE PATOLOGICOS
    public function Data_Lista_Aprocedimiento($codAtencion) {
        $sql = "SELECT  t1.cod_aprocedimiento AS codigo ,
                        t1.cod_atencion AS codatencion ,
                        t2.proc_descripcion AS descripcion ,
                        t1.aproc_feg_reg AS fecha ,
                        per.cNombres AS nom ,
                        per.cApePat AS ap ,
                        per.cApeMat AS am
                FROM    Atencion_procedimiento AS t1
                        INNER JOIN Procedimiento AS t2 ON t1.cod_procedimiento = t2.cod_procedimiento
                        INNER JOIN dbo.Usuario AS usu ON usu.cod_user = t1.cod_user
                        INNER JOIN presupuesto.dbo.Trabajador AS per ON per.nCodTra = usu.percodigo
                WHERE   t1.cod_atencion = '$codAtencion'
                        AND aproc_estado = 1";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        return $datos;
    }
}
