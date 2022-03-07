<?php

namespace App\Form;

use App\Entity\Neww;

use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class NewwType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('title',TextType::class,['label' => 'العنوان'])
     
            ->add('imaggeFile',FileType::class, 
            ['required' => false,
         
              'label' => 'حمل الصور' ,
              'constraints' => [
                new File([
                    'maxSize' => '4000000',
                    'mimeTypes' => [
                        'image/jpeg',
                    ],
                    'mimeTypesMessage' => '(.jpg) حمل صورة صحيحة '
                ])
                ]
             ]
         )
            ->add('description',TextareaType::class,['label' => 'وصف'])
     
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Neww::class,
        ]);
    }
}
