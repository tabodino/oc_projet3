<?php

namespace OC\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           // ->add('codeReservation')
            ->add('dateReservation', DateType::class, array(
               'widget' => 'single_text',
               'format' => 'yyyy-MM-dd',
             ))
            ->add('fullDay', ChoiceType::class, array(
                'placeholder' => '',
                'choices' => array(
                    'demi-journée' => 0,
                    'journée entière' => 1,
                ),
            ))
            ->add('reduced', CheckboxType::class, array(
                'label' => "Je dispose d'une réduction *",
                'required' => false,
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\CoreBundle\Entity\Ticket'
        ));
    }
}
