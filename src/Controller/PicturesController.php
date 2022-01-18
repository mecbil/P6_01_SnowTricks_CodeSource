<?php

namespace App\Controller;

use App\Entity\Pictures;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class PicturesController extends AbstractController
{
    /**
     * @Route("/pictures/delete/{id}", name="pictures_delete")
     */
    public function delete($id, ManagerRegistry $doctrine): Response
    {
        // delete a picture


        $repopicture = $doctrine->getRepository(Pictures::class);
        $picture = $repopicture->find($id);

        $em = $doctrine->getManager();
        $em->remove($picture);
        $em->flush();

        $onglet = 'categories';
        return $this->redirectToRoute('tricks_show', [
            'onglet' => $onglet,
            'id' => ($picture->getTricks())->getId(),
            
        ]);

    }
}
