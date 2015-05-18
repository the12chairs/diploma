<?php

namespace Diploma\BackOfficeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Diploma\BackOfficeBundle\Entity\Script;
use Diploma\BackOfficeBundle\Form\ScriptType;

/**
 * Script controller.
 *
 * @Route("/script")
 */
class ScriptController extends Controller
{

    /**
     * Lists all Script entities.
     *
     * @Route("/", name="script")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DiplomaBackOfficeBundle:Script')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Script entity.
     *
     * @Route("/", name="script_create")
     * @Method("POST")
     * @Template("DiplomaBackOfficeBundle:Script:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Script();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('script_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Script entity.
     *
     * @param Script $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Script $entity)
    {
        $form = $this->createForm(new ScriptType(), $entity, array(
            'action' => $this->generateUrl('script_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Script entity.
     *
     * @Route("/new", name="script_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Script();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Script entity.
     *
     * @Route("/{id}", name="script_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DiplomaBackOfficeBundle:Script')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Script entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Script entity.
     *
     * @Route("/{id}/edit", name="script_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DiplomaBackOfficeBundle:Script')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Script entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Script entity.
    *
    * @param Script $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Script $entity)
    {
        $form = $this->createForm(new ScriptType(), $entity, array(
            'action' => $this->generateUrl('script_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Script entity.
     *
     * @Route("/{id}", name="script_update")
     * @Method("PUT")
     * @Template("DiplomaBackOfficeBundle:Script:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DiplomaBackOfficeBundle:Script')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Script entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('script_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Script entity.
     *
     * @Route("/{id}", name="script_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DiplomaBackOfficeBundle:Script')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Script entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('script'));
    }

    /**
     * Creates a form to delete a Script entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('script_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
