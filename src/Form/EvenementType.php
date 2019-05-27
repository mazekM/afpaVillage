<?php

namespace App\Form;

use App\Entity\Evenements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('id',IntegerType::class,array('disabled' => true))
            ->add('title')
            ->add('category')
            ->add('date',DateType::class,['widget' => 'single_text','format' => 'yyyy-MM-dd'
            ])
            ->add('description')
            ->add('pictureFiles',FileType::class,[
                'required'=> false,
                'multiple'=> true
            ])
            ->add('adresse',TextType::class)
            ->add('lat',HiddenType::class)
            ->add('lng',HiddenType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenements::class,
            'translation_domain'=>'forms'
        ]);
    }
}
