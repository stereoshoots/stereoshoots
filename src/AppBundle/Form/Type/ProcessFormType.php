<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProcessFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	$builder->add('title', 'text');
	$builder->add('description', 'textarea');
    }

    public function getName()
    {
        return 'app_photo_process';
    }
}