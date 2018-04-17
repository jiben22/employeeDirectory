<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Employee;
use AppBundle\Form\EmployeeType;


class AddController extends Controller
{
    /**
     * @Route("/add", name="add")
     */
    public function indexAction(Request $request)
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dataEmployee = $form->getData();

            //Call function to save employee
            $this->addEmployee($dataEmployee);

            return $this->redirectToRoute('homepage');
        }

        return $this->render('templates/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function addEmployee($dataEmployee)
    {
        //Create a new Employee
        $employee = new Employee();

        //Entity manager
        $em = $this->getDoctrine()->getManager();

        //Add attributes for employee
        $employee->setLastname($dataEmployee['lastname']);
        $employee->Firstname($dataEmployee['firstname']);
        $employee->setAge($dataEmployee['age']);
        $employee->setJob($dataEmployee['job']);
        $employee->setPhone($dataEmployee['phone']);
        //Add object environment
        $employee->setEnvironment($dataEmployee['environment']);

        //Don't forget the adding of skills if the people having it


        $entityManager->persist($employee);
        $entityManager->flush();

    }
}
