<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commodity', 'entity', ['class' => 'AppBundle\Entity\Commodity', 'property' => 'name'])
            ->add('station', 'entity', ['class' => 'AppBundle\Entity\Station', 'property' => 'name'])
            ->add('sell')
            ->add('buy')
            ->add('demand')
            ->add('supply')
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
