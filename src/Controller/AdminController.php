<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class AdminController extends AbstractController
{
    /**
     * @Route("/Admin/{onglet}", name="admin_admin")
     * @Route("/Admin/{onglet}", name="admin_tricks")
     * @Route("/Admin/{onglet}", name="admin_categories")
     */
    public function index($onglet = null, Request $request, ManagerRegistry $doctrine): Response
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

                $onglet = 'categories';
                return $this->redirectToRoute('admin_categories', ['onglet' => $onglet]);

            }
            $onglet = 'profil';
            return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'activee' => 'Admin',
            'formCategorie' => $form->createView(),
            'Categories' => $cat,
            'onglet' => $onglet,
        ]);
        } else {
            return $this->redirectToRoute('app_home');
        }
    }
     
}
