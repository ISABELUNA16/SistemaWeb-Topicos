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

class MantenimientoController extends Controller {

    /**
     * @Route("/mantenimiento", name="mantenimiento_principal")
     */
    public function MatenimientoAction() {

        return $this->render('RecepcionBundle:Mantenimiento:Mante_Diagnostico.html.twig');
    }
    
    /**
     * @Route("/lstTipoDiagnostico", name="mante_tdiagnostico")
     * @Method("POST") 
     */
    public function ListaDiagnosticoAction() {
      
        $em = $this->getDoctrine()->getManager();
        $Tdiagnostico = $em->getRepository('ModeloBundle:Tdiagnostico')->findby(array('tdiagEstado'=>1));
        return $this->render('RecepcionBundle:Mantenimiento:cbo_tdiagnostico.html.twig',['Tdiagnostico'=>$Tdiagnostico]);
    }
    
    /**
     * @Route("/lstTblTipoDiagnostico", name="mante_tbl_tdiagnostico")
     * @Method("POST") 
     */
    public function ListaTblDiagnosticoAction() {
      
        $em = $this->getDoctrine()->getManager();
        $Tdiagnostico = $em->getRepository('ModeloBundle:Tdiagnostico')->findAll();
        return $this->render('RecepcionBundle:Mantenimiento:tbl_tdiagnostico.html.twig',['Tdiagnostico'=>$Tdiagnostico]);
    }
    
    

     /**
     * @Route("/guardarTdiagnostico", name="mante_guardar_tdiagnostico")
     * @Method("POST")
     */
    public function GuardarTdiagnosticoAction(Request $request)
    {   
        
        $usuario = $this->getUser()->getCodUser();  
        $tdiagnostico = $request->request->get('tdiagnostico');
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO

        $Tdiagnostico=new Tdiagnostico();
        $Tdiagnostico->setTdiagDescripcion($tdiagnostico);
        $Tdiagnostico->setTdiagEstado(1);
        $em->persist($Tdiagnostico);
        $em->flush();
        
        if(!$Tdiagnostico->getCodTdiagnostico()){
           $rpta=['result'=>false,'mensaje'=>'Ocurrio un problema al registrar la atencion favor de intentarlo nuevamente, si en caso el problema persiste comunicarse con la unidad de informatica para verificar la incidencia'];
        }else{
           $rpta=['result'=>true,'mensaje'=>'Se registro correctamente'];
        }
        
       
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }
    
     /**
     * @Route("/deleteTdiagnostico", name="mante_delete_tdiagnostico")
     * @Method("POST")
     */
    public function DeleteTdiagnosticoAction(Request $request)
    {   
        
        $codtdiagnostico = $request->request->get('codtdiagnostico');
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO

        $Tdiagnostico = $em->getRepository('ModeloBundle:Tdiagnostico')->findOneBy(array('codTdiagnostico'=>$codtdiagnostico));
        if($Tdiagnostico){
          $em->remove($Tdiagnostico);
          $em->flush(); 
          $rpta=['result'=>true];
        }else{
          $rpta=['result'=>false];
        }
        
        $rpta=['result'=>true,'mensaje'=>'Se registro correctamente'];
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }
   
    
}
