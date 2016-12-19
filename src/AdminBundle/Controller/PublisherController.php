<?php

namespace AdminBundle\Controller;

use ModelBundle\Entity\Publisher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Publisher controller.
 *
 * @Route("editeur")
 */
class PublisherController extends Controller
{
    /**
     * Lists all publisher entities.
     *
     * @Route("/", name="editeur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publishers = $em->getRepository('ModelBundle:Publisher')->findAll();

        return $this->render('AdminBundle/publisher/index.html.twig', array(
            'publishers' => $publishers,
        ));
    }

    /**
     * Creates a new publisher entity.
     *
     * @Route("/new", name="editeur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $publisher = new Publisher();
        $form = $this->createForm('ModelBundle\Form\PublisherType', $publisher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($publisher);
            $em->flush($publisher);

            return $this->redirectToRoute('editeur_show', array('id' => $publisher->getId()));
        }

        return $this->render('AdminBundle/publisher/new.html.twig', array(
            'publisher' => $publisher,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a publisher entity.
     *
     * @Route("/{id}", name="editeur_show")
     * @Method("GET")
     */
    public function showAction(Publisher $publisher)
    {
        $deleteForm = $this->createDeleteForm($publisher);

        return $this->render('AdminBundle/publisher/show.html.twig', array(
            'publisher' => $publisher,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing publisher entity.
     *
     * @Route("/{id}/edit", name="editeur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Publisher $publisher)
    {
        $deleteForm = $this->createDeleteForm($publisher);
        $editForm = $this->createForm('ModelBundle\Form\PublisherType', $publisher);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('editeur_edit', array('id' => $publisher->getId()));
        }

        return $this->render('AdminBundle/publisher/edit.html.twig', array(
            'publisher' => $publisher,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a publisher entity.
     *
     * @Route("/{id}", name="editeur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Publisher $publisher)
    {
        $form = $this->createDeleteForm($publisher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($publisher);
            $em->flush($publisher);
        }

        return $this->redirectToRoute('editeur_index');
    }

    /**
     * Creates a form to delete a publisher entity.
     *
     * @param Publisher $publisher The publisher entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Publisher $publisher)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('editeur_delete', array('id' => $publisher->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
