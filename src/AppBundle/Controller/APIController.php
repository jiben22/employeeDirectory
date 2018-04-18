<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GuzzleHttp\Client;

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
}
