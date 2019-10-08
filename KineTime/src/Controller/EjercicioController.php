<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TipoEjercicio;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\EjercicioType;

class EjercicioController extends AbstractController
{
    
    public function index()
    {
        return $this->render('ejercicio/index.html.twig', [
            'controller_name' => 'EjercicioController',
        ]);
    }

    public  function addEjercicio(Request $request)
    {
        //Para definir el tamaño maximo de los archivos modificar el archivo php.ini
        $tipoEjercicio = new TipoEjercicio();

        $form = $this->createForm(EjercicioType::class, $tipoEjercicio);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $video = $tipoEjercicio->getVideo();
            
            $upload_directory = $this->getParameter('uploads_directory');

            $filename =  md5(uniqid()) . '.' . $video->guessExtension();

            $video->move(
                $upload_directory,
                $filename
            );

            $tipoEjercicio->setUrl("uploads/" . $filename);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoEjercicio);
            $em->flush();
        }

        return $this->render('ejercicio/agregarEjercicio.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
