<?php

namespace AppBundle\Controller;

use AppBundle\Form\usersikillsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;

use FOS\UserBundle\Model\UserInterface;

class userskillsController extends Controller
{
    /**
     * @Route("/addskill", name="addskill")
     */
    public function addAction(Request $request)
    {
        $user=$this->getUser();


        $form=$this->createForm(usersikillsType::class);

        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
           $em=$this->getDoctrine()->getManager();
            $skillName = $form['Skills']->getData();



            if ( !$user->getSkills()->contains($skillName) ){

            $user->addSkill($skillName);

            $em->persist($user);
            $em->flush();





            $id=$user->getId();
            $userdata = $this -> getDoctrine()->getRepository('AppBundle:User')->find($id);
            $skills=$userdata->getSkills();


            return $this->render('@FOSUser/Profile/show.html.twig', array(
                'user' => $user,
                'skills'=>$skills

            ));
        }
        }
       $formView =$form->createView();

        return $this->render('@FOSUser/add.html.twig', array(
         'form'=>$formView

        ));


    }
    /**
     * @Route("/deleteskill/{id}", name="skill_delete")
     */
    public function deleteAction($id)
    {
        $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $skill=$em->getRepository('AppBundle:skill')->find($id);
        $user->removeskill($skill);
        $em->persist($user);
        $em->flush();


        $iduser=$user->getId();
        $userdata = $this -> getDoctrine()->getRepository('AppBundle:User')->find($iduser);
        $skills=$userdata->getSkills();


        return $this->render('@FOSUser/Profile/show.html.twig', array(
            'user' => $user,
            'skills'=>$skills

        ));

    }

}
