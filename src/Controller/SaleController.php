<?php

namespace App\Controller;

use App\Entity\Sale;
use App\Form\SaleType;
use App\Repository\ProductRepository;
use App\Repository\SaleRepository;
use App\Repository\UserRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sales")
 */
class SaleController extends AbstractController
{
    /**
     * @Route("/", name="sale_index", methods={"GET"})
     * @param SaleRepository $saleRepository
     * @param UserRepository $userRepository
     * @param ProductRepository $productRepository
     * @return Response
     */
    public function index(
        SaleRepository $saleRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository
    ): Response
    {
        $sales = $saleRepository->findAll();
        $result = [];

        foreach ($sales as $sale) {
            $user = $userRepository->findOneBy(['id' => $sale->getUser()]);
            $product = $productRepository->findOneBy(['id' => $sale->getProduct()]);
            $result[] = ['sale' => $sale, 'user' => $user, 'product' => $product];
        }

        return $this->render('sale/index.html.twig', [
            'salesInfo' => $result,
        ]);
    }

    /**
     * @Route("/new", name="sale_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $sale = new Sale();
        $form = $this->createForm(SaleType::class, $sale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sale);
            $entityManager->flush();

            return $this->redirectToRoute('sale_index');
        }

        return $this->render('sale/new.html.twig', [
            'sale' => $sale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sale_show", methods={"GET"})
     * @param Sale $sale
     * @return Response
     */
    public function show(Sale $sale): Response
    {
        return $this->render('sale/show.html.twig', [
            'sale' => $sale,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sale_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Sale $sale
     * @return Response
     */
    public function edit(Request $request, Sale $sale): Response
    {
        $form = $this->createForm(SaleType::class, $sale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sale_index');
        }

        return $this->render('sale/edit.html.twig', [
            'sale' => $sale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sale_delete", methods={"DELETE"})
     * @param Request $request
     * @param Sale $sale
     * @return Response
     */
    public function delete(Request $request, Sale $sale): Response
    {
        if ($this->isCsrfTokenValid('delete' . $sale->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sale_index');
    }

    /**
     * @Route("/ajax-new", name="ajax_sale_new", methods={"GET","POST"})
     * @param Request $request
     * @param ProductRepository $productRepository
     * @param UserRepository $userRepository
     * @return Response
     * @throws Exception
     */
    public function ajaxNew(
        Request $request,
        ProductRepository $productRepository,
        UserRepository $userRepository
    ): Response {
        $userId = $request->get('user_id');
        $productId = $request->get('product_id');
        $orderedQty = $request->get('ordered_qty');
        $saledPrice = $request->get('saled_price');

        try {
            $user = $userRepository->findOneBy(['id' => $userId]);
            $product = $productRepository->findOneBy(['id' => $productId]);
            $totalPrice = (float)$saledPrice * (float)$orderedQty;

            $sale = new Sale();
            $sale
                ->setUser($user)
                ->setProduct($product)
                ->setSaledPrice($totalPrice)
                ->setSaledQty($orderedQty)
                ;

            $productQty = (int)$product->getQty() - (int)$orderedQty;
            $product->setQty($productQty);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sale);
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->json("User {$user->getFirstName()} {$user->getLastName()} bought $orderedQty {$product->getSku()}");
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
