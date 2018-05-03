<?php

namespace ModeloBundle\Repository;

class AtencionDiagnosticoRepository extends \Doctrine\ORM\EntityRepository {
 //  FUNCION PARA LA LISTA ANTECEDENTE PATOLOGICOS
    public function Data_Lista_Adiagnosticos($codAtencion) {
        $sql = "SELECT  t1.[cod_adiagnostico] AS codigo ,
                        t1.[cod_atencion] AS codatencion ,
                        t2.[diag_descripcion] AS descripcion ,
                        t2.[diag_codigo] AS cod ,
                        t1.[adiag_tipo] AS tipo ,
                        t1.[adiag_feg_reg] AS fecha ,
                        t1.[adiag_estado] AS estado ,
                        per.cNombres AS nom ,
                        per.cApePat AS ap ,
                        per.cApeMat AS am
                FROM    Atencion_diagnostico AS t1
                        INNER JOIN Diagnostico AS t2 ON t1.cod_diagnostico = t2.cod_diagnostico
                        INNER JOIN dbo.Usuario AS usu ON usu.cod_user = t1.cod_user
                        INNER JOIN presupuesto.dbo.Trabajador AS per ON per.nCodTra = usu.percodigo
                WHERE   t1.[cod_atencion] = $codAtencion
                        AND adiag_estado = 1;";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        return $datos;
    }
}
