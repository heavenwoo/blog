<?php
namespace Taichi\UserBundle\EventListener;

use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class LoginListener
{
    /**
     * @var string
     */
    protected $locale;

    /**
     * Router
     *
     * @var Router
     */
    protected $router;

    /**
     * @param Router $router The router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function handle(AuthenticationEvent $event)
    {
        $token = $event->getAuthenticationToken();
        $this->locale = $token->getUser()->getLocale();

    }

    public function onKernelResponse(FilterResponseEvent $event)
    {

        if (null !== $this->locale) {
            $request = $event->getRequest();
            $request->getSession()->set('_locale', $this->locale);
        }
    }
}