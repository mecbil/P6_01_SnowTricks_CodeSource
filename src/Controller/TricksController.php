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
     * Get the 8 next tricks in the database and create a Twig file with them that will be displayed via Javascript
     * 
     * @Route("/{start}", name="loadMoreTricks", requirements={"start": "\d+"})
     */
    public function loadMoreTricks(ManagerRegistry $doctrine, $start = 8)
    {
        // Get 8 tricks from the start position
        $repo = $doctrine->getRepository(Tricks::class);
        $tricks = $repo->findBy([], ['modifyAt' => 'DESC'], 8, $start);

        return $this->render('home/loadMoreTricks.html.twig', [
            'activee' => 'Tricks',
            'Tricks' => $tricks
        ]);
    }

    /**
     * Get the 4 next comment in the database and create a Twig file with them that will be displayed via Javascript
     * 
     * @Route("{id}/details{begin}", name="loadMoreComments", requirements={"begin": "\d+"})
     */
    public function loadMoreComments(Tricks $tricks, ManagerRegistry $doctrine, $begin = 4)
    {
        // Get 4 comments from the begin position
        $repo = $doctrine->getRepository(Comments::class);
        
        $Comments = $repo->findBy(['tricks' => $tricks->getId()], ['created_at' => 'DESC'], 4, $begin);

        return $this->render('home/loadMoreComments.html.twig', [
            'activee' => 'Tricks',
            'Comments' => $Comments,
        ]);
    }

    /**
     * @Route("/tricks/{id}/details", name="tricks_show")
     */
    public function showOneTricks($id, Request $request,ManagerRegistry $doctrine): Response
    {
        $repotricks = $doctrine->getRepository(Tricks::class);
        $tricks = $repotricks->find($id);
        if (!$tricks) {
            throw $this->createNotFoundException('Enregistrement non trouvé');
        }
        $repocomments = $doctrine->getRepository(Comments::class);
        $allcomments = $repocomments->findBy(['tricks' => $id], ['created_at' => 'DESC']);

        // Add picture
        $pictures = new Pictures();

        $formpictures = $this->createForm(PicturesType::class, $pictures);
        $formpictures->handleRequest($request);
        // $image = $formpictures->get('link');
        // dump($image);

        if($formpictures->isSubmitted() && $formpictures->isValid()) {

            $pictures->setTricks($tricks);

            // Traitement de l'image
            $file = $formpictures->get('link')->getData();
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
            'subim' => $pictures->getId() !== null,
            'Tricks' => $tricks,
            'formpictures' => $formpictures->createView(),
            'formvids' => $formvids->createView(),
            'formcomments' => $formcomments->createView(),
            'onglet' => '',
            'comments' => $allcomments,

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

        $tricks = $repotrick->findBy([], ['modifyAt' => 'DESC']);

        return $this->render('home/index.html.twig', [
            'activee' => 'Home',
            'Tricks' => $tricks,
        ]);

    }
}
