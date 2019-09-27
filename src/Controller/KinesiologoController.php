<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Kinesiologo;
use App\Form\RegisterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class KinesiologoController extends AbstractController
{
    

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
        return $this->render('kinesiologo/home.html.twig', [
            'nombre_kinesiologo' => 'Admin',
            'nombre_paciente' => 'Mario Verdejo',
            'edad_paciente' => '22',
            'zona_lesion' => 'Antebrazo Derecho',
            'farmacos' => 'Duloxetina, Pregabalina',
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */    
    public function addKinesiologo()
    {
        return $this->render('kinesiologo/agregarKinesiologo.html.twig');
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
    public  function addEjercicio()
    {
        return $this->render('kinesiologo/agregarEjercicio.html.twig');
    }
}
