<?php

namespace App\Controller\Autenticacion;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController {

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('Login/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/registrar", name="registrar")
     */
    public function registrarAction(Request $request) {
        $arUsuario = new \App\Entity\Usuario();
        $form = $this->createForm(\App\Form\UsuarioType::class, $arUsuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $arUsuario = $form->getData();
            $password = $this->get('security.password_encoder')
                    ->encodePassword($arUsuario, $arUsuario->getPlainPassword());
            $arUsuario->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($arUsuario);
            $em->flush();
            return $this->redirectToRoute('login');
        }

        return $this->render('Login:registrar.html.twig', array('form' => $form->createView())
        );
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request) {
        return $this->redirect("/logout");
    }



}
