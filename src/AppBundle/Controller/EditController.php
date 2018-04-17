<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\EmployeeType;


class EditController extends Controller
{
    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function editEmployeeAction(Request $request, $id)
    {
        //Delete employee by his id
        $em = $this->getDoctrine()->getEntityManager();

        $employee = $em->getRepository('AppBundle:Employee')->find($id);

        //Create form implements employee
        $form = $this->createForm(EmployeeType::class, $employee);

        
        return $this->render('templates/edit.html.twig');
    }
}
