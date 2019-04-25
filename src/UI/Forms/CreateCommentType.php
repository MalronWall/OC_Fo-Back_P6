<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */
namespace App\UI\Forms;

use App\Domain\DTO\CreateCommentDTO;
use App\Domain\DTO\Interfaces\CreateCommentDTOInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', TextareaType::class, [
                'required' => false,
                'label' => 'Comment'
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreateCommentDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                return new CreateCommentDTO(
                    $form->get('comment')->getData()
                );
            }
        ]);
    }
}
