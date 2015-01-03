<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use AppBundle\Entity\Station;
use AppBundle\Form\StationType;

class StationController extends Controller
{
    /**
     * @Route("/station", name="station-index")
     * @Template("Station/index.html.twig")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle\Entity\Station');
        $stations = $repository->findAll();
        return ['stations' => $stations];
    }

    /**
     * @Route("/station/{id}", name="station-show", requirements={"id": "\d+"})
     * @Template("Station/show.html.twig")
     */
    public function showAction(Station $station)
    {
        return ['station' => $station];
    }

    /**
     * @Route("/station/new/{system_id}", name="station-new", defaults={"system_id" = 0})
     * @Template("Station/new.html.twig")
     */
    public function newAction(Request $request, $system_id)
    {
        $station = new Station();
        $station->setSystem($this->findSystem($system_id));
        $form = $this->createForm(new StationType, $station);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($station);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Station added.');
            return $this->redirect($this->generateUrl('station-show', [
                'id' => $station->getId()
            ]));
        }

        return $this->render('station/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    protected function findSystem($id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle\Entity\System');
        $system = $repository->findOneById($id);
        return $system;
    }

    /**
     * @Route("/station/{id}/edit", name="station-edit", requirements={"id": "\d+"})
     * @Template("Station/edit.html.twig")
     */
    public function editAction(Request $request, Station $station)
    {
        $form = $this->createForm(new StationType, $station);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($station);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Station saved.');
            return $this->redirect($this->generateUrl('station-show', [
                'id' => $station->getId()
            ])); 
        }

        return $this->render('station/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/station/{id}/delete", name="station-delete", requirements={"id": "\d+"})
     */
    public function deleteAction(Request $request, Station $station)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($station);
        $em->flush();
        $request->getSession()->getFlashBag()->add('info', 'Station deleted.');
        return $this->redirect($this->generateUrl('station-index'));
    }
}
