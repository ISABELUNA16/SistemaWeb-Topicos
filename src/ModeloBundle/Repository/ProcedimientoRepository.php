<?php

namespace ModeloBundle\Repository;

class ProcedimientoRepository extends \Doctrine\ORM\EntityRepository {
    //  FUNCION PARA LA LISTA DE ATENCIONES REGISTRADAS
    public function Data_Lista_Atenciones() {
        $sql = "SELECT  cod_atencion AS codigo ,
                        per.nCodTra AS percodigo ,
                        at.ate_tipo_per AS tipo ,
                        CONVERT(VARCHAR(8), at.ate_fec_reg, 114) AS fechareg ,
                        per.cLe AS dni ,
                        per.cNombres COLLATE DATABASE_DEFAULT AS nombre ,
                        per.cApePat COLLATE DATABASE_DEFAULT AS paterno ,
                        per.cApeMat COLLATE DATABASE_DEFAULT AS materno ,
                        at.cod_estado AS codestado ,
                        est.est_decripcion AS estado
                FROM    Atencion AS at
                        INNER JOIN presupuesto.dbo.Trabajador AS per ON per.nCodTra = at.percodigo
                                                                        AND at.ate_tipo_per = 1
                        INNER JOIN dbo.Estado AS est ON est.cod_estado = at.cod_estado
                WHERE   CONVERT(VARCHAR(10), at.ate_fec_reg, 103) = CONVERT(VARCHAR(10), GETDATE(), 103)
                        AND est.cod_estado <> 5
                UNION
                SELECT  cod_atencion AS codigo ,
                        pac.cod_paciente AS percodigo ,
                        at.ate_tipo_per AS tipo ,
                        CONVERT(VARCHAR(8), at.ate_fec_reg, 114) AS fechareg ,
                        pac.pac_dni AS dni ,
                        pac.pac_nombre COLLATE DATABASE_DEFAULT AS nombre ,
                        pac.pac_apaterno COLLATE DATABASE_DEFAULT AS paterno ,
                        pac.pac_amaterno COLLATE DATABASE_DEFAULT AS materno ,
                        at.cod_estado AS codestado ,
                        est.est_decripcion AS estado
                FROM    Atencion AS at
                        INNER JOIN Paciente AS pac ON pac.cod_paciente = at.percodigo
                                                      AND at.ate_tipo_per = 2
                        INNER JOIN dbo.Estado AS est ON est.cod_estado = at.cod_estado
                WHERE   CONVERT(VARCHAR(10), at.ate_fec_reg, 103) = CONVERT(VARCHAR(10), GETDATE(), 103)
                        AND est.cod_estado <> 5
                ORDER BY at.cod_atencion DESC;";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        return $datos;
    }
    
    
    //  FUNCION PARA LA LISTA DE ATENCIONES EXAMINADAS
    public function Doctor_Lista_Atenciones() {
        $sql = "SELECT  cod_atencion AS codigo ,
                        per.nCodTra AS percodigo ,
                        at.ate_tipo_per AS tipo ,
                        CONVERT(VARCHAR(8), at.ate_fec_reg, 114) AS fechareg ,
                        per.cLe AS dni ,
                        per.cNombres COLLATE DATABASE_DEFAULT AS nombre ,
                        per.cApePat COLLATE DATABASE_DEFAULT AS paterno ,
                        per.cApeMat COLLATE DATABASE_DEFAULT AS materno ,
                        at.cod_estado AS codestado ,
                        est.est_decripcion AS estado
                FROM    Atencion AS at
                        INNER JOIN presupuesto.dbo.Trabajador AS per ON per.nCodTra = at.percodigo
                                                                        AND at.ate_tipo_per = 1
                        INNER JOIN dbo.Estado AS est ON est.cod_estado = at.cod_estado
                WHERE   CONVERT(VARCHAR(10), at.ate_fec_reg, 103) = CONVERT(VARCHAR(10), GETDATE(), 103)
                        AND est.cod_estado in (2,3) 
                UNION
                SELECT  cod_atencion AS codigo ,
                        pac.cod_paciente AS percodigo ,
                        at.ate_tipo_per AS tipo ,
                        CONVERT(VARCHAR(8), at.ate_fec_reg, 114) AS fechareg ,
                        pac.pac_dni AS dni ,
                        pac.pac_nombre COLLATE DATABASE_DEFAULT AS nombre ,
                        pac.pac_apaterno COLLATE DATABASE_DEFAULT AS paterno ,
                        pac.pac_amaterno COLLATE DATABASE_DEFAULT AS materno ,
                        at.cod_estado AS codestado ,
                        est.est_decripcion AS estado
                FROM    Atencion AS at
                        INNER JOIN Paciente AS pac ON pac.cod_paciente = at.percodigo
                                                      AND at.ate_tipo_per = 2
                        INNER JOIN dbo.Estado AS est ON est.cod_estado = at.cod_estado
                WHERE   CONVERT(VARCHAR(10), at.ate_fec_reg, 103) = CONVERT(VARCHAR(10), GETDATE(), 103)
                        AND est.cod_estado in (2,3) 
                ORDER BY at.cod_atencion DESC;";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        return $datos;
    }
}
