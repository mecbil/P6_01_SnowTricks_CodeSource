<?php

namespace App\Controller;

use App\Entity\Pictures;
use App\Form\PicturesType;
use App\Entity\Vids;
use App\Form\VidsType;
use App\Entity\Comments;
use App\Form\CommentsType;
use App\Entity\Tricks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class VidsController extends AbstractController
{
    /**
     * @Route("/vids/delete/{id}", name="vids_delete")
     */
    public function delete($id, ManagerRegistry $doctrine): Response
    {
        $repovids = $doctrine->getRepository(Vids::class);
        $vids = $repovids->find($id);

        $em = $doctrine->getManager();
        $em->remove($vids);
        $em->flush();

        $onglet = 'categories';
        return $this->redirectToRoute('tricks_show', [
            'onglet' => $onglet,
            'id' => ($vids->getTricks())->getId(),
            
        ]);
    }

    /**
     * @Route("/vids/edit/{id}", name="vids_edit")
     */
    public function edit(Vids $video, Request $request, ManagerRegistry $doctrine): Response
    {
        $idtricks = $video->getTricks();
        $repotricks = $doctrine->getRepository(Tricks::class);
        $tricks = $repotricks->find($idtricks);

        $repocomments = $doctrine->getRepository(Comments::class);
        $allcomments = $repocomments->findBy(['tricks' => $idtricks], ['created_at' => 'DESC']);

        $formvids = $this->createForm(VidsType::class, $video);

        $formvids->handleRequest($request);

        if ($formvids->isSubmitted() && $formvids->isValid()) {

            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute('tricks_show', [
                'onglet' => '',
                'id' => ($video->getTricks())->getId(),
                
            ]);
        }

        $picture = new Pictures();
        $formpicture = $this->createForm(PicturesType::class, $picture);
        
        $comments = new Comments();
        $formcomments = $this->createForm(CommentsType::class, $comments);


        return $this->render('tricks/showonetricks.html.twig', [
            'onglet' => 'video',
            'subvid' => $video->getId() !== null,
            'subim' => $picture->getId() !== null,
            'id' => ($video->getTricks())->getId(),
            'activee' => 'Connexion',
            'Tricks' => $tricks,
            'formpictures' => $formpicture->createView(),
            'formvids' => $formvids->createView(),
            'formcomments' => $formcomments->createView(),
            'comments' => $allcomments,
        ]);
    }
}
