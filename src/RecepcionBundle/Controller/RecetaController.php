<?php

namespace RecepcionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\AtencionDiagnostico;
use ModeloBundle\Entity\AtencionMedicamento;
use Symfony\Component\HttpFoundation\Response;

class RecetaController extends Controller {

    /**
     * @Route("/receta/{codatencion}", name="doctor_receta")
     * @Method("GET")
     */
    public function RecetaAction($codatencion) {
      
        $em2 = $this->getDoctrine()->getManager('trabajador'); //CONEXION A BASE DE DATOS TOPICO   
        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Atencion = $em->getRepository('ModeloBundle:Atencion')->find($codatencion); //DATOS ATENCION BY CODATENCION
      
        if ($Atencion->getateTipoPer() == 1) {
            $Persona = $em2->getRepository('ModeloBundle:Persona')->Data_trabajador_by_Codigo($Atencion->getpercodigo()); //DATOS PACIENTE
        } else {
            $Persona = $em->getRepository('ModeloBundle:Paciente')->Data_paciente_by_Codigo($Atencion->getpercodigo()); //DATOS PACIENTE
        }
        $medicamento = $em->getRepository('ModeloBundle:Medicamento')->findAll();
        $NomPaciente = $Persona['nombres'] . ' ' . $Persona['apaterno'] . ' ' . $Persona['amaterno'];
        return $this->render('RecepcionBundle:Doctor:receta.html.twig', ['Paciente' => $NomPaciente, 'medicamento' => $medicamento, 'codatencion' => $codatencion]);
    }

    /**
     * @Route("/lstamedicamento", name="doctor_lista_amedicamento")
     * @Method("POST")
     */
    public function LstArecetaAction(Request $request) {
      
        $codatencion = $request->request->get('codatencion');

        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Amedicamento = $em->getRepository('ModeloBundle:AtencionMedicamento')->Data_Lista_Amedicamento($codatencion);
        $result = true;
        if (!$Amedicamento) {
            $result = false;
        }
        echo $this->renderView('RecepcionBundle:Doctor:data_receta.html.twig', ['lstAmedicamento' => $Amedicamento, 'result' => $result]);
        exit;
    }
    
    /**
     * @Route("/guardarMedicamento", name="doctor_guardar_medicamento")
     * @Method("POST")
     */
    public function GuardarMedicamentoAction(Request $request) {
        
        $usuario = $this->getUser()->getCodUser();
        $codMedicamento = $request->request->get('codmedicamento');
        $codAtencion = $request->request->get('codatencion');
        
        $concentracion = $request->request->get('concentracion');
        $unidad = $request->request->get('unidad');
        $dosis = $request->request->get('dosis');
        $tdosis = $request->request->get('tdosis');
        $duracion = $request->request->get('duracion');
        $tduracion = $request->request->get('tduracion');


        $em = $this->getDoctrine()->getManager();

        $DataMedicamento = $em->getRepository('ModeloBundle:AtencionMedicamento')->findOneBy(array('codAtencion' => $codAtencion, 'codMedicamento' => $codMedicamento));
        if (!$DataMedicamento) {
            $Amedicamento = new AtencionMedicamento();
            $Amedicamento->setCodAtencion($codAtencion);
            $Amedicamento->setCodMedicamento($codMedicamento);
            $Amedicamento->setAmedConcentracion($concentracion);
            $Amedicamento->setAmedUnidad($unidad);
            $Amedicamento->setAmedDosis($dosis);
            $Amedicamento->setAmedTdosis($tdosis);
            $Amedicamento->setAmedDuracion($duracion);
            $Amedicamento->setAmedTduracion($tduracion);
            $Amedicamento->setCodUser($usuario);
            $Amedicamento->setAmedFegReg(new \DateTime);
            $Amedicamento->setAmedEstado(1);
            $em->persist($Amedicamento);
            $em->flush();

            if (!$Amedicamento->getCodAmedicamento()) {
                $rpta = ['result' => false, 'mensaje' => 'Ocurrio un problema al registrar favor de intentarlo de nuevo'];
            } else {
                $rpta = ['result' => true, 'mensaje' => 'Se registro correctamente'];
            }
        } else {
            $rpta = ['result' => false, 'mensaje' => 'Ya se encuentra registrado'];
        }


        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }
    
    
    /**
     * @Route("/generarrecetamedica/{codatencion}", name="doctor_generar_receta")
     * @Method("GET")
     */
    public function generarpdfAction($codatencion) {
       
        $em2 = $this->getDoctrine()->getManager('trabajador');
        $em = $this->getDoctrine()->getManager();

        $Atencion = $em->getRepository('ModeloBundle:Atencion')->find($codatencion); //DATOS ATENCION BY CODATENCION
        $Usuario = $em->getRepository('ModeloBundle:Usuario')->findOneBy(array('codUser'=>$Atencion->getcodUser()));
        $Doctor = $em2->getRepository('ModeloBundle:Persona')->Data_trabajador_by_Codigo($Usuario->getpercodigo());
       
        if ($Atencion->getateTipoPer() == 1) {
            $Persona = $em2->getRepository('ModeloBundle:Persona')->Data_trabajador_by_Codigo($Atencion->getpercodigo()); //DATOS PACIENTE
        } else {
            $Persona = $em->getRepository('ModeloBundle:Paciente')->Data_paciente_by_Codigo($Atencion->getpercodigo()); //DATOS PACIENTE
        }
        $Nompaciente = $Persona['nombres'] . ' ' . $Persona['apaterno'] . ' ' . $Persona['amaterno'];
        $Nomdoctor = $Doctor['nombres'] . ' ' . $Doctor['apaterno'] . ' ' . $Doctor['amaterno'];
        
        
        $Adiagnostico = $em->getRepository('ModeloBundle:AtencionDiagnostico')->Data_Lista_Adiagnosticos($codatencion); //DATOS LISTA ATENCIONES MEDICAS
        $Aprocedimiento = $em->getRepository('ModeloBundle:AtencionProcedimiento')->Data_Lista_Aprocedimiento($codatencion);
        $Amedicamento = $em->getRepository('ModeloBundle:AtencionMedicamento')->Data_Lista_Amedicamento($codatencion);

        return $this->render('RecepcionBundle:Historial:imprimir.html.php', ['Nomdoctor'=>$Nomdoctor,'Nompaciente'=>  $Nompaciente,'Diagnostico' => $Adiagnostico, 'Procedimiento' => $Aprocedimiento, 'Receta' => $Amedicamento]);
    }

}
