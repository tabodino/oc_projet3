<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 31/05/16
 * Time: 16:15
 */

namespace OC\BackBundle\Controller;

use OC\BackBundle\Entity\User;
use OC\CoreBundle\Entity\Price;
use OC\CoreBundle\Form\Handler\PriceFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminController extends Controller
{
    // Page accueil administration
    public function indexAction()
    {
        // Nombre de tickets par jour (calendrier)
        $nbTicketByDay = $this->get('oc_core_ticket.manager')->countAllTicketByDay();
        // Stats visiteurs
        $countVisitors = $this->get('oc_core_visitor.manager')->getVisitorCounter();
        
        return $this->render('OCBackBundle:Admin:index.html.twig', array(
            'countVisitors' => $countVisitors,
            'nbTicketByDay' => $nbTicketByDay,
        ));
    }


    // Page liste des tarifs
    public function pricelistAction()
    {
        // Récupération du manager d'entité price
        $prices = $this->get('oc_core_price.manager')->getAll();

        return $this->render('OCBackBundle:Admin:pricelist.html.twig', array('prices' => $prices));
    }

    // Modification tarifs
    public function editPriceAction(Request $request)
    {
        $formHandler = new PriceFormHandler($request, $this->getDoctrine()->getManager());

        $formHandler->process();

        return $this->redirectToRoute('oc_back_pricelist');
    }

    // Page calendrier
    public function calendarAction()
    {
        // Nombre de tickets par jour (calendrier)
        $nbTicketByDay = $this->get('oc_core_ticket.manager')->countAllTicketByDay();

        return $this->render('OCBackBundle:Admin:calendar.html.twig', array('nbTicketByDay' => $nbTicketByDay));
    }

    // Page Statistiques
    public function statsAction()
    {
        // Service Stats visiteurs
        $countVisitors = $this->get('oc_core_visitor.manager')->getVisitorCounter();
        // Retourne les 5 nations les plus présentes
        $countryVisitor = $this->get('oc_core_visitor.manager')->countVisitorsByCountry();
        // Retourne le nombre de visteurs par categorie de prix
        $countPrice = $this->get('oc_core_visitor.manager')->countCategoryPrice();
        
        return $this->render('OCBackBundle:Admin:stats.html.twig', array(
            'countryVisitor' => $countryVisitor,
            'countPrice' => $countPrice,
            'countVisitors' => $countVisitors,

        ));
    }

    // Page aide
    public function helpAction()
    {
        return $this->render('OCBackBundle:Admin:help.html.twig');
    }
}