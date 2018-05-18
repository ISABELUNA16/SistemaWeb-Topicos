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
use ModeloBundle\Entity\Tprocedimiento;

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
        $codTprocedimiento = $request->request->get('codigotipo');
  
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $Procedimiento=new Procedimiento();
        $Procedimiento->setProcDescripcion($descripcion);
        $Procedimiento->setCodTprocedimiento($codTprocedimiento);
        $Procedimiento->setProcEstado(1);
        $em->persist($Procedimiento);
        $em->flush();
        
        if(!$Procedimiento->getCodProcedimiento()){
           $rpta=['result'=>false,'mensaje'=>'Ocurrió un problema al registrar la atención. Inténtelo nuevamente, si en caso el problema persiste comuníquese con la unidad de informática para verificar la incidencia'];
        }else{
           $rpta=['result'=>true,'mensaje'=>'Se registró correctamente'];
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
    
    
    //FUNCIONES PARA EL MODAL DEL TIPO DE PROCEDIMIENTO
    
    /**
     * @Route("/lstTipoProcedimiento", name="mante_tprocedimiento")
     * @Method("POST") 
     */
    public function ListaTprocedimientoAction() {

        if (!$this->ValidarSession()) { 
            return $this->redirectToRoute('acceso_login'); 
      
        }
        $em = $this->getDoctrine()->getManager();
        $Tprocedimiento = $em->getRepository('ModeloBundle:Tprocedimiento')->findby(array('tprocEstado'=>1));
        return $this->render('RecepcionBundle:Mantenimiento:cbo_tprocedimiento.html.twig',['Tprocedimiento'=>$Tprocedimiento]);
    }
    
    /**
     * @Route("/lstTblTipoProcedimiento", name="mante_tbl_tprocedimiento")
     * @Method("POST") 
     */
    public function ListaTblProcedimientoAction() {
        if (!$this->ValidarSession()) { 
            return $this->redirectToRoute('acceso_login'); 
        }
        $em = $this->getDoctrine()->getManager();
        $Tprocedimiento = $em->getRepository('ModeloBundle:Tprocedimiento')->findAll();
        return $this->render('RecepcionBundle:Mantenimiento:tbl_tprocedimiento.html.twig',['Tprocedimiento'=>$Tprocedimiento]);
    } 


     /**
     * @Route("/guardarTprocedimiento", name="mante_guardar_tprocedimiento")
     * @Method("POST")
     */
    public function GuardarTprocedimientoAction(Request $request)
    {   
        if(!$this->ValidarSession()){ 
            return $this->redirectToRoute('acceso_login');
        }
        $session = new Session();//INICIAR SESSION
        $usuario= $session->get('usuario');
        
        $tprocedimiento = $request->request->get('tprocedimiento');
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO

        $Tproc = new Tprocedimiento();
        $Tproc->setTprocDescripcion($tprocedimiento);
        $Tproc->setTprocEstado(1);
        $em->persist($Tproc);
        $em->flush();

        
        if(!$Tproc->getCodTprocedimiento()){
           $rpta=['result'=>false,'mensaje'=>'Ocurrió un problema al registrar el tipo de procedimiento, inténtelo nuevamente. Si en caso el problema persista, comúniquese con la unidad de informática para verificar la incidencia.'];
        }else{
           $rpta=['result'=>true,'mensaje'=>'Se registró correctamente'];
        }
        
       
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * @Route("/deleteTprocedimiento", name="mante_delete_tprocedimiento")
     * @Method("POST")
     */
    public function DeleteTprocedimientoAction(Request $request)
    {   
        if(!$this->ValidarSession()){ 
            return $this->redirectToRoute('acceso_login');
        }

        $codtprocedimiento = $request->request->get('codtprocedimiento');
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO

        $Tprocedimiento = $em->getRepository('ModeloBundle:Tprocedimiento')->findOneBy(array('codTprocedimiento'=>$codtprocedimiento));
        if($Tprocedimiento){
         
          $em->remove($Tprocedimiento);
          $em->flush(); 
          $rpta=['result'=>true];
          echo json_encode($rpta, JSON_PRETTY_PRINT);
          exit;
          
        }else{
       
          $rpta=['result'=>false];
          echo json_encode($rpta, JSON_PRETTY_PRINT);
          exit;
        }
        
       
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
