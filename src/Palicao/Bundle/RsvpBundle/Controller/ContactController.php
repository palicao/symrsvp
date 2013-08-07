<?php

namespace Palicao\Bundle\RsvpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Palicao\Bundle\RsvpBundle\Entity\Contact;
use Palicao\Bundle\RsvpBundle\Form\Type\ContactType;
use Palicao\Bundle\RsvpBundle\Form\Type\ContactFilterType;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * Contact controller.
 *
 * @Route("/contact")
 */
class ContactController extends Controller
{
    /**
     * Lists all Contact entities.
     *
     * @Route("/", name="contact")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new ContactFilterType());
        if (!is_null($response = $this->saveFilter($form, 'contact', 'contact'))) {
            return $response;
        }

        $qb = $em->getRepository('PalicaoRsvpBundle:Contact')->createQueryBuilder('c');
        $paginator = $this->filter($form, $qb, 'contact');
        

        return array(
            'form' => $form->createView(),
            'paginator' => $paginator,
        );
    }

    /**
     * Finds and displays a Contact entity.
     *
     * @Route("/{id}/show", name="contact_show")
     * @Template()
     */
    public function showAction(Contact $contact)
    {
        $deleteForm = $this->createDeleteForm($contact->getId());

        return array(
            'contact' => $contact,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Contact entity.
     *
     * @Route("/new", name="contact_new")
     * @Template()
     */
    public function newAction()
    {
        $contact = new Contact();
        $form   = $this->createForm(new ContactType(), $contact);

        return array(
            'contact' => $contact,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Contact entity.
     *
     * @Route("/create", name="contact_create")
     * @Method("POST")
     * @Template("PalicaoRsvpBundle:Contact:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(new ContactType(), $contact);

        if ($form->bind($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return $this->redirect($this->generateUrl('contact_show', array('id' => $contact->getId())));
        }

        return array(
            'contact' => $contact,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Contact entity.
     *
     * @Route("/{id}/edit", name="contact_edit")
     * @Template()
     */
    public function editAction(Contact $contact)
    {
        $editForm = $this->createForm(new ContactType(), $contact);
        $deleteForm = $this->createDeleteForm($contact->getId());

        return array(
            'contact' => $contact,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Contact entity.
     *
     * @Route("/{id}/update", name="contact_update")
     * @Method("POST")
     * @Template("PalicaoRsvpBundle:Contact:edit.html.twig")
     */
    public function updateAction(Contact $contact)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($contact->getId());
        $editForm = $this->createForm(new ContactType(), $contact);
        if ($editForm->bind($this->getRequest())->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('contact_edit', array('id' => $contact->getId())));
        }

        return array(
            'contact' => $contact,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }


    /**
     * Save order.
     *
     * @Route("/order/{field}/{type}", name="contact_sort")
     */
    public function sortAction($field, $type)
    {
        $this->setOrder('contact', $field, $type);

        return $this->redirect($this->generateUrl('contact'));
    }

    /**
     * @param string $name   session name
     * @param sting  $field  field name
     * @param sting  $type   sort type ("ASC"/"DESC")
     */
    protected function setOrder($name, $field, $type = 'ASC')
    {
        $this->getRequest()->getSession()->set('sort.' . $name, compact('field', 'type'));
    }

    /**
     * @param  string $name
     * @return string
     */
    protected function getOrder($name)
    {
        $session = $this->getRequest()->getSession();

        return $session->has('sort.' . $name) ? $session->get('sort.' . $name) : null;
    }

    /**
     * @param QueryBuilder $qb
     * @param string       $name
     */
    protected function addQueryBuilderSort(QueryBuilder $qb, $name)
    {
        $alias = current($qb->getDQLPart('from'))->getAlias();
        if (is_array($order = $this->getOrder($name))) {
            $qb->orderBy($alias . '.' . $order['field'], $order['type']);
        }
    }
    /**
     * Save filters
     *
     * @param  FormInterface $form
     * @param  string        $name        route/entity name
     * @param  string        $route       route name, if different from entity name
     * @param  array         $params      possible route parameters
     * @return Response
     */
    protected function saveFilter(FormInterface $form, $name, $route = null, array $params = null)
    {
        $request = $this->getRequest();
        $url = is_null($route) ? $this->generateUrl($name) : $this->generateUrl($route, is_null($params) ? array() : $params);
        if ($request->query->has('submit-filter') && $form->bind($request)->isValid()) {
            $request->getSession()->set('filter.' . $name, $request->query->get($form->getName()));

            return $this->redirect($url);
        } elseif ($request->query->has('reset-filter')) {
            $request->getSession()->set('filter.' . $name, null);

            return $this->redirect($url);
        }
    }

    /**
     * Filter form
     *
     * @param  FormInterface  $form
     * @param  QueryBuilder   $qb
     * @return SlidingPagination
     */
    protected function filter(FormInterface $form, QueryBuilder $qb, $name)
    {
        if (!is_null($values = $this->getFilter($name))) {
            if ($form->bind($values)->isValid()) {
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $qb);
            }
        }

        // possible sorting
        $this->addQueryBuilderSort($qb, $name);
        return $this->get('knp_paginator')->paginate($qb->getQuery(), $this->getRequest()->query->get('page', 1), 20);
    }

    /**
     * Get filters from session
     *
     * @param  string $name
     * @return array
     */
    protected function getFilter($name)
    {
        return $this->getRequest()->getSession()->get('filter.' . $name);
    }
    /**
     * Deletes a Contact entity.
     *
     * @Route("/{id}/delete", name="contact_delete")
     * @Method("POST")
     */
    public function deleteAction(Contact $contact)
    {
        $form = $this->createDeleteForm($contact->getId());
        if ($form->bind($this->getRequest())->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contact);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contact'));
    }

    /**
     * Create Delete form
     *
     * @param integer $id
     * @return FormBuilder
     */
    protected function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
