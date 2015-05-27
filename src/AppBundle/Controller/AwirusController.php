<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Awirus;
use AppBundle\Form\AwirusType;

/**
 * Awirus controller.
 *
 * @Route("/admin/awirus")
 */
class AwirusController extends Controller
{

    /**
     * Lists all Awirus entities.
     *
     * @Route("/", name="admin_awirus")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Awirus')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Awirus entity.
     *
     * @Route("/", name="admin_awirus_create")
     * @Method("POST")
     * @Template("AppBundle:Awirus:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Awirus();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_awirus_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Awirus entity.
     *
     * @param Awirus $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Awirus $entity)
    {
        $form = $this->createForm(new AwirusType(), $entity, array(
            'action' => $this->generateUrl('admin_awirus_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Awirus entity.
     *
     * @Route("/new", name="admin_awirus_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Awirus();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Awirus entity.
     *
     * @Route("/{id}", name="admin_awirus_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Awirus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Awirus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Awirus entity.
     *
     * @Route("/{id}/edit", name="admin_awirus_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Awirus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Awirus entity.');
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
    * Creates a form to edit a Awirus entity.
    *
    * @param Awirus $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Awirus $entity)
    {
        $form = $this->createForm(new AwirusType(), $entity, array(
            'action' => $this->generateUrl('admin_awirus_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Awirus entity.
     *
     * @Route("/{id}", name="admin_awirus_update")
     * @Method("PUT")
     * @Template("AppBundle:Awirus:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Awirus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Awirus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_awirus_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Awirus entity.
     *
     * @Route("/{id}", name="admin_awirus_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Awirus')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Awirus entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_awirus'));
    }

    /**
     * Creates a form to delete a Awirus entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_awirus_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
