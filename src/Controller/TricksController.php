<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Entity\Comments;
use App\Form\CommentsType;
use App\Entity\Pictures;
use App\Form\PicturesType;
use App\Entity\Vids;
use App\Form\VidsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class TricksController extends AbstractController
{
    /**
     * @Route("/tricks", name="tricks")
     */
    public function showTricks(ManagerRegistry $doctrine, Request $request): Response
    {
        $repotricks = $doctrine->getRepository(Tricks::class);
        // Pagination
        $limit = 8;
        $page = (int)$request->query->get('page', 1);
        $total =$repotricks->findAll();
        
        $tricks = $repotricks->findBy([], ['modifyAt' => 'ASC'], $limit,$page*$limit-$limit);


        return $this->render('tricks/showtricks.html.twig', [
            'activee' => 'Tricks',
            'Tricks' => $tricks,
            'total' => count($total),
            'limit' => $limit,
            'page' => $page,

        ]);
    }

    /**
     * Get the 15 next tricks in the database and create a Twig file with them that will be displayed via Javascript
     * 
     * @Route("/{start}", name="loadMoreTricks", requirements={"start": "\d+"})
     */
    public function loadMoreTricks(ManagerRegistry $doctrine, $start = 8)
    {
        // Get 4 tricks from the start position
        $repo = $doctrine->getRepository(Tricks::class);
        $tricks = $repo->findBy([], ['modifyAt' => 'DESC'], 8, $start);

        return $this->render('home/loadMoreTricks.html.twig', [
            'activee' => 'Tricks',
            'Tricks' => $tricks
        ]);
    }

    /**
     * @Route("/tricks/details/{id}", name="tricks_show")
     */
    public function showOneTricks($id, Request $request,ManagerRegistry $doctrine): Response
    {
        $repotricks = $doctrine->getRepository(Tricks::class);
        $tricks = $repotricks->find($id);
        if (!$tricks) {
            throw $this->createNotFoundException('Enregistrement non trouvé');
        }
        $repocomments = $doctrine->getRepository(Comments::class);
        $comments = $repocomments->findAll();

        // Add picture
        $pictures = new Pictures();

        $formpictures = $this->createForm(PicturesType::class, $pictures);
        $formpictures->handleRequest($request);

        if($formpictures->isSubmitted() && $formpictures->isValid()) {

            $pictures->setTricks($tricks);

            // Traitement de l'image
            $file = $request->files->get('Imagetricks');
            $fichier = $file->getClientOriginalName();

            // moves the file to the directory where images are stored
            $file->move(
                $this->getParameter('images_directory'),
                $fichier
            );

            $pictures->setLink($fichier);

            $em = $doctrine->getManager();
            $em->persist($pictures);
            $em->flush();

            $onglet = 'categories';
            return $this->redirectToRoute('tricks_show', [
                'onglet' => $onglet,
                'id' => $id,
                'onglet' => '',
                
            ]);
        }

        // Add a Video
        $vids = new Vids();

        $formvids = $this->createForm(VidsType::class, $vids);
        $formvids->handleRequest($request);
        // dump($vids->getLink());
        if($formvids->isSubmitted() && $formvids->isValid()) {

            $vids->setTricks($tricks);
            $vids->setLink(str_replace("watch?v=","embed/",$vids->getLink()));

            $em = $doctrine->getManager();
            $em->persist($vids);
            $em->flush();

            $onglet = 'categories';
            return $this->redirectToRoute('tricks_show', [
                'onglet' => $onglet,
                'id' => $id,
                'onglet' => '',
                
            ]);
        }

        // Add a comment
        $user = $this->getUser();

        $comments = new Comments();
        $formcomments = $this->createForm(CommentsType::class, $comments);
        $formcomments->handleRequest($request);

        if($formcomments->isSubmitted() && $formcomments->isValid()) {

            $comments->setTricks($tricks);
            $comments->setUsers($user);
            $comments->setCreatedAt(new \DateTime());
            $comments->setModifyAt(new \DateTime());
            $comments->setAuthor($tricks->getAuthor());

            $em = $doctrine->getManager();
            $em->persist($comments);
            $em->flush();

            $onglet = 'categories';
            return $this->redirectToRoute('tricks_show', [
                'onglet' => $onglet,
                'id' => $id,
                'onglet' => '',

            ]);
        }

        return $this->render('tricks/showonetricks.html.twig', [
            'controller_name' => 'TricksController',
            'activee' => 'Tricks',
            'subvid' => $vids->getId() !== null,
            'Tricks' => $tricks,
            'formpictures' => $formpictures->createView(),
            'formvids' => $formvids->createView(),
            'formcomments' => $formcomments->createView(),
            'onglet' => '',

        ]);
    }

    /**
     * @Route("/trick/{id}/delete", name="trick_delete")
     */
    public function delete($id, ManagerRegistry $doctrine): Response
    {
        $repotrick = $doctrine->getRepository(Tricks::class);
        $trick = $repotrick->find($id);

        $em = $doctrine->getManager();
        $em->remove($trick);
        $em->flush();

        $tricks = $repotrick->findAll();

        return $this->render('tricks/showtricks.html.twig', [
            'activee' => 'Tricks',
            'Tricks' => $tricks,
        ]);

    }
}
