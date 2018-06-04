<?php

namespace RecepcionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;


class HistorialController extends Controller
{
    
    /**
     * @Route("/viewhistorial", name="historial_view")
     * @Method("POST")
     */
    public function ViewHistorialAction(Request $request)
    {   
       
        $percodigo = $request->request->get('percodigo');
        $em = $this->getDoctrine()->getManager();//CONEXION A BASE DE DATOS TOPICO
        $Atenciones = $em->getRepository('ModeloBundle:Atencion')->findBy(array('percodigo'=>$percodigo,'codEstado'=>[5,4]),array('ateFecReg'=>'DESC'));
        echo $this->renderView('RecepcionBundle:Historial:view_historial.html.twig',['Atenciones'=>$Atenciones]);
        exit;
    }
    
    /**
     * @Route("/lstviewhistorial", name="historial_view_lista")
     * @Method("POST")
     */
    public function LstViewHistorialAction(Request $request)
    {   
        
        $codAtencion = $request->request->get('codatencion');
        
        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $Amedicamento= $em->getRepository('ModeloBundle:AtencionMedicamento')->Data_Lista_Amedicamento($codAtencion);
        $Adiagnostico = $em->getRepository('ModeloBundle:AtencionDiagnostico')->Data_Lista_Adiagnosticos($codAtencion);
        $Aprocedimiento = $em->getRepository('ModeloBundle:AtencionProcedimiento')->Data_Lista_Aprocedimiento($codAtencion);
        $Aanamnesis = $em->getRepository('ModeloBundle:AtencionAnamnesis')->Data_Lista_Aanamnesis($codAtencion);
       
        $resultM = true; 
        $resultD = true;
        $resultP = true;
        $resultA = true;
        
        if (!$Amedicamento)$resultM = false;
        if (!$Adiagnostico)$resultD = false;
        if (!$Aprocedimiento)$resultP = false;
        if (!$Aanamnesis)$resultA = false;

        echo $this->renderView('RecepcionBundle:Historial:data_historial.html.twig',
                                ['lstAmedicamento'=>$Amedicamento,'resultM'=>$resultM,
                                 'lstAdiagnostico' => $Adiagnostico, 'resultD' => $resultD,
                                 'lstAprocedimiento'=>$Aprocedimiento,'resultP'=>$resultP,
                                 'lstAanamnesis'=>$Aanamnesis, 'resultA'=>$resultA]);
        exit;
    }

}
