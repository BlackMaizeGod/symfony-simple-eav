<?php

namespace App\Form;

use App\Entity\Attribute;
use App\Entity\Orm\ProductAttributeRelation;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductAttributeRelationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'sku',
                'choice_value' => 'id'
            ])
            ->add('attribute', EntityType::class, [
                'class' => Attribute::class,
                'choice_label' => 'code',
                'choice_value' => 'id'
            ])
            ->add('value', TextareaType::class,[
                'attr' => [
                    'rows' => 10,
                    'cols' => 50,
                    'style' => 'resize: none;'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductAttributeRelation::class,
        ]);
    }
}
