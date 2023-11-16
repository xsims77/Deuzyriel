<?php

namespace App\Form;


use App\Entity\Organization;
use App\Entity\PhysicalCustomers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class PhysicalFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('dateBirthday', BirthdayType::class)
            ->add('gender', ChoiceType::class, [
                'placeholder' => 'Choisissez dans la liste',
                'choices'   => [
                    'homme' => 'homme',
                    'femme' => 'femme',
                    'binaire' => 'binaire',
                    'autre'   => 'autre'
                ],
            ])
            ->add('email')
            ->add('address')
            ->add('zip')
            ->add('city')
            ->add('country')
            ->add('isNPAI', ChoiceType::class, [
                'placeholder'=> 'Choisissez entre oui ou non',
                'choices'  => [
                    'Oui' => true,
                    'Non' => false,
                ],
            ])
            ->add('organization', EntityType::class,[
                'mapped'        => false,
                'required'      => true,
                'class'         => Organization::class,
                'choice_label'  => 'organizationName',
                'placeholder'   => 'Sélectionnez une entitée',
                'constraints'   => [
                    new NotBlank([
                      'message' => 'Veuillez choisir une entitée parmis la liste proposée.',
                    ])
                  ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PhysicalCustomers::class,
        ]);
    }
}
