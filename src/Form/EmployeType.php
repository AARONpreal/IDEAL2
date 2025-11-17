<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Departement;
use App\Entity\Service;
use App\Entity\Fonction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateEntree', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('matricule')
            ->add('numeroCnps')
            ->add('categorieContrat', ChoiceType::class, [
                'choices' => [
                    'CDI' => 'CDI',
                    'CDD' => 'CDD',
                    'STARGIAIRE'=> 'STAGIAIRE',
                ]
            ])
            ->add('situationMatrimoniale', ChoiceType::class, [
                'choices' => [
                    '' => '',
                    'Célibataire' => 'Célibataire',
                    'Marié(e)' => 'Marié(e)',
                    'Divorcé(e)' => 'Divorcé(e)',
                    'Veuf(ve)' => 'Veuf(ve)',
                ],
                'required' => false
            ])
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('age', IntegerType::class, [
                'required' => false
            ])
            ->add('genre', ChoiceType::class, [
                'choices' => [
                    '' => '',
                    'Masculin' => 'Masculin',
                    'Féminin' => 'Féminin',
                ],
                'required' => false
            ])
            ->add('groupeSanguin', ChoiceType::class, [
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
            ->add('contact')
            ->add('departement', EntityType::class, [
                'class' => Departement::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choisir un département...'
            ])
            ->add('service', EntityType::class, [
                'class' => Service::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choisir un service...',
                'required' => false
            ])
            ->add('fonction', EntityType::class, [
                'class' => Fonction::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choisir une fonction...'
            ])
        ;

        // Ajout d'un événement pour pré-remplir le service selon le département
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $employe = $event->getData();
            $form = $event->getForm();

            if (!$employe || null === $employe->getId()) {
                $form->add('service', EntityType::class, [
                    'class' => Service::class,
                    'choice_label' => 'nom',
                    'placeholder' => 'Choisir un service...',
                    'required' => false
                ]);
            }
        });

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();

            if (isset($data['departement'])) {
                $form->add('service', EntityType::class, [
                    'class' => Service::class,
                    'choice_label' => 'nom',
                    'placeholder' => 'Choisir un service...',
                    'required' => false,
                    'query_builder' => function ($er) use ($data) {
                        return $er->createQueryBuilder('s')
                            ->where('s.departement = :departement')
                            ->setParameter('departement', $data['departement']);
                    },
                ]);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
