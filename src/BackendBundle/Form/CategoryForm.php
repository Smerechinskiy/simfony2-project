<?php
namespace   BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $category, array $options)
    {
        $category->add('name', 'text', array('label' => 'Название категории:'))
            ->add('description', 'textarea', array('label' => 'Описание:'))
            ->add('button', 'submit', array('attr' => array('class' => 'btn btn-save'), 'label' => 'Сохранить'));
    }

    public function getName()
    {
        return 'name';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Category',
        ));
    }

}
