<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */
namespace App\UI\Forms;

use App\Domain\DTO\CreateTrickDTO;
use App\Domain\DTO\Interfaces\CreateTrickDTOInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateTrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => false,
                'label' => 'Title'
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Description',
                'attr' => [
                    'class' => 'ckeditor4',
                ]
            ])
            ->add('figureGroup', TextType::class, [
                'required' => false,
                'label' => 'Group'
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreateTrickDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                return new CreateTrickDTO(
                    $form->get('title')->getData(),
                    $form->get('description')->getData(),
                    $form->get('figureGroup')->getData()
                );
            }
        ]);
    }
}
