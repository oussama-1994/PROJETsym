<?php
/**
 * Created by PhpStorm.
 * User: Lenovo2018
 * Date: 26/09/2018
 * Time: 01:04
 */

namespace AppBundle\Form;
use FOS\UserBundle\Controller\RegistrationController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProRegistrationType extends AbstractType
{

     public function buildForm(FormBuilderInterface $builder, array $options)
     {
         parent::buildForm($builder, $options);
         $builder
             ->add('entreprise')
         ->add('image', FileType::class, array('label' => 'Photo','data_class' => null, 'required'=> false));
     }


    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_pro_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }

}