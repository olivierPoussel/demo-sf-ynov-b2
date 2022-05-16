<?php

namespace App\Controller;

use App\Entity\Acteur;
use App\Form\ActeurType;
use App\Repository\ActeurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/acteur')]
class ActeurController extends AbstractController
{
    #[Route('/', name: 'acteur_list')]
    public function acteurList(ActeurRepository $acteurRepository): Response
    {
        $acteurList = $acteurRepository->findAll();

        return $this->render('/acteur/list.html.twig', [
            "listActeur" => $acteurList
        ]);
    }

    #[Route('/create', 'acteur_create')]
    #[IsGranted('ROLE_ADMIN')]
    public function createActeur(Request $request, ManagerRegistry $doctrine)
    {
        //afficher le form
        $acteur = new Acteur();
        $form = $this->createForm(ActeurType::class, $acteur);
        //recup des datas
        $form->handleRequest($request);

        //check si le form est submit
        if ($form->isSubmitted() && $form->isValid()) {
            //les envoyer a la bdd
            $manager = $doctrine->getManager();
            $manager->persist($acteur);
            $manager->flush();

            return $this->redirectToRoute('acteur_list');
        }


        return $this->render('/acteur/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'acteur_detail')]
    public function acteurDetail(Acteur $acteur, ActeurRepository $acteurRepository)
    {
        // $acteur = $acteurRepository->find($id);

        return $this->render('/acteur/detail.html.twig', [
            "acteur" => $acteur
        ]);
    }
}
