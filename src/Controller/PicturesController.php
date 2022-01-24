<?php

namespace App\Controller;

use App\Entity\Pictures;
use App\Form\PicturesType;
use App\Entity\Tricks;
use App\Entity\Vids;
use App\Form\VidsType;
use App\Entity\Comments;
use App\Form\CommentsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class PicturesController extends AbstractController
{
    /**
     * @Route("/pictures/delete/{id}", name="pictures_delete")
     */
    public function delete($id, ManagerRegistry $doctrine): Response
    {
        $repopicture = $doctrine->getRepository(Pictures::class);
        $picture = $repopicture->find($id);

        $em = $doctrine->getManager();
        $em->remove($picture);
        $em->flush();

        return $this->redirectToRoute('tricks_show', [
            'id' => ($picture->getTricks())->getId(),
        ]);
    }

    /**
     * @Route("/pictures/edit/{id}", name="pictures_edit")
     */
    public function edit(Pictures $picture, Request $request, ManagerRegistry $doctrine): Response
    {
        $idtricks = $picture->getTricks();
        $repotricks = $doctrine->getRepository(Tricks::class);
        $tricks = $repotricks->find($idtricks);

        $formpicture = $this->createForm(PicturesType::class, $picture);

        $formpicture->handleRequest($request);

        if ($formpicture->isSubmitted() && $formpicture->isValid()) {
            if ($request->files->get('Imagetricks')) {
                // Traitement de l'image
                $file = $request->files->get('Imagetricks');
                $fichier = $file->getClientOriginalName();

                // moves the file to the directory where images are stored
                $file->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                $picture->setLink($fichier);
            }
            
            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute('tricks_show', [
                'onglet' => '',
                'id' => ($picture->getTricks())->getId(),
            ]);
        }

        $vids = new Vids();
        $formvids = $this->createForm(VidsType::class, $vids);
        
        $comments = new Comments();
        $formcomments = $this->createForm(CommentsType::class, $comments);

        return $this->render('tricks/showonetricks.html.twig', [
            'onglet' => 'imgage',
            'id' => ($picture->getTricks())->getId(),
            'activee' => 'Connexion',
            'Tricks' => $tricks,
            'formpictures' => $formpicture->createView(),
            'formvids' => $formvids->createView(),
            'formcomments' => $formcomments->createView(),
        ]);
    }
}
