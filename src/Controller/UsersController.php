<?php

namespace App\Controller;

use App\Entity\Tricks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class UsersController extends AbstractController
{
    /**
     * @Route("/admin", name="users")
     */
    public function index(): Response
    {
        $onglet = 'tricks';
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'UsersController',
            'onglet' => $onglet,
            
        ]);
    }

}
