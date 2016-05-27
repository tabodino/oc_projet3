<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 17/05/16
 * Time: 10:38
 */

namespace OC\CoreBundle\Controller;

use OC\CoreBundle\Entity\Customer;
use OC\CoreBundle\Form\Handler\CustomerStripeFormHandler;
use OC\CoreBundle\Services\AgeCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class CartController extends Controller
{
    // Page panier
    public function cartAction()
    {
        // Service session panier
        $cart = $this->get('oc_core_cart.session')->cartSession();

        // Récupération des reservations du panier
        $reservations = $this->get('oc_core_visitor.manager')->findArray(array_keys($cart));


        return $this->render('OCCoreBundle:Cart:cart.html.twig', array('reservations' => $reservations));
    }
    
    
    // Ajout au panier
    public function addCartAction($id)
    {
        // Service session panier
        $cart = $this->get('oc_core_cart.session')->cartSession();
        
        // Définie la quantité à 1
        $cart[$id] = 1;

        // Ajout de la quantité à la session
        $this->get('oc_core_cart.session')->getSession()->set('cart', $cart);

        // Retoune la vue du panier
        return $this->redirectToRoute('oc_core_cart_view');
    }


    // Supprimer du panier
    public function removeFromCartAction($id)
    {
        // Service session panier
        $cart = $this->get('oc_core_cart.session')->cartSession();

        // Vérifier si l'id produit est bien dans le panier
        if (array_key_exists($id, $cart)) {
            // Supprime le produit du panier
            unset($cart[$id]);
            // Mise à jour de la session
            $this->get('oc_core_cart.session')->getSession()->set('cart', $cart);
            // Suppression en bdd
            $this->get('oc_core_visitor.manager')->remove($id);
        }

        return $this->redirectToRoute('oc_core_cart_view');
    }


    // Validation panier
    public function validateCartAction(Request $request)
    {
        // Service session panier
        $cart = $this->get('oc_core_cart.session')->cartSession();

        $customer = new Customer();
        // Instance du form handler client stripe
        $formHandler = new CustomerStripeFormHandler($request, $this->getDoctrine()->getManager(), $customer);

        // Procédure si formulaire validé
        if ($formHandler->process()) {
            // Récupère les visiteurs correspondant au client
            $visitors = $this->get('oc_core_visitor.manager')->setVisitorByCustomerId($customer->getId(), $cart);
            // Envoi email confirmation
            $this->get('oc_core_reservation_email')->reservationConfirm($customer->getEmail(), $visitors);
        }
        // Vide la session
        $this->get('oc_core_cart.session')->getSession()->clear();

        return $this->render('OCCoreBundle:Cart:validatedCart.html.twig');
    }

    // Vérification réservation QR-Code
    public function viewReservationAction($codeReservation)
    {
        // Trouve une réservation par rapport à son code
        $visitor = $this->get('oc_core_visitor.manager')->getVisitorByCodeReservation($codeReservation);

        return $this->render('OCCoreBundle:Cart:viewReservation.html.twig', array('visitor' => $visitor));
    }
}  