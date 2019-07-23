<?php

namespace App\Controller;

use App\Entity\Artiste;
use App\Entity\Contact;
use App\Form\ArtisteType;
use App\Form\ContactType;
use App\Repository\ArtisteRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
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
    public function artistes(ArtisteRepository $repo)
    {
        $artistes = $repo->findAll();

        return $this->render('maquis/artistes.html.twig', [
            'artistes' => $artistes
        ]);
    }

    /**
     * @Route("/artistes/new", name="artiste_create")
     */
    public function createArtistes(Request $request, ObjectManager $manager)
    {
        $artiste = new Artiste();

        $form = $this->createForm(ArtisteType::class, $artiste);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($artiste);
            $manager->flush();

            return $this->redirectToRoute('show_artiste', ['id' => $artiste->getId()]);
        }

        return $this->render('admin/artistesAdmin.html.twig', [
            'formArtiste' => $form->createView(),
            'editMode' => $artiste->getId() !==null
        ]);
    }

    /**
     * @Route("/artistes/{id}/edit", name="artiste_edit")
     */
    public function editArtistes(Artiste $artiste, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(ArtisteType::class, $artiste);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($artiste);
            $manager->flush();

            return $this->redirectToRoute('show_artiste', ['id' => $artiste->getId()]);
        }

            return $this->render('admin/artistesAdmin.html.twig', [
            'formArtiste' => $form->createView(),
            'editMode' => $artiste->getId() !==null
        ]);
    }

    /**
     * @Route("/artistes/{id}/delete", name="artiste_delete")
     */
    public function deleteArtistes(Artiste $artiste, ObjectManager $manager)
    {
        $manager->remove($artiste);
        $manager->flush();

        return $this->redirectToRoute('admin');
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
    public function admin(ArtisteRepository $repo)
    {
        $artistes = $repo->findAll();

        return $this->render('admin/admin.html.twig', [
            'artistes' => $artistes
        ]);
    }
}
