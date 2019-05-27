<?php
namespace App\Controller\pages;

/**
 * Description of ContactController
 *
 * @author Stagiaire
 */
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\ContactType;
use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use App\Notification\ContactNotification;


class ContactController Extends AbstractController
{

    /**
         * @Route("/contact",name="contact")
         */
        public function showAction(Request $request, ContactNotification $notification):Response
        {
            $contact=new Contact();
            $form = $this->createForm(ContactType::class,$contact);
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
                $notification->notify($contact);
                $this->addFlash('success','Votre email a bien été envoyé');
                
                return $this->redirectToRoute('accueil');
               
            }
    
            return $this->render('emails/contact.html.twig',[
                "page_active"=>"contact",
                'form'       => $form->createView()
            ]);
        }
    
    } 