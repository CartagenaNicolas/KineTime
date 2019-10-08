<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EjercicioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', TextType::class, array(
            'label' => 'Nombre del ejercicio:'
        ))
        ->add('tipo', TextType::class, array(
            'label' => 'Tipo de ejercicio'
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