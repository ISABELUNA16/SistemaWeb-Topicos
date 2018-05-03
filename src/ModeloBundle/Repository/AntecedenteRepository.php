<?php

namespace ModeloBundle\Repository;

class AntecedenteRepository extends \Doctrine\ORM\EntityRepository {
 //  FUNCION PARA LA LISTA ANTECEDENTE PATOLOGICOS
    public function Data_Lista_Antecedente($codper,$tipo) {
        $sql = "SELECT  ant.cod_antecedente as codigo,
                        ant.ant_descripcion as descripcion,
                        ant.ant_fecha_reg  as fecha,
                        per.cNombres  as nom,
                        per.cApePat as ap,
                        per.cApeMat as am
                FROM    Antecedente AS ant
                        INNER JOIN dbo.Usuario AS usu ON usu.cod_user = ant.cod_user
                        INNER JOIN presupuesto.dbo.Trabajador AS per ON per.nCodTra = usu.percodigo
                WHERE   ant.codper = $codper
                        AND ant.cod_tantecedente = $tipo
                        AND ant.ant_estado = 1";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll();
        return $datos;
    }
}
