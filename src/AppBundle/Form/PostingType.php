<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Validator\Constraints\Type;

class PostingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commodity', 'entity', ['class' => 'AppBundle\Entity\Commodity', 'property' => 'name'])
            ->add('station', 'entity', ['class' => 'AppBundle\Entity\Station', 'property' => 'name'])
            ->add('sell', 'text', ['constraints' => [new Type('numeric')]])
            ->add('buy', 'text')
            ->add('demand', 'text')
            ->add('supply', 'text')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Posting'
        ));
    }

    public function getName()
    {
        return 'posting';
    }
}
