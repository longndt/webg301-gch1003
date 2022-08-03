<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class,
            [
                'label' => 'Book title',
                'attr' => [
                    'minlength' => 3,
                    'maxlength' => 30
                ]
            ])
            ->add('quantity', IntegerType::class,
            [
                'label' => 'Book quantity',
                'attr' => [
                    'min' => 1,
                    'max' => 100
                ]
            ])
            ->add('price', MoneyType::class,
            [
                'label' => 'Book price',
                'currency' => 'USD'
            ])
            ->add('date', DateType::class,
            [
                'label' => 'Published date',
                'widget' => 'single_text'
            ])
            ->add('image' ,TextType::class,
            [
                'label' => 'Book image',
                'attr' => [
                    'maxlength' => 255
                ]
            ])
            /* 
            Thông tin chứa dữ liệu của bảng khác trong DB
            => Load dữ liệu của bảng Author và Genre trong 
            form add/edit Book để người dùng lựa chọn
            */
            ->add('authors', EntityType::class,
            [
                'label' => 'Author',
                'required' => true,
                'class' => Author::class,
                'choice_label' => 'name',
                'multiple' => true,  //nếu có thể chọn nhiều option (relationship: many)
                'expanded' => false
            ]) 
            ->add('genre', EntityType::class,
            [
                'label' => 'Genre',
                'required' => true,
                'class' => Genre::class,
                'choice_label' => 'name',
                'multiple' => false, //nếu chỉ được chọn 1 option (relationship: 1)
                'expanded' => false
            ])

            /* Note:
                multiple: false & expanded: false => drop-down list
                multiple: false & expanded: true => radio button
                multiple: true & expanded: false => drop-down list   (Hold CTRL button to select many)
                multiple: true & expanded: true => check-box    
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
