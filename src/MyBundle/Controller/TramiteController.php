<?php

namespace MyBundle\Controller;

use MyBundle\Entity\Tramite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MyBundle\Entity\Document;
use MyBundle\Form\TramiteType;
use MyBundle\Form\searchType;
use Biblioteca\UserBundle\Entity\usuario as User;
use Symfony\Component\Validator\Constraints\NotBlank as NotBlankConstraint;
use Symfony\Component\Form\FormError;

/**
 * Tramite controller.
 *
 * @Route("tramite")
 */
class TramiteController extends Controller
{
    /**
     * Lists all tramite entities.
     *
     * @Route("/", name="tramite_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tramites = $em->getRepository('MyBundle:Tramite')->findAll();

        return $this->render('tramite/index.html.twig', array(
            'tramites' => $tramites,
        ));
    }

    /**
     * Creates a new tramite entity.
     *
     * @Route("/new", name="tramite_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tramite = new Tramite();
        $form = $this->createForm('MyBundle\Form\TramiteType', $tramite);
        $form->handleRequest($request);

        /*$notBlankConstraint = new NotBlankConstraint();
        $notBlankConstraint->message = 'Por favor, debe cargar un archivo PDF.';
        foreach ($tramite->getRecaudos() as $key => $recaudo) {
            $errors = $this->get('validator')->validateValue(
                $tramite->getRecaudos()->get($key)->getFile(),
                $notBlankConstraint );   
                foreach ($errors as $error) {
                    $form->get('recaudos')->addError( new FormError("Para el Capítulo ".($key + 1)." , debe cargar un archivo PDF."));
                }
            }*/

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tramite);

            foreach ($tramite->getRecaudos() as $actualRecaudo) {  
                $actualRecaudo->setTramite($tramite);
            }

            $em->flush();

            return $this->redirectToRoute('tramite_show', array('id' => $tramite->getId()));
        }

        return $this->render('tramite/new.html.twig', array(
            'tramite' => $tramite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tramite entity.
     *
     * @Route("/{id}", name="tramite_show")
     * @Method("GET")
     */
    public function showAction(Tramite $tramite)
    {
        $deleteForm = $this->createDeleteForm($tramite);

        return $this->render('tramite/show.html.twig', array(
            'tramite' => $tramite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tramite entity.
     *
     * @Route("/{id}/edit", name="tramite_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tramite $tramite)
    {
        $deleteForm = $this->createDeleteForm($tramite);
        $editForm = $this->createForm('MyBundle\Form\TramiteType', $tramite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tramite_edit', array('id' => $tramite->getId()));
        }

        return $this->render('tramite/edit.html.twig', array(
            'tramite' => $tramite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tramite entity.
     *
     * @Route("/{id}", name="tramite_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tramite $tramite)
    {
        $form = $this->createDeleteForm($tramite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tramite);
            $em->flush();
        }

        return $this->redirectToRoute('tramite_index');
    }

    /**
     * Creates a form to delete a tramite entity.
     *
     * @param Tramite $tramite The tramite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tramite $tramite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tramite_delete', array('id' => $tramite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
