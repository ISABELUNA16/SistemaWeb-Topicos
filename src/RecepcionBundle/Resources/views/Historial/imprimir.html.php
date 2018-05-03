<?php

use Dompdf\Dompdf;

ob_start();
?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
    </head>
    <body>
        <div class="container">
            <div class="row" style="border-bottom: 1px solid #f3f2f2;">
                <div class="col-xs-3" style="padding-bottom: 10px;"><img src="./bundles/public/img/logotipo2_small.png" /></div>
                <div class="col-xs-5"><h4><strong>TOPICO DE ATENCIÓN MEDICA</strong></h4></div>
                <div class="col-xs-4" style="text-align: center"><strong>Fecha : 24/04/2018</strong><br>Unidad de Personal</div>
            </div>
            <div class="row"  style="border-bottom: 1px solid #f3f2f2;">
                <div class="col-xs-12" style="text-align: center"><h4><strong>RECETARIO</strong></h4></div>
            </div>
            <div class="row"  style="border-bottom: 1px solid #f3f2f2;">
                <div class="col-xs-12">
                    <h5><strong>PACIENTE :</strong> <?php echo $Nompaciente ?> </h5>
                    <h5><strong>MEDICO   :</strong> <?php echo $Nomdoctor ?></h5>
                </div>
            </div>
            <div class="row"  style="border-bottom: 1px solid #f3f2f2;">
                <div class="col-xs-12">
                    <h5><strong>LISTA DE DIAGNOSTICOS</strong></h5>       
                    <ul>
                        <?php
                        foreach ($Diagnostico as $valor) {
                            echo '<li>' . $valor['descripcion'] . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php if (count($Procedimiento)!=0) {?>
            <div class="row"  style="border-bottom: 1px solid #f3f2f2;">
                <div class="col-xs-12">
                    <h5><strong>LISTA DE PROCEDIMIENTO</strong></h5>       
                    <ul>
                        <?php
                        foreach ($Procedimiento as $valor) {
                            echo '<li>' . $valor['descripcion'] . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php }?>
            <div class="row">
                <div class="col-xs-12">
                    <h5><strong>RECETA MEDICA</strong></h5>        
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th style="padding-top: 2px;padding-bottom: 2px;">Medicamento</th>
                                <th style="text-align: center;padding-top: 2px;padding-bottom: 2px;">Unidad</th>
                                <th style="text-align: center;padding-top: 2px;padding-bottom: 2px;">Dosis</th>
                                <th style="text-align: center;padding-top: 2px;padding-bottom: 2px;">Duración</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($Receta as $valor) {
                                echo '<tr>';
                                echo '<td >' . $valor['descripcion'].' '.$valor['concentracion']. '</td>';
                                echo '<td style="text-align: center">' . $valor['unidad'].' Unid </td>';
                                echo '<td style="text-align: center"> Cad. ' . $valor['dosis'].' '.$valor['tdosis']. '</td>';
                                echo '<td style="text-align: center">' . $valor['duracion'].' '.$valor['tduracion']. '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row"  style="border-bottom: 1px solid #f3f2f2;">
                <div class="col-xs-12">
                    <h5><strong>OBSERVACIÓN</strong></h5>
                    <textarea style="width: 100%;">
                        
                    </textarea>
                </div>
            </div>
            <br>
            <br><br>
            <br><br>
            <br><br>
            <br>
            <footer>
                <p style="text-align: center;color: #dddddd;">________________________________</p>
                <p style="text-align: center">Firma del Médico</p>
            </footer>
        </div>
    </body> 
</html>
<?php
$dompdf = new DOMPDF();
$dompdf->loadHtml(ob_get_clean());
$dompdf->render();
$dompdf->stream("Receta.pdf", array("Attachment" => 0));
?>