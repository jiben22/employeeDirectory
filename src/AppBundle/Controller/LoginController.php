<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LoginController extends Controller
{
    /**
     * @Route("/", name="login")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('fos_user_security_login');

    }
}
