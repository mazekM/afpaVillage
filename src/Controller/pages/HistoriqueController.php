<?php
namespace App\Controller\pages;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class HistoriqueController extends AbstractController
{


    /**
     * @Route("/pages/historique", name="historique")
     */
    public function historiqueAction() {
            return $this->render('pages/historique.html.twig',[
                "page_active" => "historique"
            ]);
    }
}