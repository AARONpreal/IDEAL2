<?php

namespace App\Form;

use App\Entity\VisiteMedical;
use App\Entity\Employe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class VisiteMedicalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateVisite', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('prochaineVisite', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('resultats', TextareaType::class, [
                'required' => false
            ])
            ->add('aptitude', CheckboxType::class, [
                'required' => false
            ])
            ->add('employe', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VisiteMedical::class,
        ]);
    }
}
