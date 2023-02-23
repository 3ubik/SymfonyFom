<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\CalculationPriceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class FormPageController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}
    #[Route("/form", name:"app_form_page")]
    public function index(Request $request): Response
    {
        $products = $this->doctrine->getRepository(Product::class)
            ->findAll();
        $form = $this->createForm(CalculationPriceType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
        }
        return $this->render('form/index.html.twig', [
            'products' => $products,
            'calculation_price_form' => $form->createView()
        ]);
    }
}
