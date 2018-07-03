<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index(AuthorizationCheckerInterface $authChecker)
    {
        if ($authChecker->isGranted('ROLE_USER') === true) {
            $repository = $this->getDoctrine()->getRepository(User::class);
            return $this->render('home/index.html.twig', [
                'users' => $repository->findAll(),
                'controller_name' => 'HomeController',
            ]);
        }
        return $this->render('frontpage/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
