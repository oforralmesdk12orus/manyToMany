<?php

namespace Mesd\ManyToManyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Mesd\ManyToManyBundle\Entity\Thing;
use Mesd\ManyToManyBundle\Form\ThingType;

/**
 * Thing controller.
 *
 */
class ThingController extends Controller
{

    /**
     * Lists all Thing entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MesdManyToManyBundle:Thing')->findAll();

        return $this->render('MesdManyToManyBundle:Thing:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Thing entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Thing();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('thing_show', array('id' => $entity->getId())));
        }

        return $this->render('MesdManyToManyBundle:Thing:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Thing entity.
     *
     * @param Thing $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Thing $entity)
    {
        $form = $this->createForm(new ThingType(), $entity, array(
            'action' => $this->generateUrl('thing_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Thing entity.
     *
     */
    public function newAction()
    {
        $entity = new Thing();
        $form   = $this->createCreateForm($entity);

        return $this->render('MesdManyToManyBundle:Thing:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Thing entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdManyToManyBundle:Thing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Thing entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MesdManyToManyBundle:Thing:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Thing entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdManyToManyBundle:Thing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Thing entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MesdManyToManyBundle:Thing:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Thing entity.
    *
    * @param Thing $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Thing $entity)
    {
        $form = $this->createForm(new ThingType(), $entity, array(
            'action' => $this->generateUrl('thing_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Thing entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MesdManyToManyBundle:Thing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Thing entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('thing_edit', array('id' => $id)));
        }

        return $this->render('MesdManyToManyBundle:Thing:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Thing entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MesdManyToManyBundle:Thing')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Thing entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('thing'));
    }

    /**
     * Creates a form to delete a Thing entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('thing_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
