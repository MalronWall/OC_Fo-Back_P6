<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace App\UI\Forms;

use App\Domain\DTO\Interfaces\LoginDTOInterface;
use App\Domain\DTO\LoginDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => false,
                'label' => 'Email'
            ])
            ->add('password', PasswordType::class, [
                    'required' => false,
                    'label' => 'Password'
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LoginDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                return new LoginDTO(
                    $form->get('email')->getData(),
                    $form->get('password')->getData()
                );
            }
        ]);
    }
}
