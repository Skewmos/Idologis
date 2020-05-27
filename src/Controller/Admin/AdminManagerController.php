<?php

namespace App\Controller\Admin;

use App\Entity\Manager;
use App\Form\ManagerType;
use App\Repository\ManagerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/manager")
 */
class AdminManagerController extends AbstractController
{
    /**
     * @Route("/", name="manager_index", methods={"GET"})
     * @param ManagerRepository $managerRepository
     * @return Response
     */
    public function index(ManagerRepository $managerRepository): Response
    {
        return $this->render('/admin/manager/index.html.twig', [
            'managers' => $managerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="manager_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $manager = new Manager();
        $form = $this->createForm(ManagerType::class, $manager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($manager);
            $entityManager->flush();

            return $this->redirectToRoute('manager_index');
        }

        return $this->render('/admin/manager/new.html.twig', [
            'manager' => $manager,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="manager_show", methods={"GET"})
     * @param Manager $manager
     * @return Response
     */
    public function show(Manager $manager): Response
    {
        return $this->render('/admin/manager/show.html.twig', [
            'manager' => $manager,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="manager_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Manager $manager
     * @return Response
     */
    public function edit(Request $request, Manager $manager): Response
    {
        $form = $this->createForm(ManagerType::class, $manager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('manager_index');
        }

        return $this->render('/admin/manager/edit.html.twig', [
            'manager' => $manager,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manager/{id}", name="manager_delete", methods={"DELETE"})
     * @param Request $request
     * @param Manager $manager
     * @return Response
     */
    public function delete(Request $request, Manager $manager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$manager->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($manager);
            $entityManager->flush();
        }

        return $this->redirectToRoute('manager_index');
    }
}
