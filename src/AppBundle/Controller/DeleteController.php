<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DeleteController extends Controller
{
    /**
     * @Route("/delete/{id}", name="delete")
     * @Security("has_role('ROLE_ADMIN')")
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
