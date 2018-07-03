<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Tweet;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Method;

class TweetController extends Controller
{
    /**
     * @Route("/{username}/tweets", name="tweets")
     */
    public function userTweets($username)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneBy(['username' => $username]);
        $tweets = [];
        foreach ($user->getTweets() as $tweet) {
            array_push($tweets, json_decode($tweet->serialize()));
        }
        
        $response = new JsonResponse($tweets, $status = 200, $headers = []);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/tweet", name="postTweet")
     */
    public function postTweet(Security $security, Request $request)
    {
        $user = $security->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $params = json_decode($request->getContent(), true);
        
        $tweet = new Tweet();
        $tweet->setUserId($user->getId());
        $tweet->setUser($user);
        $tweet->setBody($params['body']);
        $tweet->setCreatedAt(new DateTime);
        
        $entityManager->persist($tweet);
        $entityManager->flush();

        $response = new JsonResponse($tweet->serialize(), $status = 201, $headers = [], $json = true);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/tweet/{id}", name="deleteTweet")
     */
    public function deleteTweet($id, Security $security, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Tweet::class);
        $tweet = $repository->find($id);
        if ($tweet->getUser()->getUsername() === $security->getUser()->getUsername()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tweet);
            $entityManager->flush();
            return new JsonResponse([], $status = 204);
        }
        return new JsonResponse(['message' => 'You do not have correct permission'], $status = 401);
    }
}
