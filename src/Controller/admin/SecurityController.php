<?php
namespace App\Controller\admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController{
    
    /**
     * @Route("/login",name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils){
        $error=$authenticationUtils->getLastAuthenticationError();
        $lastUsername=$authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig',[
            "page_active"=>"login",'last_username'=>$lastUsername,'error'=>$error]);
    }

}