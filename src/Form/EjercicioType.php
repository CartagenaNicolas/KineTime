<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\TipoEjercicio;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EjercicioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', TextType::class, array(
            'label' => 'Nombre del ejercicio:'
        ))
        ->add('tipoEjercicio', EntityType::class, array(
            'label' => 'Tipo de ejercicio',
            'class' => TipoEjercicio::class,
            'choice_label' => 'descripcion'
        ))
        ->add('objetivo', TextareaType::class, array(
            'label' => 'Objetivo del ejercicio'
        ))
        ->add('video', FileType::class, array(
            'label' => 'Video del ejercicio'
        ))
        ->add('submit', SubmitType::class, array(
            'label' => 'Registrar'
        ));
    }
}