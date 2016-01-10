<?php

namespace Taichi\BlogBundle\Menu;

use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createAdminSidebarMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        //...

        return $menu;
    }
}