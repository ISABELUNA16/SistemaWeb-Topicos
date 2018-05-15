<?php

namespace RecepcionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Atencion;
use ModeloBundle\Entity\Paciente;

class RecepcionController extends Controller
{
    /**
     * @Route("/recepcion", name="recepcion_home")
     */
    public function RecepcionHomeAction()
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        
        return $this->render('RecepcionBundle:Recepcion:recepcion.html.twig');
    }
    
    /**
     * @Route("/lstatencion", name="recepcion_lista_atencion")
     * @Method("POST")
     */
    public function LstAtencionesAction()
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }

        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $DataAtenciones = $em->getRepository('ModeloBundle:Atencion')->Data_Lista_Atenciones();//DATOS LISTA ATENCIONES MEDICAS
        echo $this->renderView('RecepcionBundle:Recepcion:data_atencion.html.twig',['listaAtenciones'=>$DataAtenciones]);
        exit;
    }
    
    /**
     * @Route("/evaluarAtencion", name="recepcion_validar_atencion")
     * @Method("POST")
     */
    public function EvaluarAtencionAction(Request $request)
    {
        if(!$this->ValidarSession()){
            return $this->redirectToRoute('acceso_login');
        }

        $dni = $request->request->get('dni');
        $fc = $this->getDoctrine()->getManager();
        $atencionRegistrada = $fc->getRepository('ModeloBundle:Atencion')->data_lista_atenciones_registradas($dni);
        $cantRegistros = intval($atencionRegistrada[0]['cantRegistro']);
        
        if($cantRegistros >= 1){
            $mensaje = ['mensaje'=>1];
        }else{
            $mensaje = ['mensaje'=>2];
        }

        echo json_encode($mensaje, JSON_PRETTY_PRINT) ;
        exit;
    }


    /**
     * @Route("/guardarAtencion", name="recepcion_new_atencion")
     * @Method("POST")
     */
    public function NuevoAtencioAction(Request $request)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }

        $session = new Session();
        $codper = $request->request->get('codper');//INPUT CODIGO DE LA PERSONA
        $tipo = $request->request->get('tipo');//INPUT CODIGO DE LA PERSONA
        $dni = $request->request->get('dni'); //DNI DEL PACIENTE
     //   $rpta = '';

        $usuario= $session->get('usuario');
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO

        $atencionRegistrada = $em->getRepository('ModeloBundle:Atencion')->data_lista_atenciones_registradas($dni);
        $cantRegistros = intval($atencionRegistrada[0]['cantRegistro']);

        if($cantRegistros >= 1){

            $rpta=['result'=> 'existe'];
            echo json_encode($rpta, JSON_PRETTY_PRINT);
            exit;

        }else{

            if(!empty($codper)){
                //si el trabajador es CAS

                $atencion = new Atencion();
                $atencion->setPercodigo($codper);
                $atencion->setCodUser($usuario['codigo']);
                $atencion->setAteFecReg(new \DateTime);
                $atencion->setAteTipoPer($tipo);
                $atencion->setCodEstado(1);
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($atencion);
                $em->flush();

                $rpta=['result'=>'registrado'];
            
            }else{

                //Si el trabajador es tercero o nuevo.
                $nombres = $request->request->get('nom');
                $paterno = $request->request->get('ap');
                $materno = $request->request->get('am');
                $dni= $request->request->get('dni');
                
                $paciente= new Paciente();
                $paciente->setPacNombre($nombres);
                $paciente->setPacApaterno($paterno);
                $paciente->setPacAmaterno($materno);
                $paciente->setPacDni($dni);
                $em = $this->getDoctrine()->getManager();
                $em->persist($paciente);
                $em->flush();
                
                $Percodigo=$paciente->getCodPaciente();
                
                $atencion= new Atencion();
                $atencion->setPercodigo($Percodigo);
                $atencion->setCodUser($usuario['codigo']);
                $atencion->setAteFecReg(new \DateTime);
                $atencion->setAteTipoPer(2);
                $atencion->setCodEstado(1);
                $em = $this->getDoctrine()->getManager();
                $em->persist($atencion);
                $em->flush();

                $rpta=['result'=>'registrado'];
            }


            if(empty($rpta)){
                $rpta=['result'=>'no registrado'];
                echo json_encode($rpta, JSON_PRETTY_PRINT);
                exit;

            }else{
                
                echo json_encode($rpta, JSON_PRETTY_PRINT);
                exit;    
            }
            
            
        } 
        
    }
    
    /**
     * @Route("/dataexamenclinico", name="recepcion_data_examen_clinico")
     * @Method("POST")
     */
    public function dataexamenclinicoAction(Request $request)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        $codatencion = $request->request->get('codatencion');//INPUT CODIGO DE LA ATENCION
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $Examen = $em->getRepository('ModeloBundle:Atencion')->findOneBy(array('codAtencion' => $codatencion));//DATOS LISTA ATENCIONES MEDICAS
        $Antropometria= $this->renderView('RecepcionBundle:Recepcion:data_atropometria.html.twig',['LstAntropometria'=>$Examen,'codigo'=>$codatencion]);//VIEW DEL EXAMEN DE ANTROPOMETRIA
        $Signos= $this->renderView('RecepcionBundle:Recepcion:data_signos.html.twig',['LstSignos'=>$Examen]);//VIEW DE SIGNOS VITALES
        
        $rpta=['antropometria'=>$Antropometria,'signos'=>$Signos];
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }
    
    
    /**
     * @Route("/guardarAtroponetria", name="recepcion_guardar_antropometria")
     * @Method("POST")
     */
    public function guardaratropometriaAction(Request $request)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }

        $codigo =$request->request->get('codigo');//IMPUT CODIGO
        
        $peso = $request->request->get('peso');//INPUT PESO
        $talla = $request->request->get('talla');//INPUT TALLA
        $pabdominal = $request->request->get('pabdominal');//INPUT PERIMETRO ABDOMINAL
        
        $IMC=$peso/(($talla/100)*($talla/100));
        
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $atencion=$em->getRepository('ModeloBundle:Atencion')->findOneBy(array('codAtencion' => $codigo));

        $atencion->setAtePeso($peso);
        $atencion->setAteTalla($talla);
        $atencion->setAteIndiceMasa($IMC);
        $atencion->setAtePerAbdominal($pabdominal);
       
        switch ($IMC) {
            case ($IMC<18):
                $enutricional='Peso Bajo';
                break;
            case ($IMC>18 &&  $IMC<24.9):
                $enutricional='Peso Normal';
                break;
            case ($IMC>25 &&  $IMC<26.9):
                $enutricional='Sobrepeso';
                break;
            case ($IMC>27 &&  $IMC<29.9):
                $enutricional='Obesidad grado I';
                break;
            case ($IMC>30 &&  $IMC<29.9):
                $enutricional='Obesidad grado II';
                break;
            case ($IMC>40):
                $enutricional='Obesidad grado III Extrema o Mórbida';
                break;
        }
        
        $atencion->setAteEstNutricional($enutricional);
        $atencion->setAteValAtropometria(1);
        if($atencion->getAteValSignos()==1){
            $atencion->setCodEstado(2);
        }    
        $em->flush();
        $rpta=['result'=>true,'mensaje'=>'Se registró correctamente el examen Antropométrico. '];
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }
    
    
    /**
     * @Route("/guardarSignos", name="recepcion_guardar_signos")
     * @Method("POST")
     */
    public function guardarsignostriaAction(Request $request)
    {   
        if(!$this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
            return $this->redirectToRoute('acceso_login');//REDIREC LOGIN
        }
        $codigo =$request->request->get('codigo');//IMPUT CODIGO
        $cardiaca = $request->request->get('cardiaca');//INPUT CARDIACA
        $respiratoria = $request->request->get('respiratoria');//INPUT RESPIRATORIA
        $arterial = $request->request->get('arterial');//INPUT ARTERIAL
        $temperatura = $request->request->get('temperatura');//INPUT TEMPERATURA
        
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $atencion=$em->getRepository('ModeloBundle:Atencion')->findOneBy(array('codAtencion' => $codigo));
        $atencion->setAteFreCardiaca($cardiaca);
        $atencion->setAteFreRespiratoria($respiratoria);
        $atencion->setAteFreArterial($arterial);
        $atencion->setAteTemperatura($temperatura);
        $atencion->setAteValSignos(1);
        if($atencion->getAteValAtropometria()==1){
            $atencion->setCodEstado(2);
        }
        $em->flush();
        
        $rpta=['result'=>true,'mensaje'=>'Se registró correctamente el examen Antropométrico'];
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
