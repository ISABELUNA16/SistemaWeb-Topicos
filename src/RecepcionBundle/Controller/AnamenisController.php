<?php

namespace RecepcionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\AtencionDiagnostico;
use ModeloBundle\Entity\AtencionProcedimiento;
use ModeloBundle\Entity\AtencionAnamnesis;
use ModeloBundle\Entity\Atencion;

class AnamenisController extends Controller {

    /**
     * @Route("/anamenis/{codatencion}", name="doctor_anamenis")
     * @Method("GET")
     */
    public function AnamenisAction($codatencion) {
      
        $em2 = $this->getDoctrine()->getManager('trabajador'); //CONEXION A BASE DE DATOS TOPICO   
        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Atencion = $em->getRepository('ModeloBundle:Atencion')->find($codatencion); //DATOS ATENCION BY CODATENCION
        
        if ($Atencion->getateTipoPer() == 1) {
            $Persona = $em2->getRepository('ModeloBundle:Persona')->Data_trabajador_by_Codigo($Atencion->getpercodigo()); //DATOS PACIENTE
        } else {
            $Persona = $em->getRepository('ModeloBundle:Paciente')->Data_paciente_by_Codigo($Atencion->getpercodigo()); //DATOS PACIENTE
        }
        $anamnesis = $em->getRepository('ModeloBundle:Anamnesis')->findAll();
        $NomPaciente = $Persona['nombres'] . ' ' . $Persona['apaterno'] . ' ' . $Persona['amaterno'];
        return $this->render('RecepcionBundle:Doctor:anamenis.html.twig', ['Paciente' => $NomPaciente, 'anamnesis' => $anamnesis, 'codatencion' => $codatencion]);
    }


    /**
     * @Route("/lstanamnesis", name="doctor_lista_anamnesis")
     * @Method("POST")
     */
    public function LstAnamnesisAction(Request $request) {
      
        $em = $this->getDoctrine()->getManager(); 
        $anamnesis = $em->getRepository('ModeloBundle:Anamnesis')->listadoAnamnesis(); //DATOS LISTA ATENCIONES MEDICAS
        echo $this->renderView('RecepcionBundle:Doctor:cbo_anamnesis.html.twig', ['lstProcedimiento' => $anamnesis]);
        exit;
    }


    /**
     * @Route("/guardaranamnesis", name="doctor_guardar_AtencionAnamnesis")
     * @Method("POST")
     */
    public function GuardarAnamnesisAction(Request $request) {
        
        $usuario = $this->getUser()->getCodUser();
        $codAnamnesis = $request->request->get('codAnamnesis');
        $observacion = $request->request->get('observacion');
        $codAtencion = $request->request->get('codatencion');
        
        $em = $this->getDoctrine()->getManager(); 

        if( !empty($codAnamnesis) &&  !empty($observacion) && !empty($codAtencion)){

            $Anamnesis = new AtencionAnamnesis();
            $Anamnesis->setCodAtencion($codAtencion);
            $Anamnesis->setCodAnamnesis($codAnamnesis);
            $Anamnesis->setAanamObservacion($observacion);
            $Anamnesis->setCodUser($usuario);
            $Anamnesis->setAanamFegReg(new \DateTime);
            $Anamnesis->setAanamEstado(1);
            $em->persist($Anamnesis);
            $em->flush();

            if (!$Anamnesis->getCodAanamnesis()) {

                $rpta = ['result' => false, 'mensaje' => 'Ocurrio un problema al registrar, intentelo nuevamente'];
            } else {

                $rpta = ['result' => true, 'mensaje' => 'Se registro correctamente.'];
            }
        
        }else{

            $rpta = ['result' => false, 'mensaje' => 'Los campos no deben estar vacios.'];
        }

        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }

     /**
     * @Route("/lstaanamnesis", name="doctor_lista_aanamnesis")
     * @Method("POST")
     */
    public function LstAanamnesisAction(Request $request) {
        
        $codatencion = $request->request->get('codatencion');

        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Aanamnesis = $em->getRepository('ModeloBundle:AtencionAnamnesis')->Data_Lista_Aanamnesis($codatencion); //DATOS LISTA ATENCIONES MEDICAS
        $result = true;
       
        if (!$Aanamnesis) {
            $result = false;
        }
        echo $this->renderView('RecepcionBundle:Doctor:data_anamnesis.html.twig', ['lstAanamnesis' => $Aanamnesis, 'result' => $result]);
        exit;
    }


}
