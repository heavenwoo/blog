<?php
namespace Taichi\CarbonBundle\Twig;

use Carbon\Carbon;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CarbonExtension extends \Twig_Extension
{
    protected $container;

    public function __construct(ContainerInterface $container)
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

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('carbon', array($this, 'carbon')),
        );
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

        if ($locale[2]) {
            $locale = substr($locale, 0, 2);
        }

        $dt->setLocale($locale);

        return $dt->diffForHumans($otherDt);
    }

    public function carbon($dateTime = null, $format = null)
    {
        $dt = ($dateTime instanceof \DateTime)
            ? Carbon::instance($dateTime)
            : new Carbon($dateTime);

        $locale = $this->container->getParameter('taichi.carbon.locale');
        $format = $format ?: $this->container->getParameter('taichi.carbon.format');

        if ($locale[2]) {
            $locale = substr($locale, 0, 2);
        }

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