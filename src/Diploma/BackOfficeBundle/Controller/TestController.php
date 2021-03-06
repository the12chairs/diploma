<?php

namespace Diploma\BackOfficeBundle\Controller;

use Diploma\BackOfficeBundle\Entity\TestResult;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Diploma\BackOfficeBundle\Entity\Test;
use Diploma\BackOfficeBundle\Form\TestType;
use Diploma\BackOfficeBundle\Form\TestRunType;
/**
 * Test controller.
 *
 * @Route("/test")
 */
class TestController extends Controller
{

    /**
     * Lists all Test entities.
     *
     * @Route("/", name="test")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DiplomaBackOfficeBundle:Test')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Test run.
     *
     * @Route("/", name="test_run")
     * @Method("GET")
     * @Template("DiplomaBackOfficeBundle:Test:run.html.twig")
     */
    public function runAction(Request $request)
    {
        $testId = $request->get('id', null);

        $em = $this->getDoctrine()->getManager();

        $test = $em->getRepository('DiplomaBackOfficeBundle:Test')->find($testId);
        $form = $this->createForm(new TestRunType($em), null, array(
            'test' => $test
        ));

        return array(
            'form' => $form->createView(),
            'test' => $test,
        );
    }

    /**
     * Handle test form.
     *
     * @Route("/", name="test_handle")
     * @Method("POST")
     * @Template("DiplomaBackOfficeBundle:Test:run.html.twig")
     */
    public function handleAction(Request $request)
    {
        $result = new TestResult();

        $testId = $request->get('id', null);

        $em = $this->getDoctrine()->getManager();

        $test = $em->getRepository('DiplomaBackOfficeBundle:Test')->find($testId);


        $form = $this->createForm(new TestRunType($em), null, array(
            'test' => $test
        ));

        $form->handleRequest($request);

        if ($form->isValid()) {


            $data = $form->getData();

            $testPoints = 0;

            foreach($data as $question) {

                $isRight = true;

                if(sizeof($question) == 0) {
                    $isRight = false;
                }
                foreach($question as $variant) {

                    if(!$variant->isRight()) {
                        $isRight = false;
                    }
                }

                if($isRight) {
                    $testPoints++;
                }
            }

            $result->setUser($this->getUser());
            $result->setTest($test);


            $result->setPoints($testPoints);

            $em = $this->getDoctrine()->getManager();
            $em->persist($result);
            $em->flush();

            return $this->render('DiplomaBackOfficeBundle:Test:results.html.twig', array(
                'test' => $test,
                'testPoints' => $testPoints,
                'answers' => $data
            ));
        }

        return $this->redirect($this->generateUrl('test_show', array('id' => $test->getId())));
    }

    /**
     * Creates a new Test entity.
     *
     * @Route("/", name="test_create")
     * @Method("POST")
     * @Template("DiplomaBackOfficeBundle:Test:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Test();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Test entity.
     *
     * @param Test $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Test $entity)
    {
        $form = $this->createForm(new TestType(), $entity, array(
            'action' => $this->generateUrl('test_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Test entity.
     *
     * @Route("/new", name="test_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Test();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Test entity.
     *
     * @Route("/{id}", name="test_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DiplomaBackOfficeBundle:Test')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Test entity.
     *
     * @Route("/{id}/edit", name="test_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DiplomaBackOfficeBundle:Test')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
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
    * Creates a form to edit a Test entity.
    *
    * @param Test $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Test $entity)
    {
        $form = $this->createForm(new TestType(), $entity, array(
            'action' => $this->generateUrl('test_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Test entity.
     *
     * @Route("/{id}", name="test_update")
     * @Method("PUT")
     * @Template("DiplomaBackOfficeBundle:Test:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DiplomaBackOfficeBundle:Test')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('test_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Test entity.
     *
     * @Route("/{id}", name="test_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DiplomaBackOfficeBundle:Test')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Test entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('test'));
    }

    /**
     * Creates a form to delete a Test entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('test_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
