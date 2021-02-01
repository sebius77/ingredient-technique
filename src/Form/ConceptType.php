<?php

namespace App\Form;

use App\Entity\Concept;
use App\Entity\Theme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ConceptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
                ])
            ->add('isDraft', CheckboxType::class, [
                'label' => 'Brouillon'
            ])
            ->add('content',CKEditorType::class, [
                'label' => 'Contenu'
            ])
            ->add('theme', EntityType::class, [
                'class' => Theme::class,
                'choice_label' => 'title',
                'label' => 'Theme'
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Ajouter'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Concept::class,
        ]);
    }
}
