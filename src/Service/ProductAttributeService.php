<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\AttributeIntRepository;
use App\Repository\AttributeDecimalRepository;
use App\Repository\AttributeVarcharRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class ProductAttributeService
{
    /**
     * @var AttributeIntRepository
     */
    private $attributeIntRepository;

    /**
     * @var AttributeDecimalRepository
     */
    private $attributeDecimalRepository;

    /**
     * @var AttributeVarcharRepository
     */
    private $attributeVarcharRepository;

    /**
     * ProductAttributeService constructor.
     * @param AttributeIntRepository $attributeIntRepository
     * @param AttributeDecimalRepository $attributeDecimalRepository
     * @param AttributeVarcharRepository $attributeVarcharRepository
     */
    public function __construct(
        AttributeIntRepository $attributeIntRepository,
        AttributeDecimalRepository $attributeDecimalRepository,
        AttributeVarcharRepository $attributeVarcharRepository
    ) {

        $this->attributeIntRepository = $attributeIntRepository;
        $this->attributeDecimalRepository = $attributeDecimalRepository;
        $this->attributeVarcharRepository = $attributeVarcharRepository;
    }

    /**
     * @return array
     */
    public function getRelations(): array
    {
        $relations = array_merge($this->attributeIntRepository->findAll(), $this->attributeDecimalRepository->findAll());
        $relations = array_merge($relations, $this->attributeVarcharRepository->findAll());

        return $relations;
    }

    /**
     * @param $type
     * @param $id
     * @return object|null
     */
    public function getAttribute($type, $id): ?object
    {
        $repository = $this->getRepository($type);

        return $repository->findOneBy(['id' => $id]);
    }

    public function castData($type, $value)
    {
        switch ($type) {
            case 'decimal':
                $castedValue = (float)$value;
                break;
            case 'int':
                $castedValue = (int)$value;
                break;
            default:
                $castedValue = $value;
                break;
        }

        return $castedValue;
    }

    /**
     * @param $productId
     * @return array
     */
    public function getAttributesValueListByProductId($productId): array
    {
        $relations = array_merge(
            $this->attributeIntRepository->findBy(['entity' => $productId]),
            $this->attributeDecimalRepository->findBy(['entity' => $productId])
            );
        $relations = array_merge($relations, $this->attributeVarcharRepository->findBy(['entity' => $productId]));

        return $relations;
    }

    /**
     * @param $type
     * @return ServiceEntityRepository
     */
    private function getRepository($type): ServiceEntityRepository
    {
        $repository = $this->attributeIntRepository;

        switch ($type) {
            case 'decimal':
                $repository = $this->attributeDecimalRepository;
                break;
            case 'varchar':
                $repository = $this->attributeVarcharRepository;
                break;
            default:
                break;
        }

        return $repository;
    }

}