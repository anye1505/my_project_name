<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MyBundle\Form\TramiteType;
use MyBundle\Entity\Tramite;

class ComisionType extends AbstractType
{
    public function getParent()
    {
        return 'my_tramite_tramite';
    }
    /**
     * {@inheritdoc}
     */
    /*public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tramite');
    }*/
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Comision'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_comision';
    }


}
