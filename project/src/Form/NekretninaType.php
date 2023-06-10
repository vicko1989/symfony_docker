<?php

namespace App\Form;

use App\Entity\Nekretnina;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class NekretninaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('naslov')
            ->add('opis')
            ->add('cijena')
            ->add('kategorija', ChoiceType::class, [
                'choices'  => [
                    'kuća' => 'kuća',
                    'stan' => 'stan',
                    'poslovni prostor' => 'poslovni prostor',
                    'zemljište' => 'zemljište',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nekretnina::class,
        ]);
    }
}
