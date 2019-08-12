<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Apply;
use AppBundle\Entity\internship;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;


class internshipController extends Controller
{
    /**
     * Lists all internship entities.
     *
     * @Route("internship/", name="internship_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $internships = $em->getRepository('AppBundle:internship')->findAll();

        return $this->render('internship/index.html.twig', array(
            'internships' => $internships,
        ));
    }

    /**
     * Creates a new internship entity.
     *
     * @Route("internship/new", name="internship_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {    $user = $this->getUser();

        $internship = new Internship();
        $form = $this->createForm('AppBundle\Form\internshipType', $internship);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $file=$internship->getImage();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('images_directory'),$fileName
            );
            $internship->setImage($fileName);

            $publisher=$user->getImage();

            $internship->setUserpicture($publisher);

             $location=$user->getLocation();
            $internship->setUserlocation($location);



            $now = new\DateTime('now');
            $internship->setDate($now);
            $internship->setUser($user);
            $entreprise=$user->getEntreprise();
            $internship->setEntrepriseName($entreprise);




            $em = $this->getDoctrine()->getManager();
            $em->persist($internship);
            $em->flush();





            $id=$user->getId();

            $userdata = $this -> getDoctrine()
                ->getRepository('AppBundle:User')
                ->find($id);
            $internships=$userdata->getInternships();

            return $this->render('@FOSUser/Profile/pro_show.html.twig', array(
                'user' => $user,
                'internships'=> $internships,

            ));
        }


        $formView =$form->createView();

        return $this->render('@FOSUser/Profile/new_inter.html.twig', array(
            'form'=>$formView,
            'internship' => $internship

        ));

    }


    /**
     * Displays a form to edit an existing internship entity.
     *
     * @Route("internship/{id}/edit", name="internship_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, internship $internship)
    {

        $editForm = $this->createForm('AppBundle\Form\internshipType', $internship);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file=$internship->getImage();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('images_directory'),$fileName
            );
            $internship->setImage($fileName);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('internship_details', array('id' => $internship->getId()));
        }

        return $this->render('@FOSUser/Profile/edit_intern.html.twig', array(
            'internship' => $internship,
            'edit_form' => $editForm->createView(),

        ));
    }


    /**
     * @Route("internship/{id}", name="internship_delete")
     */
    public function deleteAction($id)

    {
        $em = $this->getDoctrine()->getManager();
        $internship=$em->getRepository('AppBundle:internship')->find($id);
        $em->remove($internship);
        $em->flush();

        return $this->redirectToRoute('fos_pro_profile_show');
    }




    /**
     * @Route("internship/details/{id}", name="internship_details")
     */
    public function detailsAction($id)

    {       $internship = $this -> getDoctrine()
        ->getRepository('AppBundle:internship')
        ->find($id);
        $user = $this->getUser();
        $users=$internship->getUsers();

        return $this->render('@FOSUser/Profile/details_intern.html.twig',array(
            'user' => $user,
            'internship'=>$internship,
            'users'=>$users
        ));
    }



    /**
     * @Route("internship/seekers/{id}", name="seekers")
     */
    public function seekersAction($id)

    {       $internship = $this -> getDoctrine()
        ->getRepository('AppBundle:internship')
        ->find($id);
        $user = $this->getUser();
        $users=$internship->getUsers();

        return $this->render('@FOSUser/Profile/seekers.html.twig',array(
            'user' => $user,
            'internship'=>$internship,
            'users'=>$users
        ));
    }

    /**
     * @Route("internship/postule/{id}", name="internship_postule")
     */
    public function postuleAction($id)

    {


        $internship = $this -> getDoctrine()
        ->getRepository('AppBundle:internship')
        ->find($id);

        $user = $this->getUser();
        $user->addAppliedInternship($internship);

        $em=$this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();




        return $this->redirectToRoute('fos_user_profile_show');
    }




    /**
     * @Route("internship/cancel/{id}", name="internship_cancel")
     */
    public function cancelAction($id)

    {

        $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $internship = $this -> getDoctrine()->getRepository('AppBundle:internship')->find($id);
        $user->removeAppliedInternship($internship);
        $em->persist($user);
        $em->flush();




        return $this->redirectToRoute('fos_user_profile_show');
    }




}
