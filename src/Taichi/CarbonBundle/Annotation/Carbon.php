<?php
namespace Taichi\CarbonBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class Carbon
 *
 * @Annotation
 *
 * @package Taichi\CarbonBundle
 */
class Carbon
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return \Carbon\Carbon::instance($this->date);
    }
}