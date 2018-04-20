<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class TranslatorController extends Controller
{
    /**
     * @Route("/translator", name="translator")
     */
    public function translatorAction()
    {
        $translation = $this->get('translator')->trans('Hello');

        return new Response($translation);
    }

}
