<?php

namespace App\Controller;

use App\Entity\Artiste;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Form\FormBuilder;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
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
        $repo = $this->getDoctrine()->getRepository(Artiste::class);

        $artistes = $repo->findAll();

        return $this->render('maquis/artistes.html.twig', [
            'artistes' => $artistes
        ]);
    }

    /**
     * @Route("/artistes/{id}", name="show_artiste")
     */
    public function showArtiste($id)
    {
        $repo = $this->getDoctrine()->getRepository(Artiste::class);

        $artiste = $repo->find($id);

        return $this->render('artistes/showArtiste.html.twig', [
            'artiste' => $artiste
        ]);
    }

    /**
     * @Route("/concerts", name="concerts")
     */
    public function concerts()
    {
        return $this->render('maquis/concerts.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contacts(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($contact);
            /*
            return $this->redirectToRoute();
            */
        }

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
}
