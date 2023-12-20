<?php

namespace App\Form;

use App\Entity\Pokemon;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PokemonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null,['attr' => ['class' => 'form-control col-12']])
            ->add('point_de_vie', null,['attr' => ['class' => 'form-control col-12']])
            ->add('point_attaque', null,['attr' => ['class' => 'form-control col-12']])
            ->add('types', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pokemon::class ,
        ]);
    }
}
