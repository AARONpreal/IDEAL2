<?php

namespace App\Controller;

use App\Entity\FicheMedical;
use App\Form\FicheMedicalType;
use App\Repository\FicheMedicalRepository;
use App\Repository\EmployeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/service-medical')]
class ServiceMedicalController extends AbstractController
{
    #[Route('/', name: 'app_service_medical_index', methods: ['GET', 'POST'])]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        FicheMedicalRepository $ficheMedicalRepository,
        EmployeRepository $employeRepository
    ): Response {
        $ficheMedical = new FicheMedical();
        $form = $this->createForm(FicheMedicalType::class, $ficheMedical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Générer un numéro de dossier automatique
            if (!$ficheMedical->getNumeroDossier()) {
                $ficheMedical->setNumeroDossier('DM-' . date('Y') . '-' . uniqid());
            }

            $entityManager->persist($ficheMedical);
            $entityManager->flush();

            return $this->redirectToRoute('app_service_medical_index');
        }

        $fichesMedicales = $ficheMedicalRepository->findAll();
        $employes = $employeRepository->findAll();

        return $this->render('service_medical/index.html.twig', [
            'fichesMedicales' => $fichesMedicales,
            'employes' => $employes,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/new', name: 'app_service_medical_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ficheMedical = new FicheMedical();
        $form = $this->createForm(FicheMedicalType::class, $ficheMedical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ficheMedical);
            $entityManager->flush();

            return $this->redirectToRoute('app_service_medical_index');
        }

        return $this->renderForm('service_medical/new.html.twig', [
            'ficheMedical' => $ficheMedical,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_service_medical_show', methods: ['GET'])]
    public function show(FicheMedical $ficheMedical): Response
    {
        return $this->render('service_medical/show.html.twig', [
            'ficheMedical' => $ficheMedical,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_service_medical_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FicheMedical $ficheMedical, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FicheMedicalType::class, $ficheMedical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_service_medical_index');
        }

        return $this->renderForm('service_medical/edit.html.twig', [
            'ficheMedical' => $ficheMedical,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_service_medical_delete', methods: ['POST'])]
    public function delete(Request $request, FicheMedical $ficheMedical, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ficheMedical->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ficheMedical);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_service_medical_index');
    }

    #[Route('/employe/{id}/info', name: 'app_service_medical_employe_info', methods: ['GET'])]
    public function getEmployeInfo(\App\Entity\Employe $employe): JsonResponse
    {
        $data = [
            'nom' => $employe->getNom(),
            'prenom' => $employe->getPrenom(),
            'dateNaissance' => $employe->getDateNaissance() ? $employe->getDateNaissance()->format('Y-m-d') : '',
            'genre' => $employe->getGenre(),
            'profession' => $employe->getFonction() ? $employe->getFonction()->getNom() : '',
            'service' => $employe->getService() ? $employe->getService()->getNom() : '',
        ];

        return new JsonResponse($data);
    }
}
