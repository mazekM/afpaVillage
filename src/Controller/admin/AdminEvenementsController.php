<?php
namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\EvenementsRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Evenements;
use App\Form\EvenementType;
// use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;

class AdminEvenementsController extends AbstractController {

    /**
     * @var EvenementsRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(EvenementsRepository $repository, ObjectManager $em)
    {
        $this->repository=$repository;
        $this->em=$em;
    }

    /**
     * @Route("/admin",name="admin.evenement.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $evenements=$this->repository->findAll();
        return $this->render('admin/evenement/index.html.twig',[
            'evenements'=> $evenements,
            "page_active" => "gestevenements"

        ]);
    }

    /**
     * @Route("/admin/evenement/create", name="admin.evenement.new")
     */
    public function new(Request $request) 
    {
        $evenement=new Evenements();
        $form=$this->createForm(EvenementType::class,$evenement);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($evenement);
            $this->em->flush();
            $this->addFlash('success','L\'événement : ' . $evenement->getTitle() . ' a bien été créé');
            return $this->redirectToRoute('admin.evenement.index');
        }
        
        return $this->render('admin/evenement/new.html.twig', [
            'evenement'   =>$evenement,
            'form'        =>$form->createView(),
            "page_active" => "gestevenements"
            

        ]);
    }

    /**
     * @Route("/admin/evenemen/{id}",name="admin.evenement.edit", methods="GET|POST")
     * @param Evenements $evenement
     * @param Request $request
     * return \Symfony\Component\HttpFoundation\Response
     */
    public function modifier(Evenements $evenement,Request $request)
    {
        $form=$this->createForm(EvenementType::class,$evenement);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success','L\'événement : ' . $evenement->getTitle() . ' a bien été modifié');
            return $this->redirectToRoute('admin.evenement.index');
        }

        return $this->render('admin/evenement/edit.html.twig',
        ['evenement'=>$evenement,
        'form'=>$form->createView(),
        "page_active" => "gestevenements"
        ]);
    }

    /**
     * @Route("/admin/evenemen/{id}",name="admin.evenement.delete",methods="DELETE")
     * @param Evenements $evenement
     * @param Request $request
     * return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Evenements $evenement, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(),$request->get('_token')))
        //dump ('supression');
        $this->em->remove($evenement);
        $this->em->flush();
        $this->addFlash('success','L\'événement : ' . $evenement->getTitle() . ' a bien été supprimé');
        //return new Response('supression');
        return $this->redirectToRoute('admin.evenement.index');
    }
}