<?php

namespace App\Controller;

use App\Entity\Vids;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

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
}
