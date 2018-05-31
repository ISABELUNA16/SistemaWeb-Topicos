<?php

namespace RecepcionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\AtencionDiagnostico;
use ModeloBundle\Entity\AtencionProcedimiento;
use ModeloBundle\Entity\Atencion;


class ProcedimientoController extends Controller {

    /**
     * @Route("/procedimiento/{codatencion}", name="doctor_procedimiento")
     * @Method("GET")
     */
    public function ProcedimientoAction($codatencion) {
      
        $em2 = $this->getDoctrine()->getManager('trabajador'); //CONEXION A BASE DE DATOS TOPICO   
        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Atencion = $em->getRepository('ModeloBundle:Atencion')->find($codatencion); //DATOS ATENCION BY CODATENCION
        if ($Atencion->getateTipoPer() == 1) {
            $Persona = $em2->getRepository('ModeloBundle:Persona')->Data_trabajador_by_Codigo($Atencion->getpercodigo()); //DATOS PACIENTE
        } else {
            $Persona = $em->getRepository('ModeloBundle:Paciente')->Data_paciente_by_Codigo($Atencion->getpercodigo()); //DATOS PACIENTE
        }

        $Tprocedimiento = $em->getRepository('ModeloBundle:Tprocedimiento')->findAll();
        $NomPaciente = $Persona['nombres'] . ' ' . $Persona['apaterno'] . ' ' . $Persona['amaterno'];
        return $this->render('RecepcionBundle:Doctor:procedimiento.html.twig', ['Paciente' => $NomPaciente, 'tprocedimiento' => $Tprocedimiento, 'codatencion' => $codatencion]);
    }

    /**
     * @Route("/lstprocedimiento", name="doctor_lista_tprocedimiento")
     * @Method("POST")
     */
    public function LstProcedimientoAction(Request $request) {
      
        $codTprocedimiento = $request->request->get('codTprocedimiento');

        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Procedimiento = $em->getRepository('ModeloBundle:Procedimiento')->findBy(array('codTprocedimiento' => $codTprocedimiento)); //DATOS LISTA ATENCIONES MEDICAS
        echo $this->renderView('RecepcionBundle:Doctor:cbo_procedimiento.html.twig', ['lstProcedimiento' => $Procedimiento]);
        exit;
    }


    /**
     * @Route("/lstaprocedimiento", name="doctor_lista_aprocedimiento")
     * @Method("POST")
     */
    public function LstAprocedimientoAction(Request $request) {
      
        $codatencion = $request->request->get('codatencion');

        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Aprocedimiento = $em->getRepository('ModeloBundle:AtencionProcedimiento')->Data_Lista_Aprocedimiento($codatencion);
        $result = true;
        if (!$Aprocedimiento) {
            $result = false;
        }
        echo $this->renderView('RecepcionBundle:Doctor:data_procedimiento.html.twig', ['lstAprocedimiento' => $Aprocedimiento, 'result' => $result]);
        exit;
    }

    /**
     * @Route("/guardarProcedimiento", name="doctor_guardar_procedimiento")
     * @Method("POST")
     */
    public function GuardarProcedmientoAction(Request $request) {
       
        $usuario = $this->getUser()->getCodUser();
        $codProcedimiento = $request->request->get('codprocedimiento');
        $codAtencion = $request->request->get('codatencion');

        $em = $this->getDoctrine()->getManager();
        $DataProcedimiento = $em->getRepository('ModeloBundle:AtencionProcedimiento')->findOneBy(array('codAtencion' => $codAtencion, 'codProcedimiento' => $codProcedimiento));
       
        if (!$DataProcedimiento) {
            $Aprocedimiento = new AtencionProcedimiento();
            $Aprocedimiento->setCodAtencion($codAtencion);
            $Aprocedimiento->setCodProcedimiento($codProcedimiento);
            $Aprocedimiento->setCodUser($usuario);
            $Aprocedimiento->setAprocFegReg(new \DateTime);
            $Aprocedimiento->setAprocEstado(1);
            $em->persist($Aprocedimiento);
            $em->flush();

            if (!$Aprocedimiento->getCodProcedimiento()) {
                $rpta = ['result' => false, 'mensaje' => 'Ocurrió un problema al registrar favor de intentarlo de nuevo'];
            } else {
                $rpta = ['result' => true, 'mensaje' => 'Se registró correctamente'];
            }
        } else {
            $rpta = ['result' => false, 'mensaje' => 'Ya se encuentra el diagnóstico registrado'];
        }
        
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * @Route("/deleteaprocedimiento", name="doctor_delete_aprocedimiento")
     * @Method("POST")
     */
    public function deleteAdiagnosticoAction(Request $request) {
        
        $codAprocedimiento = $request->request->get('codaprocedimiento');
        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Aprocedimiento = $em->getRepository('ModeloBundle:AtencionProcedimiento')->find(array('codAprocedimiento' => $codAprocedimiento)); //DATOS ANTECEDENTE POR ID 
       
        if ($Aprocedimiento) {
            $em->remove($Aprocedimiento);
            $em->flush();
            $rpta = ['result' => true];
       
        } else {
            $rpta = ['result' => false];
        }
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }


}
