<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\ZonaLesion;


class AntecedentesClinicosType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('morbilidad', TextareaType::class, array(
      'label' => 'Morbilidad'
    ))
    ->add('medico', TextType::class, array(
      'label' => 'Medico tratante'
    ))
    ->add('zona', EntityType::class, array(
      'label' => 'Zona de la lesion',
      'class' => ZonaLesion::class,
      'choice_label' => 'nombre'
    ))
    ->add('operacion', ChoiceType::class, array(
      'label' => 'Operacion',
      'choices' => array(
          'Si' => 'Si',
          'No' => 'No'
      )
    ))
    ->add('factoresRiesgo', TextType::class, array(
      'label' => 'Factores de Riesgo'
    ))
    ->add('cuandoEpisodio', DateType::class, array(
      'label' => 'Cuando Sucedio',
      'widget' => 'single_text',
      'format' => 'yyyy-MM-dd',
      'input' => 'string'
    ))
    ->add('submit', SubmitType::class, array(
      'label' => 'Guardar'
    ));
  }
}
