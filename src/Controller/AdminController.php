<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class AdminController extends AbstractController
{
    /**
     * @Route("/Admin", name="admin")
     */
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        if ($this->getUser()) 
        {
            $repo = $doctrine->getRepository(Categories::class);
            $cat = $repo->findAll();
            $categorie = new Categories;

            $form = $this->createForm(CategoriesType::class, $categorie);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
                $em = $doctrine->getManager();
                $em->persist($categorie);
                $em->flush();

                return $this->redirectToRoute('admin');

            }

            return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'activee' => 'Admin',
            'form' => $form->createView(),
            'Categories' => $cat,
        ]);
        } else {
            return $this->redirectToRoute('app_home');
        }
    }
     
}
