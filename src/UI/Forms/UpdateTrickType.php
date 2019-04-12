<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */
namespace App\UI\Forms;

use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;
use App\Domain\Models\FigureGroup;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateTrickType extends AbstractType
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
                'label' => 'Description'
            ])
            ->add('figureGroup', EntityType::class, [
                'label' => 'Group',
                'class' => FigureGroup::class
            ])
            ->add('links', CollectionType::class, [
                'label' => 'Links',
                'required' => false,
                'entry_type' => NewLinkMediaType2::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ])
            ->add('images', CollectionType::class, [
                'label' => 'Images',
                'required' => false,
                'entry_type' => NewImageMediaType2::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UpdateTrickDTOInterface::class
        ]);
    }
}
