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
        $em = $this->getDoctrine()->getManager();
        $nbTotalVisitor = $em->getRepository('OCCoreBundle:Visitor')->countTotalVisitors();
        $nbMontlyVisitor = $em->getRepository('OCCoreBundle:Visitor')->countMonthlyVisitors();
        $nbWeeklyVisitor = $em->getRepository('OCCoreBundle:Visitor')->countWeeklyVisitors();
        $nbDailyVisitor = $em->getRepository('OCCoreBundle:Visitor')->countDailyVisitors();
        $nbTicketByDay = $em->getRepository('OCCoreBundle:Ticket')->countAllTicketByDay();

        return $this->render('OCBackBundle:Admin:index.html.twig', array(
            'nbTotalVisitor' => $nbTotalVisitor,
            'nbMontlyVisitor' => $nbMontlyVisitor,
            'nbWeeklyVisitor' => $nbWeeklyVisitor,
            'nbDailyVisitor' => $nbDailyVisitor,
            'nbTicketByDay' => $nbTicketByDay,

        ));
    }

    // Page profil
    public function profileAction()
    {
        // Surchage template formulaire fosuserbundle
        $form = $this->get('fos_user.change_password.form.factory')->createForm();

        return $this->render('OCBackBundle:Admin:profile.html.twig', array('form' => $form->createView()));
    }

    // Page utilisateurs
    public function usersAction()
    {
        // Récupération utilisateurs FOSUserBundle
        $users = $this->get('fos_user.user_manager')->findUsers();

        return $this->render('OCBackBundle:Admin:users.html.twig', array('users' => $users));
    }


    public function deleteUserAction($username)
    {
        $manager = $this->get('fos_user.user_manager');

        $user = $manager->findUserByUsername($username);

        // Tester suppression propre compte

        if (!$user instanceof User) {
            throw new NotFoundHttpException('User not found. ');
        }

        $manager->deleteUser($user);

        return $this->redirectToRoute('oc_back_users');

    }

    public function pricelistAction()
    {
        // Récupération du manager d'entité price
        $prices = $this->get('oc_core_price.manager')->getAll();

        return $this->render('OCBackBundle:Admin:pricelist.html.twig', array('prices' => $prices));
    }

    public function editPriceAction(Request $request)
    {

        $formHandler = new PriceFormHandler($request, $this->getDoctrine()->getManager());
        $formHandler->process();

        return $this->redirectToRoute('oc_back_pricelist');
    }

    public function calendarAction()
    {
        $em = $this->getDoctrine()->getManager();
        $nbTicketByDay = $em->getRepository('OCCoreBundle:Ticket')->countAllTicketByDay();

        return $this->render('OCBackBundle:Admin:calendar.html.twig', array('nbTicketByDay' => $nbTicketByDay));
    }

    public function helpAction()
    {
        return $this->render('OCBackBundle:Admin:help.html.twig');
    }
}