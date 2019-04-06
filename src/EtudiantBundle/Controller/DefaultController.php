<?php

namespace EtudiantBundle\Controller;

use EtudiantBundle\Entity\Etudiant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Tests\Fixtures\Entity;
use \DateTime;
class DefaultController extends Controller
{
    /**
     * @Route("/Acceuil")
     */
    public function indexAction()
    {
        return $this->render('index.html.twig');
        //return $this->render('EtudiantBundle:Default:index.html.twig');
    }
    /**
     * @Route("/inscription",
     *       name="inscription"
     *     )
     */
    public function inscriptionAction()
    {

        return $this->render('inscription.html.twig');
        //return $this->render('EtudiantBundle:Default:index.html.twig');
    }

    /**
     * @Route("/ajouteretudiant",
     *       name="ajouteretudiant"
     *     )
     */
    public function AjouterEtudiantAction(Request $request)
    {

        $a = new Etudiant();
        $form = $this->createFormBuilder($a)
            ->add('id',TextType::class,array('label'=>'ID :'))
            ->add('nom', TextType::class,array('label'=>'Nom :'))
            ->add('prenom', TextType::class,array('label'=>'Prénom :'))
            ->add('daten',DateTimeType::class,array('label'=>'Date de naissance:'))

            ->add('ajouter',SubmitType::class,array('attr'=>array('class'=>'btn btn-primary')))

            ->getForm()
        ;
        $form->handleRequest($request);
        if ($form->isValid())
        {
            $a=$form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($a);
            $em->flush();
            return $this->redirect($this->generateUrl('listEtud'));

        }
        //return $this->render('@Produit2/Produit/addProd.html.twig',array( 'form' => $form->createView(),));





        return $this->render('ajouter_etudiant.html.twig');
        //return $this->render('EtudiantBundle:Default:index.html.twig');
    }



    /**
     * @Route("/listEtud",
     *       name="listEtud"
     *     )
     */

    public function listAction()
    {
        $etudiant = $this->getDoctrine()
            ->getManager()
            ->getRepository('EtudiantBundle:Etudiant')
            ->findAll();
        return $this->render('listEtudiant.html.twig', array('listEtud' => $etudiant));
    }

    /**
     * @Route("/AffEtud/{id}",
     *       name="AffEtud",
     *     requirements={"id":"\d+"
     * }
     *     )
     */
    public function AffEtudAction($id)
    {

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('EtudiantBundle:Etudiant')
        ;

        $a = $repository->find($id);

        if (null === $a) {
            throw new NotFoundHttpException("L'étudiant avec l'Id ".$id." n'existe pas.");
        }
        return $this->render('AffEtud.html.twig', array( 'etudiant' => $a));
    }

    /**
     * @Route("/MajEtud/{id}",
     *       name="MajEtud",
     *     requirements={"id":"\d+"
     * }
     *     )
     */
    public function MajEtudAction($id, Request $request)
    {
        $a = $this->getDoctrine()
        ->getManager()
        ->getRepository('EtudiantBundle:Etudiant')
        ->find($id);
        $form = $this->createFormBuilder($a)
            ->add('id',TextType::class,array('label'=>'ID :'))
            ->add('nom', TextType::class,array('label'=>'Nom :'))
            ->add('prenom', TextType::class,array('label'=>'Prénom :'))
            ->add('dateN',Datetime::class,array('label'=>'Date de naissance:'))
            ->add('modifier',SubmitType::class,array('attr'=>array('class'=>'btn btn-primary')))
            ->getForm()
        ;
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($a);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice','Etudiant bien enregistré.');
            return $this->redirect($this->generateUrl('AffEtud', array('id' => $a->getId())));
        }
        return $this->render('MajEtudiant.html.twig',array('form' => $form->createView(),'Etudiant'=>$a
        ));
    }

    /**
     * @Route("/SuppEtud/{id}",
     *       name="SuppEtud",
     *     requirements={"id":"\d+"
     * }
     *     )
     */

    public function SuppEtudAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository('EtudiantBundle:Etudiant')->find($id);
        $em->remove($a);
        $em->flush();
        if ($a == null) {
            throw $this->createNotFoundException("L'etudiant avec l'ID".$id." n'existe pas.");
        }
        $request->getSession()->getFlashBag()->add('info', 'Etudiant supprimé.');
        return $this->redirect($this->generateUrl('listEtud'));
    }
}
