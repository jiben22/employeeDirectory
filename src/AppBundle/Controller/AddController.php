<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use AppBundle\Entity\Employee;
use AppBundle\Entity\Skill;
use AppBundle\Form\EmployeeType;

class AddController extends Controller
{
    /**
     * @Route("/add", name="add")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addEmployeeAction(Request $request)
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employee = $form->getData();

            var_dump($employee);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($employee);            
            $entityManager->flush();

            return $this->redirectToRoute('list');
        }

        return $this->render('templates/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
