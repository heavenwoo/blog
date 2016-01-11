<?php
namespace Taichi\CarbonBundle\Twig;

use Carbon\Carbon;
use Symfony\Component\DependencyInjection\Container;

class CarbonExtension extends \Twig_Extension
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('carbon', [$this, 'carbon'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('diffForHumans', [$this, 'diffForHumans'], ['is_safe' => ['html']]),
        ];
    }

    public function diffForHumans($dateTime, $otherDateTime = null)
    {
        $dt = ($dateTime instanceof \DateTime)
            ? Carbon::instance($dateTime)
            : new Carbon($dateTime);
        $otherDt = (null === $otherDateTime)
            ? null
            : (($otherDateTime instanceof \DateTime)
                ? Carbon::instance($otherDateTime)
                : new Carbon($otherDateTime));

        $locale = $this->container->getParameter('taichi.carbon.locale');

        $dt->setLocale($locale);

        return $dt->diffForHumans($otherDt);
    }

    public function carbon($dateTime, $locale = null, $format = null)
    {
        $dt = ($dateTime instanceof \DateTime)
            ? Carbon::instance($dateTime)
            : new Carbon($dateTime);

        $locale = $locale ?: $this->container->getParameter('taichi.carbon.locale');
        $format = $format ?: $this->container->getParameter('taichi.carbon.format');

        $dt->setLocale($locale);

        $dt->setToStringFormat($format);

        return $dt;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'carbon.extension';
    }
}