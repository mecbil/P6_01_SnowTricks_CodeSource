<?php

namespace App\Controller;

use App\Entity\Tricks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class TricksController extends AbstractController
{
    /**
     * @Route("/tricks", name="tricks")
     */
    public function showTricks(ManagerRegistry $doctrine): Response
    {
        $repocat = $doctrine->getRepository(Tricks::class);
        $tricks = $repocat->findAll();

        return $this->render('tricks/showtricks.html.twig', [
            'controller_name' => 'TricksController',
            'activee' => 'Tricks',
            'Tricks' => $tricks,
        ]);
    }

    /**
     * @Route("/tricks/{id}", name="tricks_show")
     */
    public function showOneTricks($id,ManagerRegistry $doctrine): Response
    {
        $repocat = $doctrine->getRepository(Tricks::class);
        $tricks = $repocat->find($id);

        return $this->render('tricks/showonetricks.html.twig', [
            'controller_name' => 'TricksController',
            'activee' => 'Tricks',
            'Tricks' => $tricks,
        ]);
    }
}
