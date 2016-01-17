<?php
namespace Taichi\BlogBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType, TextareaType};
use Taichi\BlogBundle\Entity\{Category, Tag, Post};

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', TextType::class, [
                'attr' => [
                    'autofocus' => true,
                ],
                'label' => 'label.subject'
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => 'label.category',
            ])
            ->add('abstract', TextareaType::class, [
                'label' => 'label.abstract'
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'rows' => 20,
                ],
                'label' => 'label.content',
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'multiple' => true,
                'label' => 'label.tags',
            ])
            ->add('pictureUrl', TextType::class, [
                'label' => 'label.picture',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'blog_post';
    }
}