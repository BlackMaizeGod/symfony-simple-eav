<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use App\Service\ProductAttributeService;
use Doctrine\DBAL\DBALException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     * @param Request $request
     * @param UserRepository $userRepository
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     * @param ProductAttributeService $productAttributeService
     * @return Response
     * @throws DBALException
     */
    public function index(
        Request $request,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        ProductAttributeService $productAttributeService
    ): Response {
        $categoryId = $request->get('category_id');
        $products = $categoryId
            ? $categoryRepository->findOneBy(['id' => $categoryId])->getProducts()
            : $productRepository->findAll();

        $bestsellersArray = $productRepository->getBestsellersIds();
        $bestsellers = $productRepository->findBy(['id' => array_keys($bestsellersArray)]);
        foreach ($bestsellers as $bestseller) {
            $saledQty = $bestsellersArray[$bestseller->getId()];
            $bestsellersArray[$bestseller->getId()] = ['product' => $bestseller, 'saled_qty' => $saledQty];
        }

        return $this->render('home_page/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'users' => $userRepository->findAll(),
            'products' => $products,
            'bestsellers' => $bestsellersArray,
            'productAttributeService' => $productAttributeService
        ]);
    }
}
