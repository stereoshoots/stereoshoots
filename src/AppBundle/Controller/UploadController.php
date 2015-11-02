<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Photo;
use AppBundle\Entity\File;
use AppBundle\Exception\FileException;

class UploadController extends Controller
{
    public function indexAction(Request $request)
    {
	$em = $this->getDoctrine()->getEntityManager();
	
	$user = $this->getUser();
	$photo = new Photo();

	$form = $this->createForm('app_photo_upload', $photo);
	
	$form->handleRequest($request);

	if($form->isValid()) {
	    $currentDate = new \DateTime();
	    $salt = uniqid();
	    
	    $extension = $form['name']->getData()->guessExtension();
	    
	    if(!in_array($extension, File::$extensions)) {
		throw new FileException('Недопустимое расширение', FileException::FILE_EXTENSION_DENIED);
	    }
	    
	    $photo->setUserId($user->getId());
	    $photo->setCreationDate($currentDate);
	    
	    $uploadPath = File::getImageUploadPath($user->getId(), $currentDate->format('Y-m-d'));
	    $photoName = sha1($user->getId().$currentDate->format('Y-m-d H:i:s').$salt).'.'.$extension;
	    
	    $photo->setName($photoName);
	    $form['name']->getData()->move($uploadPath, $photoName);
	    
	    $em->persist($photo);
	    $em->flush();
	    
	    return $this->redirect($this->generateUrl('process_photo', array('slug' => $photo->getId())));
	}
	
	return $this->render('AppBundle::upload.html.twig', array(
	    'form' => $form->createView()
	));
    }
}

