<?php

namespace App\Controller\Admin;

use App\Entity\Configuration;
use App\Form\ConfigurationType;
use App\Repository\ConfigurationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/configuration")
 */
class ConfigurationController extends AbstractController
{
    /**
     * @Route("/", name="configuration_index", methods={"GET"})
     * @param ConfigurationRepository $configurationRepository
     * @return Response
     */
    public function index(ConfigurationRepository $configurationRepository): Response
    {
        return $this->render('admin/configuration/index.html.twig', [
            'configurations' => $configurationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="configuration_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $configuration = new Configuration();
        $form = $this->createForm(ConfigurationType::class, $configuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($configuration);
            $entityManager->flush();

            return $this->redirectToRoute('configuration_index');
        }

        return $this->render('admin/configuration/new.html.twig', [
            'configuration' => $configuration,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="configuration_show", methods={"GET"})
     * @param Configuration $configuration
     * @return Response
     */
    public function show(Configuration $configuration): Response
    {
        return $this->render('admin/configuration/show.html.twig', [
            'configuration' => $configuration,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="configuration_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Configuration $configuration
     * @return Response
     */
    public function edit(Request $request, Configuration $configuration): Response
    {
        $form = $this->createForm(ConfigurationType::class, $configuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('configuration_index');
        }

        return $this->render('admin/configuration/edit.html.twig', [
            'configuration' => $configuration,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="configuration_delete", methods={"DELETE"})
     * @param Request $request
     * @param Configuration $configuration
     * @return Response
     */
    public function delete(Request $request, Configuration $configuration): Response
    {
        if ($this->isCsrfTokenValid('delete'.$configuration->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($configuration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('configuration_index');
    }
}
