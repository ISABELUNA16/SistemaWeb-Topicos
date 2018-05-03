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
use ModeloBundle\Entity\Medicamento;

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
        $Medicamento = $em->getRepository('ModeloBundle:Medicamento')->findAll();
        $resul=true;
        return $this->render('RecepcionBundle:Mantenimiento:tbl_medicamento.html.twig',['Medicamento'=>$Medicamento,'result'=>$resul]);
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
  
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $Medicamento=new Medicamento();
        $Medicamento->setMedDescripcion($descripcion);
        $Medicamento->setMedEstado(1);
        $em->persist($Medicamento);
        $em->flush();
        
        if(!$Medicamento->getCodProcedimiento()){
           $rpta=['result'=>false,'mensaje'=>'Ocurrio un problema al registrar la atencion favor de intentarlo nuevamente, si en caso el problema persiste comunicarse con la unidad de informatica para verificar la incidencia'];
        }else{
           $rpta=['result'=>true,'mensaje'=>'Se registro correctamente'];
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
