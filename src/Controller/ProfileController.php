<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;

class ProfileController extends Controller
{
    /**
     * @Route("/user/{username}", name="userProfile")
     */
    public function userProfile($username)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneBy(['username' => $username]);
        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'controller_name' => 'ProfileController',
        ]);
    }
    
    /**
     * @Route("/profile", name="loggedInProfile")
     */
    public function show(Security $security)
    {
        return $this->render('profile/index.html.twig', [
            'user' => $security->getUser(),
            'controller_name' => 'ProfileController',
        ]);
    }
}
