<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/Admin", name="admin")
     */
    public function index(): Response
    {
        if ($this->getUser()) 
        {
            return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'activee' => 'Admin',
        ]);
        } else {
            return $this->redirectToRoute('app_home');
        }
    }
      
}
