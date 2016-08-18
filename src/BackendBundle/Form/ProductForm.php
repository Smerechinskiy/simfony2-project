<?php
namespace   BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $product, array $options)
    {
        $product->add('file', 'file', array('label' => 'Изображение:', 'required' => false))
            ->add('name', 'text', array('label' => 'Название продукта:'))
            ->add('description', 'textarea', array('label' => 'Описание:'))
            ->add('category', 'entity', array('label' => 'Категория:', 'class' => 'BackendBundle:Category', 'placeholder' => '', 'property' => 'name', 'expanded' => false, 'multiple' => false, 'required' => false))
            ->add('quantity', 'integer', array('label' => 'Порция (г.):'))
            ->add('price', 'money', array('currency' => 'UAH', 'label' => 'Цена:'))
            ->add('button', 'submit', array('attr' => array('class' => 'btn btn-save'), 'label' => 'Сохранить'));
    }

    public function getName()
    {
        return 'product';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Product',
        ));
    }

}
