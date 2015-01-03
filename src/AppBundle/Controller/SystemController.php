<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use AppBundle\Entity\System;
use AppBundle\Form\SystemType;

class SystemController extends Controller
{
    /**
     * @Route("/system", name="system-index")
     * @Template("System/index.html.twig")
     */
    public function indexAction()
    {
    	$repository = $this->getDoctrine()->getRepository('AppBundle\Entity\System');
    	$systems = $repository->findAll();
        return ['systems' => $systems];
    }

    /**
	 * @Route("/system/{id}", name="system-show", requirements={"id": "\d+"})
     * @Template("System/show.html.twig")
	 */
	public function showAction(System $system)
	{
	    return ['system' => $system];
	}

    /**
     * @Route("/system/new", name="system-new")
     * @Template("System/new.html.twig")
     */
    public function newAction(Request $request)
    {
    	$system = new System();
    	$form = $this->createForm(new SystemType, $system);
    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($system);
    		$em->flush();

            $request->getSession()->getFlashBag()->add('success', 'System added.');
    		return $this->redirect($this->generateUrl('system-show', [
    			'id' => $system->getId()
    		]));
    	}

    	return $this->render('system/new.html.twig', [
    		'form' => $form->createView()
    	]);
    }

    /**
     * @Route("/system/{id}/edit", name="system-edit", requirements={"id": "\d+"})
     * @Template("System/edit.html.twig")
     */
    public function editAction(Request $request, System $system)
    {
    	$form = $this->createForm(new SystemType, $system);
    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($system);
    		$em->flush();

            $request->getSession()->getFlashBag()->add('info', 'System saved.');
    		return $this->redirect($this->generateUrl('system-show', [
    			'id' => $system->getId()
    		])); 
    	}

    	return $this->render('system/edit.html.twig', [
    		'form' => $form->createView()
    	]);
    }

    /**
     * @Route("/system/{id}/delete", name="system-delete", requirements={"id": "\d+"})
     */
    public function deleteAction(Request $request, System $system)
    {
    	$em = $this->getDoctrine()->getManager();
    	$em->remove($system);
    	$em->flush();
        $request->getSession()->getFlashBag()->add('info', 'System deleted.');
    	return $this->redirect($this->generateUrl('system-index'));
    }
}
