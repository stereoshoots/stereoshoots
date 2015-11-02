<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    public function indexAction(Request $request)
    {	
	$authChecker = $this->get('security.authorization_checker');

	if(!$authChecker->isGranted('ROLE_USER')) {
	    $formFactory = $this->get('fos_user.registration.form.factory');
	    
	    $form = $formFactory->createForm();

	    $csrfToken = $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue();
	    
	    return $this->render('AppBundle::index.html.twig', array(
		'form' => $form->createView(),
		'csrf_token' => $csrfToken
	    ));
	}
	
        return $this->render('AppBundle::index.html.twig');
    }
}

