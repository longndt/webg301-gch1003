<?php

namespace App\Form;

use App\Entity\Note;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextType::class,
            [
                'label' => 'Nội dung',
                'required' => true,
                'attr' => [
                    'minlength' => 5,
                    'maxlength' => 30
                ]
            ])
            ->add('date', DateType::class,
            [
                'label' => 'Deadline',
                'widget' => 'single_text'
            ])
            ->add('quantity', IntegerType::class,
            [
                'label' => 'Số lượng',
                'attr' => 
                [
                    'min' => 1,
                    'max' => 50
                ]
            ])
            ->add('money', MoneyType::class,
            [
                'label' => 'Tiền',
                'currency' => 'VND'
            ])
            ->add('image', TextType::class,
            [
                'label' => 'Hình ảnh',
                'required' => true
            ])
            ->add('category', ChoiceType::class,
            [
                'label' => 'Thể loại',
                'choices' => [
                    'Cá nhân' => 'Personal',
                    'Công việc' => 'Work',
                    'Gia đình' => 'Family'
                ],
                'expanded' => false, //false: drop-down list (default)
                                    //true: radio button
                'multiple' => false  //default: false
                                    //drop-down: Hold CTRL to select multiple
                //drop-down:  false - false
                //radio: true - false
                //checkbox: true - true
            ])
            ->add('Create', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
