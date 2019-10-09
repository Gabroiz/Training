<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContratadorController extends AbstractController
{
    /**
     * @Route("/contratador", name="contratador")
     */
    public function index()
    {
        return $this->render('contratador/index.html.twig', [
            'controller_name' => 'ContratadorController',
        ]);
    }
}
