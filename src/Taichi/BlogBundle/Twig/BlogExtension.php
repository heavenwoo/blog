<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Taichi\BlogBundle\Twig;

use Symfony\Component\Intl\Intl;

/**
 * This Twig extension adds a new 'md2html' filter to easily transform Markdown
 * contents into HTML contents inside Twig templates.
 * See http://symfony.com/doc/current/cookbook/templating/twig_extension.html
 *
 * In addition to creating the Twig extension class, before using it you must also
 * register it as a service. See app/config/services.yml file for details.
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Julien ITARD <julienitard@gmail.com>
 */
class BlogExtension extends \Twig_Extension
{
    /**
     * @var array
     */
    private $locales;

    public function __construct($locales)
    {
        $this->locales = $locales;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('locales', array($this, 'getLocales')),
        );
    }

    /**
     * Takes the list of codes of the locales (languages) enabled in the
     * application and returns an array with the name of each locale written
     * in its own language (e.g. English, Français, Español, etc.)
     *
     * @return array
     */
    public function getLocales()
    {
        $localeCodes = explode('|', $this->locales);

        $locales = array();
        foreach ($localeCodes as $localeCode) {
            $locales[] = array('code' => $localeCode, 'name' => Intl::getLocaleBundle()->getLocaleName($localeCode, $localeCode));
        }

        return $locales;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        // the name of the Twig extension must be unique in the application. Consider
        // using 'app.extension' if you only have one Twig extension in your application.
        return 'blog.extension';
    }
}
