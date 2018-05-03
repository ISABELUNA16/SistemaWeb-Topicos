<?php

namespace RecepcionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Antecedente;


class AntecedenteController extends Controller
{
    
    /**
     * @Route("/datosAntecedente/{codatencion}/{tipo}", name="antecedentes_home")
     * @Method("GET")
     */
    public function AntecedenteActon($codatencion,$tipo)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        
         $em2 = $this->getDoctrine()->getManager('trabajador');//CONEXION A PRESUESTO   
         $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
         $Atencion= $em->getRepository('ModeloBundle:Atencion')->find($codatencion);//DATOS ATENCION BY CODATENCION
         if($Atencion->getateTipoPer()==1){
            $Persona = $em2->getRepository('ModeloBundle:Persona')->Data_trabajador_by_Codigo($Atencion->getpercodigo());//DATOS PACIENTE
         }else{
            $Persona = $em->getRepository('ModeloBundle:Paciente')->Data_paciente_by_Codigo($Atencion->getpercodigo());//DATOS PACIENTE
         }
         
         $NomPaciente=$Persona['nombres'].' '.$Persona['apaterno'].' '.$Persona['amaterno'];
         $TipAntecedente=$em->getRepository('ModeloBundle:Tantecedente')->find($tipo);
         
         $Items=$em->getRepository('ModeloBundle:Tantecedente')->Data_Items($Atencion->getpercodigo());

         return $this->render('RecepcionBundle:Doctor:clinico_antecedente.html.twig',['items'=>$Items,'tipodescripcion'=>$TipAntecedente->gettantDescripcion(),'tipo'=>$tipo,'Paciente'=>$NomPaciente,'genero'=> $Persona['genero'],'codatencion'=>$codatencion]);
         
         
    }
    
    /**
     * @Route("/lstAntecedentes", name="Antecedente_lista")
     * @Method("POST")
     */
    public function LstAntecedentesAction(Request $request)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        $codAtencion = $request->request->get('codatencion');
        $tipo = $request->request->get('tipo');
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $AtencionPersona=$em->getRepository('ModeloBundle:Atencion')->findOneBy(array('codAtencion'=>$codAtencion));
        $Antecedentes = $em->getRepository('ModeloBundle:Antecedente')->Data_Lista_Antecedente($AtencionPersona->getpercodigo(),$tipo);//DATOS LISTA ANTECEDENTE PATOLOGICOS
        $result=true;
        if(!$Antecedentes){
            $result=false;
        }
        
        echo $this->renderView('RecepcionBundle:Doctor:data_antecedente.html.twig',['lstAntecedentes'=>$Antecedentes,'result'=>$result]);
        exit;
    }
    
    
    /**
     * @Route("/deleteantecedente", name="Antecedente_delete")
     * @Method("POST")
     */
    public function deleteAntecedentesAction(Request $request)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        $codAntecedente = $request->request->get('codantecedente');
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $Antecedentes = $em->getRepository('ModeloBundle:Antecedente')->find(array('codAntecedente'=>$codAntecedente));//DATOS ANTECEDENTE POR ID 
        if($Antecedentes){
          $em->remove($Antecedentes);
          $em->flush(); 
          $rpta=['result'=>true];
        }else{
          $rpta=['result'=>false];
        }
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }
    
    /**
     * @Route("/lstItemsCant", name="Antecedente_lista_items_count")
     * @Method("POST")
     */
    public function LstAnteItemsCountAction(Request $request)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        $codatencion = $request->request->get('codatencion');
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $AtencionPersona=$em->getRepository('ModeloBundle:Atencion')->findOneBy(array('codAtencion'=>$codatencion));
        $Items=$em->getRepository('ModeloBundle:Tantecedente')->Data_Items_cantidades($AtencionPersona->getpercodigo());
        $cantidad=[];
        foreach ($Items as $val) {
            $x=['item'.$val['cod']=>$val['cantidad']];
            array_push($cantidad, $x);
        }
        $rpta=['cantidad'=>$cantidad];
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }
    
    
    /**
     * @Route("/guardarAntecedente", name="Antecedente_guardar")
     * @Method("POST")
     */
    public function GuardarAntecedenteAction(Request $request)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        $session = new Session();//INICIAR SESSION
        $usuario= $session->get('usuario');
        
        $codAtencion = $request->request->get('codatencion');
        $descripcion = $request->request->get('descripcion');
        $tipo = $request->request->get('tipo');
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        
        $AtencionPersona=$em->getRepository('ModeloBundle:Atencion')->findOneBy(array('codAtencion'=>$codAtencion));
        $Antecedente=new Antecedente();
        $Antecedente->setCodper($AtencionPersona->getpercodigo());
        $Antecedente->setAntDescripcion($descripcion);
        $Antecedente->setAntEstado(1);
        $Antecedente->setAntFechaReg(new \DateTime);
        $Antecedente->setCodTantecedente($tipo);
        $Antecedente->setCodUser($usuario['codigo']);
        $em->persist($Antecedente);
        $em->flush();
        
        if(!$Antecedente->getCodAntecedente()){
            $rpta=['result'=>false];
        }else{
            $rpta=['result'=>true,'mensaje'=>'Ocurrio un problema al registrar la atencion favor de intentarlo nuevamente, si en caso el problema persiste comunicarse con la unidad de informatica para verificar la incidencia'];
        }
        
        $rpta=['result'=>true,'mensaje'=>'Se registro correctamente'];
        echo json_encode($rpta, JSON_PRETTY_PRINT);
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
