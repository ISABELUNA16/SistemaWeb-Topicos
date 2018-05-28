<?php

namespace AccesoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Component\Security\Authentication\authenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class AccesoController extends Controller {
    
    /**
     * @Route("/login", name="acceso_login")
     */
    public function LoginAction(Request $request) {
        
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
      
        return $this->render(
            'AccesoBundle:Login:login.html.twig', array(
                'last_username' => $lastUsername,
                'error' => $error,
            ));
       
    }


    /**
     * @Route("/panel", name="panel_principal")
     */
    public function panelAction()
    {    
        return $this->render('RecepcionBundle:Principal:panelPrincipal.html.twig');
     
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
