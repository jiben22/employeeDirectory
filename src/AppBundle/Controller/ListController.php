<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
class ListController extends Controller
{
    /**
     * @Route("/list", name="list")
     * @Security("has_role('ROLE_USER') or has_role('ROLE_ADMIN')")
     */
    public function listEmployeesAction(Request $request)
    {
        $employees = $this
        ->getDoctrine()
        ->getRepository('AppBundle:Employee')
        ->findAll();

        return $this->render('templates/list.html.twig', array(
            'employees' => $employees,
        ));
    }
}
