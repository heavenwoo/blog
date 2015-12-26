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
                'attr' => ['autofocus' => true],
            ])
            ->add('category', EntityType::class, [
                'class' => \Taichi\BlogBundle\Entity\Category::class,
            ])
            ->add('summary', TextareaType::class)
            ->add('content', TextareaType::class, [
                'attr' => ['rows' => 20],
            ])
            ->add('tags', EntityType::class, [
                'class' => \Taichi\BlogBundle\Entity\Tag::class,
                'multiple' => true,
            ])
            ->add('pictureUrl', TextType::class)
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