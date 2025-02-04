<?php

// src/Controller/TeamController.php
namespace App\Controller;

use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/team')]
class TeamController extends AbstractController
{
    #[Route('/', name: 'team_index', methods: ['GET'])]
    public function index(TeamRepository $teamRepository): Response
    {
        return $this->render('team/index.html.twig', [
            'teams' => $teamRepository->findAll(),
        ]);
    }

    #[Route('/create', name: 'team_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $team = new Team();
        $team->setName($request->request->get('name'));
        $team->setBudget(1000000); // Budget initial par défaut
        $team->setReputation(50);  // Réputation de départ

        $entityManager->persist($team);
        $entityManager->flush();

        return $this->redirectToRoute('team_index');
    }
}
