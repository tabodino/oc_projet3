<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 31/05/16
 * Time: 16:15
 */

namespace OC\BackBundle\Controller;

use OC\BackBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminController extends Controller
{
    // Page accueil administration
    public function indexAction()
    {
        return $this->render('OCBackBundle:Admin:index.html.twig');
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


   /* public function addUserAction()
    {
        return $this->render('OCBackBundle:Admin:addUser.html.twig');
    }*/

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

}