<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 25/05/16
 * Time: 10:42
 */

namespace OC\CoreBundle\Controller;

use OC\CoreBundle\Entity\Customer;
use OC\CoreBundle\Form\Handler\CustomerPayPalFormHandler;
use OC\CoreBundle\Services\Paypal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PaypalController extends Controller
{
    // Redirection api paiement Paypal
    public function setExpressCheckoutAction(Request $request)
    {
        $paypal = new Paypal();

        $params = array(
            'PAYMENTREQUEST_0_AMT' => $request->get('amount'),
            'RETURNURL' => 'http://localhost/oc_projet3/web/app_dev.php/paypal/success',
            'CANCELURL' => "http://localhost/oc_projet3/web/app_dev.php/paypal/error",
        );

        $response = $paypal->request('SetExpressCheckout', $params);
        if ($response) {

            $paypal = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$response['TOKEN'];

            return $this->redirect($paypal);

        }else {

            return $this->render('OCCoreBundle:Paypal:errorPaypal.html.twig');
        }
    }
    
    // Transaction paypal
    public function getExpressCheckoutDetailsAction(Request $request)
    {
        // Service session panier
        $cart = $this->get('oc_core_cart.session')->cartSession();
        $paypal = new Paypal();
        //$token = $request->query->get('TOKEN');
        $response = $paypal->request('GetExpressCheckoutDetails', array(
            'TOKEN' => $request->query->get('token')
        ));

        if ($response) {
            $cart['email'] = $response['EMAIL'];
            // Ajout email client à la session
            $this->get('oc_core_cart.session')->getSession()->set('cart', $cart);

            return $this->doExpressCheckoutPaymentAction($response);

        }else {

            return $this->render('OCCoreBundle:Paypal:errorPaypal.html.twig');
        }
    }

   public function errorPaymentAction()
    {
        return $this->render('OCCoreBundle:Paypal:errorPaypal.html.twig');
    }
    
    // Confirmation paiement paypal
    public function doExpressCheckoutPaymentAction($response)
    {
        $paypal = new Paypal();

        $resp = $paypal->request('DoExpressCheckoutPayment', array(
            'TOKEN' => $response['TOKEN'],
            'PAYERID' => $response['PAYERID'],
            'PAYMENTREQUEST_0_AMT' => $response['PAYMENTREQUEST_0_AMT'],
        ));

        if ($resp) {
            return $this->redirectToRoute('oc_core_paypal_validated');
        }else {
            return $this->render('OCCoreBundle:Paypal:errorPaypal.html.twig');
        }
    }

    public function validatedCartPaypalAction(Request $request)
    {
        $customer = new Customer();
        // Service session panier
        $cart = $this->get('oc_core_cart.session')->cartSession();
        // Modifie l'adresse email pour test envoi reservation (uniquement pour les tests)
        $testEmail = str_replace("-buyer","" , $cart['email']);

        // Instance du form handler client stripe
        $formHandler = new CustomerPayPalFormHandler($request, $this->getDoctrine()->getManager(), $customer);

        // Procédure si formulaire validé
        $formHandler->process($testEmail);
        // Récupère les visiteurs correspondant au client
        $visitors = $this->get('oc_core_visitor.manager')->setVisitorByCustomerId($customer->getId(), $cart);
        // Envoi email confirmation
        $this->get('oc_core_reservation_email')->reservationConfirm($customer->getEmail(), $visitors);

        // Vide la session
        $this->get('oc_core_cart.session')->getSession()->clear();

        return $this->render('OCCoreBundle:Cart:validatedCart.html.twig');

    }
}