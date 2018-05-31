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
       
        <div class="container" style="border:1px solid #f3f2f2; padding: 2px;">
            <div class="row" style="border-bottom: 1px solid #f3f2f2;">
                <div class="col-xs-3" style="padding-bottom: 8px;"><img src="./bundles/public/img/logotipo2_small.png" /></div>
                <div class="col-xs-5"><center>
                    <p><strong>TÓPICO DE ATENCIÓN MÉDICA</strong></p>
                    <p><strong>RECETARIO</strong></p></center>
                </div>
                <div class="col-xs-3" style="text-align: center"><strong>Fecha : hoy</strong><br>Unidad de Personal</div>
            </div>
            <br>
            <div class="row"  style="border-bottom: 1px solid #f3f2f2;">
                <div class="col-xs-12">
                    <p><strong>PACIENTE   :</strong> <?php echo $Nompaciente ?> </p>
                    <p><strong>MÉDICO     :</strong> <?php echo $Nomdoctor ?></p>
                </div>
            </div>
            <br>
            <div class="row"  style="border-bottom: 1px solid #f3f2f2;">
                <div class="col-xs-12">
                    <p><strong>DIAGNÓSTICOS  :</strong></p>       
                    <ul>
                        <?php
                        foreach ($Diagnostico as $valor) {
                            echo '<li>' . $valor['descripcion'] . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12">
                    <p><strong>RECETA MÉDICA</strong></p>        
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th style="padding-top: 2px;padding-bottom: 2px;">Medicamento</th>
                                <th style="text-align: center;padding-top: 2px;padding-bottom: 2px;">Unidad</th>
                                <th style="text-align: center;padding-top: 2px;padding-bottom: 2px;">Dosis</th>
                                <th style="text-align: center;padding-top: 2px;padding-bottom: 2px;">Duración</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 11px;">
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
           <!-- <div class="row"  style="border-bottom: 1px solid #f3f2f2;">
                <div class="col-xs-12">
                    <h5><strong>OBSERVACIÓN</strong></h5>
                    <textarea style="width: 100%;">
                        
                    </textarea>
                </div>
            </div>-->
            <br>
            <br>
            <br>
            <footer>
                <p style="text-align: center;color: #dddddd;">________________________________</p>
                <p style="text-align: center">Firma del Médico</p>
            </footer>
        </div>
    </body> 
</html>
<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("Receta.pdf", array("Attachment" => 0));
?>