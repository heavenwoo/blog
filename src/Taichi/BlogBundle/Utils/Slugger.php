<?php
namespace Taichi\BlogBundle\Utils;

class Slugger
{
    public function slugify($string)
    {
        return trim(preg_replace(
            '/[^a-z0-9]/', '-', strtolower(trim(strip_tags($string)))
            ), '-'
        );
    }
}
