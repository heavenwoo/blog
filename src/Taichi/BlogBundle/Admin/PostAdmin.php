<?php
namespace Taichi\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\{
    TextType, TextareaType
};
use Taichi\BlogBundle\Entity\{
    Category, Tag, Post
};


class PostAdmin extends Admin
{
    public function toString($object)
    {
        return $object instanceof Post
            ? $object->getSubject()
            : 'Post'; // shown in the breadcrumb on the create view
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Content', ['class' => 'col-md-9'])
                ->add('subject', TextType::class, [
                    'attr'  => [
                        'autofocus' => true,
                    ],
                    'label' => 'label.subject',
                ])
                ->add('abstract', TextareaType::class, [
                    'label' => 'label.abstract',
                ])
                ->add('content', TextareaType::class, [
                    'attr'  => [
                        'rows' => 20,
                    ],
                    'label' => 'label.content',
                ])
                ->add('pictureUrl', TextType::class, [
                    'label' => 'label.pictureUrl',
                ])
            ->end()
            ->with('Meta', ['class' => 'col-md-3'])
                ->add('category', EntityType::class, [
                    'class' => Category::class,
                    'label' => 'label.category',
                ])
                ->add('tags', EntityType::class, [
                    'class'    => Tag::class,
                    'multiple' => true,
                    'label'    => 'label.tag',
                ])
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('subject')
            ->add('category', null, [], EntityType::class, [
                'class' => Category::class,
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('subject')
            ->add('category')
            ->add('createdAt');
    }
}