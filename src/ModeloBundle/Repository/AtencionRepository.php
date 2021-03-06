<?php

namespace ModeloBundle\Repository;

class AtencionRepository extends \Doctrine\ORM\EntityRepository {
    
    public function fechaAtencion($codatencion){
        
        $sql = " SELECT CONVERT(VARCHAR(10), ate_fec_reg , 103) as fecha FROM Atencion where cod_atencion = '$codatencion';";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $fecha = $stmt->fetchAll();
        return $fecha;

    } 


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
                        AND est.cod_estado <> 6
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
                        AND est.cod_estado <> 6
                ORDER BY at.cod_atencion DESC;";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        return $datos;
    }
    
    //VALIDAR SI EXISTEN PACIENTES CON ESTADO REGISTRADO
    
    public function data_lista_atenciones_registradas($dni){

        $query = "DECLARE @CantidadCas int, @CantidadTercero int
   
                SET @CantidadCas = (SELECT count(*) cantRegistro
                                    FROM    Atencion AS at
                                            INNER JOIN presupuesto.dbo.Trabajador AS per ON per.nCodTra = at.percodigo
                                            AND at.ate_tipo_per = 1
                                            INNER JOIN dbo.Estado AS est ON est.cod_estado = at.cod_estado
                                    WHERE   CONVERT(VARCHAR(10), at.ate_fec_reg, 103) = CONVERT(VARCHAR(10), GETDATE(), 103)
                                            AND (est.cod_estado = 1 OR est.cod_estado = 2 OR est.cod_estado = 3) AND  per.cLe= '$dni');
                SET @CantidadTercero = (SELECT  count(*) cantRegistro
                                        FROM    Atencion AS at
                                                INNER JOIN Paciente AS pac ON pac.cod_paciente = at.percodigo
                                                AND at.ate_tipo_per = 2
                                                INNER JOIN dbo.Estado AS est ON est.cod_estado = at.cod_estado
                                        WHERE   CONVERT(VARCHAR(10), at.ate_fec_reg, 103) = CONVERT(VARCHAR(10), GETDATE(), 103)
                                                AND (est.cod_estado = 1 OR est.cod_estado = 2 OR est.cod_estado = 3) AND  pac.pac_dni= '$dni');
                                                
                IF(@CantidadCas <> 0)
                 select  @CantidadCas AS cantRegistro
                
                ELSE IF (@CantidadTercero >= 0)
                  select @CantidadTercero AS cantRegistro " ;

        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $cantidad = $stmt->fetchAll();
        return $cantidad;
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
                        AND est.cod_estado in (2,3,4,5) 
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
                        AND est.cod_estado in (2,3,4,5) 
                ORDER BY at.cod_atencion DESC;";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        return $datos;
    }



    //VALIDAR SI EXISTEN PACIENTES EN ATENCION
    
    public function data_lista_atenciones_doctor(){

        $query = "DECLARE @CantidadCas int, @CantidadTercero int
   
                SET @CantidadCas = (SELECT count(*) cantRegistro
                                    FROM    Atencion AS at
                                            INNER JOIN presupuesto.dbo.Trabajador AS per ON per.nCodTra = at.percodigo
                                            AND at.ate_tipo_per = 1
                                            INNER JOIN dbo.Estado AS est ON est.cod_estado = at.cod_estado
                                    WHERE   CONVERT(VARCHAR(10), at.ate_fec_reg, 103) = CONVERT(VARCHAR(10), GETDATE(), 103)
                                            AND est.cod_estado = 3)
                SET @CantidadTercero = (SELECT  count(*) cantRegistro
                                        FROM    Atencion AS at
                                                INNER JOIN Paciente AS pac ON pac.cod_paciente = at.percodigo
                                                AND at.ate_tipo_per = 2
                                                INNER JOIN dbo.Estado AS est ON est.cod_estado = at.cod_estado
                                        WHERE   CONVERT(VARCHAR(10), at.ate_fec_reg, 103) = CONVERT(VARCHAR(10), GETDATE(), 103) 
                                                AND est.cod_estado = 3)
                                                
                IF(@CantidadCas <> 0)
                 select  @CantidadCas AS cantRegistro
                
                ELSE IF (@CantidadTercero >= 0)
                  select @CantidadTercero AS cantRegistro" ; 

        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $cantidad = $stmt->fetchAll();
        return $cantidad;
    }


}
