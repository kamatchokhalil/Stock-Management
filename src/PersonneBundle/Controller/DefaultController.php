<?php

namespace PersonneBundle\Controller;

use PersonneBundle\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/personne", name="personne")
     */
    public function indexAction()
    {
        return $this->render('PersonneBundle:Default:index.html.twig');
    }

    /**
     * @Route("/apropos/{nom}", name="apropos", defaults={"nom":"123"})
     */

    public function aproposAction($nom)
    {
        return $this->render('personne/apropos.html.twig',array('nom'=>$nom));
    }
    /**
     * @Route("/objet", name="objet")
     */
    public function index_bonjourAction()
    {
        $person= new Personne();
        $person->setAge(27);
        $person->setNom("Oueslati Ahmed Khalil ");
        return $this->render('personne/objet.html.twig',array('person'=>$person));
    }
    /**
     * @Route("/bio/{name}/{age}", name="bio")
     */
    public function bioAction($name,$age)
    {
        $bio= new Personne();
        $bio->setNom($name);
        $bio->setAge($age);

        return $this->render('personne/objet.html.twig',array('bio'=>$bio,'comment'=>"Manuplé par moi meme",'tab'=>array('x'=>20,'y'=>10)));
    }
    /**
     * @Route("/Personne/{_locale}/{nom}/{age}.{_format}, name='Personne',
     * default={"_format":"html"},
     *     requirements={"_locale":"en|fr","_format":"html|xml","age":"\d+"})
     */

   /* public function monAction($nom,$age,$_locale)
    {
        $person = new Personne();
        $person->setNom($nom);
        $person->setAge($age);
        $person->setEmail("oueslati.Ahmedkhalil@gmail.com");
        $em=$this->getDodtrine()->getManager();
        $em->persist($person);
        $em->flush();
        if($_locale=="fr")
        {
            return $this->render('personne/test.html.twig',array('id'=>$person->getId(),'c'=>"Personne"));
        }
     /*   else
        {
            return $this->render ( 'personne/index.html.twig',array());
        }
   }
*/


}
