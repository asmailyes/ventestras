<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("login", name="loginpage")
     */
    public function loginAction(Request $request)
    {
        var_dump($request->request);
        // replace this example code with whatever you need
        return $this->render('default/login.html.twig');
    }
    
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $user->setEmail($request->request->get('email'));
        $user->setPassword(password_hash($request->request->get('password'), PASSWORD_BCRYPT));
        $user->setLogin($request->request->get('login'));
        
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($user);
        $manager->flush();
        
        return $this->redirectToRoute('loginpage');
    }
}