<?php

namespace ModeloBundle\Repository;

class PersonaRepository extends \Doctrine\ORM\EntityRepository {
    

    
//  FUNCION PARA SESSION DEL USUARIO PARAMETRO DNI PERSONA
    public function Data_trabajador_by_Dni($dni) {
        $sql="SELECT    t1.nCodTra AS codigo ,
                        t1.cLe AS dni ,
                        t1.cApePat AS apaterno ,
                        t1.cApeMat AS amaterno ,
                        t1.cNombres AS nombres
              FROM      presupuesto.dbo.Trabajador AS t1
              WHERE     cLe = '$dni'
                        AND nEstTra = 1;";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetch();
        return $datos;
    }
    
    //  FUNCION PARA SESSION DEL USUARIO PARAMETRO DNI PERSONA
    public function Data_persona_by_Codigo($codigo) {
        $sql = "SELECT  t1.nCodTra AS codigo ,
                        t1.cLe AS dni ,
                        t1.cApePat AS apaterno ,
                        t1.cApeMat AS amaterno ,
                        t1.cNombres AS nombres
              FROM      presupuesto.dbo.Trabajador AS t1
              WHERE     t1.nCodTra = '$codigo'
                        AND nEstTra = 1;";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetch();
        return $datos;
    }

    
    
    public function Data_trabajador_by_Codigo($codigo) {
        $sql = " SELECT t1.nCodTra AS codigo ,
                        t1.cLe AS dni ,
                        t1.cApePat AS apaterno ,
                        t1.cApeMat AS amaterno ,
                        t1.cNombres AS nombres ,
                        CASE nSex
                          WHEN '412' THEN '1'
                          WHEN '413' THEN '2'
                        END AS genero
                 FROM   presupuesto.dbo.Trabajador AS t1
                 WHERE  t1.nCodTra = '$codigo'
                        AND nEstTra = 1;";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetch();
        return $datos;
    }
            
    
    
    
    function data_trabajador($codper) {
        $sql = "SELECT  t1.nCodTra AS codigo ,
                        cLe AS pacDni ,
                        CASE nSex
                          WHEN '412' THEN 'MASCULINO'
                          WHEN '413' THEN 'FEMENINO'
                        END AS pacGenero ,
                        dFecNac AS pacNacimiento ,
                        t3.VALOR1 AS codCondicion ,
                        t2.VALOR1 AS pacAreaTrabajo ,
                        '' AS segDescripcion ,
                        ( SELECT    v.VALOR1
                          FROM      dbo.VALORGENERICA AS v
                          WHERE     CLAVE1 = ( SUBSTRING(t1.cCodUbi, 1, 2) + '0000' )
                        ) AS departamento ,
                        ( SELECT    v.VALOR1
                          FROM      dbo.VALORGENERICA AS v
                          WHERE     CLAVE1 = ( SUBSTRING(t1.cCodUbi, 1, 4) + '00' )
                        ) AS provincia ,
                        ( SELECT    v.VALOR1
                          FROM      dbo.VALORGENERICA AS v
                          WHERE     CLAVE1 = ( SUBSTRING(t1.cCodUbi, 1, 6) )
                        ) AS distrito ,
                        ( SELECT    v.VALOR1
                          FROM      dbo.VALORGENERICA AS v
                          WHERE     CLAVE1 = ( SUBSTRING(t1.cDirUbi, 1, 2) + '0000' )
                        ) AS dirdepartamento ,
                        ( SELECT    v.VALOR1
                          FROM      dbo.VALORGENERICA AS v
                          WHERE     CLAVE1 = ( SUBSTRING(t1.cDirUbi, 1, 4) + '00' )
                        ) AS dirprovincia ,
                        ( SELECT    v.VALOR1
                          FROM      dbo.VALORGENERICA AS v
                          WHERE     CLAVE1 = ( SUBSTRING(t1.cDirUbi, 1, 6) )
                        ) AS dirdistrito ,
                        t5.VALOR1 AS pacProfession ,
                        t1.cTel AS pacTelefono ,
                        t1.cDirAct AS pacDireccion ,
                        DATEDIFF(MONTH, t1.dFecIngIns, GETDATE()) AS pacServicio ,
                        t6.VALOR1 AS pacEstadoCivil ,
                        '' AS pacNumHijoVivos ,
                        '' AS pacNumHijoFallecidos
                FROM    [presupuesto].[dbo].[Trabajador] AS t1
                        INNER JOIN dbo.VALORGENERICA AS t2 ON t2.ID_REGISTRO = t1.nCodAre
                        INNER JOIN dbo.VALORGENERICA AS t3 ON t3.CLAVE1 = t1.cTipTraba
                                                              AND t3.ID_TABLA = 'TBL050'
                        INNER JOIN dbo.VALORGENERICA AS t4 ON t4.CLAVE1 = t1.cCodUbi
                                                              AND t4.ID_TABLA = 'TBL006'
                        INNER JOIN dbo.VALORGENERICA AS t5 ON t5.ID_REGISTRO = t1.nprofocu
                                                              AND t5.ID_TABLA = 'TBL056'
                        INNER JOIN dbo.VALORGENERICA AS t6 ON t6.CLAVE1 = t1.cEstCiv
                                                              AND t6.ID_TABLA = 'TBL052'
                WHERE   t1.nEstTra = 1
                        AND t1.cLe = '$codper';";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetch();
        return $datos;
    }

    //  FUNCION LISTAR COMBO DEPARTAMENTO
    public function Data_Departamento() {
        $sql = "SELECT  ubicodigo AS codigo ,
                        ubidpto AS dep ,
                        ubiprovincia AS pro ,
                        ubidistrito AS dis ,
                        ubinombre AS nom
                FROM    ActividadIPD.dbo.grubigeo
                WHERE   ubipais = 01
                        AND ubiprovincia = 00
                        AND ubidistrito = 00
                        AND ubiestado = 1;";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        return $datos;
    }
    
    //  FUNCION LISTAR COMBO PROVINCIA
    public function Data_Provincia($dep) {
        $sql = "SELECT  ubicodigo AS codigo ,
                        ubidpto AS dep ,
                        ubiprovincia AS pro ,
                        ubidistrito AS dis ,
                        ubinombre AS nom
                FROM    ActividadIPD.dbo.grubigeo
                WHERE   ubipais = 01
                        AND ubidpto = $dep
                        AND ubidistrito = 00
                        AND ubiestado = 1
                        AND ubiprovincia <> 00;";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        return $datos;
    }
    
    //  FUNCION LISTAR COMBO DISTRITO
    public function Data_Distrito($prov,$dep) {
        $sql = "SELECT  ubicodigo AS codigo ,
                        ubidpto AS dep ,
                        ubiprovincia AS pro ,
                        ubidistrito AS dis ,
                        ubinombre AS nom
                FROM    ActividadIPD.dbo.grubigeo
                WHERE   ubipais = 01
                        AND ubidpto = $dep
                        AND ubiprovincia = $prov
                        AND ubiestado = 1
                        AND ubidistrito <> 00;";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        return $datos;
    }
    
    public function Data_lugar_nacimiento($codnac){
        $sql = "SELECT  ubidpto AS dep ,
                        ubiprovincia AS prov ,
                        ubicodigo AS dist
                FROM    dbo.grubigeo
                WHERE   ubicodigo = $codnac";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetch();
        return $datos;
    }
    
    public function Data_lugar_procedencia($codproc){
        $sql = "SELECT  ubidpto AS dep ,
                        ubiprovincia AS prov ,
                        ubicodigo AS dist
                FROM    dbo.grubigeo
                WHERE   ubicodigo = $codproc";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetch();
        return $datos;
    }
}
