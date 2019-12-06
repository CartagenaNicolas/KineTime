<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Choice;

class PacienteType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('rut', TextType::class, array(
            'label' => 'Rut'
        ))
        ->add('correo', EmailType::class, array(
            'label' => 'Email'
        ))
        ->add('nombre', TextType::class, array(
            'label' => 'Nombre'
        ))
        ->add('edad', NumberType::class, array(
            'label' => 'Edad'
        ))
        ->add('direccion', TextType::class, array(
            'label' => 'Direccion'
        ))
        ->add('ocupacion', TextType::class, array(
            'label' => 'Ocupacion'
        ))
        ->add('fumador', ChoiceType::class, array(
            'label' => 'Fumador',
            'choices' => array(
                'Si' => 'Si',
                'No' => 'No'
            )
        ))
        ->add('bebedor', ChoiceType::class, array(
            'label' => 'Bebedor',
            'choices' => array(
                'Si' => 'Si',
                'No' => 'No'
            )
        ))
        ->add('submit', SubmitType::class, array(
            'label' => 'Registrar'
        ));
    }
}