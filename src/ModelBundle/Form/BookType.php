<?php

namespace ModelBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titre'])
            ->add('price', NumberType::class, ['label' => 'Prix'])
            ->add('datePublished', DateType::class, ['label' => 'Date de publication', 'widget' => 'single_text'])
            ->add('abstract', TextareaType::class, ['label' => 'Résumé'])
            ->add('publisher', EntityType::class, [
                'label' => 'Editeur',
                'class' => 'ModelBundle\Entity\Publisher',
                'choice_label' => 'name',
                'expanded' => true
            ])
            ->add('author', EntityType::class,[
                'label' => 'Auteur',
                'class' => 'ModelBundle\Entity\Author',
                'choice_label' => 'fullName'
            ])
            ->add('tags', EntityType::class, [
                'label' => 'tags',
                'class' => 'ModelBundle\Entity\Tag',
                'choice_label' => 'tagName',
                'expanded' => true,
                'multiple' => true
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ModelBundle\Entity\Book'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'modelbundle_book';
    }


}
