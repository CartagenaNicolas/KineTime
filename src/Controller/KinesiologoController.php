<?php

namespace App\Controller;

use App\Entity\Paciente;
use App\Entity\PacienteHasKinesiologo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Kinesiologo;
use App\Form\KinesiologoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class KinesiologoController extends AbstractController
{

    public function inicioApp()
    {
        return $this->render('kinesiologo/index.html.twig');
    }

    public function login(AuthenticationUtils $authenticationUtils) {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUSername();
        
        return $this->render('kinesiologo/login.html.twig', array(
            'error' => $error,
            'last_username' => $lastUsername
        ));
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function home()
    {
        // Cargar Repositorio
        $paciente_repo = $this->getDoctrine()->getRepository(Paciente::class);

        // Consulta
        $pacientes = $paciente_repo->findAll();
        return $this->render('kinesiologo/home.html.twig', [
            'nombre_kinesiologo' => 'Admin',
            'Pacientes' => $pacientes,
            'zona_lesion' => 'Antebrazo Derecho',
            'farmacos' => 'Duloxetina, Pregabalina',
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */    
    public function addKinesiologo(Request $request)
    {
        $kinesiologo = new Kinesiologo();
        $form = $this->createForm(KinesiologoType::class, $kinesiologo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kinesiologo);
            $em->flush();

            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('kinesiologo/agregarKinesiologo.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function listKinesiologos()
    {
        // Cargar Repositorio
        $kine_repo = $this->getDoctrine()->getRepository(Kinesiologo::class);

        // Consulta
        $kinesiologos = $kine_repo->findAll();

        return $this->render('kinesiologo/listarKinesiologos.html.twig', [
            'nombre_kinesiologo' => 'Alejandro Casas',
            'especialidad' => 'Traumatología',
            'kinesiologos' => $kinesiologos,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function detailFile()
    {
        return $this->render('kinesiologo/detallesFicha.html.twig');
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function chat()
    {
        return $this->render('kinesiologo/chat.html.twig');
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function historialPaciente()
    {
        $usuario = $this->getUser();

        $pacienteKine_repo = $this->getDoctrine()->getRepository(PacienteHasKinesiologo::class);
        $paciente_repo = $this->getDoctrine()->getRepository(Paciente::class);

        $paciente = $paciente_repo->findAll();
        $PK = $pacienteKine_repo->findBy(['kinesiologo' => $usuario]);

        return $this->render('kinesiologo/historialPaciente.html.twig', [
            'historial' => $PK
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function calificacion(Paciente $paciente)
    {
        $usuario = $this->getUser();

        $pacienteKine_repo = $this->getDoctrine()->getRepository(PacienteHasKinesiologo::class);
        $PK = $pacienteKine_repo->findOneBy([
            'kinesiologo' => $usuario->getId(),
            'paciente' => $paciente->getId()
        ]);
        $historial = $pacienteKine_repo->findBy(['paciente' => $paciente->getId()]);

        return $this->render('kinesiologo/calificacion.html.twig', [
            'paciente' => $paciente,
            'datos' => $PK,
            'historial' => $historial
        ]);
    }
    
}
