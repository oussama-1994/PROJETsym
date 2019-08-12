<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/add")
     */
    public function addAction()
    {


        return $this->render('AppBundle:Security:user_home.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/profil")
     */
             public function redirectAction()
        {



        $authChecker = $this->container->get('security.authorization_checker');

        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $skills = $em->getRepository('AppBundle:skill')->findAll();

            $id=$user->getId();
            $userdata = $this -> getDoctrine()
                ->getRepository('AppBundle:User')
                ->find($id);
            $internships=$userdata->getInternships();


        if ($authChecker->isGranted('ROLE_PRO')) {
            return $this->render('@FOSUser/Profile/pro_show.html.twig', array(
                'user' => $user,
                'internships'=> $internships,

            ));
        } else if ($authChecker->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('fos_user_profile_show');

        } else { return $this->render('@FOSUser/Security/admin_home.html.twig', array(
            'user' => $user,
            'skills' => $skills,

        ));
            }
    }

}
