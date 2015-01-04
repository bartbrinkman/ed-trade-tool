<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use AppBundle\Entity\Posting;
use AppBundle\Form\PostingType;

class PostingController extends Controller
{
    /**
     * @Route("/posting", name="posting-index")
     * @Template("Posting/index.html.twig")
     */
    public function indexAction()
    {
    	$repository = $this->getDoctrine()->getRepository('AppBundle\Entity\Posting');
    	$postings = $repository->findAll();
        return ['postings' => $postings];
    }

    /**
	 * @Route("/posting/{id}", name="posting-show", requirements={"id": "\d+"})
     * @Template("Posting/show.html.twig")
	 */
	public function showAction(Posting $posting)
	{
	    return ['posting' => $posting];
	}

    /**
     * @Route("/posting/new/{station_id}", name="posting-new", defaults={"station_id": 0})
     * @Template("Posting/new.html.twig")
     */
    public function newAction(Request $request, $station_id)
    {
    	$posting = new Posting();
        $posting
            ->setStation($this->findStation($station_id))
            ->setSell(0)
            ->setBuy(0)
            ->setDemand(0)
            ->setSupply(0)
        ;
    	$form = $this->createForm(new PostingType, $posting);
    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($posting);
    		$em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Posting added.');
    		return $this->redirect($this->generateUrl('station-show', [
    			'id' => $posting->getStation()->getId()
    		]));
    	}

    	return $this->render('posting/new.html.twig', [
    		'form' => $form->createView()
    	]);
    }

    protected function findStation($id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle\Entity\Station');
        $station = $repository->findOneById($id);
        return $station;
    }

    /**
     * @Route("/posting/{id}/edit", name="posting-edit", requirements={"id": "\d+"})
     * @Template("Posting/edit.html.twig")
     */
    public function editAction(Request $request, Posting $posting)
    {
    	$form = $this->createForm(new PostingType, $posting);
    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($posting);
    		$em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Posting saved.');
    		return $this->redirect($this->generateUrl('posting-show', [
    			'id' => $posting->getId()
    		])); 
    	}

    	return $this->render('posting/edit.html.twig', [
    		'form' => $form->createView()
    	]);
    }

    /**
     * @Route("/posting/patch/{id}", name="posting-patch", defaults={"id": 0})
     */
    public function patchAction(Request $request, Posting $posting)
    {
        $form = $this->createForm(new PostingType(), $posting, ['csrf_protection' => false]);
        
        foreach($form as $element) {
            if (!isset($request->request->get('posting')[$element->getName()])) {
                $form->remove($element->getName());
            }
        }

        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($posting);
            $em->flush();
            return new JsonResponse([
                'success' => true, 
                'posting' => [
                    'sell' => $posting->getSell(),
                    'buy' => $posting->getBuy(),
                    'demand' => $posting->getDemand(),
                    'supply' => $posting->getSupply()
                ]]);
        }

        return new JsonResponse(['success' => false, 'error' => $form->getErrorsAsString()]);
    }

    /**
     * @Route("/posting/{id}/delete", name="posting-delete", requirements={"id": "\d+"})
     */
    public function deleteAction(Request $request, Posting $posting)
    {
    	$em = $this->getDoctrine()->getManager();
    	$em->remove($posting);
    	$em->flush();
        $request->getSession()->getFlashBag()->add('info', 'Posting deleted.');
    	return $this->redirect($this->generateUrl('posting-index'));
    }
}
