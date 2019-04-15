<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Forms;

use App\Domain\DTO\Interfaces\UpdateImageMediaDTOInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateImageMediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', FileType::class, [
                'required' => false,
                'label' => 'Image',
                'attr' => [
                    "class" => "upload",
                    "accept" => "image/jpg, image/jpeg, image/png"
                ]
            ])
            ->add('alt', TextType::class, [
                'required' => false,
                'label' => 'Descriptif'
            ])
            ->add('first', CheckboxType::class, [
                'required' => false,
                'label' => 'Mettre en 1ère position'
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UpdateImageMediaDTOInterface::class
        ]);
    }
}
