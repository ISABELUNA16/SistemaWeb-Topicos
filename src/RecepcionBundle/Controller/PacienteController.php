<?php

namespace RecepcionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use ModeloBundle\Entity\Paciente;

class PacienteController extends Controller {

    /**
     * @Route("/dataPersona", name="paciente_persona")
     * @Method("POST")
     */
    public function DataPersonaAction(Request $request) {
      
        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS ACTIVIDAD IPD
        $em2 = $this->getDoctrine()->getManager('trabajador'); //CONEXION A BASE DE DATOS ACTIVIDAD IPD
        $dni = $request->get('dni'); //PARAMETER POST 
       
        $DataPersona = $em2->getRepository('ModeloBundle:Persona')->Data_trabajador_by_Dni($dni); //DATOS DE LA TABLA TRABAJADOR
        $result = true;
        $tipo = 1;
        if (empty($DataPersona)) {
            $tipo = 2;
            $DataPersona = $em->getRepository('ModeloBundle:Paciente')->Data_persona_by_Dni($dni); //DATOS DE LA TABLA PACIENTE
            if (empty($DataPersona)) {
                $result = false;
            }
        }

        $viewDataPersona = $this->renderView('RecepcionBundle:Paciente:datapersona.html.twig', array('data' => $DataPersona, 'result' => $result, 'tipo' => $tipo));

        $rpta = ['data' => $viewDataPersona];
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * @Route("/datadatospersonales", name="paciente_datos_personales")
     * @Method("POST")
     */
    public function datadatosAction(Request $request) {
     
        $codper = $request->request->get('percodigo'); //INPUT CODIGO
        $tipo = $request->request->get('tipo'); //INPUT TIPO
        $dni = $request->request->get('dni'); //INPUT DNI

        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
        $em2 = $this->getDoctrine()->getManager('trabajador'); //CONEXION A BASE DE PRESUPUESTO
        $em3 = $this->getDoctrine()->getManager('actividad'); //CONEXION A BASE DE ACTIVIDAD IPD
        $lnacimiento = [];
        $lprocedencia = [];
     
        if ($tipo == 1) {
            $trabajador = true;
            $Paciente = $em2->getRepository('ModeloBundle:Persona')->data_trabajador($dni);
        } else {
            $trabajador = false;
            $Paciente = $em->getRepository('ModeloBundle:Paciente')->findOneBy(array('codPaciente' => $codper));
            if ($Paciente->getPacLugarNac()) {
                $lnacimiento = $em3->getRepository('ModeloBundle:Persona')->Data_lugar_nacimiento($Paciente->getPacLugarNac());
            }
            if ($Paciente->getPacLugarProc()) {
                $lprocedencia = $em3->getRepository('ModeloBundle:Persona')->Data_lugar_procedencia($Paciente->getPacLugarProc());
            }
        }

        $Seguro = $em->getRepository('ModeloBundle:Seguro')->findAll();
        $Condicion = $em->getRepository('ModeloBundle:Condicion')->findAll();
        $Departamento = $em3->getRepository('ModeloBundle:Persona')->Data_Departamento();
        $Datos = $this->renderView('RecepcionBundle:Recepcion:data_datos.html.twig', ['data' => $trabajador,
            'datos' => $Paciente,
            'seguro' => $Seguro,
            'condicion' => $Condicion,
            'departamento' => $Departamento,
            'lnacimiento'=>$lnacimiento,
            'lprocedencia'=>$lprocedencia
        ]); //VIEW DEL EXAMEN DE ANTROPOMETRIA

        $rpta = ['datos' => $Datos];
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * @Route("/dataprovincia", name="paciente_datos_provincia")
     * @Method("POST")
     */
    public function dataprovinciaAction(Request $request) {

        $dep = $request->request->get('dep'); //INPUT CODIGO DEPARTAMENTO
        $em = $this->getDoctrine()->getManager('trabajador'); //CONEXION A BASE ACTIVIDAD IPD
        $Provincia = $em->getRepository('ModeloBundle:Persona')->Data_Provincia($dep);

        $Datos = $this->renderView('RecepcionBundle:Recepcion:data_provincia.html.twig', ['provincia' => $Provincia]); //VIEW

        $rpta = ['datos' => $Datos];
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * @Route("/datadistrito", name="paciente_datos_distrito")
     * @Method("POST")
     */
    public function datadistritoAction(Request $request) {
      
        $prov = $request->request->get('prov'); //INPUT PROVINCIA
        $dep = $request->request->get('dep'); //INPUT DEPARTAMENTO

        $em3 = $this->getDoctrine()->getManager('trabajador'); //CONEXION A BASE ACTIVIDAD IPD
        $Distritos = $em3->getRepository('ModeloBundle:Persona')->Data_Distrito($prov, $dep);
        $Datos = $this->renderView('RecepcionBundle:Recepcion:data_distrito.html.twig', ['ditritos' => $Distritos]); //VIEW

        $rpta = ['datos' => $Datos];
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * @Route("/guardardatospaciente", name="paciente_guardar_datos")
     * @Method("POST")
     */
    public function guardardatospacienteAction(Request $request) {
      
        $em = $this->getDoctrine()->getManager(); //CONEXION A BASE DE DATOS TOPICO
      
        $PacienteData = $em->getRepository('ModeloBundle:Paciente')->findOneBy(array('pacDni' => $request->request->get('txtdni')));
      
        if (!$PacienteData) {
            $Paciente = new Paciente();
            $Paciente->setPacDni($request->request->get('txtdni'));
            $Paciente->setPacGenero($request->request->get('cbogenero'));
            $Paciente->setPacNacimiento(new \DateTime($request->request->get('txtfecha')));
            $Paciente->setPacSede($request->request->get('cbosede'));
            $Paciente->setCodCondicion($request->request->get('cbocondicion'));
            $Paciente->setPacAreaTrabajo($request->request->get('cboarea'));
            $Paciente->setCodSeguro($request->request->get('cboseguro'));
            $Paciente->setPacLugarNac($request->request->get('cbodistrito1'));
            $Paciente->setPacLugarProc($request->request->get('cbodistrito2'));
            $Paciente->setPacProfession($request->request->get('txtprofesion'));
            $Paciente->setPacTelefono($request->request->get('txttelefono'));
            $Paciente->setPacDireccion($request->request->get('txtdireccion'));
            $Paciente->setPacServicio($request->request->get('txtiempo'));
            $Paciente->setPacTipoPlaso($request->request->get('cboplazo'));
            $Paciente->setPacEstadoCivil($request->request->get('cbocivil'));
            $Paciente->setPacNumHijoVivos($request->request->get('txthijovivos'));
            $Paciente->setPacNumHijoFallecidos($request->request->get('txthijofallecido'));
            $em->persist($Paciente);
        } else {
            $PacienteData->setPacDni($request->request->get('txtdni'));
            $PacienteData->setPacGenero($request->request->get('cbogenero'));
            $PacienteData->setPacNacimiento(new \DateTime($request->request->get('txtfecha')));
            $PacienteData->setPacSede($request->request->get('cbosede'));
            $PacienteData->setCodCondicion($request->request->get('cbocondicion'));
            $PacienteData->setPacAreaTrabajo($request->request->get('cboarea'));
            $PacienteData->setCodSeguro($request->request->get('cboseguro'));
            $PacienteData->setPacLugarNac($request->request->get('cbodistrito1'));
            $PacienteData->setPacLugarProc($request->request->get('cbodistrito2'));
            $PacienteData->setPacProfession($request->request->get('txtprofesion'));
            $PacienteData->setPacTelefono($request->request->get('txttelefono'));
            $PacienteData->setPacDireccion($request->request->get('txtdireccion'));
            $PacienteData->setPacServicio($request->request->get('txtiempo'));
            $PacienteData->setPacTipoPlaso($request->request->get('cboplazo'));
            $PacienteData->setPacEstadoCivil($request->request->get('cbocivil'));
            $PacienteData->setPacNumHijoVivos($request->request->get('txthijovivos'));
            $PacienteData->setPacNumHijoFallecidos($request->request->get('txthijofallecido'));
        }
        $em->flush();

        $rpta = ['mensaje' => 'Se Actualizo la informacion del paciente correctamente'];
        echo json_encode($rpta, JSON_PRETTY_PRINT);
        exit;
    }

}
