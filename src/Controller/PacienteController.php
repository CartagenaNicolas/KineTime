<?php

namespace App\Controller;

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
        return $this->render('paciente/listarPaciente.html.twig', [
            'nombre_paciente' => 'Manuel Rodriguez',
            'edad' => '25',
            'diagnostico' => 'Fractura del cúbito',
        ]);
    }
}
