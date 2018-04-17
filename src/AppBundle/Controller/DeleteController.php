<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DeleteController extends Controller
{
    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteEmployeeAction(Request $request, $id)
    {        
        //Delete employee by his id
        $em = $this->getDoctrine()->getEntityManager();

        $employee = $em->getRepository('AppBundle:Employee')->find($id);

        $em->remove($employee);
        $em->flush();
        
        return $this->redirectToRoute('list');
    }
}
