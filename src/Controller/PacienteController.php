<?php

namespace App\Controller;

use App\Entity\ZonaLesion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Paciente;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class PacienteController extends AbstractController
{

    /**
     * @IsGranted("ROLE_USER")
     */
    public function addPaciente()
    {
        return $this->render('paciente/agregarPaciente.html.twig');
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

        // Comprobar si el resultado es correcto

        return $this->render('paciente/listarPaciente.html.twig', [
            'pacientes' => $pacientes,
        ]);
    }
}
