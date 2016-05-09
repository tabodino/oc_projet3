<?php
/**
 * Created by PhpStorm.
 * User: Stef et JM
 * Date: 09/05/2016
 * Time: 18:53
 */

namespace OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
    public function reservationAction()
    {
        return $this->render('OCCoreBundle:Core:reservation.html.twig');
    }


}