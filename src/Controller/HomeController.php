<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends  AbstractController
{


    /**
     * @Route("/", name="home")
     * @param PropertyRepository $repository
     * @param Request $request
     * @return Response
     */
    public function  index(PropertyRepository $repository, Request $request): Response
    {
        $search = new  PropertySearch();
        $properties = $repository->findLatest();
        $last_twelve = $repository->findTwelve();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);
        return  $this->render('pages/home.html.twig', [
            'properties' => $properties,
            'last' => $last_twelve,
            'form' => $form->createView(),
            'type' => Property::TYPE,
            'energy' => Property::ENERGY
        ]);
    }
}