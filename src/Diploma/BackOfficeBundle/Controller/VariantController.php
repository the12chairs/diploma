<?php

namespace Diploma\BackOfficeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Diploma\BackOfficeBundle\Entity\QuestionVariant;
use Diploma\BackOfficeBundle\Form\QuestionVariantType;

/**
 * QuestionVariant controller.
 *
 * @Route("/variant")
 */
class VariantController extends Controller
{

    /**
     * Lists all QuestionVariant entities.
     *
     * @Route("/", name="variant")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DiplomaBackOfficeBundle:QuestionVariant')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new QuestionVariant entity.
     *
     * @Route("/", name="variant_create")
     * @Method("POST")
     * @Template("DiplomaBackOfficeBundle:Variant:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new QuestionVariant();

        $em = $this->getDoctrine()->getManager();

        $id = $request->get('questionId', null);

        $entity = new QuestionVariant();
        $form = $this->createForm(new QuestionVariantType(), $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_show', array('id' => $entity->getQuestion()->getTest()->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a QuestionVariant entity.
     *
     * @param QuestionVariant $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(QuestionVariant $entity)
    {
        $form = $this->createForm(new QuestionVariantType(), $entity, array(
            'action' => $this->generateUrl('variant_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new QuestionVariant entity.
     *
     * @Route("/new", name="variant_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $id = $request->get('questionId', null);

        $question = $em->getRepository('DiplomaBackOfficeBundle:Question')->find($id);

        $entity = new QuestionVariant();
        $form = $this->createForm(new QuestionVariantType(), $entity, array(
            'question' => $question,
        ));

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'testId' => $question->getTest()->getId()
        );
    }

    /**
     * Finds and displays a QuestionVariant entity.
     *
     * @Route("/{id}", name="variant_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DiplomaBackOfficeBundle:QuestionVariant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuestionVariant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing QuestionVariant entity.
     *
     * @Route("/{id}/edit", name="variant_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DiplomaBackOfficeBundle:QuestionVariant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuestionVariant entity.');
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
    * Creates a form to edit a QuestionVariant entity.
    *
    * @param QuestionVariant $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(QuestionVariant $entity)
    {
        $form = $this->createForm(new QuestionVariantType(), $entity, array(
            'action' => $this->generateUrl('variant_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing QuestionVariant entity.
     *
     * @Route("/{id}", name="variant_update")
     * @Method("PUT")
     * @Template("DiplomaBackOfficeBundle:QuestionVariant:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DiplomaBackOfficeBundle:QuestionVariant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuestionVariant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('variant_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a QuestionVariant entity.
     *
     * @Route("/{id}", name="variant_delete")
     * @Method("DELETE")
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('DiplomaBackOfficeBundle:QuestionVariant')->find($id);

        $testId = $entity->getQuestion()->getTest()->getId();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuestionVariant entity.');
        }

        $em->remove($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('test_show', array('id' => $testId)));
    }

    /**
     * Creates a form to delete a QuestionVariant entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('variant_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
