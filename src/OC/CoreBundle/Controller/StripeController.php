<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 19/05/16
 * Time: 10:47
 */

namespace OC\CoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StripeController extends Controller
{
    public function paymentAction(Request $request)
    {
        return $this->render('OCCoreBundle:Stripe:creditCardForm.html.twig');
    }
}