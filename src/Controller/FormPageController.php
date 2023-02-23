<?php

namespace App\Controller;

use App\Form\CalculationPriceType;
use App\Services\CalculateResultPrice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FormPageController extends AbstractController
{
    private const FORM_TEMPLATE = 'form/index.html.twig';
    private const FORM_NAME = 'calculation_price_form';

    /**
     * @param CalculateResultPrice $calculateService
     */
    public function __construct(private readonly CalculateResultPrice $calculateService) {

    }

    #[Route("/form", name:"app_form_page")]
    public function index(Request $request): Response
    {
        $form = $this->createForm(CalculationPriceType::class);
        $form->handleRequest($request);

        $renderParameters = [
            self::FORM_NAME => $form->createView(),
        ];

        if ($form->isSubmitted() && $form->isValid()) {
            $taxNumber = $form['tax_number']->getData();
            $selectedProduct = $form['product']->getData();
            $renderParameters['calculated_result'] = $this->calculateService
                ->calculateResult($taxNumber, $selectedProduct);
        }

        return $this->render(self::FORM_TEMPLATE,
            $renderParameters
        );
    }
}
