<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 17/05/16
 * Time: 17:47
 */

namespace OC\CoreBundle\Services;

use Symfony\Component\HttpFoundation\RequestStack;

class CartSession
{
    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getSession()
    {
        // Récupère la requete
        $request = $this->requestStack->getCurrentRequest();
        // Retourne la session
        return $request->getSession();
    }

    public function cartSession()
    {
        // Récupère la session
        $session = $this->getSession();
        // vérifie la session panier
        if (!$session->has('cart'))
            // creer un panier vide si panier inexistant
            $session->set('cart', array());
        // récupère la session panier
        $cart = $session->get('cart');
        // retourne la session panier
        return $cart;

    }

}