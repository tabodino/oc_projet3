<?php
/**
 * Created by PhpStorm.
 * User: Stef et JM
 * Date: 09/05/2016
 * Time: 18:53
 */

namespace OC\CoreBundle\Controller;

use OC\CoreBundle\Entity\Customer;
use OC\CoreBundle\Form\Type\CustomerType;
use OC\CoreBundle\Form\Handler\CustomerFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CoreController extends Controller
{
    // La page d'accueil
    public function indexAction()
    {
        return $this->render('OCCoreBundle:Core:index.html.twig');
    }

    // La page des tarifs
    public function pricelistAction()
    {
        return $this->render('OCCoreBundle:Core:pricelist.html.twig');
    }

    // La page reservation
    public function reservationAction(Request $request)
    {
        //Nouvel objet client
        $customer = new Customer();
        // Création formulaire
        $form = $this->get('form.factory')->create(CustomerType::class, $customer);
        // Instance du form handler client
        $formHandler = new CustomerFormHandler($form, $request, $this->getDoctrine()->getManager(), $customer);

        if ($formHandler->process()) {

            return $this->redirectToRoute('oc_core_homepage');
            //return new RedirectResponse($this->generateUrl("dashboard"));
        }

        return $this->render('OCCoreBundle:Core:reservation.html.twig', array(
            'form' => $form->createView()
        ));
    }




}