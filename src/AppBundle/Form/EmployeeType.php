<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\ChoiceType;

use AppBundle\Form\EnvironmentType;

class EmployeeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('lastname', TextType::class, array(
            'label' => 'Nom',
            'required' => true
        ))
        ->add('firstname', TextType::class, array(
            'label' => 'Prénom',
            'required' => true
        ))
        ->add('age', IntegerType::class, array(
            'label' => 'Âge',
            'required' => true,
            'data' => 25
        ))
        ->add('job', TextType::class, array(
            'label' => 'Intitulé du poste',
            'required' => true
        ))
        ->add('phone', TextType::class, array(
            'label' => 'Téléphone',
            'required' => true
        ))
        ->add('environment', EnvironmentType::class, array(
            'label' => 'Localisation',
            'required' => true
        ))
        ->add('skills', EntityType::class, array(
            'class' => 'AppBundle:Skills',
            'choice_label' => 'denomination',
        ))
        ->add('submit', SubmitType::class, array(
            'label' => 'Ajouter',
        ));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Employee'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_employee';
    }


}
