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
use ModeloBundle\Entity\Medicamento;
use ModeloBundle\Entity\Tmedicamento;

class MantMedicamentoController extends Controller {

    /**
     * @Route("/mantmedicamento", name="mantenimiento_medicamento")
     */
    public function MatenimientoAction() {
        if (!$this->ValidarSession()) { //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login'); //REDIREC LOGIN
        }
        return $this->render('RecepcionBundle:Mantenimiento:Mante_Medicamento.html.twig');
    }
    

    /**
     * @Route("/lstMedicamento", name="mante_tbl_medicamento")
     * @Method("POST") 
     */
    public function ListaMedicamentoAction() {
        if (!$this->ValidarSession()) { //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login'); //REDIREC LOGIN
        }
        $em = $this->getDoctrine()->getManager();
        $Tmedicamento = $em->getRepository('ModeloBundle:Tmedicamento')->findAll();
        $Medicamento = $em->getRepository('ModeloBundle:Medicamento')->findAll();
        $resul=true;

        return $this->render('RecepcionBundle:Mantenimiento:tbl_medicamento.html.twig',['Tmedicamento'=>$Tmedicamento,'Medicamento'=>$Medicamento,'result'=>$resul]);
    }
    
     /**
     * @Route("/newmedicamento", name="mante_guardar_medicamento")
     * @Method("POST")
     */
    public function GuardarmedicamentoAction(Request $request)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        
        $descripcion = $request->request->get('descripcion');
        $codTmedicamento = $request->request->get('codigotipo');
  
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $Medicamento=new Medicamento();
        $Medicamento->setMedDescripcion($descripcion);
        $Medicamento->setCodTmedicamento($codTmedicamento);
        $Medicamento->setMedEstado(1);
        $em->persist($Medicamento);
        $em->flush();
        
        if(!$Medicamento->getCodMedicamento()){
           
            $rpta=['result'=>false,'mensaje'=>'Ocurrió un problema al registrar la atención. Inténtelo nuevamente, si en caso el problema persiste comuníquese con la unidad de informática para verificar la incidencia'];

        }else{
           $rpta=['result'=>true,'mensaje'=>'Se registró correctamente'];
        }
        
       
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }
    
     /**
     * @Route("/deletemedicamento", name="mante_borrar_medicamento")
     * @Method("POST")
     */
    public function BorrarmedicamentoAction(Request $request)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        $codMedicamento = $request->request->get('codMedicamento');
        
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $Medicamento = $em->getRepository('ModeloBundle:Medicamento')->find(array('codMedicamento'=>$codMedicamento));
        if($Medicamento){
          $em->remove($Medicamento);
          $em->flush(); 
          $rpta=['result'=>true];
        }else{
          $rpta=['result'=>false];
        }
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;

    }

    //FUNCIONES PARA EL MODAL DEL TIPO DE MEDICAMENTO
    
    /**
     * @Route("/lstTipoMedicamento", name="mante_tmedicamento")
     * @Method("POST") 
     */
    public function ListaTmedicamentoAction() {

        if (!$this->ValidarSession()) { 
            return $this->redirectToRoute('acceso_login'); 
      
        }
        $em = $this->getDoctrine()->getManager();
        $Tmedicamento = $em->getRepository('ModeloBundle:Tmedicamento')->findby(array('tmedEstado'=>1));
        return $this->render('RecepcionBundle:Mantenimiento:cbo_tmedicamento.html.twig',['Tmedicamento'=>$Tmedicamento]);
    }
    
    /**
     * @Route("/lstTblTipoMedicamento", name="mante_tbl_tmedicamento")
     * @Method("POST") 
     */
    public function ListaTblMedicamentoAction() {
        if (!$this->ValidarSession()) { 
            return $this->redirectToRoute('acceso_login'); 
        }
        $em = $this->getDoctrine()->getManager();
        $Tmedicamento = $em->getRepository('ModeloBundle:Tmedicamento')->findAll();
        return $this->render('RecepcionBundle:Mantenimiento:tbl_tmedicamento.html.twig',['Tmedicamento'=>$Tmedicamento]);
    } 

    /**
     * @Route("/guardarTmedicamento", name="mante_guardar_tmedicamento")
     * @Method("POST")
     */
    public function GuardarTmedicamentoAction(Request $request)
    {   
        if(!$this->ValidarSession()){ 
            return $this->redirectToRoute('acceso_login');
        }
        $session = new Session();//INICIAR SESSION
        $usuario= $session->get('usuario');
        
        $tmedicamento = $request->request->get('tmedicamento');
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO

        $Tmed = new Tmedicamento();
        $Tmed->setTmedDescripcion($tmedicamento);
        $Tmed->setTmedEstado(1);
        $em->persist($Tmed);
        $em->flush();

        
        if(!$Tmed->getCodTmedicamento()){
           $rpta=['result'=>false,'mensaje'=>'Ocurrió un problema al registrar el tipo de medicamento, inténtelo nuevamente. Si en caso el problema persiste, comúniquese con la unidad de informática para verificar la incidencia.'];
        }else{
           $rpta=['result'=>true,'mensaje'=>'Se registró correctamente'];
        }
        
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * @Route("/deleteTmedicamento", name="mante_delete_tmedicamento")
     * @Method("POST")
     */
    public function DeleteTmedicamentoAction(Request $request)
    {   
        if(!$this->ValidarSession()){ 
            return $this->redirectToRoute('acceso_login');
        }

        $codtmedicamento = $request->request->get('codtmedicamento');
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO

        $Tmedicamento = $em->getRepository('ModeloBundle:Tmedicamento')->findOneBy(array('codTmedicamento'=>$codtmedicamento));
        if($Tmedicamento){
          $em->remove($Tmedicamento);
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
