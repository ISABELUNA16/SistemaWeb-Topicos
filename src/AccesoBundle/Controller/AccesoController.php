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
    public function panelAction(Request $request)
    {    
        
        $usuario_dni = $this->getUser()->getUsername();
        $em = $this->getDoctrine()->getManager();

        $nombresCAS = $em->getRepository('ModeloBundle:Usuario')->Data_usuario_by_dni_cas($usuario_dni);

        if(!empty($nombresCAS)){

            $session = $request->getSession();
            $session->set('nombres', $nombresCAS);
            $session->set('dni', $usuario_dni);

        }else{

            $nombresTercero = $em->getRepository('ModeloBundle:Usuario')->Data_usuario_by_dni_tercero($usuario_dni);
            $session = $request->getSession();
            $session->set('nombres', $nombresTercero);
            $session->set('dni', $usuario_dni);
        }
        return $this->render('RecepcionBundle:Principal:panelPrincipal.html.twig');
     
    }

}
