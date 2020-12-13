<?php

namespace App\Controller;

use App\Entity\Orm\ProductAttributeRelation;
use App\Form\ProductAttributeRelationType;
use App\Repository\AttributeRepository;
use App\Service\ProductAttributeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product-attribute-relations")
 */
class ProductAttributeRelationController extends AbstractController
{
    /**
     * @Route("/", name="product_attribute_relation_index", methods={"GET"})
     * @param ProductAttributeService $productAttributeService
     * @return Response
     */
    public function index(ProductAttributeService $productAttributeService): Response
    {
        return $this->render('product_attribute_relation/index.html.twig', [
            'product_attribute_relations' => $productAttributeService->getRelations(),
        ]);
    }

    /**
     * @Route("/new", name="product_attribute_relation_new", methods={"GET","POST"})
     * @param Request $request
     * @param AttributeRepository $attributeRepository
     * @param ProductAttributeService $productAttributeService
     * @return Response
     */
    public function new(
        Request $request,
        AttributeRepository $attributeRepository,
        ProductAttributeService $productAttributeService
    ): Response {
        $productAttributeRelation = new ProductAttributeRelation();
        $form = $this->createForm(ProductAttributeRelationType::class, $productAttributeRelation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attribute = $attributeRepository->findOneBy(['id' => $form->getData()->getAttribute()->getId()]);
            $type = $attribute->getType()->getType();
            $formattedType = ucfirst($type);

            $entityClass = "App\Entity\Attribute$formattedType";
            $entity = new $entityClass();
            $entity->setAttribute($form->getData()->getAttribute());
            $entity->setEntity($form->getData()->getProduct());
            $entity->setValue($productAttributeService->castData($type,$form->getData()->getValue()));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entity);
            $entityManager->flush();

            return $this->redirectToRoute('product_attribute_relation_index');
        }

        return $this->render('product_attribute_relation/new.html.twig', [
            'product_attribute_relation' => $productAttributeRelation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_attribute_relation_show", methods={"GET"})
     * @param Request $request
     * @param ProductAttributeService $productAttributeService
     * @return Response
     */
    public function show(Request $request, ProductAttributeService $productAttributeService): Response
    {
        return $this->render('product_attribute_relation/show.html.twig', [
            'product_attribute_relation' => $productAttributeService->getAttribute(
                $request->get('type'), $request->get('id')
            )
        ]);
    }

    /**
     * @Route("/{type}/{id}/edit", name="product_attribute_relation_edit", methods={"GET","POST"})
     * @param Request $request
     * @param ProductAttributeService $productAttributeService
     * @return Response
     */
    public function edit(
        Request $request,
        ProductAttributeService $productAttributeService
    ): Response {
        $form = $this->createForm(ProductAttributeRelationType::class);
        $form->handleRequest($request);

        $attribute = $productAttributeService->getAttribute(
            $request->get('type'), $request->get('id')
        );

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $value = $productAttributeService->castData($request->get('type'), $form->getData()->getValue());

            $attribute->setValue($value);
            $entityManager->persist($attribute);
            $entityManager->flush();

            return $this->redirectToRoute('product_attribute_relation_index');
        }

        return $this->render('product_attribute_relation/edit.html.twig', [
            'product_attribute_relation' => $attribute,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{type}/{id}/delete", name="product_attribute_relation_delete", methods={"DELETE"})
     * @param Request $request
     * @param ProductAttributeService $productAttributeService
     * @return Response
     */
    public function delete(
        Request $request,
        ProductAttributeService $productAttributeService
    ): Response {
        $attribute = $productAttributeService->getAttribute(
            $request->get('type'), $request->get('id')
        );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($attribute);
        $entityManager->flush();

        return $this->redirectToRoute('product_attribute_relation_index');
    }
}
