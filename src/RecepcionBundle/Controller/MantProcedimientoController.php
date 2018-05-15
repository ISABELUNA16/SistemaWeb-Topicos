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
use ModeloBundle\Entity\Tdiagnostico;
use ModeloBundle\Entity\Procedimiento;

class MantProcedimientoController extends Controller {

    /**
     * @Route("/mantprocedimiento", name="mantenimiento_procedimiento")
     */
    public function MatenimientoAction() {
        if (!$this->ValidarSession()) { //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login'); //REDIREC LOGIN
        }
        return $this->render('RecepcionBundle:Mantenimiento:Mante_Procedimiento.html.twig');
    }
    
    
    /**
     * @Route("/lstProcedimiento", name="mante_tbl_procedimiento")
     * @Method("POST") 
     */
    public function ListaProcedimientoAction() {
        if (!$this->ValidarSession()) { 
            return $this->redirectToRoute('acceso_login'); 
        }
        $em = $this->getDoctrine()->getManager();
        $Tprocedimiento = $em->getRepository('ModeloBundle:Tprocedimiento')->findAll();
        $Procedimiento = $em->getRepository('ModeloBundle:Procedimiento')->findAll();
        $resul=true;
        return $this->render('RecepcionBundle:Mantenimiento:tbl_procedimiento.html.twig',['Tprocedimiento' => $Tprocedimiento,'Procedimiento'=>$Procedimiento,'result'=>$resul]);
    }
 
     /**
     * @Route("/newprocedimiento", name="mante_guardar_procedimiento")
     * @Method("POST")
     */
    public function GuardarprocedimientoAction(Request $request)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        $descripcion = $request->request->get('descripcion');
  
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $Procedimiento=new Procedimiento();
        $Procedimiento->setProcDescripcion($descripcion);
        $Procedimiento->setProcEstado(1);
        $em->persist($Procedimiento);
        $em->flush();
        
        if(!$Procedimiento->getCodProcedimiento()){
           $rpta=['result'=>false,'mensaje'=>'Ocurrio un problema al registrar la atencion favor de intentarlo nuevamente, si en caso el problema persiste comunicarse con la unidad de informatica para verificar la incidencia'];
        }else{
           $rpta=['result'=>true,'mensaje'=>'Se registro correctamente'];
        }
        
       
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }
    
     /**
     * @Route("/deleteprocedimiento", name="mante_borrar_procedimiento")
     * @Method("POST")
     */
    public function BorrarprocedimientoAction(Request $request)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        $codProcedimiento = $request->request->get('codProcedimiento');
        
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $Procedimiento = $em->getRepository('ModeloBundle:Procedimiento')->find(array('codProcedimiento'=>$codProcedimiento));
        if($Procedimiento){
          $em->remove($Procedimiento);
          $em->flush(); 
          $rpta=['result'=>true];
        }else{
          $rpta=['result'=>false];
        }
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;

    }
    
    private function ValidarSession() {
        $sesion_creada = true; //VARIABLE INICIALIZADA CON TRUE 
        $session = new Session(); //INICIAR SESSION
        $UserSession = $session->get('usuario'); //OBTENER SESSION
        if (empty($UserSession)) {
            $sesion_creada = false;
        }
        return $sesion_creada; //RETORNA DE VARIABLE
    }

}
