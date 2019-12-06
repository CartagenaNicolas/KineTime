<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ComentarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('comentario', TextareaType::class, array(
            'label' => 'Comentario sobre el kinesiologo:'
        ))
        ->add('submit', SubmitType::class, array(
            'label' => 'Registrar'
        ));
    }
}