<?php

namespace RecepcionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;


class HistorialController extends Controller
{
    
    /**
     * @Route("/viewhistorial", name="historial_view")
     * @Method("POST")
     */
    public function ViewHistorialAction(Request $request)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        $percodigo = $request->request->get('percodigo');
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $Atenciones = $em->getRepository('ModeloBundle:Atencion')->findBy(array('percodigo'=>$percodigo,'codEstado'=>[5,4]),array('ateFecReg'=>'DESC'));
        echo $this->renderView('RecepcionBundle:Historial:view_historial.html.twig',['Atenciones'=>$Atenciones]);
        exit;
    }
    
    /**
     * @Route("/lstviewhistorial", name="historial_view_lista")
     * @Method("POST")
     */
    public function LstViewHistorialAction(Request $request)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        $codAtencion = $request->request->get('codatencion');
        
        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Adiagnostico = $em->getRepository('ModeloBundle:AtencionDiagnostico')->Data_Lista_Adiagnosticos($codAtencion); //DATOS LISTA ATENCIONES MEDICAS
        $Aprocedimiento = $em->getRepository('ModeloBundle:AtencionProcedimiento')->Data_Lista_Aprocedimiento($codAtencion);
        $Amedicamento= $em->getRepository('ModeloBundle:AtencionMedicamento')->Data_Lista_Amedicamento($codAtencion);
        $resultD = true;
        $resultP = true;
        $resultM = true;
        if (!$Adiagnostico)$resultD = false;
        if (!$Aprocedimiento)$resultP = false;
        if (!$Amedicamento)$resultM = false;
        echo $this->renderView('RecepcionBundle:Historial:data_historial.html.twig',
                                ['lstAdiagnostico' => $Adiagnostico, 'resultD' => $resultD,
                                 'lstAprocedimiento'=>$Aprocedimiento,'resultP'=>$resultP,
                                 'lstAmedicamento'=>$Amedicamento,'resultM'=>$resultM ]);
        exit;
    }
    
    private function ValidarSession(){
        $sesion_creada=true;//VARIABLE INICIALIZADA CON TRUE 
        $session = new Session();//INICIAR SESSION
        $UserSession=$session->get('usuario');//OBTENER SESSION
        if(empty($UserSession)){
            $sesion_creada=false;
        }
        return $sesion_creada;//RETORNA DE VARIABLE
    }
    
   
}
