<?php
/**
 * Created by PhpStorm.
 * User: Stef et JM
 * Date: 09/05/2016
 * Time: 18:53
 */

namespace OC\CoreBundle\Controller;

use OC\CoreBundle\Entity\Customer;
use OC\CoreBundle\Entity\Price;
use OC\CoreBundle\Entity\Ticket;
use OC\CoreBundle\Entity\Visitor;
use OC\CoreBundle\Form\Handler\VisitorFormHandler;
use OC\CoreBundle\Form\Type\TicketType;
use OC\CoreBundle\Form\Type\VisitorType;
use OC\CoreBundle\Services\AgeCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Comparator\DateComparator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        // Récupération du manager d'entité price
        $prices = $this->get('oc_core_price.manager')->getAll();

        return $this->render('OCCoreBundle:Core:pricelist.html.twig', array('prices' => $prices));
    }

    // La page reservation
    public function reservationAction(Request $request)
    {
        //Nouvel objet visiteur
        $visitor = new Visitor();
        // Création formulaire
        $form = $this->createForm(VisitorType::class, $visitor);
        // Instance du form handler client
        $formHandler = new VisitorFormHandler($form, $request, $this->getDoctrine()->getManager(), $visitor);
        // Procédure si formulaire validé
        if ($formHandler->process()) return $this->redirectToRoute('oc_core_cart_add', array('id' => $visitor->getId()));
        // Return template reservation
        return $this->render('OCCoreBundle:Core:reservation.html.twig', array('form' => $form->createView()));
    }

    // Requete ajax autocompletion pays
    public function completeCountryAction(Request $request, $word)
    {
        // Tableau vide en cas d'erreur ajax
        $countries = array();
        // Verifie si la requete est en Ajax
        if ($request->isXmlHttpRequest()) $countries = $this->get('oc_core_country.manager')->getCountryBeginWith($word);

        return $this->render('OCCoreBundle:Core:completeCountry.html.twig', array('countries' => $countries));
    }

}