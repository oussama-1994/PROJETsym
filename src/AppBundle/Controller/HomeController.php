<?php

namespace AppBundle\Controller;

use AppBundle\Form\searchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/home/")
     */
    public function homeAction()
    {


        $authChecker = $this->container->get('security.authorization_checker');

        $user = $this->getUser();


        $em = $this->getDoctrine()->getManager();

        $internships = $em->getRepository('AppBundle:internship')->findAll();

        if ($authChecker->isGranted('ROLE_PRO')) {
            return $this->render('@FOSUser/Profile/pro_home.html.twig', array(
                'user' => $user,
                'internships'=> $internships,

            ));
        } else if ($authChecker->isGranted('ROLE_USER')) {
            return$this->render('@FOSUser/Profile/home.html.twig', array(
                'user' => $user,
                'internships'=> $internships,


            ));
        } else { return $this->render('@FOSUser/Profile/admin_home.html.twig', array(
            'user' => $user,


        ));
        }



    }



    /**
     * @Route("/recherche", name="recherche")
     */
    public function searchAction(Request $request)
    {
        $user=$this->getUser();


        $form=$this->createForm(searchType::class);

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





}
