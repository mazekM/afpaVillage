<?php

namespace App\Form;

use App\Entity\EvenementsSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class EvenementsSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxId',IntegerType::class,[
                'required'=>false,
                'label'=>false,
                'attr'=>[
                    'placeholder' => 'Id maximale'
                ]

            ])
            ->add('minId',IntegerType::class,[
                'required'=>false,
                'label'=>false,
                'attr'=>[
                    'placeholder' => 'Id minimale'
                ]

            ])
            
            ->add('distance',ChoiceType::class, [
                'choices'=> [
                    '10 km' =>10,
                    '1000 km' => 1000

                ]
            ])
            ->add('lat',HiddenType::class)
            ->add('lng',HiddenType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EvenementsSearch::class,
            'method' => 'get',
            'csrf_protection' =>false
        ]);
    }
    public function getBlockPrefix()
    {
        return "";
    }

}
