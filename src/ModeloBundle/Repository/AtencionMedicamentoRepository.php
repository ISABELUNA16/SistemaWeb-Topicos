<?php

namespace ModeloBundle\Repository;

class AtencionMedicamentoRepository extends \Doctrine\ORM\EntityRepository {
 //  FUNCION PARA LA LISTA ANTECEDENTE PATOLOGICOS
    public function Data_Lista_Amedicamento($codAtencion) {
        $sql = "SELECT  t1.cod_amedicamento AS codigo ,
                        t1.cod_atencion AS codatencion ,
                        t2.med_descripcion AS descripcion ,
                        t1.amed_concentracion AS concentracion ,
                        t1.amed_unidad AS unidad ,
                        t1.amed_dosis AS dosis ,
                        CASE t1.amed_tdosis
                          WHEN '1' THEN 'horas'
                          WHEN '2' THEN 'dias'
                        END AS tdosis ,
                        t1.amed_duracion AS duracion ,
                        CASE t1.amed_tduracion
                          WHEN '1' THEN 'dias'
                          WHEN '2' THEN 'semanas'
                          WHEN '3' THEN 'mes'
                        END AS tduracion ,
                        t1.amed_feg_reg AS fecha ,
                        per.cNombres AS nom ,
                        per.cApePat AS ap ,
                        per.cApeMat AS am
                FROM    Atencion_medicamento AS t1
                        INNER JOIN Medicamento AS t2 ON t1.cod_medicamento = t2.cod_medicamento
                        INNER JOIN dbo.Usuario AS usu ON usu.cod_user = t1.cod_user
                        INNER JOIN presupuesto.dbo.Trabajador AS per ON per.nCodTra = usu.percodigo
                WHERE   amed_estado = 1
                        AND cod_atencion = $codAtencion";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        return $datos;
    }
}
