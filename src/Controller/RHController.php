<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use App\Repository\EmployeRepository;
use App\Repository\DepartementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/rh')]
class RHController extends AbstractController
{
    #[Route('/', name: 'app_rh_index', methods: ['GET', 'POST'])]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        EmployeRepository $employeRepository,
        DepartementRepository $departementRepository
    ): Response {
        $employe = new Employe();
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($employe);
            $entityManager->flush();

            return $this->redirectToRoute('app_rh_index');
        }

        $employes = $employeRepository->findAll();
        $departements = $departementRepository->findAll();

        return $this->render('rh/index.html.twig', [
            'employes' => $employes,
            'form' => $form->createView(),
            'departements' => $departements,
        ]);
    }

    #[Route('/new', name: 'app_rh_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $employe = new Employe();
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($employe);
            $entityManager->flush();

            return $this->redirectToRoute('app_rh_index');
        }

        return $this->renderForm('rh/new.html.twig', [
            'employe' => $employe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rh_show', methods: ['GET'])]
    public function show(Employe $employe): Response
    {
        return $this->render('rh/show.html.twig', [
            'employe' => $employe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rh_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Employe $employe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_rh_index');
        }

        return $this->renderForm('rh/edit.html.twig', [
            'employe' => $employe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rh_delete', methods: ['POST'])]
    public function delete(Request $request, Employe $employe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employe->getId(), $request->request->get('_token'))) {
            $entityManager->remove($employe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_rh_index');
    }

    #[Route('/departements/{id}/services', name: 'app_rh_departement_services', methods: ['GET'])]
    public function getServicesByDepartement(\App\Entity\Departement $departement): JsonResponse
    {
        $services = $departement->getServices();

        $data = [];
        foreach ($services as $service) {
            $data[] = [
                'id' => $service->getId(),
                'nom' => $service->getNom(),
            ];
        }

        return new JsonResponse($data);
    }
}
