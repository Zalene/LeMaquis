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
            $this->addFlash('success', 'Votre email a bien été envoyé');
            $contactNotification->notify($contact);
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
     * @Route("/mentions", name="mentions")
     */
    public function mentions()
    {
        return $this->render('maquis/mentions.html.twig');
    }
}
