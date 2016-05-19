<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 17/05/16
 * Time: 10:38
 */

namespace OC\CoreBundle\Controller;

use OC\CoreBundle\Entity\Customer;
use OC\CoreBundle\EntityManager\VisitorManager;
use OC\CoreBundle\Form\Handler\CustomerFormHandler;
use OC\CoreBundle\Form\Handler\VisitorFormHandler;
use OC\CoreBundle\Form\Type\CustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{
    // Page panier
    public function cartAction(Request $request)
    {
        // Service session panier
        $cart = $this->get('oc_core_cart.session')->cartSession();

        $em = $this->getDoctrine()->getManager();

        $reservations = $em->getRepository('OCCoreBundle:Visitor')->findArray(array_keys($cart));

        return $this->render('OCCoreBundle:Cart:cart.html.twig', array(
            'reservations' => $reservations,
            'cart' => $cart,
        ));
    }

    // Ajout au panier
    public function addCartAction($id, Request $request)
    {
        // Service session panier
        $cart = $this->get('oc_core_cart.session')->cartSession();

        // définie la quantité à 1
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
        if (array_key_exists($id, $cart))
        {
            // Supprime le produit de panier
            unset($cart[$id]);
            // Mise à jour de la session
            $this->get('oc_core_cart.session')->getSession()->set('cart', $cart);


            // Probleme manager voir entitymanager
          /*  $em = $this->getDoctrine()->getManager();

            $visitor = $em->getRepository('OCCoreBundle:Visitor')->find($id);

            $em->remove($visitor);

            $em->flush();*/
            $visitor = $this->get('oc_core_visitor.manager')->find($id);
            var_dump($visitor); die();

        }

        return $this->redirectToRoute('oc_core_cart_view');

    }

    // Validation panier
    public function validateCartAction(Request $request)
    {
        $customer = new Customer();
        // Instance du form handler client
        $formHandler = new CustomerFormHandler($request, $this->getDoctrine()->getManager(), $customer);
        // Procédure si formulaire validé
        if ($formHandler->process()) {
            $em = $this->getDoctrine()->getManager();
            $visitors = $em->getRepository('OCCoreBundle:Visitor')->getVisitorByCustomerId($customer->getId());
            // Qr code + envoi mail + pdf

        }




        // Vider la session + envoi email + generation qrcode

        return $this->render('OCCoreBundle:Cart:validatedCart.html.twig');
    }

}