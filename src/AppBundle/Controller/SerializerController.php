<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerController extends Controller
{
    /**
     * @Route("/serializer", name="serializer")
     */
    public function serizlizerAction(SerializerInterface $serializer)
    {
        $employees = $this
        ->getDoctrine()
        ->getRepository('AppBundle:Employee')
        ->findAll();
        //->find(28196);

        $jsonEmployeesAdmins = $serializer->serialize(
            $employees,
            'json', array('groups' => array('admins'))
        );

        /*
        $jsonEmployeesUsers = $serializer->serialize(
            $employees,
            'json', array('groups' => array('admins'))
        );
        */

        $response = new Response($jsonEmployeesAdmins);
        $response->headers->set("content-type", "application/json");
        return $response;
    }
}
