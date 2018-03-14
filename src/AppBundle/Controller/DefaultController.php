<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Annonce;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("create", name="createpage")
     */
    public function createAction(Request $request)
    {
        return $this->render('default/create.html.twig');
    }


    /**
     * @Route("store", name="storepage")
     */
     public function storeAction(Request $request)
        {
            $entityManager = $this->getDoctrine()->getManager();
            $annonce = new Annonce();
            $annonce-> setTitre($request->request->get('titre'));
            $annonce->setDescription($request->request->get('description'));
            $annonce->setPrix($request->request->get('prix'));
            $annonce->setImage($request->request->get('image'));

            $entityManager->persist($annonce);
            $entityManager->flush();
            var_dump($annonce);

            return $this->redirectToRoute('annoncespage');

        }

        /**
     * @Route("annonces", name="annoncespage")
     */
    public function annoncesAction()
    {
         $repository = $this->getDoctrine()->getRepository('AppBundle\Entity\Annonce');
        $annonces = $repository->findAll();

        
        return $this->render('default/annonces.html.twig', [
    
            'annonces' => $annonces
        ]);
    }    
        /**
     * @Route("/annonce/{id}", name="annoncepage", requirements={"id"="\d+"})
     */
        public function annonceAction($id)
        {
           $repository = $this->getDoctrine()->getRepository('AppBundle\Entity\Annonce');
           $annonce = $repository->find($id);

           return $this->render('default/annonce.html.twig', [
    
            'annonce' => $annonce
            
           ]);
            
        }





}
