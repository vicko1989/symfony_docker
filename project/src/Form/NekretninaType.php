<?php

namespace App\Form;

use App\Entity\Nekretnina;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class NekretninaType extends AbstractType
{
    // nekretnina form
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
            ->add('image', FileType::class, [
                'label' => 'Slika',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Molimo vas dodajte sliku',
                    ])
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
