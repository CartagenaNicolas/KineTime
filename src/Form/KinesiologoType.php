<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Choice;

class KinesiologoType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('rut', TextType::class, array(
            'label' => 'Rut'
        ))
        ->add('nombre', TextType::class, array(
                'label' => 'Nombre'
        ))
        ->add('especialidad', ChoiceType::class, array(
            'label' => 'Especialidad',
            'choices' => array(
                'Traumatologia y Ortopedia' => 'Traumatologia y Ortopedia',
                'Geriatria y Gerontologia' => 'Geriatria y Gerontologia',
                'Respiratorio' => 'Respiratorio',
                'Intensiva' => 'Intensiva',
                'Cardiologia y Cirugia Cardiovascular' => 'Cardiologia y Cirugia Cardiovascular',
                'Quemados y Cirugia Reconstructiva' => 'Quemados y Cirugia Reconstructiva',
                'Pelviperineal' => 'Pelviperineal',
                'Del Deporte' => 'Del Deporte'
            )
        ))
        ->add('certificaciones', NumberType::class, array(
            'label' => 'Certificaciones'
        ))
        ->add('anos_experiencia', NumberType::class, array(
            'label' => 'Años Experiencia'
        ))
        ->add('Metas', TextareaType::class, array(
            'label' => 'Metas'
        ))
        ->add('submit', SubmitType::class, array(
            'label' => 'Registrar'
        ));
    }
}