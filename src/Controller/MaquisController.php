<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MaquisController extends AbstractController
{
    /** 
     *@Route("/", name="home")
     */
    public function home()
    {
        return $this->render('maquis/home.html.twig', [
            'controller_name' => 'MaquisController',
        ]);
    }

    /**
     * @Route("/albums", name="albums")
     */
    public function albums()
    {
        return $this->render('maquis/albums.html.twig');
    }

    /**
     * @Route("/studio", name="studio")
     */
    public function studio()
    {
        return $this->render('maquis/studio.html.twig');
    }

    /**
     * @Route("/artistes", name="artistes")
     */
    public function artistes()
    {
        return $this->render('maquis/artistes.html.twig');
    }

    /**
     * @Route("/concerts", name="concerts")
     */
    public function concerts()
    {
        return $this->render('maquis/concerts.html.twig');
    }

    /**
     * @Route("/contacts", name="contacts")
     */
    public function contacts()
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        return $this->render('maquis/contacts.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return $this->render('maquis/admin.html.twig');
    }

    /**
     * @Route("/yanuzi", name="yanuzi")
     */
    public function yanuzi()
    {
        return $this->render('artistes/yanuzi.html.twig');
    }

    /**
     * @Route("/mrAbitbol", name="mrAbitbol")
     */
    public function mrAbitbol()
    {
        return $this->render('artistes/mrAbitbol.html.twig');
    }

    /**
     * @Route("/godhiva", name="godhiva")
     */
    public function godhiva()
    {
        return $this->render('artistes/godhiva.html.twig');
    }

    /**
     * @Route("/beatnik", name="beatnik")
     */
    public function beatnik()
    {
        return $this->render('artistes/beatnik.html.twig');
    }
}
