<?php

namespace Palicao\Bundle\RsvpBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactFilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
            ->add('email', 'filter_text')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => 'Palicao\Bundle\RsvpBundle\Entity\Contact',
            'csrf_protection'   => false,
            'validation_groups' => array('filter'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'contact_filter';
    }
}
