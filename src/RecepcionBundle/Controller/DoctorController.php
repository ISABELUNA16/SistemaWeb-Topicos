<?php

namespace RecepcionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\AtencionDiagnostico;
use ModeloBundle\Entity\AtencionProcedimiento;

class DoctorController extends Controller
{
    /**
     * @Route("/doctor", name="doctor_home")
     */
    public function RecepcionHomeAction()
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        
        return $this->render('RecepcionBundle:Doctor:doctor.html.twig');
    }
    
    /**
     * @Route("/lstatenciondoctor", name="doctor_lista_atencion")
     * @Method("POST")
     */
    public function LstAtencionesAction()
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $DataAtenciones = $em->getRepository('ModeloBundle:Atencion')->Doctor_Lista_Atenciones();//DATOS LISTA ATENCIONES MEDICAS
        echo $this->renderView('RecepcionBundle:Doctor:data_atencion.html.twig',['listaAtenciones'=>$DataAtenciones]);
        exit;
    }

    /**
     * @Route("/recibiratencion", name="doctor_recibir_atencion")
     * @Method("POST")
     */
    public function RecibirAtencionAction(Request $request)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        
        $codAtencion = $request->request->get('codigo');//INPUT CODIGO DE LA PERSONA
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO

        $cantidadAtenciones = $em->getRepository('ModeloBundle:Atencion')->data_lista_atenciones_doctor();
        $cantRegistros = intval($cantidadAtenciones[0]['cantRegistro']);

        if($cantRegistros >= 1){
            
            $mensaje = ['mensaje'=>1];
            echo json_encode($mensaje, JSON_PRETTY_PRINT);
            exit;
       
        }else{
            
            $atencion=$em->getRepository('ModeloBundle:Atencion')->findOneBy(array('codAtencion' => $codAtencion));
            $atencion->setCodEstado(3);
            $em->flush();
            $mensaje = ['mensaje'=>2];
            echo json_encode($mensaje, JSON_PRETTY_PRINT);
            exit;
        }

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
