<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListController extends Controller
{
    /**
     * @Route("/", name="list")
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
