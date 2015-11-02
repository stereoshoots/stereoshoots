<?php
namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	$builder->add('avatar', 'file', array('required' => false, 'data_class' => null));
	$builder->add('phone', 'text', array('required' => false));
	$builder->add('gender', 'choice', array(
	    'choices'  => array('not specifed' => 'Не указан', 'male' => 'Мужской', 'female' => 'Женский'),
	));
	$builder->add('birthDate', 'date', array('years' => range(date('Y') -100, date('Y'))));
        $builder->add('locationCountry', 'text', array('required' => false));
	$builder->add('locationCity', 'text', array('required' => false));
    }

    public function getParent()
    {
        return 'fos_user_profile';
    }

    public function getName()
    {
        return 'app_user_profile';
    }
}