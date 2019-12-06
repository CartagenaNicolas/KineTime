<?php

namespace App\Controller;

use App\Entity\Deportes;
use App\Entity\Ejercicio;
use App\Entity\Kinesiologo;
use App\Entity\PacienteHasKinesiologo;
use App\Entity\TipoEjercicio;
use App\Entity\ZonaLesion;
use App\Entity\PacientesHasRutinas;
use App\Entity\Rutina;
use App\Entity\Volumen;
use App\Entity\RutinasHasEjercicios;
use App\Entity\EvaluacionRutina;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Paciente;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\PacienteType;
use App\Form\PacienteEditType;
use App\Form\ComentarioType;
use App\Entity\AntecedentesClinicos;
use App\Form\AntecedentesClinicosType;
use App\Form\EvaluacionType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PacienteController extends AbstractController
{

    /**
     * @IsGranted("ROLE_USER")
     */
    public function home()
    {
        $user = $this->getUser();

        // Cargar Repositorios
        $ejercicio_repositorio = $this->getDoctrine()->getRepository(Ejercicio::class);
        $pacienteRutina_repo = $this->getDoctrine()->getRepository(PacientesHasRutinas::class);
        $rutina_repo = $this->getDoctrine()->getRepository(Rutina::class);
        $rutinaEjercicio_repo = $this->getDoctrine()->getRepository(RutinasHasEjercicios::class);

        // Consulta
        $ejercicios = $ejercicio_repositorio->findAll();
        $pacienteRutina = $pacienteRutina_repo->findOneBy(['paciente' => $user->getId()]);
        $rutina = $rutina_repo->findOneBy(['id' => $pacienteRutina->getRutina()]);
        $rutinaEjercicio = $rutinaEjercicio_repo->findBy(['rutina' => $rutina->getId()]);


        return $this->render('paciente/home.html.twig', [
            'ejercicios' => $ejercicios,
            'usuario' => $user,
            'rutinas' => $rutinaEjercicio,
            'id_rutina' => $rutina
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
       $antecedente = new AntecedentesClinicos();
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
        $ejercicio = $ejercicio_repo->findOneBy(['nombre' => $texto]);
        $pacienteRutina = $pacienteRutina_repo->findOneBy(['paciente' => $pacienteId]);
        $rutina = $rutina_repo->findAll();
        $volumen = $volumen_repo->findOneBy(['id' => 1]);
        
        // Clases
        $rutinaI = new Rutina();
        $pacienteHasRutina = new PacientesHasRutinas();
        $rutinaHasEjercicio = new RutinasHasEjercicios();
        
        if(empty($pacienteRutina)) {
            $rutinaI->setVolumen($volumen);
            $em = $this->getDoctrine()->getManager();
            $em->persist($rutinaI);
            $em->flush();
            $pacienteHasRutina->setRutina($rutinaI);
            $pacienteHasRutina->setPaciente($paciente);
            $em->persist($pacienteHasRutina);
            $em->flush();
        }

        $rutinaI = $pacienteRutina->getRutina();
        if(!$ejercicio) {
            $mensaje = "Ejercicio no encontrado";
        } else {
            $rutinaHasEjercicio->setEjercicio($ejercicio);
            $rutinaHasEjercicio->setRutina($pacienteRutina->getRutina());
            $em = $this->getDoctrine()->getManager();
            $em->persist($rutinaHasEjercicio);
            $em->flush();
            $mensaje = "Registro realizado con exito";
        }

        return new Response(var_dump($mensaje));
    }

    public function verEjercicio($ejercicio) {

        $ejercicio_repo = $this->getDoctrine()->getRepository(Ejercicio::class);
        $ejercicio = $ejercicio_repo->findOneBy(['id' => $ejercicio]);

        return $this->render('paciente/vistaEjercicio.html.twig', [
            'ejercicio' => $ejercicio
        ]);
    }

    public function comenzarRutina($rutina, $ejercicio)
    {
        $rutinaEjercicio_repo = $this->getDoctrine()->getRepository(RutinasHasEjercicios::class);
        $rutina_repo = $this->getDoctrine()->getRepository(Rutina::class);
        $ejercicio_repo = $this->getDoctrine()->getRepository(Ejercicio::class);

        $rutinaEjercicio = $rutinaEjercicio_repo->findBy(['rutina' => $rutina]);
        $rutina = $rutina_repo->findAll();
        $ejercicio_rutina = $ejercicio_repo->findAll();
        $user = $this->getUser();
        $paciente = $user->getId();

        return $this->render('paciente/rutina.html.twig', [
            'rutina' => $rutinaEjercicio,
            'ejercicios' => $ejercicio,
            'paciente' => $paciente
        ]);
    }

    public function evaluarEjercicio(Paciente $paciente,  Rutina $rutina, Ejercicio $ejercicio, Request $request)
    {
        $evaluacion = new EvaluacionRutina();
        
        $rutinaEjercicioE;

        $rutina_repo = $this->getDoctrine()->getRepository(Rutina::class);
        $rutinaEjercicio_repo = $this->getDoctrine()->getRepository(RutinasHasEjercicios::class);
        $ejercicio_repo = $this->getDoctrine()->getRepository(Ejercicio::class);
        $paciente_repo = $this->getDoctrine()->getRepository(Paciente::class);

        $rutina_bd = $rutina_repo->findAll();
        $rutinaEjercicio = $rutinaEjercicio_repo->findBy(['rutina' => $rutina]);
        $ejercicioEvaluar = $ejercicio_repo->findBy(['id' => $ejercicio]);
        $pacienteEvaluar = $paciente_repo->findOneBy(['id' => $paciente]);

        $form = $this->createForm(EvaluacionType::class, $evaluacion);

        $form->handleRequest($request);

        $contador = 0;

        $siguiente = 0;

        foreach($rutinaEjercicio as $rutinaEjercicios)
        {
            $contador++;

            if($ejercicio->getId() == $rutinaEjercicios->getEjercicio()->getId())
            {
                $rutinaEjercicioE = $rutinaEjercicios;
                if(isset($rutinaEjercicio[$contador++]))
                {
                    $siguiente = $rutinaEjercicio[$contador++]->getEjercicio()->getId();
                }
                else {
                    $siguiente = 0;
                }
            }
        }

        if($form->isSubmitted() && $form->isValid())
        {
            $evaluacion->setFecha(new \DateTime('@'.strtotime('now')));
            $evaluacion->setRutinaEjercicio($rutinaEjercicioE);
            $em = $this->getDoctrine()->getManager();
            $em->persist($evaluacion);
            $em->flush();
            if($siguiente != 0)
            {
                return $this->redirect($this->generateUrl('comenzarRutina', array(
                    'rutina' => $rutina->getId(),
                    'ejercicio' => $siguiente
                ))); 
            }
            else {
                return $this->redirect($this->generateUrl('homePaciente'));
            }
            
        }

        return $this->render('paciente/evaluacionEjercicio.html.twig', [
            'ejercicio' => $ejercicioEvaluar,
            'paciente' => $pacienteEvaluar,
            'rutina' => $evaluacion,
            'form' => $form->createView()
        ]);
    }

    public function historialKinesiologo($paciente)
    {
        // Cargar repositorios
        $pacienteKine_repo = $this->getDoctrine()->getRepository(PacienteHasKinesiologo::class);
        $kinesiologo_repo = $this->getDoctrine()->getRepository(Kinesiologo::class);

        // Consulta
        $pacienteKine = $pacienteKine_repo->findBy(['paciente' => $paciente]);
        $kinesiologo = $kinesiologo_repo->findAll();

        return $this->render('paciente/historialKinesiologos.html.twig',[
            'historial' => $pacienteKine
        ]);
    }

    public function dejarComentario(Kinesiologo $kinesiologo, Request $request)
    {
        $user = $this->getUser();

        $pacienteKine_repo = $this->getDoctrine()->getRepository(PacienteHasKinesiologo::class);
        $pacienteKine = $pacienteKine_repo->findOneBy([
            'kinesiologo' => $kinesiologo,
            'paciente' => $user->getId()
        ]);

        $form = $this->createForm(ComentarioType::class, $pacienteKine);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pacienteKine);
            $em->flush();
        }

        return $this->render('paciente/comentario.html.twig', [
            'form' => $form->createView(),
            'kine' => $pacienteKine
        ]);
    }

}
