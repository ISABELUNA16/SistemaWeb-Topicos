<?php

namespace ModeloBundle\Repository;

class AtencionAnamnesisPacienteRepository extends \Doctrine\ORM\EntityRepository {

	 public function Data_Lista_AanamnesisPaciente($codAtencion) {

	 	$sql = "SELECT  At1.cod_aanamnesispac AS codigo ,
                        At1.cod_atencion AS codatencion ,
                        At1.aanamnesispac_te AS TE ,
                        At1.aanamnesispac_inicio AS inicio  ,
                        At1.aanamnesispac_curso AS curso  ,
                        At1.aanamnesispac_feg_reg AS fecha ,
                        per.cNombres AS nom ,
                        per.cApePat AS ap ,
                        per.cApeMat AS am
                FROM    Atencion_anamnesis_paciente AS At1
                        INNER JOIN dbo.Usuario AS usu ON usu.cod_user = At1.cod_user
                        INNER JOIN presupuesto.dbo.Trabajador AS per ON per.nCodTra = usu.percodigo
                WHERE   At1.cod_atencion = '$codAtencion'
                        AND At1.aanamnesispac_estado = 1";

        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        return $datos;
    }

    public function cantAnam($codAtencion){
    	
    	$sql = "SELECT COUNT(*) AS cantidad FROM Atencion_anamnesis_paciente where  CONVERT(VARCHAR(10), aanamnesispac_feg_reg, 103) = CONVERT(VARCHAR(10), GETDATE(), 103) AND cod_atencion = '43' AND aanamnesispac_estado = 1";

    	$stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $cantidad = $stmt->fetchAll();
        return $cantidad;

    }

}
