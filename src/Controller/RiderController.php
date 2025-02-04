<?php

// src/Controller/RiderController.php
namespace App\Controller;

use App\Entity\Rider;
use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rider')]
class RiderController extends AbstractController
{
    #[Route('/create', name: 'rider_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $team = $entityManager->getRepository(Team::class)->find($request->request->get('team_id'));

        if (!$team) {
            return $this->redirectToRoute('team_index');
        }

        $rider = new Rider();
        $rider->setName($request->request->get('name'));
        $rider->setSkills(['speed' => 50, 'technique' => 50]); // Valeurs de base
        $rider->setLevel(1);
        $rider->setTeam($team);

        $entityManager->persist($rider);
        $entityManager->flush();

        return $this->redirectToRoute('team_index');
    }
}

