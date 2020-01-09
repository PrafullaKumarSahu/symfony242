<?php

namespace Me\EventBundle\Controller;

use Me\EventBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{
    //throws execeptions
    private function enforceUserSecurity()
    {
        $securityContext = $this->container->get('security.context');
        if ( ! $securityContext->isGranted('ROLE_USER') ) {
            throw new AccessDeniedException('Need ROLE_USER!');
        }
    }
    /**
     * Lists all event entities.
     * 
     * @Template("")
     * @Route("/", name="events")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('EventBundle:Event')->findAll();

        return $this->render('EventBundle:event:index.html.twig', array(
            'events' => $events,
        ));
    }

    /**
     * Creates a new event entity.
     *
     */
    public function newAction(Request $request)
    {
        $this->enforceUserSecurity();
        $event = new Event();
        $form = $this->createForm('Me\EventBundle\Form\EventType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('event_show', array('id' => $event->getId()));
        }

        return $this->render('event/new.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     */
    public function showAction(Event $event)
    {
        $deleteForm = $this->createDeleteForm($event);

        return $this->render('event/show.html.twig', array(
            'event' => $event,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     */
    public function editAction(Request $request, Event $event)
    {
        $this->enforceUserSecurity();
        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('Me\EventBundle\Form\EventType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_edit', array('id' => $event->getId()));
        }

        return $this->render('event/edit.html.twig', array(
            'event' => $event,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a event entity.
     *
     */
    public function deleteAction(Request $request, Event $event)
    {
        $this->enforceUserSecurity();
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
        }

        return $this->redirectToRoute('event_index');
    }

    /**
     * Creates a form to delete a event entity.
     *
     * @param Event $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Event $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('event_delete', array('id' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
