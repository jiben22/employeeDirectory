<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Validator\Constraints\DateTime;

use AppBundle\Entity\Employee;

class QueryBuilderController extends Controller
{
    /**
     * @Route("/query-builder-employees-date", name="queryBuilderEmployeesDate")
     */
    public function queryBuilderEmployeesDateAction()
    {
        $dateDebut = new \DateTime('01/01/2013');
        $dateFin = new \DateTime('01/31/2025');

        $employeesDate = $this
        ->getDoctrine()
        ->getRepository('AppBundle:Employee')
        ->findByEmployeesDate($dateDebut, $dateFin);

        return $this->render('templates/query-builder.html.twig', array(
            'employees' => $employeesDate,
        ));
    }

    /**
     * @Route("/query-builder-employee-name", name="queryBuilderEmployeeName")
     */
    public function queryBuilderEmployeeNameAction()
    {
        $employee = $this
        ->getDoctrine()
        ->getRepository('AppBundle:Employee')
        ->findByEmployeeName('Jacky');

        return $this->render('templates/query-builder.html.twig', array(
            'employees' => $employee,
        ));
    }
}
