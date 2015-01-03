<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use AppBundle\Entity\Commodity;
use AppBundle\Form\CommodityType;

class CommodityController extends Controller
{
    /**
     * @Route("/commodity", name="commodity-index")
     * @Template("Commodity/index.html.twig")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle\Entity\Commodity');
        $commodities = $repository->findAll();
        return ['commodities' => $commodities];
    }

    /**
     * @Route("/commodity/{id}", name="commodity-show", requirements={"id": "\d+"})
     * @Template("Commodity/show.html.twig")
     */
    public function showAction(Commodity $commodity)
    {
        return ['commodity' => $commodity];
    }

    /**
     * @Route("/commodity/new", name="commodity-new")
     * @Template("Commodity/new.html.twig")
     */
    public function newAction(Request $request, $station_id)
    {
        $commodity = new Commodity();
        $form = $this->createForm(new CommodityType, $commodity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commodity);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Commodity added.');
            return $this->redirect($this->generateUrl('commodity-show', [
                'id' => $commodity->getId()
            ]));
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/commodity/{id}/edit", name="commodity-edit", requirements={"id": "\d+"})
     * @Template("Commodity/edit.html.twig")
     */
    public function editAction(Request $request, Commodity $commodity)
    {
        $form = $this->createForm(new CommodityType, $commodity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commodity);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'commodity saved.');
            return $this->redirect($this->generateUrl('commodity-show', [
                'id' => $commodity->getId()
            ])); 
        }

        return $this->render('commodity/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/commodity/{id}/delete", name="commodity-delete", requirements={"id": "\d+"})
     */
    public function deleteAction(Request $request, Commodity $commodity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($commodity);
        $em->flush();
        $request->getSession()->getFlashBag()->add('info', 'commodity deleted.');
        return $this->redirect($this->generateUrl('commodity-index'));
    }
}
