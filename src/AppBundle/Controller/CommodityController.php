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
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT c, d
            FROM AppBundle\Entity\Category c
            JOIN c.commodities d
            ORDER BY c.name ASC, d.name ASC'
        );
        $categories = $query->getResult();
        return ['categories' => $categories];
    }

    /**
     * @Route("/commodity/{id}", name="commodity-show", requirements={"id": "\d+"})
     * @Template("Commodity/show.html.twig")
     */
    public function showAction(Commodity $commodity)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
            FROM AppBundle\Entity\Posting p
            WHERE p.commodity = :commodity
            AND p.sell > 0
            ORDER BY p.sell DESC'
        )->setParameter('commodity', $commodity);
        $demand = $query->getResult();
        $query = $em->createQuery(
            'SELECT p
            FROM AppBundle\Entity\Posting p
            WHERE p.commodity = :commodity
            AND p.buy > 0
            ORDER BY p.buy ASC'
        )->setParameter('commodity', $commodity);
        $supply = $query->getResult();
        return ['commodity' => $commodity, 'demand' => $demand, 'supply' => $supply];
    }

    /**
     * @Route("/commodity/new", name="commodity-new")
     * @Template("Commodity/new.html.twig")
     */
    public function newAction(Request $request)
    {
        $commodity = new Commodity();
        $form = $this->createForm(new CommodityType, $commodity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commodity);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Commodity added.');
            return $this->redirect($this->generateUrl('commodity-index'));
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

            $request->getSession()->getFlashBag()->add('info', 'Commodity saved.');
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
        $request->getSession()->getFlashBag()->add('info', 'Commodity deleted.');
        return $this->redirect($this->generateUrl('commodity-index'));
    }
}
