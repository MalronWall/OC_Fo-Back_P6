<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Forms;

use App\Domain\DTO\Interfaces\NewImageMediaDTOInterface;
use App\Domain\DTO\NewImageMediaDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewImageMediaType2 extends AbstractType
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
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewImageMediaDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                return new NewImageMediaDTO(
                    $form->get('image')->getData()
                );
            }
        ]);
    }
}
