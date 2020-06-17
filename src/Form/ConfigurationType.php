<?php

namespace App\Form;

use App\Entity\Configuration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('email')
            ->add('phone')
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
            ->add('style', ChoiceType::class, [
                "choices" => $this->getChoices(Configuration::STYLE)
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Configuration::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoices(array $tab)
    {
        $choices = $tab;
        $output = [];
        foreach ($choices as $k => $v) {
            $output[$k] = $v;
        }
        return $output;
    }
}
