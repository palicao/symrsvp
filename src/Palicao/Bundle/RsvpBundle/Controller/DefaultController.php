<?php

namespace Palicao\Bundle\RsvpBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Palicao\Bundle\RsvpBundle\Entity\Contact;

class DefaultController extends Controller
{
    public function indexAction()
    {
        
        $replacements = array();
        for ($i = 0; $i < 10; $i++) {
          $replacements['palicao+'.$i.'@gmail.com'] = array(
            '{name}' => 'Name '.$i,
            '{message}' => 'Message '.$i
          );
        }
        $decorator = new \Swift_Plugins_DecoratorPlugin($replacements);
        
        $mailer = $this->get('mailer');
        $mailer->registerPlugin($decorator);
        
        for ($i = 0; $i < 10; $i++) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Ciao, {name}')
                ->setFrom('mittente@example.com')
                ->setTo('palicao+'.$i.'@gmail.com')
                ->setBody('{message}');
            $mailer->send($message);
        }
        
        return $this->render('PalicaoRsvpBundle:Default:index.html.twig');
    }
    
    public function insertContactAction($email) {
        $contact = new Contact();
        $contact->setEmail($email);
        
        
        $validator = $this->get('validator');
        $errors = $validator->validate($contact);
        
        if (count($errors) == 0) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
        } else {
            print_r($errors);
        }
        
        return new Response('Created contact id '.$contact->getId(). ' with email '. $contact->getEmail());
        
    }
    
    /*
    public function addParamsAction() {
        
        $contact = new Contact();
        $contact->email = 'piopio@piopio.com';
        
        $group = new ContactGroup();
        $group->name = 'PioPio Group';
        
    }
     * 
     */
}
