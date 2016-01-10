<?php

namespace Taichi\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TaichiUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}