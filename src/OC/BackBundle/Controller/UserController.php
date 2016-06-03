<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 03/06/16
 * Time: 15:27
 */

namespace OC\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

    // Page profil
    public function profileAction()
    {
        // Surchage template formulaire fosuserbundle
        $form = $this->get('fos_user.change_password.form.factory')->createForm();

        return $this->render('OCBackBundle:User:profile.html.twig', array('form' => $form->createView()));
    }

    // Page utilisateurs
    public function listUsersAction()
    {
        // Récupération utilisateurs FOSUserBundle
        $users = $this->get('fos_user.user_manager')->findUsers();

        return $this->render('OCBackBundle:User:listUsers.html.twig', array('users' => $users));
    }

    // Suppression d'un utilisateur
    public function deleteUserAction($id)
    {
        // Récupère le user manager
        $this->get('oc_back_user.manager')->deleteUser($id);

        return $this->redirectToRoute('oc_back_users');
    }
}