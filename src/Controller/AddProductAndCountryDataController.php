<?php

namespace App\Controller;

use App\Entity\Country;
use App\Entity\Product;
use App\Form\CountryType;
use App\Form\ProductType;
use App\Repository\CountryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddProductAndCountryDataController extends AbstractController
{
    private const SUCCES_PRODUCT_MESSAGE = 'Product added Successfully';

    private const SUCCES_COUNTRY_MESSAGE = 'Country added Successfully';

    private const FORM_TEMPLATE = 'addData/index.html.twig';

    /**
     * @param ProductRepository $productRepository
     * @param CountryRepository $countryRepository
     */
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly CountryRepository $countryRepository)
    {
    }

    /**
     * @param Request $request
     * @return Response
     */
    #[Route('/addData', name: 'addData')]
    public function index(Request $request): Response
    {
        $product = new Product();
        $country = new Country();

        $productForm = $this->createForm(ProductType::class, $product);
        $countryForm = $this->createForm(CountryType::class, $country);

        $message = null;

        $productForm->handleRequest($request);
        if ($productForm->isSubmitted() && $productForm->isValid()) {
            $this->productRepository->add($product, true);
            $message = self::SUCCES_PRODUCT_MESSAGE;
        }

        $countryForm->handleRequest($request);
        if ($countryForm->isSubmitted() && $countryForm->isValid()) {
            $this->countryRepository->add($country, true);
            $message = self::SUCCES_COUNTRY_MESSAGE;
        }

        $renderParameters = [
            'add_product_form' => $productForm->createView(),
            'add_country_form' => $countryForm->createView(),
        ];

        if(isset($message)){
            $renderParameters['message'] = $message;
        }
        return $this->render(self::FORM_TEMPLATE, $renderParameters);

    }
}
