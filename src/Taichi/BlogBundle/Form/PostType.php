<?php
namespace Taichi\BlogBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
                'class' => \Taichi\BlogBundle\Entity\Category::class,
                'label' => 'label.category',
            ])
            ->add('summary', TextareaType::class, [
                'label' => 'label.summary'
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'rows' => 20,
                ],
                'label' => 'label.content',
            ])
            ->add('tags', EntityType::class, [
                'class' => \Taichi\BlogBundle\Entity\Tag::class,
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
            'data_class' => 'Taichi\BlogBundle\Entity\Post',
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