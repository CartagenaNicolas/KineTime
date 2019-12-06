<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EvaluacionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('evaluacion', RangeType::class, array(
            'label' => 'Escala E.V.A. para la evaluación del dolor: ',
            'attr' => [
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'list' => 'opciones'
            ]
        ))
        ->add('observacion', TextAreaType::class, array(
            'label' => 'Observación'
        ))
        ->add('submit', SubmitType::class, array(
            'label' => 'Enviar'
        ));
    }
}