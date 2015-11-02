<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{
    public function indexAction(Request $request, $username)
    {
	$em = $this->getDoctrine()->getManager();
	
	$user = $this->getUser();
	
	$userManager = $this->container->get('fos_user.user_manager');
	$profileUser = $userManager->findUserByUsername($username);
	
	if(!$profileUser) {
	    throw $this->createNotFoundException('Пользователь не найден');
	}

	$follow = $em->createQuery('
	    SELECT f
	    FROM AppBundle:Follower f
	    WHERE f.userId = :userId
	    AND f.followerId = :followerId
	')->setParameter('userId', $profileUser->getId())
	  ->setParameter('followerId', $user->getId())
	  ->getOneOrNullResult();
	
	return $this->render('AppBundle::profile.html.twig', array('user' => $profileUser, 'follow' => $follow));
    }
    
        
    public function followersAction(Request $request, $username)
    {	
	$em = $this->getDoctrine()->getManager();
	$userManager = $this->container->get('fos_user.user_manager');
	
	$user = $userManager->findUserByUsername($username);

	if(!$user) {
	    throw $this->createNotFoundException('Пользователь не найден');
	}
	
	
	return $this->render('AppBundle::followers.html.twig', array('followers' => $user->getFollowers()));
    }
    
    public function followingAction(Request $request, $username)
    {
	$em = $this->getDoctrine()->getManager();
	$userManager = $this->container->get('fos_user.user_manager');
	
	$user = $userManager->findUserByUsername($username);
	
	if(!$user) {
	    throw $this->createNotFoundException('Пользователь не найден');
	}
	
	return $this->render('AppBundle::following.html.twig', array('followings' => $user->getFollowings()));
    }
}

