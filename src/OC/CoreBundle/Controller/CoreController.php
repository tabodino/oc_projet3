<?php
/**
 * Created by PhpStorm.
 * User: Stef et JM
 * Date: 09/05/2016
 * Time: 18:53
 */

namespace OC\CoreBundle\Controller;

use OC\CoreBundle\Entity\Customer;
use OC\CoreBundle\Entity\Ticket;
use OC\CoreBundle\Entity\Visitor;
use OC\CoreBundle\Form\Handler\VisitorFormHandler;
use OC\CoreBundle\Form\Type\TicketType;
use OC\CoreBundle\Form\Type\VisitorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $form = $this->get('form.factory')->create(VisitorType::class, $visitor);
        // Instance du form handler client
        $formHandler = new VisitorFormHandler($form, $request, $this->getDoctrine()->getManager(), $visitor);
        // Procédure si formulaire validé
        if ($formHandler->process()) return $this->redirectToRoute('oc_core_homepage');
        // Return template reservation
        return $this->render('OCCoreBundle:Core:reservation.html.twig', array('form' => $form->createView()));
    }

    // Requete ajax autocompletion pays
    public function completeCountryAction(Request $request, $word)
    {
        // récuperation du pays en paramètre
        $country = $request->get('word');
        // Tableau pour stocker les suggestions
        $countries = array();

        // Verifie si la requete est en Ajax
        //if ($request->isXmlHttpRequest()) {

            $tabcountries = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('OCCoreBundle:Country')
                ->getCountryBeginWith($country);

            foreach ($tabcountries as $c) {
                array_push($c, $countries);
            }
        var_dump($tabcountries); die();
      //  }

        return $this->render('OCCoreBundle:Core:completeCountry.html.twig', array('countries' => $countries));
    }


}