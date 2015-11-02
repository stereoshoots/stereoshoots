<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Follower;
use AppBundle\Exception\FollowException;
use Symfony\Component\HttpFoundation\Response;

class FollowController extends Controller
{ 
    public function subscribeAction(Request $request)
    {
	$userId = $request->request->get('id');;
	
	$em = $this->getDoctrine()->getManager();
	$user = $this->getUser();
	
	$followedUser = $em->getRepository('AppBundle:User')->find($userId);
	
	if(!$followedUser) {
	    return new Response('user not exist');
	}
	
	$follow = $em->createQuery('
	    SELECT f
	    FROM AppBundle:Follower f
	    WHERE f.userId = :userId
	    AND f.followerId = :followerId
	')->setParameter('userId', $followedUser->getId())
	  ->setParameter('followerId', $user->getId())
	  ->getOneOrNullResult();
	
	if($follow) {
	    $follow->setActive(true);
	}
	else {
	    $follow = new Follower();
	    $follow->setUserId($followedUser->getId());
	    $follow->setFollowerId($user->getId());
	}
	
	$em->persist($follow);
	$em->flush();
	
	return new Response ('subscribed');
    }
    
    public function unsubscribeAction(Request $request)
    {
	$userId = $request->request->get('id');
	
	$em = $this->getDoctrine()->getManager();
	$user = $this->getUser();
	
	$followedUser = $em->getRepository('AppBundle:User')->find($userId);
	
	if(!$followedUser) {
	    return new Response('user not exist');
	}
	
	$follow = $em->createQuery('
	    SELECT f
	    FROM AppBundle:Follower f
	    WHERE f.userId = :userId
	    AND f.followerId = :followerId
	')->setParameter('userId', $followedUser->getId())
	  ->setParameter('followerId', $user->getId())
	  ->getOneOrNullResult();
	
	if(!$follow) {
	    return new Response ('system error');
	}
	
	$follow->setActive(false);
	
	$em->persist($follow);
	$em->flush();
	
	return new Response ('unsubscribed');
    }
}

