<?php

namespace App\Form;

use App\Entity\Todo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TodoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class,
            [
                'label' => 'Todo Title',
                'required' => true,
                'attr' => [
                    'minlength' => 5,
                    'maxlength' => 20
                ]
            ])
            ->add('content', TextType::class,
            [
                'label' => 'Todo Content',
                'required' => true,
                'attr' => [
                    'minlength' => 5,
                    'maxlength' => 50
                ]
            ])
            ->add('category', ChoiceType::class,
            [
                'label' => 'Todo Category',
                'choices' => [
                    'Personal' => 'Personal',
                    'Work' => 'Work',
                    'Study' => 'Study',
                    'Family' => 'Family'
                ],
                //'expanded' => true,
                //'multiple' => true
            ])
            ->add('date', DateType::class,
            [
                'label' => 'Deadline',
                'widget' => 'single_text'
            ])
            ->add('image', TextType::class,
            [
                'label' => 'Image URL',
                'required' => true,
            ])
            //->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Todo::class,
        ]);
    }
}
