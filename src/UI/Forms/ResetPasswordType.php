<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Forms;

use App\Domain\DTO\Interfaces\ResetPasswordDTOInterface;
use App\Domain\DTO\ResetPasswordDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => false,
                'label' => 'Email'
            ])
            ->add(
                'password',
                RepeatedType::class,
                [
                    'first_options' => ['label' => 'Password'],
                    'second_options' => ['label' => 'Confirm password'],
                    'type' => PasswordType::class,
                    'invalid_message' => "Les deux mots de passe ne correspondent pas !"
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ResetPasswordDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                return new ResetPasswordDTO(
                    $form->get('email')->getData(),
                    $form->get('password')->getData()
                );
            }
        ]);
    }
}
