<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Form\EmployeeType;


class EditController extends Controller
{
    /**
     * @Route("/edit/{id}", name="edit")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editEmployeeAction(Request $request, $id)
    {
        //Delete employee by his id
        $em = $this->getDoctrine()->getEntityManager();

        $employee = $em->getRepository('AppBundle:Employee')->find($id);

        //Create form implements employee
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->add('submit', SubmitType::class, array(
            'label' => 'Editer',
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employee = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($employee);            
            $entityManager->flush();

            return $this->redirectToRoute('details', array('id' => $id));
        }

        
        return $this->render('templates/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
