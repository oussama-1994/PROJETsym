<?php
/**
 * Created by PhpStorm.
 * User: Lenovo2018
 * Date: 07/10/2018
 * Time: 16:30
 */

namespace AppBundle\Form;

use AppBundle\Entity\skill;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class usersikillsType extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Skills',EntityType::class,array(
            'class'=>'AppBundle\Entity\skill',
            'choice_label'=>'name',
            'expanded'=>false,
            'multiple'=>false,
            'mapped'=>false,
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\skill',
        ));
    }


}