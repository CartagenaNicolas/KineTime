<?php

namespace App\Controller;

use App\Entity\Ejercicio;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TipoEjercicio;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\EjercicioType;
use App\Form\EjercicioEditType;

class EjercicioController extends AbstractController
{

    public function index()
    {
        return $this->render('ejercicio/index.html.twig', [
            'controller_name' => 'EjercicioController',
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public  function addEjercicio(Request $request)
    {
        //Para definir el tamaño maximo de los archivos modificar el archivo php.ini
        $ejercicio = new Ejercicio();

        $form = $this->createForm(EjercicioType::class, $ejercicio);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $video = $ejercicio->getVideo();

            $upload_directory = $this->getParameter('uploads_directory');

            $filename =  md5(uniqid()) . '.' . $video->guessExtension();

            $video->move(
                $upload_directory,
                $filename
            );

            $ejercicio->setUrl("uploads/" . $filename);

            $em = $this->getDoctrine()->getManager();
            $em->persist($ejercicio);
            $em->flush();
            return $this->redirect($this->generateUrl('mantenedorEjercicios'));
        }

        return $this->render('ejercicio/agregarEjercicio.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function listarEjercicios()
    {

        // Cargar Repositorios
        $ejercicios_repo = $this->getDoctrine()->getRepository(Ejercicio::class);
        $tipoEjercicio_repo = $this->getDoctrine()->getRepository(TipoEjercicio::class);

        // Consulta
        $ejercicios = $ejercicios_repo->findAll();
        $tipoEjercicio = $tipoEjercicio_repo->findAll();

        return $this->render('ejercicio/listarEjercicios.html.twig', [
            'ejercicios' => $ejercicios
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Ejercicio $ejercicio)
    {
        $form = $this->createForm(EjercicioEditType::class, $ejercicio);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $em = $this->getDoctrine()->getManager();
            $em->persist($ejercicio);
            $em->flush();
            return $this->redirect($this->generateUrl('mantenedorEjercicios'));
        }
        return $this->render('ejercicio/agregarEjercicio.html.twig', [
            'edit' => true,
            'form' => $form->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function delete(Ejercicio $ejercicio)
    {
        $em = $this->getDoctrine()->getManager();
        unlink($ejercicio->getUrl());
        $em->remove($ejercicio);
        $em->flush();
        return $this->redirectToRoute('mantenedorEjercicios');
    }
}
