<?php

namespace App\Form;


use App\Repository\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SearchType extends AbstractType
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    /**
    * Builder
    *
    * @param FormBuilderInterface $builder Builder.
    * @param array                $options Array options.
    *
    * @return void
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',options: [
                'label' => false,
                'required' => false,
                'attr'=> [
                    'placeholder'=>"Votre recherche...",
                ]
            ])
            ->add('categories', ChoiceType::class, [
                'choices' => $this->categoryRepository->findAll(),
                'choice_value' => 'id',
                'choice_label' => 'name',
                'label' => false,
                'required' => false,
                'multiple' => true,
                'expanded' => true

            ]);
    }
        
    
    /**
     * Configuration
     *
     * @param OptionsResolver $resolver Resolver.
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'crsf_protection' => false
        ]);
    }//Fin de configureOptions()
}