<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Employee;

class DetailsController extends Controller
{
    /**
     * @Route("/details/{id}", name="details")
     */
    public function detailsEmployeeAction(Request $request, $id)
    {
        //Delete employee by his id
        $em = $this->getDoctrine()->getEntityManager();

        $employee = $em->getRepository('AppBundle:Employee')->find($id);
        //$employee = $em->getRepository('AppBundle:Employee')->findBy(array('id' => $id));

        if($employee)
        {
            return $this->render('templates/details.html.twig', array(
                'employee' => $employee,
            ));
        } else {
            return $this->redirectToRoute('list');
        }
    }
}
