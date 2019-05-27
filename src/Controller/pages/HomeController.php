<?php
namespace App\Controller\pages;

/**
 * Description of VillageController
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

class HomeController Extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function indexAction() {
           
        return $this->render('pages/accueil.html.twig',[
                "page_active" => "accueil"
            ]);
    }

    /**
     * @Route ("/lang/{lang}", name="langue")
     */
    public function langue (Request $request, string $lang)
    {
        $request->getSession()->set("_locale",$lang);
        return $this->redirectToRoute('accueil');
        
    }
}
