<?php

namespace App\Controller;

use App\Entity\Country;
use App\Entity\Product;
use App\Form\CalculationPriceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class FormPageController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}
    #[Route("/form", name:"app_form_page")]
    public function index(): Response
    {
        $products = $this->doctrine->getRepository(Product::class)
            ->findAll();
        $form = $this->createForm(CalculationPriceType::class);
        return $this->render('form/index', [
            'products' => $products,
        ]);
    }
}
