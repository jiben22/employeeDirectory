<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use GuzzleHttp\Client;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\AcceptHeader;

class APIController extends Controller
{
    /**
     * @Route("/api", name="api")
     */
    public function apiAction()
    {
        $client = new Client();
        $rep = $client->request('GET', 'https://api-adresse.data.gouv.fr/search/?q=8%20bd%20du%20port', [
            //'auth' => ['user', 'pass'],
        ]);
        //echo $res->getStatusCode();
        // "200"
        //var_dump($res->getHeader('content-type'));
        // 'application/json; charset=utf8'
        $data = $rep->getBody()->getContents();
        // {"type":"User"...'

        /*
        // Send an asynchronous request.
        $request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
        $promise = $client->sendAsync($request)->then(function ($response) {
            echo 'I completed! ' . $response->getBody();
        });
        $promise->wait();
        */
        $data = json_decode($data, true); // decode the JSON into an associative array

        $longitude = $data['features'][0]['geometry']['coordinates'][0];
        $latitude = $data['features'][0]['geometry']['coordinates'][1];

        return $this->render('templates/api.html.twig', array(
            'data' => $data,
            'longitude' => $longitude,
            'latitude' => $latitude,
        ));
    }

    /**
     * @Route("/api/list", name="api_list")
     */
    public function apiListAction()
    {
        $employees = $this
        ->getDoctrine()
        ->getRepository('AppBundle:Employee')
        //->findAll();
        ->find(28196);

        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(array('skills'));
        $encoder = new JsonEncoder();

        $serializer = new Serializer(array($normalizer), array($encoder));
        $jsonContent = $serializer->serialize($employees, 'json');
 
        $response = new Response($jsonContent);
        //$response->header->set('Content-Type', 'json');
        return new $response;
    }
}
