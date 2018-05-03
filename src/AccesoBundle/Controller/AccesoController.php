<?php

namespace AccesoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class AccesoController extends Controller {
    
    /**
     * @Route("/", name="acceso_redirec_login")
     */
    public function redirecAction() {
        
        return $this->redirectToRoute('acceso_login');
    }
    
    /**
     * @Route("/login", name="acceso_login")
     */
    public function LoginAction() {
        
        if($this->ValidarSession()){ //CONDICIONAL DE VERIFICACION DE SESSION
             return $this->redirectToRoute('recepcion_home');//REDIREC HOME
        }else{
             session_destroy();//DESTRUIR LAS SESSIONES
             return $this->render('AccesoBundle:Login:login.html.twig');
        }
       
    }

    /**
     * @Route("/validar ", name="acceso_validar")
     * @Method("POST")
     */
    public function ValidarAction(Request $request) {
        //PARAMETROS POST
        $user = $request->request->get('txtname');//INPUT NAME
        $pass = $request->request->get('txtpass');//INPUT CLAVE
        $md5_pass = md5($pass);//CODIFICADO A MD5
        //VERIFICAR SI INGRESO LO DATOS DE USUARIO Y CONTRASEÑA
        if (empty($user) || empty($pass)) {
            $this->addFlash('msj', 'Usuario y Clave son obligatorios');//MENSAJE FLASH
            return $this->redirectToRoute('Acceso_Login');//REDIREC AL LOGIN
        } else {
            $em = $this->getDoctrine()->getManager();
            
            $user = $em->getRepository('ModeloBundle:Usuario') //VERIFICAR CREDENCIALES
                       ->findOneBy(array('userName' => $user, 'userPasword' => $md5_pass));
            
            if (!empty($user)) {
                //SI ESTA REGISTRADO
                $em2 = $this->getDoctrine()->getManager('trabajador');
                $percod=$user->getPercodigo();//CODIGO PERSONA BD(ACTIVIDAD IPD) TABLA (GRPERSONA)
                $user_session = $em2->getRepository('ModeloBundle:Usuario')->Data_usuario_by_cod($percod);//DATOS PARA LA SESSION USUARIO
                $session = new Session();//INICIAR SESSION
                $session->set('usuario', $user_session);//GUARDAR SESSION
                
                if($user_session['codperf']===1){
                    return $this->redirectToRoute('recepcion_home');//REDIREC AL HOME
                }else{
                    return $this->redirectToRoute('doctor_home');//REDIREC AL HOME
                }
                
            } else {
                
                $this->addFlash('msj', 'Usuario y clave incorrectos');//MENSAJE FLASH
                return $this->redirectToRoute('acceso_login');//REDIC LOGIN
            }
        }
    }

    /**
     * @Route("/cerrar", name="acceso_cerrar")
     */
    public function cerrarSesionAction() {
        session_destroy();//DESTRUIR LAS SESSIONES
        return $this->redirectToRoute('acceso_login');
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
