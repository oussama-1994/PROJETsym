<?php
/**
 * Created by PhpStorm.
 * User: Lenovo2018
 * Date: 01/10/2018
 * Time: 20:55
 */


namespace AppBundle\Form;
use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ProProfileFormType extends BaseType





{

    public function __construct()
    {

    }





    public function buildUserForm(FormBuilderInterface $builder, array $options){
        parent::buildUserForm($builder, $options);

        // custom field
        $builder
            ->add('headline')
            ->add('location')
            ->add('entreprise')
            ->add('image', FileType::class, array('label' => 'Photo','data_class' => null, 'required'=> false))


        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'fos_user_profile_edit';
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
            ]
        );
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }

}