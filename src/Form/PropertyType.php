<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ["required" => true])
            ->add('description')
            ->add('surface')
            ->add('surfaceTer')
            ->add('rooms')
            ->add('bedrooms')
            ->add('energy_class', ChoiceType::class, [
                "choices" => $this->getChoices(Property::ENERGY)
            ])
            ->add('adress')
            ->add('zip_code')
            ->add('sold')
            ->add('city')
            ->add('price')
            ->add('type', ChoiceType::class, [
                "choices" => $this->getChoices(Property::TYPE)
            ])
            ->add('heat', ChoiceType::class, [
                "choices" => $this->getChoices(Property::HEAT)
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoices(array $tab)
    {
        $choices = $tab;
        $output = [];
        foreach ($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }
}
