<?php

namespace ModeloBundle\Repository;

class PacienteRepository extends \Doctrine\ORM\EntityRepository {
    //  FUNCION PARA SESSION DEL USUARIO PARAMETRO DNI PERSONA
    public function Data_persona_by_Dni($dni) {
        $sql = "  SELECT    cod_paciente AS codigo ,
                            pac_dni AS dni ,
                            pac_apaterno AS apaterno ,
                            pac_amaterno AS amaterno ,
                            pac_nombre AS nombres
                  FROM      Paciente
                  WHERE     pac_dni = $dni";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetch();
        return $datos;
    }
    
    public function Data_paciente_by_Codigo($codigo){
        $sql = "SELECT [cod_paciente] AS codigo 
                        ,[pac_nombre]  AS nombres
                        ,[pac_apaterno] AS apaterno
                        ,[pac_amaterno] AS amaterno
                        ,[pac_dni] AS dni
                        ,[pac_genero] as genero
                    FROM [Topico].[dbo].[Paciente] WHERE cod_paciente=$codigo";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetch();
        return $datos;
    }
    
    
}
