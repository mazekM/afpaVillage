<?php
namespace App\Controller\pages;

/**
 * Description of ShowEvenementController
 *
 * @author Stagiaire
 */
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Evenements;
use App\Form\ContactType;
use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use App\Notification\ContactNotification;
use App\Repository\EvenementsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\EvenementsSearch;
use App\Form\EvenementsSearchType;

class EvenementsController Extends AbstractController
{
    private $repository;

    private $em;

    public function __construct(EvenementsRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    
    
    
    /**
     * @Route("/evenements", name="evenements")
     */
    
    public function listeEvenementsAction(PaginatorInterface $paginator, Request $request): Response
    {
        $search=new EvenementsSearch;
        $form=$this->createForm(EvenementsSearchType::class, $search);
        $form->handleRequest($request);
        //$evenements=$this->getDoctrine()->getRepository(Evenements::class)->findAll();//findInFutureEvents();
        $evenements=$paginator->paginate($this->repository->findIdIntervalEvents($search),
        $request->query->getInt('page', 1),
        12
    );

        if(!$evenements){
           throw $this->createNotFoundException("Il n'y a pas d'événement") ;
        }
        
        return $this->render('pages/listeEvenements.html.twig',[
            "page_active"=>"evenements",
            'evenements'=>$evenements,
            'form'      =>$form->createView()
        ]);
    }
    
    
    
    /**
     * @Route("/evenements/{slug}-{id}",name="showEvenement", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function showAction(Evenements $event,string $slug, Request $request, ContactNotification $notification):Response
    {
        //$event=$this->getDoctrine()->getRepository(Evenements::class)->find($id); // parametres en entrée $slug, $id
        if(!$event){
           throw $this->createNotFoundException("L'evenement (N°: $id) n'existe pas") ;
        }

        if ($event->getSlug() !== $slug){
            return $this->redirectToRoute('showEvenement', [
                'id' => $event->getId(),
                'slug' =>$event->getSlug()
            ],301);
        }

        $contact=new Contact();
        $contact->setEvenement($event);
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $notification->notify($contact);
            $this->addFlash('success','Votre email a bien été envoyé');
            
            return $this->redirectToRoute('evenements',[
                'id'=> $event->getId()
            ]);
           
        }

        return $this->render('pages/showEvenement.html.twig',[
            "page_active"=>"evenements",
            'event'=>$event,
            'form'       => $form->createView()
        ]);
    }

} 