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
use ModeloBundle\Entity\Diagnostico;
use ModeloBundle\Entity\Tdiagnostico;

class MantDiagnosticoController extends Controller {

    /**
     * @Route("/mantdiagnostico", name="mantenimiento_diagnostico")
     */
    public function MatenimientoAction() {
       
        return $this->render('RecepcionBundle:Mantenimiento:Mante_Diagnostico.html.twig');
    }
    
    
    /**
     * @Route("/lstDiagnostico", name="mante_tbl_diagnostico")
     * @Method("POST") 
     */
    public function ListaDiagnosticoAction() {
       
        $em = $this->getDoctrine()->getManager();
        $Tdiagnostico = $em->getRepository('ModeloBundle:Tdiagnostico')->findAll();
        $diagnostico=$em->getRepository('ModeloBundle:Diagnostico')->findAll();
        $resul=true;
        return $this->render('RecepcionBundle:Mantenimiento:tbl_diagnostico.html.twig',['Tdiagnostico'=>$Tdiagnostico,'diagnostico'=>$diagnostico,'result'=>$resul]);
    }
    
    /**
     * @Route("/newdiagnostico", name="mante_guardar_diagnostico")
     * @Method("POST")
     */
    public function GuardardiagnosticoAction(Request $request)
    {   

        $usuario = $this->getUser()->getCodUser();
      
        $diagnostico = $request->request->get('descripcion');
        $codigo = $request->request->get('codigo');
        $codTdiagnostico = $request->request->get('codigotipo');
        
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO

        $Diagnostico=new Diagnostico();
        $Diagnostico->setDiagDescripcion($diagnostico);
        $Diagnostico->setCodTdiagnostico($codTdiagnostico);
        $Diagnostico->setDiagCodigo($codigo);
        $Diagnostico->setDiagEstado(1);
        $em->persist($Diagnostico);
        $em->flush();
        
        if(!$Diagnostico->getCodDiagnostico()){
           $rpta=['result'=>false,'mensaje'=>'Ocurrio un problema al registrar la atencion favor de intentarlo nuevamente, si en caso el problema persiste comunicarse con la unidad de informatica para verificar la incidencia'];
        }else{
           $rpta=['result'=>true,'mensaje'=>'Se registro correctamente'];
        }

        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }
    
     /**
     * @Route("/deletediagnostico", name="mante_borrar_diagnostico")
     * @Method("POST")
     */
    public function BorrardiagnosticoAction(Request $request)
    {   
        $codDiagnostico = $request->request->get('codDiagnostico');
        
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $Diagnostico = $em->getRepository('ModeloBundle:Diagnostico')->find(array('codDiagnostico'=>$codDiagnostico));
        if($Diagnostico){
          $em->remove($Diagnostico);
          $em->flush(); 
          $rpta=['result'=>true];
        }else{
          $rpta=['result'=>false];
        }
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;

    }
        
    /**
     * @Route("/lstTipoDiagnostico", name="mante_tdiagnostico")
     * @Method("POST") 
     */
    public function ListaTdiagnosticoAction() {  
        
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
      
          echo json_encode($rpta, JSON_PRETTY_PRINT);
          exit;

        }else{
          $rpta=['result'=>false];
          echo json_encode($rpta, JSON_PRETTY_PRINT);
          exit;
        }
      
    }
  
}
