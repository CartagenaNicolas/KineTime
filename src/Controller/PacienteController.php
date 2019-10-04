<?php

namespace App\Controller;

use App\Entity\Deportes;
use App\Entity\ZonaLesion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Paciente;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\PacienteType;

class PacienteController extends AbstractController
{

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
        $zona_repo = $this->getDoctrine()->getRepository(ZonaLesion::class);

        // Consulta
        $pacientes = $paciente_repo->findAll();
        $zonas = $zona_repo->findAll();

        return $this->render('paciente/listarPaciente.html.twig', [
            'pacientes' => $pacientes,
        ]);
    }
}
