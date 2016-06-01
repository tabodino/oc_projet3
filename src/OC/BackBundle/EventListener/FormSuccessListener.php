<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 01/06/16
 * Time: 10:02
 */

namespace OC\BackBundle\EventListener;


use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserBundle;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class FormSuccessListener implements EventSubscriberInterface
{

    private $router;


    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::CHANGE_PASSWORD_SUCCESS => 'onChangePasswordSuccess',
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
            FOSUserEvents::REGISTRATION_COMPLETED => 'onRegistrationCompleted',
        );
    }

    public function onChangePasswordSuccess(FormEvent $event)
    {
        $url = $this->router->generate('oc_back_profile');

        $event->setResponse(new RedirectResponse($url));

    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        $url = $this->router->generate('oc_back_users');

        $event->setResponse(new RedirectResponse($url));

    }

    public function onRegistrationCompleted(FilterUserResponseEvent $event)
    {
        $event->stopPropagation();
    }


}