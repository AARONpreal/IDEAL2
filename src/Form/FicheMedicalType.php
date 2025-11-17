<?php

namespace App\Form;

use App\Entity\FicheMedical;
use App\Entity\Employe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FicheMedicalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroDossier', TextType::class, [
                'disabled' => true,
                'required' => false
            ])
            ->add('nom')
            ->add('prenom')
            ->add('nomJeuneFille')
            ->add('nee')
            ->add('adresse', TextareaType::class, [
                'required' => false
            ])
            ->add('telephone')
            ->add('personneAContacter')
            ->add('profession')
            ->add('groupeSanguinRhesus', ChoiceType::class, [
                'choices' => [
                    '' => '',
                    'A+' => 'A+',
                    'A-' => 'A-',
                    'B+' => 'B+',
                    'B-' => 'B-',
                    'AB+' => 'AB+',
                    'AB-' => 'AB-',
                    'O+' => 'O+',
                    'O-' => 'O-',
                ],
                'required' => false
            ])
            ->add('allergie', TextareaType::class, [
                'required' => false
            ])
            ->add('antecedentsFamiliaux', TextareaType::class, [
                'required' => false
            ])
            ->add('antecedentsPersonnels', TextareaType::class, [
                'required' => false
            ])
            ->add('correspondantsMedicaux', TextareaType::class, [
                'required' => false
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('diagnostic', TextareaType::class, [
                'required' => false
            ])
            ->add('conduiteAvenir', TextareaType::class, [
                'required' => false
            ])
            ->add('employe', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionner un employé...'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FicheMedical::class,
        ]);
    }
}
