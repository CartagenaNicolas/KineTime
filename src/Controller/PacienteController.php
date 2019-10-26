<?php

namespace App\Controller;

use App\Entity\Deportes;
use App\Entity\Ejercicio;
use App\Entity\TipoEjercicio;
use App\Entity\ZonaLesion;
use App\Entity\PacientesHasRutinas;
use App\Entity\Rutina;
use App\Entity\Volumen;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Paciente;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\PacienteType;
use App\Form\PacienteEditType;
use App\Entity\AntecedentesClinicos;
use App\Form\AntecedentesClinicosType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PacienteController extends AbstractController
{

    public function login()
    {
        return $this->render('paciente/login.html.twig');
    }

    /**
     * @IsGranted("ROLE_USER")
     */
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

    /**
     * @IsGranted("ROLE_USER")
     */
    public function visualizacionEjercicio()
    {
        return $this->render('paciente/visualizacion.html.twig');
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function addPaciente(Request $request,UserPasswordEncoderInterface $encoder)
    {
        
        $paciente = new Paciente();
        $form = $this->createForm(PacienteType::class, $paciente);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $cadena_base .= '0123456789' ;
            
            $password = '';
            $limite = strlen($cadena_base) - 1;
            
            for ($i=0; $i < 10; $i++){
                $password .= $cadena_base[rand(0, $limite)];
            }
            $encoded = $encoder->encodePassword($paciente, $password);
            $paciente->setPassword($encoded);
            $paciente->setEstado(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($paciente);
            $em->flush();
            
            $pacienteId = $paciente->getId();
            return $this->redirect($this->generateUrl('agregarAntecedentesClinicos', array('pacienteId' => $pacienteId)));
        }

        return $this->render('paciente/agregarPaciente.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */
     public function addAntecedentesClinicos($pacienteId, Request $request)
     {
       $antecedente = new AntecedentesClinicos;
       $form = $this->createForm(AntecedentesClinicosType::class, $antecedente);
       
       $form->handleRequest($request);
       
       if($form->isSubmitted() && $form->isValid())
       {
           $paciente_repo = $this->getDoctrine()->getRepository(Paciente::class);
           $paciente = $paciente_repo->find($pacienteId);
           $antecedente->setPaciente($paciente);
           $em = $this->getDoctrine()->getManager();
           $em->persist($antecedente);
           $em->flush();
           return $this->redirect($this->generateUrl('datosPaciente', array('paciente' => $pacienteId)));           
       }
       return $this->render('paciente/agregarAntecedentesClinicos.twig', [
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
        $antecedente_repo = $this->getDoctrine()->getRepository(AntecedentesClinicos::class);
        $zona_repo = $this->getDoctrine()->getRepository(ZonaLesion::class);

        // Consulta
        $pacientes = $paciente_repo->findBy(['estado' => true]);
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
        $antecedentes_repo = $this->getDoctrine()->getRepository(AntecedentesClinicos::class);
        $zona_repo = $this->getDoctrine()->getRepository(ZonaLesion::class);
        
        // Consulta
        $datos_paciente = $paciente_repo->find($paciente);
        $antecedente_paciente = $antecedentes_repo->findOneBy(['paciente' => $paciente]);
        $zona = $zona_repo->findAll();

        if($antecedente_paciente == null) {
            var_dump($paciente);
            $pacienteId = $paciente;
            return $this->redirect($this->generateUrl('agregarAntecedentesClinicos', array('pacienteId' => $pacienteId)));
        }
        return $this->render('paciente/datosPaciente.html.twig', [
            'paciente' => $datos_paciente,
            'antecedentes' => $antecedente_paciente
        ]);
    }
    
    /**
     * @IsGranted("ROLE_USER")
     */
    public function deletePaciente(Paciente $paciente)
    {
        $paciente->setEstado(false);
        $em = $this->getDoctrine()->getManager();
        $em->persist($paciente);
        $em->flush();
        return $this->redirectToRoute('listarPaciente');
    }
    
    /**
     * @IsGranted("ROLE_USER")
     */
    public function editPaciente(Request $request, Paciente $paciente)
    {
        var_dump($paciente);
        $form = $this->createForm(PacienteEditType::class, $paciente);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paciente);
            $em->flush();
            return $this->redirect($this->generateUrl('datosPaciente', array('paciente' => $paciente->getId()))); 
        }
        return $this->render('paciente/agregarPaciente.html.twig', [
            'edit' => true,
            'form' => $form->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */
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

    /**
     * @IsGranted("ROLE_USER")
     */
    public function registrarEjercicio(Request $request)
    {
        // Obtencion del nombre del ejercicio enviado por AJAX
        $texto = $request->get('nombre');
        $pacienteId = $request->get('paciente');

        // Carga de repositorio
        $paciente_repo = $this->getDoctrine()->getRepository(Paciente::class);
        $ejercicio_repo = $this->getDoctrine()->getRepository(Ejercicio::class);
        $pacienteRutina_repo = $this->getDoctrine()->getRepository(PacientesHasRutinas::class);
        $rutina_repo = $this->getDoctrine()->getRepository(Rutina::class);
        $volumen_repo = $this->getDoctrine()->getRepository(Volumen::class);
        
        // Consultas
        $paciente = $paciente_repo->findOneBy(['id' => $pacienteId]);
        $ejercicio = $ejercicio_repo->findBy(['nombre' => $texto]);
        $pacienteRutina = $pacienteRutina_repo->findBy(['paciente' => $pacienteId]);
        $rutina = $rutina_repo->findAll();
        $volumen = $volumen_repo->findOneBy(['id' => 1]);
        
        if($pacienteRutina) {
            $rutinaI = new Rutina();
            $rutinaI->setVolumen($volumen);
            $em = $this->getDoctrine()->getManager();
            $em->persist($rutinaI);
            $em->flush();
            $pacienteHasRutina = new PacientesHasRutinas();
            $pacienteHasRutina->setRutina($rutinaI);
            $pacienteHasRutina->setPaciente($paciente);
            $em->persist($pacienteHasRutina);
            $em->flush();
        }
        $id = $ejercicio;

        if(!$ejercicio) {
            $mensaje = "Ejercicio no encontrado";
        } else {
            $mensaje = "Ejercicio Encontrado ";

        }

        return new Response(var_dump($pacienteId));
    }
}
