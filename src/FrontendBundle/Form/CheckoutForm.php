<?php
namespace   FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CheckoutForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $checkout, array $options)
    {
        $checkout->add('name', 'text', array('label' => 'Ваше имя:'))
            ->add('city', 'text', array('label' => 'Город:'))
            ->add('address', 'text', array('label' => 'Адрес доставки:'))
            ->add('telephone', 'text', array('label' => 'Номер телефона:'))
            ->add('annotation', 'textarea', array('label' => 'Примечание:', 'required' => false))
            ->add('button', 'submit', array('attr' => array('class' => 'btn btn-success right checkout'), 'label' => 'Оформить заказ'));
    }

    public function getName()
    {
        return 'name';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Order',
        ));
    }

}
