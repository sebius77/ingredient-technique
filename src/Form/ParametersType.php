<?php

namespace App\Form;

use App\Entity\Parameters;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParametersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('presentationText', CKEditorType::class, [
                'label' => 'Texte de présentation',
                'required' => false
            ])
            ->add('referenceList', CKEditorType::class, [
                'label' => 'Références',
                'required' => false
            ])
            ->add('footerText', TextType::class, [
                'label' => 'Texte pour le footer',
                'required' => false
            ])
            ->add('toDoList', CKEditorType::class, [
                'label' => 'Les choses à faire',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Parameters::class,
        ]);
    }
}
