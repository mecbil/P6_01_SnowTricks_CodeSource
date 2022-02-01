<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\TricksRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(ManagerRegistry $doctrine, TricksRepository $repo): Response
    {

        $tricks = $repo->findBy([], ['modifyAt' => 'DESC']);

        return $this->render('home/index.html.twig', [
        'activee' => 'Home',
        'Tricks' => $tricks,
        ]);
    }

    
}
