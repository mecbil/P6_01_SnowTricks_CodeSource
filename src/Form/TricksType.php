<?php

namespace App\Form;

use App\Entity\Tricks;
use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TricksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('author', HiddenType::class)
            ->add('content')
            // ->add('createdAt', HiddenType::class)
            // ->add('modifyAt', HiddenType::class)
            ->add('fitured_img', fileType::class, [
                'data_class'=> null, 
                'label' => 'Images mises en avant :',
                'mapped' => false,
                'required' => false,             
            ])
            // ->add('users', EntityType::class, [
            //     // looks for choices from this entity
            //     'class' => Users::class,
            
            //     // uses the User.username property as the visible option string
            //     'choice_label' => 'id',
                
            // ])
            ->add('categories')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tricks::class,
        ]);
    }
}
