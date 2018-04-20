<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api", name="api")
 */
class SerializerController extends Controller
{
    /**
     * @Route("/serializer", name="serializer")
     */
    public function serializerAction(SerializerInterface $serializer)
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

    /**
     * @Route("/list2", name="api_list2")
     */
    public function apiListAction(SerializerInterface $serializer)
    {
        $employees = $this
        ->getDoctrine()
        ->getRepository('AppBundle:Employee')
        ->findAll();
        //->find(28196);

        $jsonEmployeesList = $serializer->serialize(
            $employees,
            'json', array('groups' => array('list'))
        );

        $response = new Response($jsonEmployeesList);
        $response->headers->set("content-type", "application/json");
        return $response;
    }

    /**
     * @Route("/details", name="api_details")
     */
    public function apiDetailsAction(SerializerInterface $serializer)
    {
        $employees = $this
        ->getDoctrine()
        ->getRepository('AppBundle:Employee')
        ->findAll();
        //->find(28196);

        $jsonEmployeesList = $serializer->serialize(
            $employees,
            'json', array('groups' => array('details'))
        );

        $response = new Response($jsonEmployeesList);
        $response->headers->set("content-type", "application/json");
        return $response;
    }
}
