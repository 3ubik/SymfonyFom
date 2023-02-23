<?php

namespace App\Form;

use App\Entity\CalculationPrice;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class CalculationPriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tax_number', TextType::class)
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => function ($product) {
                    return 'Name:' . $product->getName() . ' Price:' . $product->getPrice();
                }
            ])
            ->add('Calculate', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CalculationPrice::class,
        ]);
    }
}
