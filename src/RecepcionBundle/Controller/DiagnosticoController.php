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

class DiagnosticoController extends Controller {

    /**
     * @Route("/diagnostico/{codatencion}", name="doctor_diagnostico")
     * @Method("GET")
     */
    public function DiagnosticoAction($codatencion) {
        
        $em2 = $this->getDoctrine()->getManager('trabajador'); //CONEXION A BASE DE DATOS TOPICO   
        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Atencion = $em->getRepository('ModeloBundle:Atencion')->find($codatencion); //DATOS ATENCION BY CODATENCION
       
        if ($Atencion->getateTipoPer() == 1) {
            $Persona = $em2->getRepository('ModeloBundle:Persona')->Data_trabajador_by_Codigo($Atencion->getpercodigo()); //DATOS PACIENTE
        } else {
            $Persona = $em->getRepository('ModeloBundle:Paciente')->Data_paciente_by_Codigo($Atencion->getpercodigo()); //DATOS PACIENTE
        }
        
        $Tdiagnostico = $em->getRepository('ModeloBundle:Tdiagnostico')->findAll();
        $NomPaciente = $Persona['nombres'] . ' ' . $Persona['apaterno'] . ' ' . $Persona['amaterno'];
        return $this->render('RecepcionBundle:Doctor:diagnostico.html.twig', ['Paciente' => $NomPaciente, 'tdiagnostico' => $Tdiagnostico, 'codatencion' => $codatencion]);
    }

    /**
     * @Route("/guardardiagnostico", name="doctor_guardar_diagnostico")
     * @Method("POST")
     */
    public function GuardarDiagnosticoAction(Request $request) {
        
        $usuario = $this->getUser()->getCodUser();
        $codDiagnostico = $request->request->get('coddiagnostico');
        $codDiagnosticoTipo = $request->request->get('coddiagnosticotipo');
        $codAtencion = $request->request->get('codatencion');

        $em = $this->getDoctrine()->getManager();
        $DataAdiagnostico = $em->getRepository('ModeloBundle:AtencionDiagnostico')->findOneBy(array('codAtencion' => $codAtencion, 'codDiagnostico' => $codDiagnostico));
        
        if (!$DataAdiagnostico) {

            $Adiagnostico = new AtencionDiagnostico();
            $Adiagnostico->setCodAtencion($codAtencion);
            $Adiagnostico->setCodDiagnostico($codDiagnostico);
            $Adiagnostico->setAdiagTipo($codDiagnosticoTipo);
            $Adiagnostico->setCodUser($usuario);
            $Adiagnostico->setAdiagFegReg(new \DateTime);
            $Adiagnostico->setAdiagEstado(1);
            $em->persist($Adiagnostico);
            $em->flush();

            if (!$Adiagnostico->getCodAdiagnostico()) {
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
     * @Route("/deleteadiagnostico", name="doctor_delete_adiagnostico")
     * @Method("POST")
     */
    public function deleteAdiagnosticoAction(Request $request) {
        
        $codAdiagnostico = $request->request->get('codadiagnostico');
        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Adiagnostico = $em->getRepository('ModeloBundle:AtencionDiagnostico')->find(array('codAdiagnostico' => $codAdiagnostico)); //DATOS ANTECEDENTE POR ID 
        if ($Adiagnostico) {
            $em->remove($Adiagnostico);
            $em->flush();
            $rpta = ['result' => true];
        } else {
            $rpta = ['result' => false];
        }
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * @Route("/cambiartipodiagnostico", name="doctor_tipo_cambio_diagnostico")
     * @Method("POST")
     */
    public function CambiarTipoDiagnosticoAction(Request $request) {
        
        $codAdiagnostico = $request->request->get('codigo');
        $tipo = $request->request->get('tipo');

        $em = $this->getDoctrine()->getManager();
        $Adiagnostico = $em->getRepository('ModeloBundle:AtencionDiagnostico')->findOneBy(array('codAdiagnostico' => $codAdiagnostico));
        $Adiagnostico->setAdiagTipo($tipo);
        $em->flush();
        $rpta = ['result' => true, 'mensaje' => 'Se Actualizo correctamente'];
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * @Route("/lstdiagnostico", name="doctor_lista_diagnostico")
     * @Method("POST")
     */
    public function LstDiagnosticoAction(Request $request) {
        
        $codTdiagnostico = $request->request->get('codTdiagnostico');

        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Diagnostico = $em->getRepository('ModeloBundle:Diagnostico')->findBy(array('codTdiagnostico' => $codTdiagnostico)); //DATOS LISTA ATENCIONES MEDICAS
        echo $this->renderView('RecepcionBundle:Doctor:cbo_diagnostico.html.twig', ['lstDiagnostico' => $Diagnostico]);
        exit;
    }

    /**
     * @Route("/lstItemsCantDiag", name="Diagnostico_lista_items_count")
     * @Method("POST")
     */
    public function LstDiagItemsCountAction(Request $request) {
        
        $codatencion = $request->request->get('codatencion');
        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $ItemsDiag = $em->getRepository('ModeloBundle:AtencionDiagnostico')->findby(array('codAtencion'=>$codatencion,'adiagEstado'=>1));
        $ItemsProc = $em->getRepository('ModeloBundle:AtencionProcedimiento')->findby(array('codAtencion'=>$codatencion,'aprocEstado'=>1));
        $ItemsRec = $em->getRepository('ModeloBundle:AtencionMedicamento')->findby(array('codAtencion'=>$codatencion,'amedEstado'=>1));
        $ItemsAnamenis = $em->getRepository('ModeloBundle:Atencion')->findOneBy(array('codAtencion'=>$codatencion));
        $countana=0;
        if(!empty($ItemsAnamenis->getatenAnamenis())){
            $countana=1;
        }
        $rpta = ['ItemsDiag' => count($ItemsDiag), 'ItemsProc' => count($ItemsProc), 'ItemsRec' => count($ItemsRec),'anamenis'=>$countana];
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * @Route("/lstadiagnostico", name="doctor_lista_adiagnostico")
     * @Method("POST")
     */
    public function LstAdiagnosticoAction(Request $request) {
        
        $codatencion = $request->request->get('codatencion');

        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Adiagnostico = $em->getRepository('ModeloBundle:AtencionDiagnostico')->Data_Lista_Adiagnosticos($codatencion); //DATOS LISTA ATENCIONES MEDICAS
        $result = true;
        if (!$Adiagnostico) {
            $result = false;
        }
        echo $this->renderView('RecepcionBundle:Doctor:data_diagnostico.html.twig', ['lstAdiagnostico' => $Adiagnostico, 'result' => $result]);
        exit;
    }

    /**
     * @Route("/cambiotipoadiagnostico", name="doctor_cambiotipo_adiagnostico")
     * @Method("POST")
     */
    public function CambioTipoAdiagnosticoAction(Request $request) {
        
        $codadiagnostico = $request->request->get('codadiagnostico');

        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Adiagnostico = $em->getRepository('ModeloBundle:AtencionDiagnostico')->Data_Lista_Adiagnosticos($codadiagnostico); //DATOS LISTA ATENCIONES MEDICAS
        $result = true;
        if (!$Adiagnostico) {
            $result = false;
        }
        echo $this->renderView('RecepcionBundle:Doctor:data_diagnostico.html.twig', ['lstAdiagnostico' => $Adiagnostico, 'result' => $result]);
        exit;
    }
    
    /**
     * @Route("/finalizarAtencion", name="doctor_finalizar_atencion")
     * @Method("POST")
     */
    public function FinalizarAtencionAction(Request $request) {
        
        $codAtencion = $request->request->get('codatencion');
        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Atencion = $em->getRepository('ModeloBundle:Atencion')->find($codAtencion); //DATOS LISTA ATENCIONES MEDICAS
        if ($Atencion) {
            $Atencion->setCodEstado(4);
            $em->flush();
            $rpta = ['result' => true];
        } else {
            $rpta = ['result' => false];
        }
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }

    
}
