<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\PasswordType;
use Symfony\Component\Form\Extension\Core\SubmitType;

class RegisterType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('rut', TextType::class, array(
            'label' => 'Rut'
        ))
        ->add('nombre', TextType::class, array(
            'label' => 'Nombre'
        ))
        ->add('password', PasswordType::class, array(
            'label' => 'Contraseña'
        ))
        ->add('especialidad', TextType::class, array(
            'label' => 'Especialidad'
        ))
        ->add('certificaciones', TextType::class, array(
            'label' => 'Certificaciones'
        ))
        ->add('anos_experiencia', TextType::class, array(
            'label' => 'Años Experiencia'
        ))
        ->add('metas', TextType::class, array(
            'label' => 'Metas'
        ))
        ->add('role', TextType::class, array(
            'label' => 'Tipo Usuario'
        )
        ->add('submit', SubmitType::class, array(
            'label' => 'Registrar'
        )));
    }
}