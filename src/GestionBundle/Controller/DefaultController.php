<?php

namespace GestionBundle\Controller;

use GestionBundle\Entity\Authentification;
use GestionBundle\Entity\fournisseur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GestionBundle\Entity\produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/Home")
     */
    public function indexAction()
    {
        return $this->render('accueil.html.twig');

    }

    /**
     * @Route("/PageAccueil")
     */
    public function PageAccueilAction()
    {
        return $this->render('Home.html.twig');

    }

    /**
     * @Route("/prod", name="prod")
     */
    public function prodAction()
    {
        return $this->render('accueilProd.html.twig');

    }

    /**
     * @Route("/four", name="four")
     */
    public function fourAction()
    {
        return $this->render('accueilFour.html.twig');

    }

    /**
     * @Route("/inscription",
     *       name="inscription"
     *     )
     */
    public function inscriptionAction()
    {

        return $this->render('inscription.html.twig');

    }

    /**
     * @Route("/ajouterprod",
     *       name="ajouterprod"
     *     )
     */
    public function ajouterprodAction(Request $request)
    {

        $a = new produit();
        $form = $this->createFormBuilder($a)
            // ->add('id',TextType::class,array('label'=>'ID :'))
            ->add('code', TextType::class, array('label' => 'code :'))
            ->add('designation', TextType::class, array('label' => 'Désignation :'))
            ->add('quantite', TextType::class, array('label' => 'Quantité:'))
            ->add('fournisseur', EntityType::class, array('label' => 'fournisseur:', 'class' => 'GestionBundle:fournisseur'
            , 'choice_label' => 'raisonsociale', 'multiple' => false,))
            ->add('ajouter', SubmitType::class, array('attr' => array('class' => 'btn btn-primary')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $a = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($a);
            $em->flush();
            return $this->redirect($this->generateUrl('listProd'));

        }
        return $this->render('addProd.html.twig', array('form' => $form->createView(),));
    }


    /**
     * @Route("/listProd",
     *       name="listProd"
     *     )
     */

    public function listProdAction()
    {
        $prod = $this->getDoctrine()
            ->getManager()
            ->getRepository('GestionBundle:produit')
            ->findAll();
        return $this->render('@Gestion/Produit/listProd.html.twig', array('listProd' => $prod));
    }




    /**
     * @Route("/AffProd/{id}",
     *       name="AffProd",
     *     requirements={"id":"\d+"
     * }
     *     )
     */
    public function AffProdAction($id)
    {

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('GestionBundle:produit');

        $a = $repository->find($id);

        if (null === $a) {
            throw new NotFoundHttpException("Le produit avec l'Id " . $id . " n'existe pas.");
        }
        return $this->render('AffProd.html.twig', array('produit' => $a));
    }

    /**
     * @Route("/MajProd/{id}",
     *       name="MajProd",
     *     requirements={"id":"\d+"
     * }
     *     )
     */
    public function MajProdAction($id, Request $request)
    {
        $a = $this->getDoctrine()
            ->getManager()
            ->getRepository('GestionBundle:produit')
            ->find($id);
        $form = $this->createFormBuilder($a)
            // ->add('id',TextType::class,array('label'=>'ID :'))
            ->add('code', TextType::class, array('label' => 'code :'))
            ->add('designation', TextType::class, array('label' => 'Désignation :'))
            ->add('quantite', TextType::class, array('label' => 'Quantité:'))
            ->add('fournisseur', EntityType::class, array('label' => 'fournisseur:', 'class' => 'GestionBundle:fournisseur'
            , 'choice_label' => 'raisonsociale', 'multiple' => false,))
            ->add('modifier', SubmitType::class, array('attr' => array('class' => 'btn btn-primary')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($a);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Produit enregistré.');
            return $this->redirect($this->generateUrl('AffProd', array('id' => $a->getId())));
        }
        return $this->render('MajProd.html.twig', array('form' => $form->createView(), 'Produit' => $a
        ));
    }

    /**
     * @Route("/SuppProd/{id}",
     *       name="SuppProd",
     *     requirements={"id":"\d+"
     * }
     *     )
     */

    public function SuppProdAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository('GestionBundle:produit')->find($id);
        $em->remove($a);
        $em->flush();
        if ($a == null) {
            throw $this->createNotFoundException("Le produit avec l'ID" . $id . " n'existe pas.");
        }
        $request->getSession()->getFlashBag()->add('info', 'Produit supprimé.');
        return $this->redirect($this->generateUrl('listProd'));
    }


    /**
     * @Route("/chercheProd",
     *       name="chercheProd"
     *     )
     */
    public function chercheAction(Request $request)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('GestionBundle:produit');
        $value = $request->get("designation");

        $liste = $repository->findBy(array('designation' => $value));

        return $this->render('AffProdCherche.html.twig', array('produit' => $liste));

    }

    /**
     * @Route("/ajouterFour",
     *       name="ajouterFour"
     *     )
     */
    public function ajouterFourAction(Request $request)
    {
        $a = new fournisseur();
        $form = $this->createFormBuilder($a)
            ->add('code',TextType::class,array('label'=>'Code :'))
            ->add('raisonsociale', TextType::class,array('label'=>'Raison sociale :'))

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
            return $this->redirect($this->generateUrl('listFour'));

        }
        return $this->render('@Gestion/Fournisseur/addFour.html.twig',array( 'form' => $form->createView(),));
    }


    /**
     * @Route("/listFour",
     *       name="listFour"
     *     )
     */

    public function listFourAction()
    {

        $four = $this->getDoctrine()
            ->getManager()
            ->getRepository('GestionBundle:fournisseur')
            ->findAll();

        return $this->render('@Gestion/Fournisseur/listFour.html.twig', array('listFour' => $four));
    }

    /**
     * @Route("/AffFour/{id}",
     *       name="AffFour",
     *     requirements={"id":"\d+"
     * }
     *     )
     */
    public function AffFourAction($id)
    {

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('GestionBundle:fournisseur')
        ;

        $a = $repository->find($id);

        if (null === $a) {
            throw new NotFoundHttpException("Fournisseur Introuvable selon l'ID".$id);
        }
        return $this->render('@Gestion/Fournisseur/AffFour.html.twig',
            array( 'four' => $a
            ));
    }

    /**
     * @Route("/MajFour/{id}",
     *       name="MajFour",
     *     requirements={"id":"\d+"
     * }
     *     )
     */
    public function MajFourAction($id, Request $request)
    {
        $a = $this->getDoctrine()
            ->getManager()
            ->getRepository('GestionBundle:fournisseur')
            ->find($id)
        ;

        $form = $this->createFormBuilder($a)
            ->add('code',TextType::class,array('label'=>'Code :'))
            ->add('raisonsociale', TextType::class,array('label'=>'Raison Sociale :'))

            ->add('modifier',SubmitType::class,array('attr'=>array('class'=>'btn btn-primary')))

            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($a);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice',
                'Fournisseur bien enregistré.');

            return $this->redirect($this->generateUrl('AffFour',
                array('id' => $a->getId())));
        }

        return $this->render('@Gestion/Fournisseur/MajFour.html.twig',array('form' => $form->createView(),'four'=>$a
        ));
    }

    /**
     * @Route("/SuppFour/{id}",
     *       name="SuppFour",
     *     requirements={"id":"\d+"
     * }
     *     )
     */

    public function deleteCategAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository('GestionBundle:fournisseur')->find($id);
        $em->remove($a);
        $em->flush();
        if ($a == null) {
            throw $this->createNotFoundException("Fournisseur ".$id." introuvable.");
        }
        $request->getSession()->getFlashBag()->add('info', 'Fournisseur supprimé.');
        return $this->redirect($this->generateUrl('listFour'));
    }


    /**
     * @Route("/chercheFour",
     *       name="chercheFour"
     *     )
     */
    public function chercheFourAction(Request $request)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('GestionBundle:fournisseur');
        $value = $request->get("raisonsociale");

        $liste = $repository->findBy(array('raisonsociale' => $value));

        return $this->render('AffFourCherche.html.twig', array('four' => $liste));

    }

    /**
     * @Route("/cherchefourprod/",
     *       name="cherchefourprod"
     *     )
     */

    public function cherchefourprodAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('GestionBundle:fournisseur')  ;
        $value = $request->get("id");

        $liste = $repository->findBy(array('id' => $value));


        $listProds = $em
            ->getRepository('GestionBundle:produit')
            ->findBy(array('fournisseur' => $liste))   ;

        return $this->render('AffListFourProd.html.twig', array(
            'four'=>$liste ,
            'produits' => $listProds
        ));
    }

    /**
     * @Route("/authentification",
     *       name="authentification"
     *     )
     */
    public function authentificationAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('GestionBundle:Authentification')  ;
        $valuelog = $request->get("login");
        $login = $repository->findBy(array('login' => $valuelog));


        if($login==null)
        {
            return $this->render('inscription.html.twig');
        }
        else
        {
            return $this->render('Home.html.twig');
        }



    }
}