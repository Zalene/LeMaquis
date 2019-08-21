<?php

namespace App\Controller;

use App\Entity\Artiste;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\AlbumRepository;
use App\Repository\ArtisteRepository;
use App\Repository\ConcertRepository;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MaquisController extends AbstractController
{
    /** 
     *@Route("/", name="home")
     */
    public function home(AlbumRepository $repoAl, ArtisteRepository $repoA, ConcertRepository $repoC, Request $request, ContactNotification $contactNotification)
    {
        $artistes = $repoA->findAll();
        $concerts = $repoC->findAll();
        $albums = $repoAl->findAll();

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /*dd($contact);*/
            $contactNotification->notify($contact);
            /*
            return $this->redirectToRoute();
            */
        }

        return $this->render('maquis/home.html.twig', [
            'controller_name' => 'MaquisController',
            'artistes' => $artistes,
            'concerts' => $concerts,
            'albums' => $albums,
            'contactForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/albums", name="albums")
     */
    public function albums(AlbumRepository $repo)
    {
        $albums = $repo->findAll();

        return $this->render('maquis/albums.html.twig', [
            'albums' => $albums
        ]);
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
    public function artistes(ArtisteRepository $repo)
    {
        $artistes = $repo->findAll();

        return $this->render('maquis/artistes.html.twig', [
            'artistes' => $artistes
        ]);
    }

    /**
     * @Route("/artistes/{id}", name="show_artiste")
     */
    public function showArtiste(Artiste $artiste)
    {
        return $this->render('artistes/showArtiste.html.twig', [
            'artiste' => $artiste
        ]);
    }


    /**
     * @Route("/concerts", name="concerts")
     */
    public function concerts(ConcertRepository $repo)
    {
        $concerts = $repo->findAll();

        return $this->render('maquis/concerts.html.twig', [
            'concerts' => $concerts
        ]);
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
}
