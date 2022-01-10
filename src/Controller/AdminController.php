<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Tricks;
use App\Entity\Users;
use App\Form\CategoriesType;
use App\Form\TricksType;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class AdminController extends AbstractController
{
    /**
     * @Route("/Admin/{onglet}", name="admin")
     * @Route("/Admin/{onglet}", name="admin_tricks")
     * @Route("/Admin/{onglet}", name="admin_categories")
     */
    public function showadmin($onglet = null, Request $request, ManagerRegistry $doctrine): Response
    {
        if ($this->getUser()) 
        {
            $user = $this->getUser();
            // dump($user->getId());
            $tricks = new Tricks();
            
            $formtricks = $this->createForm(TricksType::class, $tricks);
            $formtricks->handleRequest($request);

            if($formtricks->isSubmitted() && $formtricks->isValid()) {
                $tricks->setCreatedAt(new \DateTime());
                $tricks->setModifyAt(new \DateTime());
                $tricks->setUsers($user);
                // Traitement de l'image
                // $image = $request->files->get('fitured_img');
                // $fichier = $image->getClientOriginalName();
                // $image->move(
                //     $this->getParameter('images_directory'),
                //     $fichier
                // );
                // $tricks->setFituredImg($fichier);
                $file = $request->files->get('fitured_img');
                // dd($file);
                // $fileName = $file->md5(uniqid()).'.'.$file->guessExtension();
                $fichier = $file->getClientOriginalName();
                // moves the file to the directory where brochures are stored
                $file->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
    
                $tricks->setFituredImg($fichier);

                // dd($tricks);
                $em = $doctrine->getManager();
                $em->persist($tricks);
                $em->flush();

                $onglet = 'categories';
                return $this->redirectToRoute('admin', [
                    'onglet' => $onglet, 
                    
                ]);
           

            }

            $repocat = $doctrine->getRepository(Categories::class);
            $cat = $repocat->findAll();
            $categorie = new Categories();

            $form = $this->createForm(CategoriesType::class, $categorie);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
                $em = $doctrine->getManager();
                $em->persist($categorie);
                $em->flush();

                $onglet = 'categories';
                return $this->redirectToRoute('admin', ['onglet' => $onglet]);

            }
            $onglet = 'profil';
            return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'activee' => 'Admin',
            'formCategorie' => $form->createView(),
            'formTricks' => $formtricks->createView(),
            'Categories' => $cat,
            'onglet' => $onglet,
        ]);
        } else {
            return $this->redirectToRoute('app_home');
        }
    }
     
}
