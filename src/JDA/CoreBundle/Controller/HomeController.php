<?php

namespace JDA\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    
    
    
    public function redirectAction(){
    	
  	
		return $this->redirect($this->generateUrl('home',array(),true),302);
    		
    }
    
    public function indexAction()
    {
    
    	$locale=$this->getRequest()->getLocale();
    	//If search query posted, redirect to search page and pass search query as url hash
    	$user = $this->get('security.context')->getToken()->getUser();
    	
    	if(is_object($user)){
    		$displayName = $user->getDisplayName();
    		$userId = $user->getId();
    	}
    	else{
    		$displayName='none';
    		$userId=0;	
    	}

    	
    	
    	
    	$request = $this->getRequest();
    	if($request->request->get('search-text')) return $this->redirect(sprintf('%s#%s', $this->generateUrl('search',array('_locale'=>$locale)), 'text='.$request->request->get('search-text')));
   
    	return $this->render('JDACoreBundle:Home:home.html.twig', array(
					// last displayname entered by the user
					'page'=> 'home',
					'displayname'=>$displayName,
					'userId'=>$userId,
					
				));
    
    }
}
