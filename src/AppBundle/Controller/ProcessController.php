<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Photo;
use AppBundle\Entity\PhotoEffect;
use AppBundle\Exception\PhotoException;
use Imagick;

class ProcessController extends Controller
{
    public function indexAction(Request $request, $slug)
    {
	$em = $this->getDoctrine()->getManager();
	$user = $this->getUser();
	$photo = $em->getRepository('AppBundle:Photo')->find($slug);
	
	if(!$photo) {
	    throw new PhotoException('Фотография не найдена', PhotoException::PHOTO_NOT_FOUND);
	}
	
	if($photo->getUserId() != $user->getId()) {
	   throw new PhotoException('Фотография не ваша', PhotoException::PHOTO_IS_NOT_YOURS);
	}
	
	if($photo->getProcessDate()) {
	    throw new PhotoException('Фотография уже опубликована', PhotoException::PHOTO_ALREADY_PROCESSED);
	}
	
	$photoEffects = new PhotoEffect();
	
	$form = $this->createForm('app_photo_process', $photo);
	
	$form->handleRequest($request);
	
	if($form->isValid()) {
	    $currentDate = new \DateTime();
	    
	    $photo->setTitle($form['title']->getData());
	    $photo->setDescription($form['title']->getData());
	    $photo->setProcessDate($currentDate);
	    
	    $em->flush();
	    
	    return $this->redirectToRoute('fos_user_profile_show');
	}

	return $this->render('AppBundle::process.html.twig', array(
	    'form' => $form->createView(),
	    'photo' => $photo
	));
    }
}

