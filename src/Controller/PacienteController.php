<?php

namespace App\Controller;

use App\Entity\Deportes;
use App\Entity\Ejercicio;
use App\Entity\TipoEjercicio;
use App\Entity\ZonaLesion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Paciente;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\PacienteType;
use App\Entity\AntecedenteClinico;

class PacienteController extends AbstractController
{

    public function login()
    {
        return $this->render('paciente/login.html.twig');
    }

    public function home()
    {
        // Cargar Repositorios
        $ejercicio_repositorio = $this->getDoctrine()->getRepository(Ejercicio::class);

        // Consulta
        $ejercicios = $ejercicio_repositorio->findAll();

        return $this->render('paciente/home.html.twig', [
            'ejercicios' => $ejercicios
        ]);
    }

    public function visualizacionEjercicio()
    {
        return $this->render('paciente/visualizacion.html.twig');
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function addPaciente(Request $request)
    {
        $paciente = new Paciente();
        $form = $this->createForm(PacienteType::class, $paciente);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paciente);
            $em->flush();

            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('paciente/agregarPaciente.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function listPacientes()
    {
        // Cargar repositorio
        $paciente_repo = $this->getDoctrine()->getRepository(Paciente::class);
        $antecedente_repo = $this->getDoctrine()->getRepository(AntecedenteClinico::class);
        $zona_repo = $this->getDoctrine()->getRepository(ZonaLesion::class);

        // Consulta
        $pacientes = $paciente_repo->findAll();
        $antecedentes = $antecedente_repo->findAll();
        $zonas = $zona_repo->findAll();

        return $this->render('paciente/listarPaciente.html.twig', [
            'pacientes' => $pacientes,
            'antecedentes' => $antecedentes,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function dataPaciente($paciente)
    {
        // Cargar repositorio
        $paciente_repo = $this->getDoctrine()->getRepository(Paciente::class);

        // Consulta
        $datos_paciente = $paciente_repo->find($paciente);

        return $this->render('paciente/datosPaciente.html.twig', [
            'paciente' => $datos_paciente
        ]);
    }

    public function planificacionPaciente($paciente)
    {
        // Carga repositorio
        $ejercicios_repo = $this->getDoctrine()->getRepository(Ejercicio::class);
        $paciente_repo = $this->getDoctrine()->getRepository(Paciente::class);
        $tipoEjercicio_repo = $this->getDoctrine()->getRepository(TipoEjercicio::class);

        // Consulta
        $ejercicios = $ejercicios_repo->findAll();
        $datosPaciente = $paciente_repo->find($paciente);
        $tipoEjercicio = $tipoEjercicio_repo->findAll();

        return $this->render('paciente/planificacionPaciente.html.twig', [
            'paciente' => $datosPaciente,
            'ejercicios' => $ejercicios
        ]);
    }

    public function registrarEjercicio(Request $request)
    {
        // Obtencion del nombre del ejercicio enviado por AJAX
        $texto = $request->get('nombre');
        $paciente = $request->get('paciente');

        // Carga de repositorio
        $ejercicio_repo = $this->getDoctrine()->getRepository(Ejercicio::class);

        $ejercicio = $ejercicio_repo->findBy(['nombre' => $texto]);
        $id = $ejercicio;

        if(!$ejercicio) {
            $mensaje = "Ejercicio no encontrado";
        } else {
            $mensaje = "Ejercicio Encontrado ";

        }

        return new Response(var_dump($paciente). "\n " . var_dump($ejercicio) );
    }
}
